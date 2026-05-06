<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class userController extends Controller
{
    function index(){
        $usuarios = DB::table('users')->get();
    }
}
/*
Modifico esto para commit

*/