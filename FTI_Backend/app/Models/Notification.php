<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    protected $primaryKey = 'id';

    protected $fillable = [
        'title',
        'content',
        'file_path',
        'user_id',
    ];

    protected $guarded = [
        'user_id',
    ];
    
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}
