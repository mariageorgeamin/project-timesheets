<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Timesheet\StoreTimesheetRequest;
use App\Http\Requests\Api\Timesheet\UpdateTimesheetRequest;
use App\Http\Resources\Api\Timesheet\TimesheetResource;
use App\Models\Timesheet;
use App\Services\TimesheetService;
use App\Traits\ResponseTrait;

class TimesheetController extends Controller
{
    use ResponseTrait;

    protected TimesheetService $timesheetService;

    public function __construct(TimesheetService $timesheetService)
    {
        $this->timesheetService = $timesheetService;
    }

    public function index()
    {
        return $this->respondWithSuccess(
            'User timesheets listed successfully.' ,
            TimesheetResource::collection($this->timesheetService->getAllTimesheets())
        );
    }

    public function store(StoreTimesheetRequest $request)
    {
        $data = $request->validated();

        $data['user_id'] = auth()->user()->id;

        return $this->respondWithSuccess(
            'Timesheet logged successfully.' ,
            TimesheetResource::make($this->timesheetService->createTimesheet($data))
        );
    }

    public function show(Timesheet $timesheet)
    {
        return $this->respondWithSuccess(
            'Timesheet data returned successfully.' ,
            TimesheetResource::make($this->timesheetService->getTimesheetById($timesheet))
        );
    }

    public function update(UpdateTimesheetRequest $request, Timesheet $timesheet)
    {
        $data = $request->validated();

        return $this->respondWithSuccess(
            'Timesheet updated successfully.' ,
            TimesheetResource::make($this->timesheetService->updateTimesheet($timesheet, $data))
        );
    }

    public function destroy(Timesheet $timesheet)
    {
        $this->timesheetService->deleteTimesheet($timesheet);
        return $this->respondWithSuccess(
            'Timesheet deleted successfully.' ,
            []
        );
    }
}
