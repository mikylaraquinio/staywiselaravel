<?php

namespace App\Exports;

use App\Models\Owner;
use Maatwebsite\Excel\Concerns\FromCollection;

class ApprovedOwnersExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Owner::where('approved', true)->get();
    }

    public function headings(): array
    {
        return [
            'Name',
            'Contact Number',
            'Email',
            'ID',
            'ID Image',
        ];
    }
}
