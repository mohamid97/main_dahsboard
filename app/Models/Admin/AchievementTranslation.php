<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AchievementTranslation extends Model 
{
    use HasFactory;
    protected $fillable = ['small_des', 'name'];
}
