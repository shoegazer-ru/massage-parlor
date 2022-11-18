<?php

namespace App\Admin\Components\Breadcrumbs\Interfaces;

use App\Admin\Components\Breadcrumbs\Models\BreadcrumbsWidget;

interface BreadcrumbsComponentInterface
{
    /**
     * @return BreadcrumbsWidget
     */
    public function getMainBreadcrumbs(): BreadcrumbsWidget;

    /**
     * @param string $modelName
     * @param array|null $params
     * 
     * @return BreadcrumbsWidget
     */
    public function getModelListBreadcrumbs(string $modelName, ?array $params = null): BreadcrumbsWidget;

    /**
     * @param string $modelName
     * @param int $modelId
     * 
     * @return BreadcrumbsWidget
     */
    public function getModelEditorBreadcrumbs(string $modelName, int $modelId): BreadcrumbsWidget;

    /**
     * @param string $modelName
     * @param array|null $params
     * 
     * @return BreadcrumbsWidget
     */
    public function getModelCreatorBreadcrumbs(string $modelName, ?array $params = null): BreadcrumbsWidget;

    /**
     * @param string $modelName
     * @param int $modelId
     * 
     * @return BreadcrumbsWidget
     */
    public function getModelDeletorBreadcrumbs(string $modelName, int $modelId): BreadcrumbsWidget;

    /**
     * @return BreadcrumbsWidget
     */
    public function getAuthBreadcrumbs(): BreadcrumbsWidget;

    /**
     * @param string $fieldName
     * 
     * @return BreadcrumbsWidget
     */
    public function getFieldsListBreadcrumbs(string $fieldName): BreadcrumbsWidget;

    /**
     * @param string $fieldName
     * @param int|null $fieldId
     * 
     * @return BreadcrumbsWidget
     */
    public function getFieldEditorBreadcrumbs(string $fieldName, ?int $fieldId = null): BreadcrumbsWidget;

    /**
     * @param string $fieldName
     * @param int $fieldId
     * 
     * @return BreadcrumbsWidget
     */
    public function getFieldDeletorBreadcrumbs(string $fieldName, int $fieldId): BreadcrumbsWidget;
}
