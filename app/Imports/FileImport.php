<?php

namespace App\Imports;

use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithBatchInserts;
use Maatwebsite\Excel\Concerns\WithChunkReading;

class FileImport implements ToModel, WithHeadingRow,WithBatchInserts, WithChunkReading
{
    /**
     * @param array $row
     */
    public function model(array $row)
    {
        return $row;
    }


    public function batchSize(): int
    {
        return 1000;
    }

    public function chunkSize(): int
    {
        return 1000;
    }

}
