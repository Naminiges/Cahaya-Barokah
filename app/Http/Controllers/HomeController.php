<?php
 
namespace App\Http\Controllers;
 
use Illuminate\Http\Request;
 
class HomeController extends Controller
{
    public function index()
    {
        if (auth()->user()->usertype == 'admin') {
            return view('admin.dashboard');
        } else {
            return view('dashboard');
        }
    }
}
