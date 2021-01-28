<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Produk extends Model
{
	protected $table = 'produk';
	protected $primaryKey = 'id_produk';
	protected $fillable = [
        'id_produk', 'nama_produk', 'harga', 'gambar', 'id_toko', 'user_beli', 'gambar_lain'
	];

}
