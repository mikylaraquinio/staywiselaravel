<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\MailMessage;

class BookingAcceptedNotification extends Notification
{
    use Queueable;

    protected $booking;

    public function __construct($booking)
    {
        $this->booking = $booking;
    }

    public function via($notifiable)
    {
        return ['mail', 'database'];
    }

    public function toMail($notifiable)
    {
        return (new MailMessage)
                    ->subject('Your Booking Has Been Accepted')
                    ->greeting('Hello ' . $notifiable->name . ',')
                    ->line('We are pleased to inform you that your booking for room ID ' . $this->booking->room_title . ' has been accepted.')
                    ->action('View My Bookings', url('/renter/status'))
                    ->line('Thank you for using our service!');
    }

    public function toDatabase($notifiable)
    {
        return [
            'message' => 'Your booking for room ID ' . $this->booking->room_id . ' has been accepted.',
            'booking_id' => $this->booking->id,
            'accepted_at' => now(),
        ];
    }
}
