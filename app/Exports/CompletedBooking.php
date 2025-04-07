<?php

namespace App\Exports;

use App\Models\Booking;
use App\Models\CarDetailsHistory;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class CompletedBooking implements FromCollection, WithHeadings
{



    public function __construct(public string $hub) {}


    /**
     * Heading for the dataset
     * @return array
     */
    public function headings(): array
    {
        return [
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
    public function collection()
    {

        $booking = Booking::with('user','Car')->select([
            'booking_id',
            DB::raw('MAX(status) as status'),
            DB::raw('MIN(start_date) as start_date'),
            DB::raw('MAX(end_date) as end_date'),
            DB::raw('MAX(address) as address'),
            DB::raw('MAX(reschedule_date) as reschedule_date'),
            DB::raw('MAX(latitude) as latitude'),
            DB::raw('MAX(longitude) as longitude'),
            DB::raw('MAX(created_at) as created_at'),
            DB::raw('MAX(user_id) as user_id'),
            DB::raw('MAX(car_id) as car_id'),
        ])
            ->where('city_code', $this->hub)
            ->groupBy('booking_id')
            ->get();

        return $booking->map(function ($book) {
            return collect([
                $book?->booking_id,
                ($book?->status == '1' ? 'Booking' : ($book?->status == '2' ? 'Completed' : 'Canceled')),
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
