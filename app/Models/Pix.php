<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pix extends Model
{
    use HasFactory;

    protected $table = 'pix';

    protected $fillable = [
        'user_id',
        'key',
        'hide',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
