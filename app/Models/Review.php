<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    use HasFactory;

    protected $guarded = array('id');

    public static $rules = array(
        'user_id' => 'required',
        'store_id' => 'required',
        'review_title' => 'required',
        'comment' => 'required',
        'stars' => 'required',
    );

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}