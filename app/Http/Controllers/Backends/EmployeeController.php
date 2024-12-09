<?php

namespace App\Http\Controllers\Backends;

use Exception;
use App\Models\Employee;
use App\Models\Translation;
use Illuminate\Http\Request;
use App\helpers\ImageManager;
use App\Models\BusinessSetting;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $employees = Employee::latest('id')->paginate(10);
        return view('backends.employee.index', compact('employees'));
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
        return view('backends.employee.create', compact('language', 'default_lang'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
        ]);

        if (is_null($request->name[array_search('en', $request->lang)])) {
            $validator->after(function ($validator) {
                $validator->errors()->add(
                    'name',
                    'Name field is required!'
                );
            });
        }
        // if (is_null($request->description[array_search('en', $request->lang)])) {
        //     $validator->after(function ($validator) {
        //         $validator->errors()->add(
        //             'description',
        //             'Description field is required!'
        //         );
        //     });
        // }

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput()
                ->with(['success' => 0, 'msg' => __('Invalid form input')]);
        }

        try {
            DB::beginTransaction();

            $emp = new Employee();
            $emp->name = $request->name[array_search('en', $request->lang)];
            $emp->email = $request->email;
            $emp->position = $request->position;
            $emp->phone = $request->phone;
            $emp->address = $request->address;
            if ($request->hasFile('image')) {
                $emp->image = ImageManager::upload('uploads/employee/', $request->image);
            }

            $emp->save();

            $data = [];
            foreach ($request->lang as $index => $key) {
                if (isset($request->name[$index]) && $key != 'en') {
                    $data[] = [
                        'translationable_type' => 'App\Models\Employee',
                        'translationable_id' => $emp->id,
                        'locale' => $key,
                        'key' => 'name',
                        'value' => $request->name[$index],
                    ];
                }
            }

            foreach ($request->lang as $index => $key) {
                if (isset($request->description[$index]) && $key != 'en') {
                    $data[] = [
                        'translationable_type' => 'App\Models\Employee',
                        'translationable_id' => $emp->id,
                        'locale' => $key,
                        'key' => 'description',
                        'value' => $request->description[$index],
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
            // DB::rollBack();
            // $output = [
            //     'success' => 0,
            //     'msg' => __('Something went wrong'),
            // ];
        }
        return redirect()->route('admin.employee.index')->with($output);
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
        $employee = Employee::findOrFail($id);
        $language = BusinessSetting::where('type', 'language')->first();
        $language = $language->value ?? null;
        $default_lang = 'en';
        $default_lang = json_decode($language, true)[0]['code'];
        return view('backends.employee.edit', compact('employee', 'language', 'default_lang'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
        ]);

        if (is_null($request->name[array_search('en', $request->lang)])) {
            $validator->after(function ($validator) {
                $validator->errors()->add(
                    'name',
                    'Name field is required!'
                );
            });
        }
        // if (is_null($request->description[array_search('en', $request->lang)])) {
        //     $validator->after(function ($validator) {
        //         $validator->errors()->add(
        //             'description',
        //             'Description field is required!'
        //         );
        //     });
        // }

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput()
                ->with(['success' => 0, 'msg' => __('Invalid form input')]);
        }

        try {
            DB::beginTransaction();

            $emp = Employee::findOrFail($id);
            $emp->name = $request->name[array_search('en', $request->lang)];
            $emp->email = $request->email;
            $emp->position = $request->position;
            $emp->phone = $request->phone;
            $emp->address = $request->address;
            if ($request->hasFile('image')) {
                $oldImage = $emp->image;
                $emp->image = ImageManager::update('uploads/employee/', $oldImage, $request->file('image'));
            }

            $emp->save();

            $data = [];
            foreach ($request->lang as $index => $key) {
                if (isset($request->name[$index]) && $key != 'en') {
                    $data[] = [
                        'translationable_type' => 'App\Models\Employee',
                        'translationable_id' => $emp->id,
                        'locale' => $key,
                        'key' => 'name',
                        'value' => $request->name[$index],
                    ];
                }
            }

            foreach ($request->lang as $index => $key) {
                if (isset($request->description[$index]) && $key != 'en') {
                    $data[] = [
                        'translationable_type' => 'App\Models\Employee',
                        'translationable_id' => $emp->id,
                        'locale' => $key,
                        'key' => 'description',
                        'value' => $request->description[$index],
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
            // DB::rollBack();
            $output = [
                'success' => 0,
                'msg' => __('Something went wrong'),
            ];
        }
        return redirect()->route('admin.employee.index')->with($output);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            DB::beginTransaction();
            $employee = Employee::findOrFail($id);
            $translation = Translation::where('translationable_type', 'App\Models\Employee')
            ->where('translationable_id', $employee->id);

            $translation->delete();
            $employee->delete();

            $employees = Employee::latest('id')->paginate(10);
            $view = view('backends.employee._table', compact('employees'))->render();

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
    public function updateStatus(Request $request)
    {
        try {
            DB::beginTransaction();

            $employee = Employee::findOrFail($request->id);
            $employee->status = $employee->status == 1 ? 0 : 1;
            $employee->save();

            $output = ['status' => 1, 'msg' => __('Status updated')];

            DB::commit();
        } catch (Exception $e) {
            $output = ['status' => 0, 'msg' => __('Something went wrong')];
            DB::rollBack();
        }

        return response()->json($output);
    }
}
