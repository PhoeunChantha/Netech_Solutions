<?php

namespace App\Http\Controllers\Website;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PolicyAndTermController extends Controller
{
    public function privacy_policy()
    {
        return view('website.privacy_and_term.privacy_policy');
    }
    public function term_condition()
    {
        return view('website.privacy_and_term.term_condition');
    }
}
