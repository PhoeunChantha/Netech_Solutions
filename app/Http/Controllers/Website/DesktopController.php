<?php

namespace App\Http\Controllers\Website;

use App\Models\Banner;

use App\Models\Product;
use App\Models\Category;
use App\Models\Discount;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\URL;
use App\Http\Controllers\Controller;

class DesktopController extends Controller
{
    //
    function index()
    {
        $cate = Category::all();
        $banners = Banner::orderBy('order', 'desc')->where('status', '=', '1')->get();
        return view('website.desktop.desktop', compact('cate', 'banners'));
    }
    public function showCategory()
    {
        $cate = Category::where('status', 1)->withCount('products')->get();
        return view('website.desktop.categories', compact('cate'));
    }
    // public function product_detail(Request $request)
    // {
    //     $discounts = Discount::where('status', 1)->whereDate('start_date', '<=', now()) // Ensure the discount has started
    //         ->whereDate('end_date', '>=', now())
    //         ->get();
    //     $product = Product::findOrFail($request->id)
    //         ->each(function ($product) use ($discounts) {
    //             $productDiscount = $discounts->first(function ($discount) use ($product) {
    //                 $productIds = $discount->product_ids;
    //                 return is_array($productIds) && in_array($product->id, $productIds); // Check if product id is in product_ids
    //             });
    //             $product->discount = $productDiscount;
    //         });;
    //     $relatedProducts = Product::where('category_id', $product->category_id)
    //         ->where('id', '!=', $product->id)
    //         ->take(4)
    //         ->get();
    //     return view('website.desktop.product-detail', compact('product', 'relatedProducts'));
    // }
    public function product_detail(Request $request)
    {
        // Fetch active discounts
        $activeDiscounts = Discount::where('status', 1)
            ->whereDate('start_date', '<=', now()) // Discount is active
            ->whereDate('end_date', '>=', now())
            ->get();

        // Find the product
        $product = Product::findOrFail($request->id);

        // Check if this product has an active discount
        $productDiscount = $activeDiscounts->first(function ($discount) use ($product) {
            $productIds = $discount->product_ids;
            return is_array($productIds) && in_array($product->id, $productIds);
        });
        $product->discount = $productDiscount;

        $relatedProducts = Product::where('category_id', $product->category_id)
            ->where('id', '!=', $product->id)
            ->take(4)
            ->get()
            ->each(function ($product) use ($activeDiscounts) {
                $productDiscount = $activeDiscounts->first(function ($discount) use ($product) {
                    $productIds = $discount->product_ids;
                    return is_array($productIds) && in_array($product->id, $productIds); // Check if product id is in product_ids
                });
                $product->discount = $productDiscount;
            });

        return view('website.desktop.product-detail', compact('product', 'relatedProducts'));
    }
    public function search(Request $request)
    {
        $query = $request->input('query');
        $activeDiscounts = Discount::where('status', 1)
            ->whereDate('start_date', '<=', now())
            ->whereDate('end_date', '>=', now())
            ->get();
        $product = Product::where('name', 'LIKE', '%' . $query . '%')
            ->where('status', 1)
            ->first();

        if (!$product) {
            return redirect()->back()->with('error', 'Product not found');
        }
        $productDiscount = $activeDiscounts->first(function ($discount) use ($product) {
            $productIds = $discount->product_ids;
            return is_array($productIds) && in_array($product->id, $productIds);
        });
        $product->discount  = $productDiscount;

        $relatedProducts = Product::where('category_id', $product->category_id)
            ->where('id', '!=', $product->id)
            ->take(4)
            ->get()
            ->each(function ($product) use ($activeDiscounts) {
                $productDiscount = $activeDiscounts->first(function ($discount) use ($product) {
                    $productIds = $discount->product_ids;
                    return is_array($productIds) && in_array($product->id, $productIds); // Check if product id is in product_ids
                });
                $product->discount = $productDiscount;
            });
        return view('website.desktop.product-detail', compact('product', 'query', 'relatedProducts'));
    }

    public function getProductDetails(Request $request, $id)
    {

        $activeDiscounts = Discount::where('status', 1)
            ->whereDate('start_date', '<=', now())
            ->whereDate('end_date', '>=', now())
            ->get();

        $product = Product::findOrFail($id);

        $productDiscount = $activeDiscounts->first(function ($discount) use ($product) {
            $productIds = $discount->product_ids;
            return is_array($productIds) && in_array($product->id, $productIds);
        });

        $product->discount = $productDiscount;

        if (!empty($product->thumbnail) && !is_array($product->thumbnail)) {
            $product->thumbnail = json_decode($product->thumbnail, true);
        }

        $relatedProducts = Product::where('category_id', $product->category_id)
            ->where('id', '!=', $product->id)
            ->take(4)
            ->get()
            ->each(function ($product) use ($activeDiscounts) {
                $productDiscount = $activeDiscounts->first(function ($discount) use ($product) {
                    $productIds = $discount->product_ids;
                    return is_array($productIds) && in_array($product->id, $productIds); // Check if product id is in product_ids
                });
                $product->discount = $productDiscount;
            });
        return response()->json([
            'product' => $product,
            'relatedProducts' => $relatedProducts
        ]);
    }





