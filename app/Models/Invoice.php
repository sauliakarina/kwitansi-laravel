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

    public function barang()
    {
    	return $this->belongsToMany('App\Models\Barang');
    }

    // public function invoice_barang()
    // {
    //     return $this->hasMany('App\Models\Invoice_barang','invoice_id','id');
    // }
}
