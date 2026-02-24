<?php

test("Test health endpoint", function () {
    $response = $this->get("/api/health");

    $response->assertStatus(200);
    expect($response->json())->toBeArray();
    expect($response->json())->toHaveKey("status");
    expect($response->json()["status"])->toBe("OK");
});

test("Test info endpoint", function () {
    $response = $this->get("/api");

    $response->assertStatus(200);
    expect($response->json())->toBeArray();
    expect($response->json())->toHaveKey("message");
    expect($response->json()["message"])->toBe("Welcome to Money Tracker API");
    expect($response->json()["endpoints"])->toBeArray();
});
