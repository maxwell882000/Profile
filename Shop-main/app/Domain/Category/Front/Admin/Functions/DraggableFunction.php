<?php

namespace App\Domain\Category\Front\Admin\Functions;

use App\Domain\Category\Entities\Category;
use App\Domain\Core\Front\Admin\Livewire\Functions\Abstracts\AbstractFunction;
use Illuminate\Support\Facades\DB;

class DraggableFunction extends AbstractFunction
{
    const FUNCTION_NAME = "reorder";

    // 1  3
    static function reorder($livewire, int $start_order, int $end_order)
    {
        $category = Category::where('order', $start_order)->first();
        if ($start_order > $end_order) {
            DB::table('categories')->where('order', ">=", $end_order)
                ->where('order', "<", $start_order)->update([
                    'order' => DB::raw("`categories`.`order` + 1")
                ]);
        } else {
            DB::table('categories')->where("order", "<=", $end_order)
                ->where('order', ">", $start_order)
                ->update([
                    'order' => DB::raw("`categories`.`order` - 1")
                ]);
        }
        $category->order = $end_order;
        $category->save();
    }
}
