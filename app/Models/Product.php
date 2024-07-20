<?php

namespace App\Models;

use App\helpers\AppHelper;
use Illuminate\Support\Facades\App;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Product extends Model
{
    use HasFactory;

    use SoftDeletes;

    protected $guarded = ['id'];

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



    public function createdBy()
    {
        return $this->belongsTo(User::class, 'created_by');
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
