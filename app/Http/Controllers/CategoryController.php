<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CategoryModel as Category;
use App\Models\ArticleModel as Article;
use Illuminate\Support\Str;

class CategoryController extends Controller
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
        $categories = Category::all();
        return view('category.index', compact('categories'));
    }

    public function show($id)
    {
        $category = category::find($id);
        return view('category.show', compact('category'));
    }

    public function create()
    {
        return view('category.create');
    }

    public function store(Request $request)
    {
        try {
            // validate request 
            $this->validate($request, [
                'name' => 'required',
            ]);

            // change title to slug
            $slug = Str::slug($request->name);
            $category            = new category();
            $category->name = $request->name;
            $category->slug = $slug;
            $category->save();
            // return redirect with message
            return redirect()->route('category.index')->withStatus(__('category has been created'));    
            // return redirect('category.index')->withErrors(['success' => 'category has been created']);

        } catch (\Throwable $th) {
            //throw $th;
            return redirect()->route('category.index')->withErrors(['error' => $th->getMessage()]);
        }
        
    }

    public function edit($id)
    {
        $category = category::find($id);
        return view('category.edit', compact('category'));
    }

    public function update(Request $request, $id)
    {
        try {
            // validate request 
            $this->validate($request, [
                'name' => 'required',
            ]);

            // change title to slug
            $slug = Str::slug($request->name);
            // update category
            $category = category::find($id);
            $category->name = $request->name;
            $category->slug = $slug;
            $category->save();

            // return redirect with message
            return redirect()->route('category.index')->withStatus(__('category has been updated'));    

        } catch (\Throwable $th) {
            //throw $th;
            return redirect()->route('category.index')->withStatus(__('category has been updated'));
        }
    }

    public function destroy($id)
    {
        $category = category::where('id', $id)->first();
        $category->delete();
        return redirect()->route('category.index')->withErrors(['success' => 'category has been deleted']);
    }

    public function list($slug)
    {
        try {
            $category = category::where('slug', $slug)->first();
            $article = article::where('category_id',$category->id)->get();
            if ($article->isNotEmpty()) {
                return view('news.detail', compact('article'));    
            } else {
                return view('news.index')->withErrors(['error' => 'Article not found']);
            }
        } catch (\Throwable $th) {
            return redirect()->route('news.index')->withStatus(__('category news is empty'));
        }
    }
}
