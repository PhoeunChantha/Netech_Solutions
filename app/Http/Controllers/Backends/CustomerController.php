<?php

namespace App\Http\Controllers\Backends;

use Exception;
use App\Models\Customer;
use App\Models\Translation;
use Illuminate\Http\Request;
use App\helpers\ImageManager;
use App\Models\BusinessSetting;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $customers = Customer::latest('id')->paginate(10);
        return view('backends.customer.index', compact('customers'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $language = BusinessSetting::where('type', 'language')->first();
        $language = $language->value ?? null;
        $default_lang = 'en';
        $default_lang = json_decode($language, true)[0]['code'];
        return view('backends.customer.create', compact('language', 'default_lang'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'first_name' => 'required',
            'last_name' => 'required',
            'address' => 'required',
            'phone' => 'required',
            'email' => 'required',
        ]);

        if (is_null($request->first_name[array_search('en', $request->lang)])) {
            $validator->after(function ($validator) {
                $validator->errors()->add(
                    'first_name',
                    'First name field is required!'
                );
            });
        }
        if (is_null($request->last_name[array_search('en', $request->lang)])) {
            $validator->after(function ($validator) {
                $validator->errors()->add(
                    'last_name',
                    'Last name field is required!'
                );
            });
        }

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput()
                ->with(['success' => 0, 'msg' => __('Invalid form input')]);
        }

        try {
            DB::beginTransaction();

            $customer = new Customer();
            $customer->first_name = $request->first_name[array_search('en', $request->lang)];
            $customer->last_name = $request->last_name[array_search('en', $request->lang)];
            $customer->email = $request->email;
            $customer->address = $request->address;
            $customer->dob = $request->dob;
            $customer->phone = $request->phone;
            if ($request->hasFile('image')) {
                $customer->image = ImageManager::upload('uploads/customer/', $request->image);
            }

            $customer->save();

            $data = [];
            foreach ($request->lang as $index => $key) {
                if (isset($request->first_name[$index]) && $key != 'en') {
                    $data[] = [
                        'translationable_type' => 'App\Models\Customer',
                        'translationable_id' => $customer->id,
                        'locale' => $key,
                        'key' => 'first_name',
                        'value' => $request->first_name[$index],
                    ];
                }
            }

            foreach ($request->lang as $index => $key) {
                if (isset($request->last_name[$index]) && $key != 'en') {
                    $data[] = [
                        'translationable_type' => 'App\Models\Customer',
                        'translationable_id' => $customer->id,
                        'locale' => $key,
                        'key' => 'first_name',
                        'value' => $request->last_name[$index],
                    ];
                }
            }
            Translation::insert($data);
            DB::commit();

            $output = [
                'success' => 1,
                'msg' => ('Create successfully'),
            ];
        } catch (Exception $e) {
            dd($e);
            DB::rollBack();
            $output = [
                'success' => 0,
                'msg' => __('Something went wrong'),
            ];
        }
        return redirect()->route('admin.customer.index')->with($output);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $customer = Customer::withoutGlobalScopes()->with('translations')->findOrFail($id);
        $language = BusinessSetting::where('type', 'language')->first();
        $language = $language->value ?? null;
        $default_lang = 'en';
        $default_lang = json_decode($language, true)[0]['code'];

        return view('backends.customer.edit', compact('customer','language', 'default_lang'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validator = Validator::make($request->all(), [
            'first_name' => 'required',
            'last_name' => 'required',
            'address' => 'required',
            'phone' => 'required',
            'email' => 'required',
        ]);

        if (is_null($request->first_name[array_search('en', $request->lang)])) {
            $validator->after(function ($validator) {
                $validator->errors()->add(
                    'first_name',
                    'First name field is required!'
                );
            });
        }
        if (is_null($request->last_name[array_search('en', $request->lang)])) {
            $validator->after(function ($validator) {
                $validator->errors()->add(
                    'last_name',
                    'Last name field is required!'
                );
            });
        }

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput()
                ->with(['success' => 0, 'msg' => __('Invalid form input')]);
        }

        try {
            DB::beginTransaction();

            $customer = Customer::findOrFail($id); 
            $customer->first_name = $request->first_name[array_search('en', $request->lang)];
            $customer->last_name = $request->last_name[array_search('en', $request->lang)];
            $customer->email = $request->email;
            $customer->address = $request->address;
            $customer->dob = $request->dob;
            $customer->phone = $request->phone;
            if ($request->hasFile('image')) {
                $oldImage = $customer->image;
                $customer->image = ImageManager::update('uploads/customer/', $oldImage, $request->file('image'));
            }

            $customer->save();

            $data = [];
            foreach ($request->lang as $index => $key) {
                if (isset($request->first_name[$index]) && $key != 'en') {
                    $data[] = [
                        'translationable_type' => 'App\Models\Customer',
                        'translationable_id' => $customer->id,
                        'locale' => $key,
                        'key' => 'first_name',
                        'value' => $request->first_name[$index],
                    ];
                }
            }

            foreach ($request->lang as $index => $key) {
                if (isset($request->last_name[$index]) && $key != 'en') {
                    $data[] = [
                        'translationable_type' => 'App\Models\Customer',
                        'translationable_id' => $customer->id,
                        'locale' => $key,
                        'key' => 'first_name',
                        'value' => $request->last_name[$index],
                    ];
                }
            }
            Translation::insert($data);
            DB::commit();

            $output = [
                'success' => 1,
                'msg' => ('Update successfully'),
            ];
        } catch (Exception $e) {
            dd($e);
            DB::rollBack();
            $output = [
                'success' => 0,
                'msg' => __('Something went wrong'),
            ];
        }
        return redirect()->route('admin.customer.index')->with($output);
    }
    public function updateStatus(Request $request)
    {
        try {
            DB::beginTransaction();

            $customer = Customer::findOrFail($request->id);
            $customer->status = $customer->status == 1 ? 0 : 1;
            $customer->save();

            $output = ['status' => 1, 'msg' => __('Status updated')];

            DB::commit();
        } catch (Exception $e) {
            DB::rollBack();
            $output = ['status' => 0, 'msg' => __('Something went wrong')];
        }

        return response()->json($output);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            DB::beginTransaction();
            $customer = Customer::findOrFail($id);
            $translation = Translation::where('translationable_type', 'App\Models\Customer')
                ->where('translationable_id', $customer->id);
            $translation->delete();
            $customer->delete();

            $customers = customer::latest('id')->paginate(10);
            $view = view('backends.customer._table', compact('customers'))->render();

            DB::commit();
            $output = [
                'status' => 1,
                'view' => $view,
                'msg' => __('Deleted successfully')
            ];
        } catch (Exception $e) {
            DB::rollBack();
            $output = [
                'status' => 0,
                'msg' => __('Something went wrong')
            ];
        }

        return response()->json($output);
    }
}
