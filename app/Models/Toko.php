<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Toko extends Model
{
	protected $table = 'toko';
	protected $primaryKey = 'id_toko';
	protected $fillable = [
        'id_toko', 'nama_toko', 'id_user', 'deskripsi', 'logo', 'background'
    ];
    protected $hidden = [
		'created_at',
		'updated_at'
	];
}
