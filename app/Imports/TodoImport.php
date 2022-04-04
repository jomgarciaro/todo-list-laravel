<?php

namespace App\Imports;

use App\Models\Todo;
use Illuminate\Database\Eloquent\Model;
use Maatwebsite\Excel\Concerns\ToModel;

class TodoImport implements ToModel
{
    public function model(array $row): Model
    {
        return new Todo([
            'title' => $row[0],
            'description' => $row[1],
            'status' => $row[2],
        ]);
    }
}
