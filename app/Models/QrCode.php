<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class QrCode extends Model
{
    protected $fillable = [
        'client_id',
        'code',
        'status',
    ];

    public function client()
    {
        return $this->belongsTo(Client::class);
    }
}
