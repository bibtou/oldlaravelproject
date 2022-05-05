<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Route;
use App\DataContainers\BlockPageDataContainer;
use App\Models\{
	Article, Category
};
use App\Services\Resource\{
	PageResourceService
};

class RouteServiceProvider extends ServiceProvider
{
    /**
     * This namespace is applied to your controller routes.
     *
     * In addition, it is set as the URL generator's root namespace.
     *
     * @var string
     */
    protected $namespace = 'App\Http\Controllers';

    /**
     * The path to the "home" route for your application.
     *
     * @var string
     */
    public const HOME = '/home';

    /**
     * Define your route model bindings, pattern filters, etc.
     *
     * @return void
     */
    public function boot()
    {
        //
		Route::pattern('page', '^([0-9]+)$');
		Route::pattern('slug', '^[0-9a-z\-]+$');
		Route::pattern('year', '^[0-9]{4}$');
		Route::pattern('month', '^[0-9]{2}$');
		
		Route::resourceVerbs([
			'create' => 'creer',
			'edit' => 'editer',
		]);		
		
        parent::boot();
		
		
		
		Route::bind('article_slug', function($value) {
			return Article::articleBlog($value, !auth()->check() ? Article::PUBLIC_POST : null);
		});
		
		Route::bind('category_slug', function($value) {
			return Category::where('slug', $value)->firstOrFail();
		});
		
		Route::bind('resource_page_from_block', function($blockId) {
			return new PageResourceService(
				(new BlockPageDataContainer)
					->setBlockId($blockId ?? 0)
					->setBlockSlug(request()->route()->parameters()['block_slug'] ?? '')
					->setPageId(request()->route()->parameters()['page_id'] ?? 0)
					->setPageSlug(request()->route()->parameters()['page_slug'] ?? '')
					->setLinkPosition(request()->route()->parameters()['block_link_position'] ?? 0)
			);
		});
    }

    /**
     * Define the routes for the application.
     *
     * @return void
     */
    public function map()
    {
        $this->mapApiRoutes();

        $this->mapWebRoutes();

        //
    }

    /**
     * Define the "web" routes for the application.
     *
     * These routes all receive session state, CSRF protection, etc.
     *
     * @return void
     */
    protected function mapWebRoutes()
    {
        Route::middleware('web')
             ->namespace($this->namespace)
             ->group(base_path('routes/web.php'));
    }

    /**
     * Define the "api" routes for the application.
     *
     * These routes are typically stateless.
     *
     * @return void
     */
    protected function mapApiRoutes()
    {
        Route::prefix('api')
             ->middleware('api')
             ->namespace($this->namespace)
             ->group(base_path('routes/api.php'));
    }
}
