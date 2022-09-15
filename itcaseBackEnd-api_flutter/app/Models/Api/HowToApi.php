<?php

namespace App\Models\Api;

use App\Models\Howto;
use Illuminate\Support\Facades\Storage;

class HowToApi extends Howto
{
    protected $table = "howtos";

    public function toArray()
    {
        return [
            "url" => $this->url,
            "image" => url($this->getImage()),
        ];
    }
}