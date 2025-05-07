<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Document extends Model
{
    protected $fillable = [
        'name',
        'sender_id',
        'receiver_id',
        'description',
        'is_saved',
        'is_vued'
    ];
    public function sender()
    {
        return $this->belongsTo(User::class, 'sender_id');
    }

    public function receiver()
    {
        return $this->belongsTo(User::class, 'receiver_id');
    }

    public function files()
    {
        return $this->hasMany(DocumentFile::class);
    }
}
