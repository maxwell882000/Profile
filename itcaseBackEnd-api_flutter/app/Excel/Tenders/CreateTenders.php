<?php

namespace App\Excel\Tenders;

use Maatwebsite\Excel\Facades\Excel;

class CreateTenders
{
    public function create()
    {
        Excel::import(new TenderImport(), public_path("TemplateTender.xlsx"));
    }
}