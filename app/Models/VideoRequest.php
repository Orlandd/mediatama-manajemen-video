<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VideoRequest extends Model
{
    /** @use HasFactory<\Database\Factories\VideoRequestFactory> */
    use HasFactory;

    protected $fillable = [
        'video_id',
        'user_id',
        'status',
        'requested_at',
        'approved_by',
        'approved_at',
        'access_start',
        'access_end',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function video()
    {
        return $this->belongsTo(Video::class);
    }

    public function approver()
    {
        return $this->belongsTo(User::class, 'approved_by');
    }
}
