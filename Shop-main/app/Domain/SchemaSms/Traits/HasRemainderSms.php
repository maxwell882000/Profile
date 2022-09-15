<?php

namespace App\Domain\SchemaSms\Traits;

use App\Domain\Installment\Entities\TakenCredit;
use App\Domain\SchemaSms\Entities\SchemaSmsInstallment;

trait HasRemainderSms
{
    use HasSendSms;

    protected TakenCredit $taken_credit;

    final  protected function getSms()
    {
        $this->sms = SchemaSmsInstallment::remainder()->first();
    }

}
