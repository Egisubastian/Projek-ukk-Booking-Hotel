<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Scout\Searchable;

class TransactionsM extends Model
{
    use HasFactory, Searchable;
    protected $table = "transactions";
    protected $fillable = ["id","id_produk", "nomor_unik", "nama_pelanggan", "fasilitas", "nomor_unik", "uang_bayar", "uang_kembali","status","total_harga"];
    protected $casts = [
        'tanggal_checkin',
            'tanggal_checkout',
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

    public function product()
    {
        return $this->belongsTo(ProductsM::class, 'id_produk', 'id');
    }

    public function getStatus()
    {
        // Add your logic to determine and return the status
        return $this->attributes['status']; // Replace 'status' with the actual status field in your model
    }
}
