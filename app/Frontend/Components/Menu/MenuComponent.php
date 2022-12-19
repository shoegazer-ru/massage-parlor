<?php

namespace App\Frontend\Components\Menu;

use App\Components\ModelProvider\Interfaces\ModelProviderComponentInterface;
use App\Frontend\Components\Menu\Interfaces\MenuComponentInterface;
use App\Frontend\Components\Menu\Models\MenuWidget;

class MenuComponent implements MenuComponentInterface
{
    /**
     * @var ModelProviderComponentInterface
     */
    protected ModelProviderComponentInterface $modelProvider;

    public function __construct(
        ModelProviderComponentInterface $modelProvider
    ) {
        $this->modelProvider = $modelProvider;
    }

    /**
     * @return MenuWidget
     */
    public function getMenuWidget(): MenuWidget
    {
        $sections = $this->modelProvider->getList('section', [
            'filter' => ['parent_id' => null]
        ]);

        $widget = new MenuWidget($sections);

        return $widget;
    }
}
