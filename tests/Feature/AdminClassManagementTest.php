<?php

namespace Tests\Feature;

use App\Models\ArcheryClass;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AdminClassManagementTest extends TestCase
{
    use RefreshDatabase;

    public function test_admin_can_create_a_class_from_dashboard(): void
    {
        $admin = User::factory()->create([
            'first_name' => 'Admin',
            'last_name' => 'User',
            'is_admin' => true,
        ]);

        $response = $this->withSession(['_token' => 'test-token'])
            ->actingAs($admin)
            ->post('/dashboard/classes', [
                '_token' => 'test-token',
                'slug' => 'beginner-private',
                'badge' => 'Private',
                'name' => 'Private Beginner Coaching',
                'short_description' => 'One-on-one guidance for new archers.',
                'full_description' => 'Personalized coaching for beginners who want focused practice.',
                'prerequisites' => 'No prior experience required.',
                'price_label' => '$75 / session',
                'price_cents' => 7500,
                'duration_minutes' => 60,
                'cta_text' => 'Book session',
                'sort_order' => 5,
                'is_active' => '1',
            ]);

        $response->assertRedirect('/dashboard#classes');
        $this->assertDatabaseHas('archery_classes', [
            'slug' => 'beginner-private',
            'name' => 'Private Beginner Coaching',
            'is_active' => true,
        ]);
        $this->assertTrue(ArcheryClass::where('slug', 'beginner-private')->exists());
    }
}
