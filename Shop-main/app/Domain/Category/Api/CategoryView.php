<?php

namespace App\Domain\Category\Api;

class CategoryView extends CategoryInMain
{
    public function toArray()
    {
        return [
            "id" => $this->id,
            "name" => $this->getNameCurrentAttribute(),
            "slug" => $this->slug,
            "depth" => $this->depth,
            "image" => $this->icon->image->fullPath(),
        ];
    }
}
