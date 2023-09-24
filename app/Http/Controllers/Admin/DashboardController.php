<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Models\Jokes;
use App\Models\LodgementInformation;
use App\Models\ServiceInterest;
use App\Models\Skill;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use LaravelDaily\LaravelCharts\Classes\LaravelChart;
use DB;

class DashboardController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function index(){

        $users = User::orderBy('id','desc')->take(10)->get();

        $jokes = Jokes::with('user')->orderBy('id','desc')->take(10)->get();
       
        return view('admin.dashboard.dashboard',compact('users','jokes'));
    }
}
