<?php

namespace App\Exports;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class FilteredYieldExport implements FromCollection, WithHeadings
{
    use Exportable;
    
    protected $yieldLists;

    public function __construct($yieldLists)
    {
        $this->yieldLists = $yieldLists;
    }

    public function collection()
    {
        // Optionally format the output
        return collect($this->yieldLists)->map(function ($item) {
            return [
                'Cycle No'       => $item->cycle_no,
                'Tray'           => $item->tray,
                'Yield Per Tray' => $item->yield_per_tray . ' g',
                'Date'           => \Carbon\Carbon::parse($item->date)->format('M j, Y'),
            ];
        });
    }

    public function headings(): array
    {
        return [
            'Cycle No',
            'Tray',
            'Yield Per Tray',
            'Date',
        ];
    }
}
