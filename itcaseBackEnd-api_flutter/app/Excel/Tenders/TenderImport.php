<?php

namespace App\Excel\Tenders;

use App\Models\HandbookCategory;
use App\Models\Tender;
use App\Repositories\TenderRepository;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithUpserts;

class TenderImport implements ToModel
{

    public function model(array $row)
    {
        if ($row[0] == "title" || !$row[0]) {
            return null;
        }
        $repo = new TenderExcelRepo();
        $repo->create(collect([
            'title' => $row[0],
            'description' => $row[1],
            'budget' => $row[2],
            'deadline' => $row[3],
            "links" => $row[4],
            "additional_info" => $row[5],
            "other_info" => $row[6],
            "work_start_at" => $row[7],
            "work_end_at" => $row[8],
            "geo_location" => $row[9],
            "remote" => $row[10],
            "place" => $row[11],
            "categories" => $row[12],
            "user_id" => $row[13],
            'client_phone_number' => $row[14],
            'google_file' => $row[15]
        ]));
    }

}