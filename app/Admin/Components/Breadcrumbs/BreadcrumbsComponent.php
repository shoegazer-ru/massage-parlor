<?php

namespace App\Admin\Components\Breadcrumbs;

use App\Admin\Components\Breadcrumbs\Interfaces\BreadcrumbsComponentInterface;
use App\Admin\Components\Breadcrumbs\Models\BreadcrumbsWidget;
use App\Admin\Components\Common\Models\Link;
use App\Exceptions\AdminModelNotFoundException;
use App\Repositories\RepositoryProvider;

class BreadcrumbsComponent implements BreadcrumbsComponentInterface
{
    protected RepositoryProvider $repositoryProvider;

    public function __construct(
        RepositoryProvider $repositoryProvider
    ) {
        $this->repositoryProvider = $repositoryProvider;
    }

    /**
     * @return BreadcrumbsWidget
     */
    public function getMainBreadcrumbs(): BreadcrumbsWidget
    {
        $links = $this->getMainLinks();

        return new BreadcrumbsWidget($links);
    }

    /**
     * @param string $modelName
     * @param array|null $params
     * 
     * @return BreadcrumbsWidget
     */
    public function getModelListBreadcrumbs(string $modelName, ?array $params = null): BreadcrumbsWidget
    {
        $links = $this->getModelListLinks($modelName, $params);

        return new BreadcrumbsWidget($links);
    }

    /**
     * @param string $modelName
     * 
     * @return BreadcrumbsWidget
     */
    public function getModelEditorBreadcrumbs(string $modelName, int $modelId): BreadcrumbsWidget
    {
        $links = $this->getModelListItemLinks($modelName, $modelId);

        $links[] = new Link(
            __('admin.breadcrumbs.editor'),
            route('model.edit', ['modelName' => $modelName, 'modelId' => $modelId])
        );

        return new BreadcrumbsWidget($links);
    }

    /**
     * @param string $modelName
     * @param array|null $params
     * 
     * @return BreadcrumbsWidget
     */
    public function getModelCreatorBreadcrumbs(string $modelName, ?array $params = null): BreadcrumbsWidget
    {
        $links = $this->getModelListLinks($modelName, $params);

        $links[] = new Link(
            __('admin.breadcrumbs.creator'),
            route('model.create', ['modelName' => $modelName])
        );

        return new BreadcrumbsWidget($links);
    }

    /**
     * @param string $modelName
     * @param int $modelId
     * 
     * @return BreadcrumbsWidget
     */
    public function getModelDeletorBreadcrumbs(string $modelName, int $modelId): BreadcrumbsWidget
    {
        $links = $this->getModelListItemLinks($modelName, $modelId);

        $links[] = new Link(
            __('admin.breadcrumbs.deletor'),
            route('model.delete', ['modelName' => $modelName, 'modelId' => $modelId])
        );

        return new BreadcrumbsWidget($links);
    }

    /**
     * @return BreadcrumbsWidget
     */
    public function getAuthBreadcrumbs(): BreadcrumbsWidget
    {
        $links = $this->getMainLinks();

        $links[] = new Link(
            __('admin.breadcrumbs.auth'),
            route('login')
        );

        return new BreadcrumbsWidget($links);
    }



    /**
     * @param string $fieldName
     * 
     * @return BreadcrumbsWidget
     */
    public function getFieldsListBreadcrumbs(string $fieldName): BreadcrumbsWidget
    {
        $links = $this->getFieldsListLinks($fieldName);

        return new BreadcrumbsWidget($links);
    }

    /**
     * @param string $fieldName
     * @param int|null $fieldId
     * 
     * @return BreadcrumbsWidget
     */
    public function getFieldEditorBreadcrumbs(string $fieldName, ?int $fieldId = null): BreadcrumbsWidget
    {
        $links = $this->getFieldsListLinks($fieldName);

        $links[] = new Link(
            __('admin.breadcrumbs.editor'),
            route('field.edit', ['fieldName' => $fieldName, 'modelId' => $fieldId])
        );

        return new BreadcrumbsWidget($links);
    }

    /**
     * @param string $fieldName
     * @param int $fieldId
     * 
     * @return BreadcrumbsWidget
     */
    public function getFieldDeletorBreadcrumbs(string $fieldName, int $fieldId): BreadcrumbsWidget
    {
        $links = $this->getFieldsListLinks($fieldName);

        $links[] = new Link(
            __('admin.breadcrumbs.deletor'),
            route('field.delete', ['fieldName' => $fieldName, 'modelId' => $fieldId])
        );

        return new BreadcrumbsWidget($links);
    }

    /* HELPERS */

    /**
     * @return Link[]
     */
    protected function getMainLinks(): array
    {
        return [
            new Link(
                __('admin.breadcrumbs.main'),
                route('dashboard')
            )
        ];
    }

    /**
     * @param string $modelName
     * @param array|null $params
     * 
     * @return array
     */
    protected function getModelListLinks(string $modelName, ?array $params = null): array
    {
        $links = $this->getMainLinks();

        $context = config('admin.breadcrumbs.models.' . $modelName . '.context');
        if ($context) {
            $repository = $this->repositoryProvider->getRepository($context['model']);
            $contextItem = $repository->getItem(['id' => $params[$context['field']]]);
            if (!$contextItem) {
                throw new AdminModelNotFoundException(__('admin.messages.model.context.not-found'));
            }
            $links[] = new Link(
                $contextItem->getCaption(),
                route('model.list', ['modelName' => $context['model']])
            );
        }

        $routeParams = ['modelName' => $modelName];
        if ($context) {
            $routeParams[$context['field']] = $params[$context['field']];
        }

        $links[] = new Link(
            __('admin.models.' . $modelName . '.name-plural'),
            route('model.list', $routeParams)
        );

        return $links;
    }

    /**
     * @param string $modelName
     * @param int $modelId
     * 
     * @return array
     */
    protected function getModelListItemLinks(string $modelName, int $modelId): array
    {
        $links = $this->getMainLinks();
        $routeParams = ['modelName' => $modelName];

        $context = config('admin.breadcrumbs.models.' . $modelName . '.context');
        if ($context) {
            $repository = $this->repositoryProvider->getRepository($modelName);
            $item = $repository->getItem(['id' => $modelId]);
            $contextRepository = $this->repositoryProvider->getRepository($context['model']);
            $contextItem = $contextRepository->getItem(['id' => $item->getAttribute($context['field'])]);
            if (!$contextItem) {
                throw new AdminModelNotFoundException(__('admin.messages.model.context.not-found'));
            }
            $links[] = new Link(
                $contextItem->getCaption(),
                route('model.list', ['modelName' => $context['model']])
            );

            $routeParams[$context['field']] = $item->getAttribute($context['field']);
        }

        $links[] = new Link(
            __('admin.models.' . $modelName . '.name-plural'),
            route('model.list', $routeParams)
        );

        return $links;
    }

    /**
     * @param string $fieldName
     * 
     * @return Link[]
     */
    protected function getFieldsListLinks(string $fieldName): array
    {
        $links = $this->getMainLinks();

        $links[] = new Link(
            __('admin.fields.' . $fieldName . '.name-plural'),
            route('fields.list', ['fieldName' => $fieldName])
        );

        return $links;
    }
}
