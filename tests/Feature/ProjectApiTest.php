<?php

namespace Tests\Feature;

use App\Models\Project;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Laravel\Sanctum\Sanctum;
use Tests\TestCase;

class ProjectApiTest extends TestCase
{
    use RefreshDatabase;

    /** Champs "fillable" d'un projet (création directe en base). */
    private function projectData(array $overrides = []): array
    {
        return array_merge([
            'slug' => 'mon-projet',
            'title' => 'Mon Projet',
            'description' => 'Une description suffisamment longue pour la validation.',
            'status' => 'published',
            'is_featured' => false,
            'sort_order' => 1,
        ], $overrides);
    }

    /** Payload envoyé à l'API (inclut les technologies). */
    private function apiPayload(array $overrides = []): array
    {
        return array_merge($this->projectData(), [
            'technologies' => [['name' => 'Laravel', 'color' => '#FF2D20']],
        ], $overrides);
    }

    public function test_public_can_list_published_projects(): void
    {
        Project::create($this->projectData());

        $this->getJson('/api/projects')
            ->assertOk()
            ->assertJsonPath('status', 'success')
            ->assertJsonCount(1, 'data');
    }

    public function test_guest_cannot_create_a_project(): void
    {
        $this->postJson('/api/admin/projects', $this->apiPayload())->assertStatus(401);
    }

    public function test_admin_can_create_a_project(): void
    {
        Sanctum::actingAs(User::factory()->create());

        $this->postJson('/api/admin/projects', $this->apiPayload())
            ->assertStatus(201)
            ->assertJsonPath('status', 'success');

        $this->assertDatabaseHas('projects', ['slug' => 'mon-projet']);
    }

    public function test_admin_can_update_project_keeping_same_slug(): void
    {
        // Régression : éditer un projet en gardant son slug ne doit pas renvoyer 422.
        Sanctum::actingAs(User::factory()->create());

        $project = Project::create($this->projectData());

        $this->putJson("/api/admin/projects/{$project->id}", $this->apiPayload([
            'slug' => $project->slug,
            'title' => 'Titre modifié',
        ]))->assertOk();
    }
}
