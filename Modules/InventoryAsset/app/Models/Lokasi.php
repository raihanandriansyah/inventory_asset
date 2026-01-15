<?php

namespace Modules\InventoryAsset\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
// use Modules\InventoryAsset\Database\Factories\LokasiFactory;

class Lokasi extends Model
{
    use HasFactory;

    protected $table = 'lokasi';

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [
        'kode_lokasi',
        'nama_lokasi',
    ];

    // protected static function newFactory(): LokasiFactory
    // {
    //     // return LokasiFactory::new();
    // }
}
