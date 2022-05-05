<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Http\Requests\Admin\RequestManageResourcePage;
use App\Models\{
	Domain, Link, Page
};

class ResourcePageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Page $page)
    {
        return view('blog.admin.resource-page.index', ['items' => $page->latest('created_at')->simplePaginate()]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Page $page)
    {
		$route = route('blog.admin.resource-page.store');

        return view('blog.admin.resource-page.create', get_defined_vars());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\Admin\RequestManageResourcePage  $request
     * @return \Illuminate\Http\Response
     */
    public function store(RequestManageResourcePage $request)
    {
		if($request->url_source === NULL) {
			$linkId = NULL;
		} else {
			$domain = Domain::firstOrCreate([
				'domain' => parse_url($request->url_source, PHP_URL_HOST),
				'user_id' => auth()->user()->id
			]);

			$linkId = Link::firstOrCreate([
				'fingerprint' => sha1($request->url_source),
				'link' => $request->url_source,
				'domain_id' => $domain->id,
				'user_id' => auth()->user()->id
			])->id;
		}
		
		$page = Page::create([
			'published' => $request->published,
			'private' => $request->private,
			'title' => $request->title,
			'slug' => Str::slug($request->title, '-'),
			'description' => $request->description,
			'content' => $request->content,
			'link_id' => $linkId,
			'user_id' => auth()->user()->id
		]);
		
		return response()->json([
			'page_id' => $page->id,
			'created_at' => $page->created_at
		]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $page = Page::find($id);

		return view('blog.admin.resource-page.show', get_defined_vars());
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Page $page)
    {
		$route = route('blog.admin.resource-page.update', ['page' => $page->id]);

        return view('blog.admin.resource-page.create', get_defined_vars());
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        exit('update');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        exit('delete');
    }

	public function pageWithSlug(int $pageId, string $pageSlug)
	{
		exit('page with slug');
	}
}
