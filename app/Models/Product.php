<?php

namespace App\Models;

use App\helpers\AppHelper;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\App;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use PhpParser\Node\Expr\Cast;

class Product extends Model
{
    use HasFactory;

    use SoftDeletes;

    protected $guarded = ['id'];
    protected $casts = ['thumbnail' => 'array'];
    // In your Product model (e.g., Product.php)

    public function getDiscountedPriceAttribute()
    {
        // Assume the `discount` relation or logic to fetch discount exists here.
        $discount = Discount::where('status', 1)
        ->whereJsonContains('product_ids', $this->id)
            ->first();

        if ($discount) {
            return $this->price - ($this->price * ($discount->discount_value / 100));
        }

        return $this->price;
    }


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

    public function brand()
    {
        return $this->belongsTo(Brand::class, 'brand_id');
    }


    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }

    public function createdBy()
    {
        return $this->belongsTo(User::class, 'created_by');
    }
    public function discount()
    {
        return $this->belongsTo(Discount::class);
    }
    public function orderdetail()
    {
        return $this->belongsTo(OrderDetail::class);
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
    // protected static function booted()
    // {
    //     parent::boot();

    //     static::creating(function ($model) {
    //         if (empty($model->code)) {
    //             do {
    //                 $code = strtoupper(Str::random(10)); // Generate a 10 character random string
    //             } while (self::where('code', $code)->exists()); // Ensure it's unique

    //             $model->code = $code;
    //         }
    //     });
    // }
}
