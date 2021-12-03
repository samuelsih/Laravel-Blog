<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    //$fillable membuat table hanya bisa diisi title dan content saja
    protected $fillable = [
        'title',
        'slug',
        'description',
        'content',
    ];

    //user() meng-set relasi dari post dan user menjadi one to many
    //belongsTo artinya setiap post yang dibuat hanya dimiliki 1 user
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function categories()
    {
        return $this->belongsToMany(Category::class, 'category_post');
    }
}
