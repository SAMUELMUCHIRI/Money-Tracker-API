<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
class Transactions extends Model
{
    protected $fillable = ["wallet_id", "type", "amount", "description"];

    public function Wallets(): BelongsTo
    {
        return $this->belongsTo(Wallets::class);
    }
}
