<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SavingGoal extends Model
{
    protected $fillable = ['name', 'amount', 'user_id', 'description', 'goal_date'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
