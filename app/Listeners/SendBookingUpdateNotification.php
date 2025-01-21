<?php

namespace App\Listeners;

use App\Events\BookingUpdated;
use App\Mail\BookingCancelledMail;
use App\Mail\BookingConfirmed;
use App\Mail\BookingReScheduleMail;
use App\Mail\NotifyManualBookingGeneratedMail;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Mail;

class SendBookingUpdateNotification {
    /**
     * Create the event listener.
     */
    public function __construct() {
    }

    /**
     * Handle the event.
     */
    public function handle(BookingUpdated $event): void {
        $booking = $event->booking;
        $action = $event->action;
        $dataset = $event->dataset;

        $admin = 'srik51977@gmail.com';
        // dd($booking);
        // Send notification to the user
        switch ($action) {
            case 'created':
                Mail::to($booking->user->email)
                    ->cc($admin)
                    ->send(new BookingConfirmed($booking));
                break;
            case 'rescheduled':
                Mail::to($booking->user->email)
                    ->cc($admin)
                    ->send(new BookingReScheduleMail($booking));
                break;

            case 'payment':
                Mail::to($dataset['email'])
                    ->cc($admin)
                    ->send(new NotifyManualBookingGeneratedMail($dataset));
                break;

            case 'cancelled':
                Mail::to($booking->user->email)
                    ->cc($admin)
                    ->send(new BookingCancelledMail($booking));
                break;
            default:
                break;
        }
    }
}
