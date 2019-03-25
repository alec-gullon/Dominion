<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Game extends Model
{
    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [
        'guid', 'object'
    ];

    public function users() {
        return $this->hasMany('App\Models\User');
    }
}