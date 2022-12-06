<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Award extends Model
{
    use HasFactory;
    protected $fillable = [
        'type',
        'quantity'
    ];
    public function receipts()
    {
        return $this->hasMany(Award::class);
    }
}
