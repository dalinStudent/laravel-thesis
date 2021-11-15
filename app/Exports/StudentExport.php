<?php 

namespace App\Exports;

use App\Models\Students;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\FromCollection;

class StudentExport implements FromCollection,WithHeadings
{
    use Exportable;
    public function collection()
    {
        
        return Students::all();
    }
    public function headings(): array

    {

        return [
            'ID',
            'Name'

        ];

    }
}
