<?php

namespace App\Exports;

// use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromArray;
// use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\WithColumnFormatting;
use Maatwebsite\Excel\Events\AfterSheet;
use Maatwebsite\Excel\Concerns\WithStrictNullComparison;

class ReportExport implements FromArray,ShouldAutoSize,WithEvents,WithStrictNullComparison
{
    /**
    * @return \Illuminate\Support\Collection
    */
    protected $data_array;
    protected $letterHeader;
    protected $count_array;
    protected $num_format;

    function __construct($data_array,$letterHeader)
    {
        $this->data_array = $data_array;
        $this->letterHeader = $letterHeader;
        $this->count_array = count($data_array);
    }

    public function array(): array
    {
        return $this->data_array;
    }

    public function registerEvents(): array
    {
        return[
            AfterSheet::class => function(AfterSheet $event){

                // styling file export
                $event->sheet->getStyle('A1:'.$this->letterHeader.'1')->applyFromArray([
                    'font'=> [
                        'bold'=> true,
                        'color' => array('rgb' => 'ffffff')
                    ],
                    'fill' => [
                        'fillType'  => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,
                        'color' => array('rgb' => '40418f')
                    ],
                    'alignment' => [
                        'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
                    ],
                ]);
                $event->sheet->getDelegate()->getStyle('A1:'.$this->letterHeader.$this->count_array)->applyFromArray([
                    'borders' => [
                        'allBorders' => [
                            'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                            'color' => ['rgb' => '000000'],
                        ],
                    ],
                    'alignment' => [
                        'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_LEFT,
                    ],
                ]);
                // $event->sheet->getDelegate()->setShowGridlines(false);
                // $event->sheet->getDelegate()->freezePane('A2');
            }
        ];
    }

}