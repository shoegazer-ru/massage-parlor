<?php

namespace App\Frontend\Components\Products;

use App\Components\ModelProvider\Interfaces\ModelProviderComponentInterface;
use App\Frontend\Components\Products\Interfaces\ProductsComponentInterface;
use App\Frontend\Components\Products\Models\ListItem;
use App\Frontend\Components\Products\Models\ListWidget;
use App\Models\File;

class ProductsComponent implements ProductsComponentInterface
{
    /**
     * @var ModelProviderComponentInterface
     */
    private ModelProviderComponentInterface $modelProvider;

    public function __construct(ModelProviderComponentInterface $modelProvider)
    {
        $this->modelProvider = $modelProvider;
    }
    /**
     * @return ListWidget
     */
    public function getListWidget(int $sectionId): ListWidget
    {
        $subsections = $this->modelProvider->getList('section', [
            'filter' => [
                'parent_id' => $sectionId
            ]
        ]);

        if ($subsections) {
            $sectionIds = $this->modelProvider->getModelsField($subsections, 'id');
            $sectionIds[] = $sectionId;
        } else {
            $sectionIds = [$sectionId];
        }

        $publications = $this->modelProvider->getList(
            'publication',
            [
                'filter' => ['section_id' => $sectionIds]
            ],
            [
                ModelProviderComponentInterface::FILES
            ]
        );

        return new ListWidget(
            $this->buildPublications($publications)
        );
    }

    /* HELPERS */

    /**
     * @param array $providerModels
     * 
     * @return array
     */
    protected function buildPublications(array $providerModels): array
    {
        $list = [];

        foreach ($providerModels as $providerModel) {
            $image = null;
            if ($providerModel->references[ModelProviderComponentInterface::FILES][File::TYPE_IMAGE] ?? null) {
                $image = reset($providerModel->references[ModelProviderComponentInterface::FILES][File::TYPE_IMAGE]);
            }
            $list[] = new ListItem(
                $providerModel->model->id,
                $providerModel->model->caption,
                $providerModel->model->annotation ?: '',
                __('frontend.products.list.moreLabel'),
                __('frontend.products.list.basketLabel'),
                $image
            );
        }

        return $list;
    }
}
