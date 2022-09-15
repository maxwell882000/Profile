<?php

namespace App\Domain\Core\Front\Admin\Button\ModelInCompelationTime;

use App\Domain\Core\Front\Admin\Button\Traits\GenerateTagAttributes;

class RedButtonCompile extends BaseButtonCompile
{
    static public function new($name, $attributes = [])
    {
        $standard = [
            'class' => "bg-red-600 hover:bg-red-400"
        ];
        return parent::new($name, self::append($standard, $attributes)); // TODO: Change the autogenerated stub
    }
}
