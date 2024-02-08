<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Scout\Searchable;
use Laravel\Scout\Searchable as MustBeSearchable;

class ProductsM extends Model
{
    use HasFactory, Searchable;

    protected $table = "products";
    protected $fillable = ["id", "nama_produk", "harga_produk", "fasilitas", "status"];
    protected $attributes = [
        'status' => 'available',
    ];

    public function searchableAs()
    {
        return 'products';
    }

    public function toSearchableArray()
    {
        return [
            'nama_produk' => $this->nama_produk,
        ];
    }

    /**
     * The roles that belong to the ProductsM
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function transactions(): BelongsToMany
    {
        return $this->belongsToMany(Role::class, 'role_user_table', 'user_id', 'role_id');
    }
}
