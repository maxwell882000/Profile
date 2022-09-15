<?php

namespace App\View\Helper\Sidebar\Models\Shop;

use App\View\Helper\Sidebar\Interfaces\SideBarFactoryInterface;
use App\View\Helper\Sidebar\Items\SideBarList;

class ShopSideBar implements SideBarFactoryInterface
{

    static public function sideBars()
    {
        return new SideBarList([

        ]);
    }
}
