<?php

namespace App\Domain\Delivery\Builders;

use App\Domain\Core\Main\Builders\BuilderEntity;

class AvailableCityBuilder extends BuilderEntity
{
  public function filterBy($filter)
  {
      return parent::filterBy($filter); // TODO: Change the autogenerated stub
  }

    protected function getSearch(): string
    {
        return "cityName";
    }
}
