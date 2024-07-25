<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Http\Traits\HasSlug;
use Illuminate\Database\Eloquent\SoftDeletes;

class Company extends Model
{
    use HasFactory, HasSlug, SoftDeletes;

    protected $fillable = [
        'name',
        'slug', 
        'image', 
        'city',
        'address',
        'vat_number',
        'description',
        'phone_number',
        'email',
        'type_id',
        'user_id',
    ]; 
    protected $appends = ['image_fullpath'];

    protected function imageFullpath(): Attribute
    {
        return new Attribute(
            get: fn () =>
            $this->image ? asset('http://127.0.0.1:8000/storage/' . $this->image) : null,
        );
    }

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function types(){
        return $this->belongsToMany(Type::class);
    }

    public function dishes()
    {
        return $this->hasMany(Dish::class);
    }
}
