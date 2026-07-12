<?php

namespace Tests\Unit;

use App\Models\Project;
use Tests\TestCase;

class ProjectModelTest extends TestCase
{
    public function test_is_featured_is_cast_to_boolean(): void
    {
        $project = new Project(['is_featured' => 1]);

        $this->assertIsBool($project->is_featured);
        $this->assertTrue($project->is_featured);
    }

    public function test_fillable_contains_core_fields(): void
    {
        $fillable = (new Project())->getFillable();

        $this->assertContains('slug', $fillable);
        $this->assertContains('title', $fillable);
        $this->assertContains('status', $fillable);
    }
}
