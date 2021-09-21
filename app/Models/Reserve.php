<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reserve extends Model
{
    use HasFactory;

    protected $guarded = array('id');

    public static $rules = array(
        'user_id' => 'required',
        'store_id' => 'required',
        'datetime' => 'required',
        'number' => 'required',
    );

    public function store()
    {
        return $this->belongsTo('App\Models\Store');
    }
}