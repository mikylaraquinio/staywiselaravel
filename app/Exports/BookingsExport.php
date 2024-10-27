<?php

namespace App\Exports;

use App\Models\Booking;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class BookingsExport implements FromCollection, WithHeadings
{
    public function collection()
    {
        // Fetch the bookings for the authenticated renter
        return Booking::where('renter_id', Auth::id())
            ->with('room') // Load related room data
            ->get()
            ->map(function ($booking) {
                return [
                    'Room Title' => $booking->room ? $booking->room->room_title : 'No Room Assigned',
                    'Name' => $booking->name,
                    'Move In Date' => $booking->move_in_date,
                    'Move Out Date' => $booking->move_out_date,
                    'Number of Occupants' => $booking->number_of_occupants,
                    'Status' => $this->getStatus($booking),
                ];
            });
    }

    public function headings(): array
    {
        return [
            'Room Title',
            'Name',
            'Move In Date',
            'Move Out Date',
            'Number of Occupants',
            'Status',
        ];
    }

    private function getStatus($booking)
    {
        if ($booking->approved == 1) {
            return 'Approved';
        } elseif ($booking->approved == 2) {
            return 'Rejected';
        }
        return 'Pending';
    }
}
