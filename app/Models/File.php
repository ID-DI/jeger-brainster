<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class File extends Model
{
    use HasFactory;

    protected $table = 'files';

    protected $fillable = [
        'email',
        'name',
        'file_path',
    ];

    public function receipt()
    {
        return $this->hasOne(Receipt::class);
    }
}
