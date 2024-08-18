<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\SoftDeletes;

class Achievement extends Model implements  TranslatableContract
{
    use HasFactory , Translatable , SoftDeletes;
    protected $fillable = ['value' , 'max_value' , 'image'];
    public $translatedAttributes = ['small_des', 'name'];
    public $translationForeignKey = 'achivement_id';
    public $translationModel = 'App\Models\Admin\AchievementTranslation';
}
