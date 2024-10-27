<?php

namespace App\Exports;

use App\Models\Owner;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class ApprovedOwnersExport implements FromCollection, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        // Select only the fields you want to export
        return Owner::where('approved', true)
            ->get(['id as Owner_ID', 'name as Name', 'number as Contact_Number', 'email as Email', 'identification as Identification', 'image as ID_Image']);
    }

    public function headings(): array
    {
        return [
            'Owner_ID',
            'Name',
            'Contact Number',
            'Email',
            'Identification',
            'ID Image',
        ];
    }
}
