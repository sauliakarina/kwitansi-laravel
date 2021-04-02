<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Invoice_barang extends Model
{
    use HasFactory;
    protected $table = 'invoice_barang';

    protected $fillable = [
        'invoice_id', 'barang_id', 'kuantiti'
    ];

    public function barang()
    {
        return $this->belongsTo('App\Models\Barang', 'barang_id','id');
    }

    public function invoice()
    {
        return $this->belongsTo('App\Models\Invoice', 'invoice_id','id');
    }
}
