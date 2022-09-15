<?php

namespace App\Domain\Core\Main\Builders\Traits;

use Illuminate\Support\Facades\DB;

trait HasProductSearch
{
    public function byProductSearch($search)
    {
        return $this->joinProduct()->where(DB::raw("UPPER(title)"), "LIKE", "%" . mb_strtoupper($search) . "%")->distinct();
//        return $this->joinProduct()->whereRaw("lower(products.title) like ?", ['%"' . app()->getLocale() . '":"' . strtolower($search) . '%']);
    }
}
