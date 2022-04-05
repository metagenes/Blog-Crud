<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\ArticleModel as Article;
use App\Models\CategoryModel as Category;
use Ramsey\Uuid\Uuid;

class ArticleController extends Controller
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
        $articles = Article::all();
        return view('article.index', compact('articles'));
    }

    public function show($id)
    {
        $article = Article::where('article_id', $id)->first();
        $categories = Category::where('id', $article->category_id)->first();
        return view('article.show', compact('article', 'categories'));
    }

    public function create()
    {
        // get all categories
        $categories = Category::all();
        return view('article.create', compact('categories'));
    }

    public function store(Request $request)
    {
        try {
            // validate request 
            $this->validate($request, [
                'title' => 'required',
                'content' => 'required',
                // 'banner' => 'required|mimes:jpeg,jpg,png,gif',
                'category' => 'required'
            ]);

            // change title to slug
            $slug = Str::slug($request->title);

            // save file to public/images/article
            // $file = $request->file('banner');
            // $fileName = $slug . '.' . $file->getClientOriginalExtension();
            // $file->move(public_path('images/article'), $fileName);
            $article            = new Article();
            $article->article_id = Uuid::uuid4()->toString();
            $article->title = $request->title;
            $article->slug = $slug;
            $article->content = $request->content;
            $article->banner = 'test';
            $article->category_id = $request->category;
            $article->save();

            // return redirect with message
            return redirect('article.index')->withErrors(['success' => 'Article has been created']);

        } catch (\Throwable $th) {
            //throw $th;
            dd($th->getMessage());
            return redirect('article.index')->withErrors(['error' => $th->getMessage()]);
        }
        
    }

    public function edit($id)
    {
        $article = Article::where('article_id', $id)->first();
        $categories = Category::where('id', $article->category_id)->first();
        return view('article.edit', compact('article', 'categories'));
    }

    public function update(Request $request, $id)
    {
        try {
            // validate request 
            $this->validate($request, [
                'title' => 'required',
                'content' => 'required',
                'banner' => 'mimes:jpeg,jpg,png,gif',
                'category_id' => 'required'
            ]);

            // change title to slug
            $slug = Str::slug($request->title);

            // save file to public/images/article
            $file = $request->file('banner');
            $fileName = $slug . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('images/article'), $fileName);

            $article            = Article::find($id);
            $article->title = $request->title;
            $article->slug = $slug;
            $article->content = $request->content;
            $article->banner = $fileName;
            $article->category_id = $request->category_id;
            $article->save();

            // return redirect with message
            return redirect('article.index')->withErrors(['success' => 'Article has been updated']);

        } catch (\Throwable $th) {
            //throw $th;
            return redirect('article.index')->withErrors(['error' => $th->getMessage()]);
        }
    }

    public function destroy($id)
    {
        $article = Article::where('article_id', $id);
        $article->delete();
        return redirect('article.index')->withErrors(['success' => 'Article has been deleted']);
    }

    public function list($slugCategory, $slugArticle)
    {
        try {
            $article = article::where('slug',$slugArticle)->get();
            if ($article->isNotEmpty()) {
                return view('news.detail', compact('article'));    
            } else {
                return view('news.index')->withErrors(['error' => 'Article not found']);
            }
        } catch (\Throwable $th) {
            return redirect('news.index')->withErrors(['errors', 'Article not found']);
        }
    }
}
