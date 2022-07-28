<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $fillable = ['nama'];

//    One to Many (Inverse) => 1 data category bisa memiliki banyak data berita Dan 1 berita hanya bisa dimiliki 1 category.
    public function news()
    {
        return $this->hasMany(News::class);
    }
}
