<?php

namespace App\Http\Controllers\Backends;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class InvoiceController extends Controller
{
    //
    function index()
    {
        return view('backends.invoice.invoice');
    }
}
