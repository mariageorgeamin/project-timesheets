<?php

namespace App\Repositories;

use App\Models\Timesheet;
use App\Repositories\Interfaces\TimesheetRepositoryInterface;
use Ramsey\Uuid\Type\Time;

class TimesheetRepository implements TimesheetRepositoryInterface
{
    public function getAllTimesheets()
    {
        return auth()->user()->timesheets;
    }

    public function getTimesheetById(Timesheet $timesheet)
    {
        return $timesheet;
    }

    public function createTimesheet(array $data)
    {
        return Timesheet::create($data);
    }

    public function updateTimesheet(Timesheet $timesheet, array $data)
    {
        $timesheet->update($data);
        return $timesheet;
    }

    public function deleteTimesheet(Timesheet $timesheet)
    {
        return $timesheet->deleteOrFail();
    }
}
