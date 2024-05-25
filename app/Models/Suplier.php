<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Suplier
 * 
 * @property int $ID_SUPLIER
 * @property string $NAMA_SUPLIER
 * @property string $NO_TLP
 * @property string $ALAMAT
 * 
 * @property Collection|Barang[] $barangs
 *
 * @package App\Models
 */
class Suplier extends Model
{
	protected $table = 'suplier';
	protected $primaryKey = 'ID_SUPLIER';
	public $timestamps = false;

	protected $fillable = [
		'NAMA_SUPLIER',
		'NO_TLP',
		'ALAMAT'
	];

	public function barangs()
	{
		return $this->hasMany(Barang::class, 'ID_SUPLIER');
	}
}
