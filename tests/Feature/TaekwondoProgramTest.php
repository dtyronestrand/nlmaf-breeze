<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\User;
use App\Models\Program; // Assuming Program model exists
use Inertia\Testing\AssertableInertia as Assert;

class TaekwondoProgramTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Test that a taekwondo member is redirected to the members area.
     */
    public function test_taekwondo_member_is_redirected(): void
    {
        // Create a user with tkd = true
        $user = User::factory()->create(['tkd' => true]);

        // Authenticate as this user
        $this->actingAs($user);

        // Make a GET request to /programs/taekwondo
        $response = $this->get('/programs/taekwondo');

        // Assert that the response is a redirect to /programs/taekwondo/members
        $response->assertStatus(302);
        $response->assertRedirect('/programs/taekwondo/members');
    }

    /**
     * Test that a non-taekwondo member sees the taekwondo page.
     */
    public function test_non_taekwondo_member_sees_taekwondo_page(): void
    {
        // Create a user with tkd = false
        $user = User::factory()->create(['tkd' => false]);

        // Authenticate as this user
        $this->actingAs($user);
        
        // Create a Taekwondo program manually if factory is not available
        Program::create([
            'title' => 'Taekwondo Program',
            'slug' => 'taekwondo',
            // Add other required fields for the Program model if any
            // For example, assuming 'description' is a required field:
            'description' => 'A default description', 
            'published' => true, // Assuming published is needed for visibility
        ]);


        // Make a GET request to /programs/taekwondo
        $response = $this->get('/programs/taekwondo');

        // Assert that the response is successful (status 200)
        // And renders the correct Inertia component
        $response->assertStatus(200);
        $response->assertInertia(fn (Assert $page) => $page
            ->component('Programs/Taekwondo')
            // Optionally check for props if needed
            // ->has('item.title', 'Taekwondo Program')
        );
    }

    /**
     * Test that an unauthenticated user is redirected from the members page.
     */
    public function test_unauthenticated_user_redirected_from_members_page(): void
    {
        // Make a GET request to /programs/taekwondo/members without authenticating
        $response = $this->get('/programs/taekwondo/members');

        // Assert that the response is a redirect to the login page
        $response->assertStatus(302);
        $response->assertRedirect('/login');
    }

    /**
     * Test that an authenticated non-tkd user gets a 403 on the members page.
     */
    public function test_authenticated_non_tkd_user_access_to_members_page(): void
    {
        // Create a user with tkd = false
        $user = User::factory()->create(['tkd' => false]);

        // Authenticate as this user
        $this->actingAs($user);

        // Make a GET request to /programs/taekwondo/members
        $response = $this->get('/programs/taekwondo/members');

        // Assert that the response is a 403 Forbidden error
        $response->assertStatus(403);
    }
}
