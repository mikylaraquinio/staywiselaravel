<?php

// In app/Exports/BookinsExport.php

namespace App\Exports;

use App\Models\Booking;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class OBookingsExport implements FromCollection, WithHeadings
{
    public function collection()
    {
        // Fetch all bookings along with the related room data
        return Booking::with('room')->get()->map(function ($booking) {
            return [
                'Room Title' => $booking->room ? $booking->room->room_title : 'Room not found',
                'Guest Name' => $booking->name,
                'Move-In Date' => $booking->move_in_date,
                'Move-Out Date' => $booking->move_out_date,
                'Occupants' => $booking->number_of_occupants,
                'Message' => $booking->message,
            ];
        });
    }

    public function headings(): array
    {
        return [
            'Room Title',
            'Guest Name',
            'Move-In Date',
            'Move-Out Date',
            'Occupants',
            'Message',
        ];
    }
}

