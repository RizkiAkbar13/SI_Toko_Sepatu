<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;

/**
 * Class Pengguna
 *
 * @property int $ID_PENGGUNA
 * @property string $EMAIL
 * @property string $USERNAME
 * @property string $PASSWORD
 * @property string $NAMA
 * @property string $ALAMAT
 * @property string $NO_TELP
 * @property string $ROLE
 *
 * @property Collection|Transaksi[] $transaksis
 *
 * @package App\Models
 */
class Pengguna extends Authenticatable
{
	protected $table = 'pengguna';
	protected $primaryKey = 'ID_PENGGUNA';
	public $timestamps = false;

	protected $fillable = [
		'EMAIL',
		'USERNAME',
		'PASSWORD',
		'NAMA',
		'ALAMAT',
		'NO_TELP',
		'ROLE'
	];

	public function transaksis()
	{
		return $this->hasMany(Transaksi::class, 'ID_PENGGUNA');
	}
}
