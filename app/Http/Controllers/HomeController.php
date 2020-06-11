<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home.home');
    }

    /**
     * Show the route for 404 responses.
     */
    public function getNotFound()
    {
        return response()->view('errors.404', [], 404);
    }

    /**
     * Show the view for the /robots.txt
     * @return \Illuminate\Http\Response
     */
    public function getRobots()
    {
        my_log('here');
        $sitePublic = setting('app-public', false);
        $allowRobots = config('app.allow_robots');
        my_log('allowRobots: '.$allowRobots);
        if ($allowRobots === null) {
            $allowRobots = $sitePublic;
        }

        return response()
            ->view('common.robots', ['allowRobots' => $allowRobots])
            ->header('Content-Type', 'text/plain');
    }
}
