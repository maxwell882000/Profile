<?php

namespace App\Excel\Tenders;

use App\Models\User;
use App\Repositories\TenderRepository;

class TenderExcelRepo extends TenderRepository
{
    public function getUser($tenderData)
    {
        return User::findOrFail($tenderData['user_id']);
    }

    protected function dateFormat(): string
    {
        return 'd.m.Y';
    }
}