<?php

use App\Models\User;
use Laravel\Sanctum\Sanctum;

test(
    "Assert that the profile endpoint returns the correct response when authenticated",
    function () {
        $this->artisan("migrate:fresh");
        Sanctum::actingAs(User::factory()->create(), ["view-tasks"]);

        $response = $this->get("/api/profile");

        $response->assertOk();
        expect($response->json()["Message"])->toBe("User Profile");
        expect($response->json()["errors"])->toBe(false);
    },
);

test(
    "Assert that the profile endpoint returns the correct response when not authenticated",
    function () {
        $this->artisan("migrate:fresh");

        $response = $this->get("/api/profile");

        $response->assertStatus(401);
    },
);
