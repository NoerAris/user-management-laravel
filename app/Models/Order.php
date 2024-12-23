<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    // Jika Anda memiliki kolom tertentu yang ingin dimasukkan ke dalam mass assignment, pastikan untuk menambahkannya
    protected $fillable = [
        'user_id',
        'product_name', // contoh, sesuaikan dengan kolom yang ada
        'quantity',
        'price',
    ];

    // Pastikan ada relasi balik ke User jika diperlukan
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
