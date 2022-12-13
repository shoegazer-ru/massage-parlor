<?php

namespace App\Frontend\Components\Menu;

use App\Frontend\Components\Menu\Interfaces\MenuComponentInterface;
use App\Frontend\Components\Menu\Models\MenuWidget;
use App\Repositories\SectionRepository;

class MenuComponent implements MenuComponentInterface
{
    /**
     * @var SectionRepository
     */
    protected SectionRepository $sectionRepository;

    public function __construct(
        SectionRepository $sectionRepository
    ) {
        $this->sectionRepository = $sectionRepository;
    }

    /**
     * @return MenuWidget
     */
    public function getMenuWidget(): MenuWidget
    {
        $sections = $this->sectionRepository->getList([
            'parent_id' => null
        ]);
        $widget = new MenuWidget($sections);

        return $widget;
    }
}
