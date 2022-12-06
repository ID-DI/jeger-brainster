<?php

namespace App\Models;

use App\Exports\ReceiptExport;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Receipt extends Model
{
    use HasFactory;

    protected $table = 'receipts';

    protected $fillable = [
        'file_id',
        'status',
        'text',
        'declined',
        'award_id',
    ];

    public function award()
    {
        return $this->belongsTo(Award::class);
    }

    public function file()
    {
        return $this->belongsTo(File::class);
    }

    protected $attributes = [
        'award_id' => null //it was null
    ];


}
