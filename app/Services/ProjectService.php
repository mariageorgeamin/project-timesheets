<?php

namespace App\Services;

use App\Models\Project;
use App\Repositories\Interfaces\ProjectRepositoryInterface;
use App\Models\Attribute;
use App\Models\AttributeValue;

class ProjectService
{
    protected $projectRepository;

    public function __construct(ProjectRepositoryInterface $projectRepository)
    {
        $this->projectRepository = $projectRepository;
    }

    public function getAllProjects($filters)
    {
        return $this->projectRepository->getAllProjects($filters);
    }

    public function getProjectById(Project $project)
    {
        return $this->projectRepository->getProjectById($project);
    }

    public function createProject($data)
    {
        $project = $this->projectRepository->createProject($data);

        if (!empty($data['attributes'])) {
            foreach ($data['attributes'] as $key => $value) {
                $attribute = Attribute::where(['name' => $key])->first();
                AttributeValue::create([
                    'attribute_id' => $attribute->id,
                    'entity_id' => $project->id,
                    'value' => $value
                ]);
            }
        }

        return $project->load('attributes.attribute');
    }

    public function updateProject(Project $project, $data)
    {
        $project = $this->projectRepository->updateProject($project, $data);

        if (!empty($data['attributes'])) {
            foreach ($data['attributes'] as $key => $value) {
                $attribute = Attribute::firstOrCreate(['name' => $key]);
                AttributeValue::updateOrCreate(
                    ['attribute_id' => $attribute->id, 'entity_id' => $project->id],
                    ['value' => $value]
                );
            }
        }

        return $project->load('attributes.attribute');
    }

    public function deleteProject(Project $project)
    {
        return $this->projectRepository->deleteProject($project);
    }
}
