<?php

namespace App\Models;
use App\Models\Transactions;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Model;

class Wallets extends Model
{
    protected $fillable = ["user_id", "name", "description"];
    public function transactions(): HasMany
    {
        return $this->hasMany(Transactions::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
