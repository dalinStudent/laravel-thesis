<?php

namespace App\Imports;

use App\Models\AttendanceTmp;
use App\Models\ProjectEmployee;
use App\Models\Schedule;
use Carbon\Carbon;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;

class AttendanceImport implements ToCollection
{
    protected $projectID;
    public function __construct($projectID)
    {
        $this->projectID = $projectID;
    }
    /**
    * @param Collection $collection
    */
    public function collection(Collection $collection)
    {
        $projectEmployees = ProjectEmployee::where([
                'project_id' => $this->projectID,
                'status' => 'work'
            ])->get();
        $schedules = Schedule::where('project_id', $this->projectID)->get();
        unset($collection[0]);
        unset($collection[1]);
        unset($collection[2]);
        unset($collection[3]);
        unset($collection[4]);
        foreach($collection as $row) {
            $em  = $projectEmployees->where('local_id', $row[0])->first();
            if ($em) {
                $day = new Carbon($row[4]);
                $schedule = $schedules->where('day_index', $day->dayOfWeek + 1)->first();
                AttendanceTmp::updateOrCreate([
                        'employee_id' => $em->employee_id,
                        'project_id' => $this->projectID,
                        'schedule_id' => $schedule->id,
                        'wage_id' => $em->employee->wage()->id,
                        'date' => $row[4]
                    ], 
                    $this->validateTimePeriod($row, $schedule)
                );
            }
        }
    }

    private function validateTimePeriod($row, $schedule)
    {
        $default = '--:--';
        $ps = explode("\n", $row[5]);
        $p1 = explode(' ', $ps[1]);
        $p2 = explode(' ', $ps[2]);
        $p3 = explode(' ', $ps[3]);
        // $p4 = explode(' ', $ps[0]);
        if ($p1[0] != $default && $p1[1] == $default) {
            $p1[1] = $schedule->p1_out;
            if ($p2[0] == $default && $p2[1] != $default) {
                $p2[0] = $schedule->p1_out;
            } else if ($p2[0] == $default && $p2[1] == $default) {
                $p2[0] = $schedule->p1_out;
                $p2[1] = $schedule->p2_out;
                if ($p3[0] == $default && $p3[1] != $default) {
                    $p3[0] = $schedule->p2_out;
                }
            }
        }

        return [
            'p1_in'  => $p1[0] == $default ? null : $p1[0],
            'p1_out' => $p1[1] == $default ? null : $p1[1],
            'p2_in'  => $p2[0] == $default ? null : $p2[0],
            'p2_out' => $p2[1] == $default ? null : $p2[1],
            'p3_in'  => $p3[0] == $default ? null : $p3[0],
            'p3_out' => $p3[0] == $default ? null : $p3[1]
        ];
    }
}
