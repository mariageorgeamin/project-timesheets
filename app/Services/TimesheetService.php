<?php

namespace App\Services;

use App\Models\Timesheet;
use App\Repositories\Interfaces\TimesheetRepositoryInterface;

class TimesheetService
{
    protected $timesheetRepository;

    public function __construct(TimesheetRepositoryInterface $timesheetRepository)
    {
        $this->timesheetRepository = $timesheetRepository;
    }

    public function getAllTimesheets()
    {
        return $this->timesheetRepository->getAllTimesheets();
    }

    public function getTimesheetById(Timesheet $id)
    {
        return $this->timesheetRepository->getTimesheetById($id);
    }

    public function createTimesheet($data)
    {
        return $this->timesheetRepository->createTimesheet($data);
    }

    public function updateTimesheet(Timesheet $id, $data)
    {
        return $this->timesheetRepository->updateTimesheet($id, $data);
    }

    public function deleteTimesheet(Timesheet $id)
    {
        return $this->timesheetRepository->deleteTimesheet($id);
    }
}
