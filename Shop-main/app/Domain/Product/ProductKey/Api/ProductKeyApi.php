<?php

namespace App\Domain\Product\ProductKey\Api;

use App\Domain\Product\ProductKey\Entities\ProductKey;

class ProductKeyApi extends ProductKey
{
    public function toArray()
    {
        return [
            "id" => $this->id,
            "text" => $this->getTextCurrentAttribute(),
            "values" => $this->pivot->toArray() ?? null,
        ];
    }

}
