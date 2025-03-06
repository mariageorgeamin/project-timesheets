<?php

namespace App\Repositories\Interfaces;

use App\Models\Project;

interface ProjectRepositoryInterface
{
    public function getAllProjects(?array $filters);
    public function getProjectById(Project $project);
    public function createProject(array $data);
    public function updateProject(Project $project, array $data);
    public function deleteProject(Project $project);
}

