<?php

namespace App\Exports;

use App\Models\CarDetailsHistory;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class CarHistory implements FromCollection, WithHeadings {



    /**
     * Get the data to export
     * @var 
     */
    public $dataset;



    /**
     * Declare the type: Car details or Car Model
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

        if ($this->type == 'models') {
            return [
                "Action",
                "Car Model ID",
                "Car Model Name",
                "Created By",
                "Created At",
            ];
        }

        if ($this->type == 'details') {
            return [
                "Action",
                "Car model ID",
                "Model Name",
                "Registration Number",
                "Created By",
                "Created At",
            ];
        }

        return [];
    }


    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection() {
        return $this->dataset;
    }
}
