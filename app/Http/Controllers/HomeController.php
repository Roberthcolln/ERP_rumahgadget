<?php

namespace App\Http\Controllers;

use App\Models\Musik;
use App\Models\Setting;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $q = $request->q;

        $konf = DB::table('setting')->first();



        return view('welcome', compact(
            'konf',

        ));
    }
}
