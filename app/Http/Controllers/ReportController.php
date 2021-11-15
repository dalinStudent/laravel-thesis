<?php

namespace App\Http\Controllers;

use App\Models\Students;
use App\Models\Departments;
use Maatwebsite\Excel\Excel;
use App\Exports\StudentExport;
use App\Http\Controllers\Controller;


class ReportController extends Controller
{
    public function studentExport()
    {
        // return (new StudentExport)->download('invoices.xlsx', \Maatwebsite\Excel\Excel::XLSX);
        return (new StudentExport)->download('StudentList.csv', \Maatwebsite\Excel\Excel::CSV);

    }
    public function getalldepartment()
    {
        
        $data = Departments::select('id','name')->get();
        
        return $data;
    }


}