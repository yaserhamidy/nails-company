<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Models\subject;
use App\Models\question;
use App\Models\awnser;

class AdminController extends Controller
{
    function index(){
        return view('dashboards.admins.index');
    }
    function profile(){
        return view('dashboards.admins.profile');
    }
    function settings(){
        return view('dashboards.admins.settings');
    }
    public function admin(){
        return view('dashboards.admins.index');
    }

    // 

   
}
