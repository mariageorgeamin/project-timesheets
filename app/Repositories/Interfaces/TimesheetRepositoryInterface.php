<?php

namespace App\Repositories\Interfaces;

use App\Models\Timesheet;

interface TimesheetRepositoryInterface
{
    public function getAllTimesheets();
    public function createTimesheet(array $data);
    public function getTimesheetById(Timesheet $timesheet);
    public function updateTimesheet(Timesheet $timesheet, array $data);
    public function deleteTimesheet(Timesheet $timesheet);
}
