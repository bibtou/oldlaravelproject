<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\{
	Article,
	Category
};

class BlogController extends Controller
{	
    public function articles(Article $article)
    {
		if ($this->onFirstPage()) return redirect()->route('blog.home');
		
		$items = $article->published( $this->getPostType() )
			->latest('displayed_at')
			->simplePaginate();
		
		return view('blog.article.articles', 
			get_defined_vars()
		);
    }

    public function article(Article $article)
    {
		return view('blog.article.article', get_defined_vars());
    }
	
	public function category(Category $category, Article $article)
	{
		if ($this->onFirstPage()) return redirect()->route('blog.category', ['category_slug' => $category->slug]);
		
		$items = $article->publishedByCategory($category->id, $this->getPostType() )
			->without('category')
			->latest('displayed_at')
			->simplePaginate();
		
		return view('blog.article.articles',
			get_defined_vars()
		);
	}
	
	public function archive($year, $month, Article $article)
	{
		if ($this->onFirstPage()) return redirect()->route('blog.archive', ['year' => $year, 'month' => $month]);
		
		$items = $article->published( $this->getPostType() )
			->whereYear('displayed_at', $year)
			->whereMonth('displayed_at', $month)
			->latest('displayed_at')
			->simplePaginate();
		
		if (0 == $items->count()) abort(404);
		
		return view('blog.article.articles',
			get_defined_vars()
		);
	}
	
	public function search(Request $request, Article $article)
	{
		if ($this->onFirstPage()) return redirect()->route('blog.search', ['s' => $request->input('s')]);
		
		$items = collect([]);
		if ($request->filled('s')) {
			$searchValue = $request->input('s');
			$items = $article->searchOnBlog($searchValue, $this->getPostType() )
				->latest('displayed_at')
				->simplePaginate();
				
			$items->appends(['s' => $searchValue]);
		}
		
		return view('blog.article.articles',
			get_defined_vars()
		);
	}
	
	public function articleByStatus(Request $request, Article $article)
	{
		
		if (Article::PUBLIC_POST == $request->status) {
			$type = Article::PUBLIC_POST;
		} elseif (Article::PRIVATE_POST == $request->status) {
			$type = Article::PRIVATE_POST;
		} else {
			$type = null;
		}
		
		session(['post_type' => $type]);
		
		return ['change' => $type];
	}
	
	private function onFirstPage()
	{
		return request()->has('page') && request()->page <= 1;
	}
	
	private function getPostType()
	{
		if (session()->has('post_type')) {
			return session()->get('post_type');
		} elseif (auth()->check()) {
			return null;
		} else {
			return Article::PUBLIC_POST;
		}
	}
}