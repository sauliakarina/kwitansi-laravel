<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    use HasFactory;

    protected $table = 'invoice';

    protected $fillable = [
        'user_id','tanggal','status','reason','waktu_approve'
    ];

    public function user()
    {
        return $this->belongsTo('App\Models\User','user_id','id');
    }
}
