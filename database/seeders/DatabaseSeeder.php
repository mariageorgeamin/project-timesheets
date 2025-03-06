<?php

namespace Database\Seeders;

use App\Models\Attribute;
use App\Models\AttributeValue;
use App\Models\Project;
use App\Models\Timesheet;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Hash;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $user = User::create([
            'first_name' => 'Test',
            'last_name' => 'User',
            'email' => 'user@test.com',
            'password' => Hash::make('123456')
        ]);

        $project = Project::create([
            'name' => 'Project A',
            'status' => 'active'
        ]);

        $attribute = Attribute::create([
            'name' => 'department',
            'type' => 'text'
        ]);

        AttributeValue::create([
            'attribute_id' => $attribute->id,
            'entity_id' => $project->id,
            'value' => 'IT'
        ]);

        Timesheet::create([
            'task_name' => 'Task A',
            'date' => '2025-01-01',
            'hours' => 5,
            'user_id' => $user->id,
            'project_id' => $project->id
        ]);
    }
}
