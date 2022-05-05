<?php

namespace App\Http\Controllers\Resource;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\Resource\{
	PageResourceService
};

class HomeController extends Controller
{
    public function index()
	{
		return view('resource.home.index');
	}

	/**
	 * @param \App\Services\Resource\PageResourceService $resource
	 *
	 * @return
	 */
	public function show(PageResourceService $resource)
	{
		$completeResource = $resource->completeResource();

		return view('resource.home.show', []); //['page' => $completeResource->get('page'), 'block' => $completeResource->get('block')]);
	}
}
