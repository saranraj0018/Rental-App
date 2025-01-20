<?php

namespace App\Exports;

use App\Models\Booking;
use App\Models\CarDetailsHistory;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class CompletedBooking implements FromCollection, WithHeadings {



    public function __construct(public string $hub) {
    }


    /**
     * Heading for the dataset
     * @return array
     */
    public function headings(): array {
        return [
            'Booking Type',
            'Start Date',
            'End Date',
            'User Name',
            'User Mobile',
            'Model Name',
            'Register Number',
            'Address',
            'Reschedule Date',
        ];
    }


    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection() {

        $booking = Booking::with(['user', 'details', 'comments', 'user.bookings','details', 'Car' ,'Car.carModel'])
            ->where('city_code', $this->hub)
            ->where('status', 2)
            ->get();

        return $booking->map(function($book) {
            return collect([
                $book?->book_type,
                $book?->start_date,
                $book?->end_date,
                $book?->user->name,
                $book?->user->mobile,
                $book?->Car?->carModel?->model_name,
                $book?->Car?->register_number,
                $book?->address,
                $book?->reschedule_date,
            ]);
        });
    }
}
