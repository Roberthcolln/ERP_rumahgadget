<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class DataAdmin extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $admin = DB::table('users')

            ->where('users.id', 1) // hanya user dengan id = 1
            ->get();

        $title = 'Data Admin';
        return view('data_admin.index', compact('admin', 'title'));
    }
}
