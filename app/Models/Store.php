<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Store extends Model
{
    use HasFactory;

    protected $guarded = array('id');

    public static $rules = array(
        'store_name' => 'required',
        'area_id' => 'required',
        'genre_id' => 'required',
    );

    public function area()
    {
        return $this->hasOne('App\Models\Area', 'id', 'area_id');
    }

    public function genre()
    {
        return $this->hasOne('App\Models\genre', 'id', 'genre_id');
    }

    public function users()
    {
        return $this->belongsToMany(User::class)->withTimestamps();
    }
}
