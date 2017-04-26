<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use Illuminate\Http\Request;
use App\report;
use App\Project;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use App;
class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $project_count=Project::All()->count();
        $report_count=Report::where('user_id',Auth::user()->id)->count();
        $languages=config('app.locales');
        return view('home',['project_count'=>$project_count,'report_count'=>$report_count,'languages'=>$languages]);
    }
    public  function changelanguage($ln){
        session(['lang' => $ln]);
        App::setLocale($ln);
        config(['app.locale' => $ln]);
        echo App::getLocale();
        return ;
    }

}
