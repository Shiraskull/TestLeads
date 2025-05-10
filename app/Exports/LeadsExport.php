<?php
namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\WithHeadings;

class LeadsExport implements FromArray, WithHeadings
{
    protected $allData;
    protected $columns;

    public function __construct(array $allData, array $columns)
    {
        $this->allData = $allData;
        $this->columns = $columns;
    }

    public function array(): array
    {
        // Mengembalikan data leads sebagai array
        return $this->allData;
    }

    public function headings(): array
    {
        // Menampilkan heading sesuai kolom yang dipilih
        return $this->columns;
    }
}
