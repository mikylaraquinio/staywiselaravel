<?php

namespace App\Exports;

use App\Models\Booking;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class AcceptedBookingsExport implements FromCollection, WithHeadings
{
    public function collection()
    {
        // Fetch all approved bookings along with the related room data
        return Booking::where('approved', true) // Assuming `approved` is the column name
            ->with('room') // Eager load related room data
            ->get()
            ->map(function ($booking) {
                return [
                    'ID' => $booking->id,
                    'Room Title' => $booking->room ? $booking->room->room_title : 'Room not found',
                    'Guest Name' => $booking->name,
                    'Move-In Date' => $booking->move_in_date,
                    'Move-Out Date' => $booking->move_out_date,
                    'Occupants' => $booking->number_of_occupants,
                    'Request' => $booking->message
                ];
            });
    }

    public function headings(): array
    {
        return [
            'ID',
            'Room Title',
            'Guest Name',
            'Move-In Date',
            'Move-Out Date',
            'Occupants',
            'Request',
        ];
    }
}

