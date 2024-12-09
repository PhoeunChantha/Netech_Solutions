<?php

namespace App\Http\Controllers\Backends;

use App\Http\Controllers\Controller;
use App\Models\Contact;
use App\Models\Employee;
use App\Models\Product;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $contacts = Contact::all();
        $products = Product::where('status', 1)->get();
        $employees = Employee::where('status', 1)->get();
        return view('backends.index', compact('contacts', 'products', 'employees'));
    }
}
