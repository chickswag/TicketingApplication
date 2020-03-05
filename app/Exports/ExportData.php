<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class ExportData implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    protected $lines;

    function __construct(array $lines) {
        $this->lines = $lines;
    }
    public function collection()
    {
        return collect($this->lines);
    }

}
