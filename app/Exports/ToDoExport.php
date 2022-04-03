<?php

namespace App\Exports;

use App\Models\Todo;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\FromCollection;

class ToDoExport implements FromCollection
{
    private string $status;

    public function __construct(string $status)
    {
        $this->status = $status;
    }

    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        if($this->status === 'all') {
            return Todo::all();
        }

        return Todo::where('status', $this->status)
            ->get();

    }
}
