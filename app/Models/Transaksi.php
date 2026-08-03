<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaksi extends Model
{
    use HasFactory;

    protected $table = 'transaksi';

    protected $fillable = [
        'tanggal',
        'jenis',
        'nominal',
        'keterangan',
    ];

    protected $casts = [
        'tanggal' => 'date',
        'nominal' => 'integer',
    ];

    /**
     * Accessor: nominal dalam format Rupiah, contoh Rp1.500.000
     */
    public function getNominalFormatAttribute(): string
    {
        return 'Rp' . number_format($this->nominal, 0, ',', '.');
    }

    /**
     * Scope singkat untuk memisahkan pemasukan / pengeluaran.
     */
    public function scopePemasukan($query)
    {
        return $query->where('jenis', 'pemasukan');
    }

    public function scopePengeluaran($query)
    {
        return $query->where('jenis', 'pengeluaran');
    }
}