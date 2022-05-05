<?php

namespace App\Http\View\Composers;

use Illuminate\View\View;
use Illuminate\Support\Facades\DB;
use App\Models\Article;
use App\Models\Category;

class BlogAsideComposer
{
	protected $category;
	
	public function __construct(Category $category)
	{
		$this->category = $category;
	}
	
	public function compose(View $view)
	{
		$onlyPublicPostIfNotAuthenticated = !auth()->check() ? Article::PUBLIC_POST : null;
		
		$categories = Category::withCount(['articles' => function($query) use($onlyPublicPostIfNotAuthenticated) {
			return $query->published($onlyPublicPostIfNotAuthenticated);
		}])->get();
		
		$archives = Article::select(
				DB::raw('
					YEAR(displayed_at) AS displayed_at_year,
					MONTH(displayed_at) AS displayed_at_month,
					COUNT(*) AS articles_count,
					MONTHNAME(displayed_at) AS month_name
				')
			)
			->without(['user', 'category'])
			->published($onlyPublicPostIfNotAuthenticated)
			->groupBy(DB::raw('displayed_at_month, displayed_at_year, month_name'))
			->orderBy('displayed_at', 'desc')
			->get();
		
		$view->with('categories_with_total_article_published', $categories);
		$view->with('archives_with_total_article_published', $archives);
	}
}