<?php

namespace App\Exports\Template;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithTitle;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;


class PerSheetBC41Export implements  WithTitle, WithHeadings , FromCollection
{
    private $sheetName;
    private $headersName;
    private $data;
    
    public function __construct($sheetName, $headersName, $data)
    {
        $this->sheetName = $sheetName;
        $this->headersName = $headersName;
        $this->data = $data;

    }

    public function headings(): array
    {
        return [$this->headersName];
    }

    
    /**
     * @return string
     */
    public function title(): string
    {
        return $this->sheetName;
    }

        /**
     * @return Builder
     */
    public function collection()
    {
        return collect($this->data);
    }
}
