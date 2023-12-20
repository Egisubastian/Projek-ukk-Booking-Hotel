<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Scout\Searchable;

class TransactionsM extends Model
{
    use HasFactory, Searchable;
    protected $table = "transactions";
    protected $fillable = ["id", "id_produk", "nama_pelanggan", "nomor_unik", "uang_bayar", "uang_kembali"];
    protected $casts = [
        'created_at' => 'datetime',
    ];

    public function searchableAs()
    {
        return 'transactions';
    }

    public function toSearchableArray()
    {
        return [
            'nama_pelanggan'     => $this->nama_pelanggan,
            'created_at'     => $this->created_at,
        ];
    }
}
