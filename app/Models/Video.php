<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Video extends Model
{
    /** @use HasFactory<\Database\Factories\VideoFactory> */
    use HasFactory;
    protected $fillable = [
        'title',
        'description',
        'url',
        'created_by',
    ];

    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function requests()
    {
        return $this->hasMany(VideoRequest::class);
    }
}
