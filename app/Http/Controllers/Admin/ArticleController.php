<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\Admin\RequestManageArticle;
use Illuminate\Support\Str;
use App\Models\Article;
use App\Models\Category;

class ArticleController extends Controller
{
	// protected $article;
	protected $category;
	protected $startYear = 2020;
	
	public function __construct(/*Article $article, */Category $category)
	{
		// $this->article = $article;
		$this->category = $category;
	}
	
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Article $article)
    {
		return view('blog.admin.article.index', ['items' => $article->latest('displayed_at')->simplePaginate()]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Article $article)
    {
        $categories = $this->category->all();
		$startYear = $this->startYear;
		$route = route('blog.admin.article.store');
		
		return view('blog.admin.article.create', get_defined_vars());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(RequestManageArticle $request, Article $article)
    {
		$article->published = $request->published;
		$article->private = $request->status;
		$article->title = $request->title;
		$article->slug = $request->filled('slug') ? Str::slug($request->slug) : Str::slug($request->title);
		$article->description = $request->excerpt;
		$article->article = $request->article;
		$article->user_id = auth()->user()->id;
		$article->category_id = $request->category;
		$article->displayed_at = $request->getDateFormatted();
		$article->save();

		return response()->json([
			'article_id' => $article->id,
			'created_at' => $article->created_at,
			'displayed_at' => $article->displayed_at
		]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Article $article)
    {
        
		return view('blog.admin.article.show', get_defined_vars());
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Article $article)
    {
        $categories = $this->category->all();
		$startYear = $this->startYear;
		$route = route('blog.admin.article.update', ['article' => $article->id]);

		return view('blog.admin.article.create', get_defined_vars());
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(RequestManageArticle $request, Article $article)
    {
		$article->published = $request->published;
		$article->private = $request->status;
		$article->title = $request->title;
		$article->slug = $request->filled('slug') ? Str::slug($request->slug) : Str::slug($request->title);
		$article->description = $request->excerpt;
		$article->article = $request->article;
		$article->user_id = auth()->user()->id;
		$article->category_id = $request->category;
		$article->displayed_at = $request->getDateFormatted();
		$article->save();
		
		return response()->json([
			'article_id' => $article->id,
			'updated_at' => $article->created_at,
			'updated_at_formatted' => $article->updated_at_formatted,
			'displayed_at' => $article->displayed_at,
			'displayed_at_formatted' => $article->displayed_at_formatted
		]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
		$article = Article::find($id);

		if($article) {
			$article->delete();
			$status = 'success_article';
		} else {
			$status = 'failed_article';
		}

		return redirect()->route('blog.admin.article.index')->with($status, $article->title ?? '');
    }
}
