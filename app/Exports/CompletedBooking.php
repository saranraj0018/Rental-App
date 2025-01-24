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
            'Booking ID',
            'Status',
            'Start Date',
            'End Date',
            'User Name',
            'User Mobile',
            'Model Name',
            'Register Number',
            'Address',
            'Reschedule Date',
            'Latitude',
            'Longitude',
            'Created Date'
        ];
    }


    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection() {

        $booking = Booking::with(['user', 'details', 'comments', 'user.bookings','details', 'Car' ,'Car.carModel'])
            ->where('city_code', $this->hub)
            ->get();

        return $booking->map(function($book) {
            return collect([
                $book?->booking_type,
                $book?->booking_id,
                ($book?->status == '1' ? 'Booking': ($book?->status == '2' ? 'Completed' : 'Canceled')),
                \Carbon\Carbon::parse($book?->start_date)->format('d-m-Y H:i A'),
                \Carbon\Carbon::parse($book?->end_date)->format('d-m-Y H:i A'),
                $book?->user?->name,
                $book?->user?->mobile,
                $book?->Car?->carModel?->model_name,
                $book?->Car?->register_number,
                $book?->address,
                \Carbon\Carbon::parse($book?->reschedule_date)->format('d-m-Y H:i A'),
                $book?->latitude,
                $book?->longitude,
                \Carbon\Carbon::parse($book?->created_at)->format('d-m-Y H:i A'),
            ]);
        });
    }
}
