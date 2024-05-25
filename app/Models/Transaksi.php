<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Transaksi
 * 
 * @property int $ID_TRANSAKSI
 * @property int $ID_BARANG
 * @property int $ID_PEMBELI
 * @property int $ID_PENGGUNA
 * @property Carbon $TANGGAL
 * @property string $KETERANGAN
 * @property Carbon $created_at
 * @property Carbon $updated_at
 * 
 * @property Barang $barang
 * @property Pembeli $pembeli
 * @property Pengguna $pengguna
 * @property Collection|Pembayaran[] $pembayarans
 *
 * @package App\Models
 */
class Transaksi extends Model
{
	protected $table = 'transaksi';
	protected $primaryKey = 'ID_TRANSAKSI';
	public $incrementing = false;

	protected $casts = [
		'ID_TRANSAKSI' => 'int',
		'ID_BARANG' => 'int',
		'ID_PEMBELI' => 'int',
		'ID_PENGGUNA' => 'int',
		'TANGGAL' => 'datetime'
	];

	protected $fillable = [
		'ID_BARANG',
		'ID_PEMBELI',
		'ID_PENGGUNA',
		'TANGGAL',
		'KETERANGAN'
	];

	public function barang()
	{
		return $this->belongsTo(Barang::class, 'ID_BARANG');
	}

	public function pembeli()
	{
		return $this->belongsTo(Pembeli::class, 'ID_PEMBELI');
	}

	public function pengguna()
	{
		return $this->belongsTo(Pengguna::class, 'ID_PENGGUNA');
	}

	public function pembayarans()
	{
		return $this->hasMany(Pembayaran::class, 'ID_TRANSAKSI');
	}
}
