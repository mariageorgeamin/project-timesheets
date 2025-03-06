<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Project\FilterProjectRequest;
use App\Http\Requests\Api\Project\StoreProjectRequest;
use App\Http\Requests\Api\Project\UpdateProjectRequest;
use App\Http\Resources\Api\Project\ProjectResource;
use App\Models\Project;
use App\Services\ProjectService;
use App\Traits\ResponseTrait;

class ProjectController extends Controller
{
    Use ResponseTrait;

    protected ProjectService $projectService;

    public function __construct(ProjectService $projectService)
    {
        $this->projectService = $projectService;
    }

    public function index(FilterProjectRequest $request)
    {
        $data = $request->validated();

        return $this->respondWithSuccess(
            'Projects listed successfully.' ,
            ProjectResource::collection($this->projectService->getAllProjects($data['filters'] ?? []))
        );
    }

    public function store(StoreProjectRequest $request)
    {
        $data = $request->validated();

        return $this->respondWithSuccess(
            'Projects stored successfully.' ,
            ProjectResource::make($this->projectService->createProject($data))
        );
    }

    public function show(Project $project)
    {
        return $this->respondWithSuccess(
            'Projects data returned successfully.' ,
            ProjectResource::make($this->projectService->getProjectById($project))
        );
    }

    public function update(UpdateProjectRequest $request, Project $project)
    {
        $data = $request->validated();

        return $this->respondWithSuccess(
            'Projects updated successfully.' ,
            ProjectResource::make($this->projectService->updateProject($project, $data))
        );
    }

    public function destroy(Project $project)
    {
        $this->projectService->deleteProject($project);
        return $this->respondWithSuccess(
            'Projects deleted successfully.' ,
            []
        );
    }
}