    public function shopping_cart()
    {
        return view('website.desktop.shopping-cart');
    }
    // public function filterProducts(Request $request)
    // {
    //     $query = Product::query();
    //     // Check if category_id is provided
    //     if ($request->has('category_id')) {
    //         $query->where('category_id', $request->category_id);
    //     }
    //     // Apply Sort By filter
    //     if ($request->sortBy === 'latest') {
    //         $query->orderBy('created_at', 'desc');
    //     } elseif ($request->sortBy === 'best_promotion') {
    //         $discounts = Discount::where('status', 1)->get();
    //         $discountedProductIds = $discounts->flatMap(function ($discount) {
    //             return is_array($discount->product_ids) ? $discount->product_ids : [];
    //         })->toArray();
    //         $query->whereIn('id', $discountedProductIds)->orderBy('price', 'desc');
    //     }

    //     // Apply Brand filter
    //     if ($request->brand_id) {
    //         $query->where('brand_id', $request->brand_id);
    //     }

    //     // Apply Price Range filter
    //     if ($request->priceRange) {
    //         $query->whereBetween('price', [$request->priceRange['min'], $request->priceRange['max']]);
    //     }

    //     $products = $query->latest('id')->paginate(10);
    //     $activeDiscounts = Discount::where('status', 1)->get();
    //     $products->getCollection()->transform(function ($product) use ($activeDiscounts) {
    //         $productDiscount = $activeDiscounts->first(fn($discount) => in_array($product->id, $discount->product_ids));

    //         $product->discount = $productDiscount;
    //         return $product;
    //     });
    //     return view('website.desktop.partials.product_list', compact('products'));
    // }
    public function filterProducts(Request $request)
    {
        // Ensure category_id is provided
        if (!$request->has('category_id')) {
            return response()->json(['error' => 'Category ID is required.'], 400);
        }

        $query = Product::where('category_id', $request->category_id);

        // Apply Sort By filter
        if ($request->sortBy === 'latest') {
            $query->orderBy('created_at', 'desc');
        } elseif ($request->sortBy === 'best_promotion') {
            $discounts = Discount::where('status', 1)->whereDate('start_date', '<=', now()) // Ensure the discount has started
                ->whereDate('end_date', '>=', now())
                ->get();
            $discountedProductIds = $discounts->flatMap(function ($discount) {
                return is_array($discount->product_ids) ? $discount->product_ids : [];
            })->toArray();
            $query->whereIn('id', $discountedProductIds)->orderBy('price', 'desc');
        }

        // Apply Brand filter
        if ($request->has('brand_id') && $request->brand_id) {
            $query->where('brand_id', $request->brand_id);
        }

        // Apply Price Range filter
        if ($request->has('priceRange') && $request->priceRange) {
            $query->whereBetween('price', [$request->priceRange['min'], $request->priceRange['max']]);
        }

        $products = $query->latest('id')->paginate(10);

        $activeDiscounts = Discount::where('status', 1)->whereDate('start_date', '<=', now()) // Ensure the discount has started
            ->whereDate('end_date', '>=', now())
            ->get();
        $products->getCollection()->transform(function ($product) use ($activeDiscounts) {
            $productDiscount = $activeDiscounts->first(fn($discount) => in_array($product->id, $discount->product_ids));

            $product->discount = $productDiscount;
            return $product;
        });

        // Return filtered product list
        return view('website.desktop.partials.product_list', compact('products'));
    }

    public function clearFilters(Request $request)
    {
        $category = Category::where('slug', $request->category_slug)->firstOrFail();
        $discounts = Discount::where('status', 1)->whereDate('start_date', '<=', now()) // Ensure the discount has started
            ->whereDate('end_date', '>=', now())
            ->get();
        $products = Product::where('category_id', $category->id)
            ->latest('id')
            ->paginate(10)
            ->each(function ($product) use ($discounts) {
                $productDiscount = $discounts->first(function ($discount) use ($product) {
                    $productIds = $discount->product_ids;
                    return is_array($productIds) && in_array($product->id, $productIds);
                });
                $product->discount = $productDiscount;
            });

        return view('website.desktop.partials.product_list', compact('products', 'category'));
    }
}
