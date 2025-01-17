<?php

namespace App\Exports;

use App\Models\CarDetailsHistory;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class User implements FromCollection, WithHeadings {



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
            "Name",
            "Mobile Number",
            "Email",
            "Aadhaar Number",
            "Driving Licence",
            "Update At",
        ];
    }


    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection() {
        return $this->dataset;
    }
}
