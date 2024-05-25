<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Barang
 * 
 * @property int $ID_BARANG
 * @property string $NAMA_BARANG
 * @property int $HARGA
 * @property int $STOK
 * @property int $ID_SUPLIER
 * 
 * @property Suplier $suplier
 * @property Collection|Transaksi[] $transaksis
 *
 * @package App\Models
 */
class Barang extends Model
{
	protected $table = 'barang';
	protected $primaryKey = 'ID_BARANG';
	public $timestamps = false;

	protected $casts = [
		'HARGA' => 'int',
		'STOK' => 'int',
		'ID_SUPLIER' => 'int'
	];

	protected $fillable = [
		'NAMA_BARANG',
		'HARGA',
		'STOK',
		'ID_SUPLIER'
	];

	public function suplier()
	{
		return $this->belongsTo(Suplier::class, 'ID_SUPLIER');
	}

	public function transaksis()
	{
		return $this->hasMany(Transaksi::class, 'ID_BARANG');
	}
}
