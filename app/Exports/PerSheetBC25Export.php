<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithCustomValueBinder;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithTitle;

class PerSheetBC25Export extends \PhpOffice\PhpSpreadsheet\Cell\StringValueBinder implements FromCollection, WithTitle, WithHeadings, WithCustomValueBinder
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
