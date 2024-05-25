<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Pembeli
 * 
 * @property int $ID_PEMBELI
 * @property string $NAMA_PEMBELI
 * @property string $JK
 * @property string $NO_TLP
 * @property string $ALAMAT
 * 
 * @property Collection|Transaksi[] $transaksis
 *
 * @package App\Models
 */
class Pembeli extends Model
{
	protected $table = 'pembeli';
	protected $primaryKey = 'ID_PEMBELI';
	public $timestamps = false;

	protected $fillable = [
		'NAMA_PEMBELI',
		'JK',
		'NO_TLP',
		'ALAMAT'
	];

	public function transaksis()
	{
		return $this->hasMany(Transaksi::class, 'ID_PEMBELI');
	}
}
