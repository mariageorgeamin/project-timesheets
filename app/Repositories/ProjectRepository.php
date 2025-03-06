<?php

namespace App\Repositories;

use App\Models\Project;
use App\Repositories\Interfaces\ProjectRepositoryInterface;

class ProjectRepository implements ProjectRepositoryInterface
{
    public function getAllProjects(?array $filters)
    {
        $query = Project::query()->with('attributes.attribute');

        if (!empty($filters)) {
            foreach ($filters as $key => $condition) {
                if (!empty($condition)) {
                    if (is_array($condition) && isset($condition['operator'], $condition['value'])) {
                        $operator = $condition['operator'];
                        $value = $condition['value'];
                    } else {
                        $operator = '=';
                        $value = $condition;
                    }

                    if (in_array($key, ['name', 'status'])) {
                        if ($operator === 'LIKE') {
                            $query->where($key, $operator, "%$value%");
                        } else {
                            $query->where($key, $operator, $value);
                        }
                    } else {
                        $query->whereHas('attributes', function ($q) use ($key, $operator, $value) {
                            $q->whereHas('attribute', fn($a) => $a->where('name', $key))
                                ->where('value', $operator, $operator === 'LIKE' ? "%$value%" : $value);
                        });
                    }
                }
            }
        }

        return $query->get();
    }

    public function getProjectById(Project $project)
    {
        return $project->load('attributes.attribute');
    }

    public function createProject(array $data)
    {
        return Project::create($data);
    }

    public function updateProject(Project $project, array $data)
    {
        $project->update($data);
        return $project;
    }

    public function deleteProject(Project $project)
    {
        return $project->deleteOrFail();
    }
}
