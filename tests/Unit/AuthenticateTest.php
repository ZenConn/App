<?php

namespace Tests\Unit;

use App\Models\User;
use Tests\TestCase;

class AuthenticateTest extends TestCase
{
    public function test_protected_route(): void
    {
        $this->json("GET", "/protected")
            ->assertUnauthorized();
    }

    public function test_unprotected_route_as_authenticated(): void
    {
        $user = User::factory()->create();

        $this
            ->actingAs($user)
            ->get("/unprotected")
            ->assertRedirect();
    }

    public function test_unprotected_route_as_expected(): void
    {
        $this
            ->get("/unprotected")
            ->assertNotFound();
    }
}
