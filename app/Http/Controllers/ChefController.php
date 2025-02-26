<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Company;
use Illuminate\Auth\Events\Logout;

class ChefController  extends Controller
{
  

    public function main()
    {
        return view('chef.main');
    } 
    
}






