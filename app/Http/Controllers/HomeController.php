<?php

namespace App\Http\Controllers;
use App\Models\ArticleModel as Article;
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
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $article = article::all()->take(5);
        return view('dashboard', compact('article'));
    }
}
