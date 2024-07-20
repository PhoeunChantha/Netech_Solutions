<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\App;


class BusinessSetting extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    public function getValueAttribute($value)
    {
        if (strpos(url()->current(), '/admin')) {
            return $value;
        }
        return $this->translations[0]->value ?? $value;
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
                    return $query->where('locale', session('locale'));
                }
            }]);
        });
    }
}
