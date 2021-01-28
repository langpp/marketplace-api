<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Checkout extends Model
{
	protected $table = 'checkout';
	protected $primaryKey = 'id_checkout';

	protected $fillable = [
		'id_checkout', 'id_produk', 'id_toko', 'id_user', 'tanggal', 'deskripsi', 'status', 'jenis_pembayaran', 'total'
	];

	protected $hidden = [
		''
	];

	// public function Absen()
	// {	
	// 	return $this->hasMany(Absen::class, 'id_siswa');
	// }

}
