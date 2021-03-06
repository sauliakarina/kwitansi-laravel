<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Barang extends Model
{
    use HasFactory;
    protected $table = 'barang';

    protected $fillable = [
        'nama',
        'harga',
        'stok',
        'discount'
    ];

    public function invoice()
    {
    	return $this->belongsToMany('App\Models\Invoice','invoice_id','id');
    }

    // public function invoice_barang()
    // {
    //     return $this->hasMany('App\Models\Invoice_barang','barang_id','id');
    // }
}
