<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Barang_invoice extends Model
{
    use HasFactory;

    use HasFactory;
    protected $table = 'barang_invoice';

    protected $fillable = [
        'invoice_id', 'barang_id', 'kuantiti'
    ];
}
