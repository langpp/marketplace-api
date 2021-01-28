<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Users extends Model
{
	protected $table = 'users';
	protected $primaryKey = 'id_user';

	protected $fillable = [
        'id_user', 'username', 'email', 'password', 'role', 'no_telp'
	];

	protected $hidden = [
		'password',
		'created_at',
		'updated_at'
	];
}
