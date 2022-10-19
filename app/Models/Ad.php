<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ad extends Model
{
    use HasFactory;
    protected $fillable = [
        'type', 'title', 'description', 'category_id', 'user_id', 'start_date'
    ];
    public function tags()
    {
        return $this->belongsToMany(Tag::class, 'ad_tag');
    }
    public function category()
    {
        return $this->belongsTo(Category::class);
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
