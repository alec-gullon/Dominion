<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [
        'name', 'guid', 'game_id'
    ];

    public function game() {
        return $this->belongsTo('App\Models\Game');
    }
}