<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Checkout extends Model
{
	protected $table = 'checkout';
	protected $primaryKey = 'id_checkout';

	protected $fillable = [
		'id_checkout', 'order_id', 'id_produk', 'id_toko', 'id_user', 'tanggal', 'deskripsi', 'status', 'total_barang', 'harga', 'phone', "first_name", "last_name", "address", "city", "postal_code", "country_code", "snaptoken"
	];

	protected $hidden = [
		'created_at',
		'updated_at'
	];
}
