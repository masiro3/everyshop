<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Category extends Model
{
    use HasFactory;
    protected $fillable = [
        'category_name',
    ];
    public $timestamps = false;

    protected $guarded = ['id'];
    
    public function books()
    {
        return $this->hasMany(Book::class);
    }
}