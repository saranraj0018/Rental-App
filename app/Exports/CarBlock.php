<?php

namespace App\Exports;

use App\Models\CarDetailsHistory;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithFormatData;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class CarBlock implements FromCollection, WithHeadings, WithMapping {



    /**
     * Get the data to export
     * @var
     */
    public $dataset;



    /**
     * Extension
     * @var
     */
    public $type;




    /**
     * Bring in the model and data
     * @param mixed $type
     * @param mixed $ext
     * @param mixed $dataset
     */
    public function __construct($type, $dataset) {
        $this->type = $type;
        $this->dataset = $dataset;
    }


    /**
     * Heading for the dataset
     * @return array
     */
    public function headings(): array {
        return [
            "Action",
            "Block Type",
            "Reason",
            "Created By",
            "Created At",
            "Register Number",
            "Start Date",
            "End Date",
        ];
    }


    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection() {
        return $this->dataset;
    }


    // Map the data for each row in the export
    public function map($row): array {
        return [
            $row->action,
            block_type()[$row->block_type],
            reason_type()[$row->reason],
            $row->user->email,
            $row->created_at,
            $row->register_number,
            $row->start_date,
            $row->end_date,
        ];
    }
}
