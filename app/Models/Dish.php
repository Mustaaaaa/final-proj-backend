<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Casts\Attribute;
use App\Http\Traits\HasSlug;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class Dish extends Model
{
    use HasFactory, HasSlug, SoftDeletes;


    public function company()
    {
        return $this->belongsTo(Company::class);
    }

    public function orders()
    {
        return $this->belongsToMany(Order::class, 'dish_order')->withPivot('qty');
    }

    protected $appends = ['image_fullpath'];

    protected function imageFullpath(): Attribute
    {
        return new Attribute(
            get: fn () =>
            $this->image ? asset('http://127.0.0.1:8000/storage/' . $this->image) : null,
        );
    }


    protected $fillable = ['name', 'slug', 'image', 'description', 'ingredients', 'price', 'visible', 'company_id'];
}
