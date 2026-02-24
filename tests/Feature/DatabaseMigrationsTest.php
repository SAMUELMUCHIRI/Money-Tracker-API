<?php

use Illuminate\Support\Facades\Schema;

it("Database migrations and Schema is correct", function () {
    $this->artisan("migrate:fresh");
    expect(Schema::hasTable("Transactions"))->toBeTrue();
    expect(Schema::hasTable("users"))->toBeTrue();
    expect(Schema::hasTable("Wallets"))->toBeTrue();
    expect(Schema::hasTable("personal_access_tokens"))->toBeTrue();
});
