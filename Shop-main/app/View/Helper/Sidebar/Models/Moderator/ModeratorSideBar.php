<?php

namespace App\View\Helper\Sidebar\Models\Moderator;


use App\Domain\Product\Product\Front\Moderator\Path\ModeratorProductRouteHandler;
use App\View\Helper\Sidebar\Interfaces\SideBarFactoryInterface;
use App\View\Helper\Sidebar\Items\SideBarList;

class ModeratorSideBar implements SideBarFactoryInterface
{

    static public function sideBars()
    {
        return new SideBarList([
            new \SideBarList([
                new \SideBarDrop(__("Товары"), ModeratorProductRouteHandler::new()),
//                new \SideBarDrop(__("Лента"), LentaRouteHandler::new())
            ], __("Действия для товаров"),
                "fa-tshirt"),
        ]);
    }
}
