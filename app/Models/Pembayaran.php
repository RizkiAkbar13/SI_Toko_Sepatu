<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Pembayaran
 * 
 * @property int $ID_PEMBAYARAN
 * @property int $TOTAL_BAYAR
 * @property int $KEMBALIAN
 * @property int $ID_TRANSAKSI
 * @property Carbon $created_at
 * @property Carbon $updated_at
 * 
 * @property Transaksi $transaksi
 *
 * @package App\Models
 */
class Pembayaran extends Model
{
	protected $table = 'pembayaran';
	protected $primaryKey = 'ID_PEMBAYARAN';

	protected $casts = [
		'TOTAL_BAYAR' => 'int',
		'KEMBALIAN' => 'int',
		'ID_TRANSAKSI' => 'int'
	];

	protected $fillable = [
		'TOTAL_BAYAR',
		'KEMBALIAN',
		'ID_TRANSAKSI'
	];

	public function transaksi()
	{
		return $this->belongsTo(Transaksi::class, 'ID_TRANSAKSI');
	}
}
