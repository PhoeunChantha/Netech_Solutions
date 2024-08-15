<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\helpers\AppHelper;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\App;

class Service extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function getNameAttribute($name)
    {
        if (strpos(url()->current(), '/admin')) {
            return $name;
        }
        return $this->translations[0]->value ?? $name;
    }
    public function getDescriptionAttribute($description)
    {
        if (strpos(url()->current(), '/admin')) {
            return $description;
        }
        return $this->translations[1]->value ?? $description;
    }


    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }

    public function translations()
    {
        return $this->morphMany(Translation::class, 'translationable');
    }

    protected static function boot()
    {
        parent::boot();
        static::addGlobalScope('translate', function (Builder $builder) {
            $builder->with(['translations' => function ($query) {
                if (strpos(url()->current(), '/api')) {
                    return $query->where('locale', App::getLocale());
                } else {
                    return $query->where('locale', AppHelper::default_lang());
                }
            }]);
        });
    }
}
