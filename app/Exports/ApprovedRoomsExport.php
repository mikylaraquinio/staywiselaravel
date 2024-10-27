<?php

namespace App\Exports;

use App\Models\Room;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class ApprovedRoomsExport implements FromCollection, WithHeadings
{
    public function collection()
    {
        return Room::where('approved', true)->select('room_title', 'description', 'price', 'amenities', 'room_type', 'image')->get();
    }

    public function headings(): array
    {
        return [
            'Room Title',
            'Description',
            'Price',
            'Amenities',
            'Room Type',
            'Image'
        ];
    }
}

