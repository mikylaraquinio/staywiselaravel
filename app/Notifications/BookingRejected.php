<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\MailMessage;

class BookingRejected extends Notification
{
    use Queueable;

    protected $booking;

    public function __construct($booking)
    {
        $this->booking = $booking;
    }

    public function via($notifiable)
    {
        return ['mail', 'database']; // Adjust the channels as needed
    }

    public function toMail($notifiable)
    {
        return (new MailMessage)
                    ->subject('Booking Rejected')
                    ->line('Your booking has been rejected.')
                    ->action('View Bookings', url('/bookings'))
                    ->line('Thank you for using our application!');
    }

    public function toArray($notifiable)
    {
        return [
            'booking_id' => $this->booking->id,
            // Add other relevant data here
        ];
    }
}

