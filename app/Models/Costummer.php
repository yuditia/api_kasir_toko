<?php

namespace App\Models;

use App\Http\Controllers\TransactionController;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Costummer extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function transactions()
    {
        return $this->hasMany(TransactionController::class);
    }
}
