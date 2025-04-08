<?php

namespace App\Listeners;

use App\Events\BookingUpdated;
use App\Mail\BookingCancelledMail;
use App\Mail\BookingConfirmed;
use App\Mail\BookingReScheduleMail;
use App\Mail\NotifyManualBookingGeneratedMail;
use App\Message\BookingCancelledMessage;
use App\Message\BookingConfirmedMessage;
use App\Message\BookingRescheduledMessage;
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
        $_mobile = '9150067320';

        switch ($action) {

            case 'created':



                /**
                 * send Message
                 */
                netty()->send(new BookingConfirmedMessage($booking))->to($booking->user->mobile, $_mobile);





                /**
                 * Send Mail
                 */
                Mail::to($booking->user->email)
                    ->bcc([$admin, 'opscoimbatore@valamcars.com'])
                    ->send(new BookingConfirmed($booking));

                break;




            case 'rescheduled':




                /**
                 * send Message
                 */
                netty()->send(new BookingRescheduledMessage($booking))->to($booking->user->mobile, $_mobile);





                /**
                 * Send Mail
                 */
                Mail::to($booking->user->email)
                    ->bcc([$admin, 'opscoimbatore@valamcars.com'])
                    ->send(new BookingReScheduleMail($booking));




                break;




            case 'payment':





                /**
                 * Send Mail
                 */
                Mail::to($dataset['email'])
                    ->bcc([$admin, 'opscoimbatore@valamcars.com'])
                    ->send(new NotifyManualBookingGeneratedMail($dataset));



                break;




            case 'cancelled':




                /**
                 * send Message
                 */
                netty()->send(new BookingCancelledMessage($booking))->to($booking->user->mobile, $_mobile);





                /**
                 * Send Mail
                 */
                Mail::to($booking->user->email)
                    ->bcc([$admin, 'opscoimbatore@valamcars.com'])
                    ->send(new BookingCancelledMail($booking));




                break;




            default:
                break;
        }
    }
}
