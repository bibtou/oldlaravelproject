<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Http\Requests\Admin\RequestManageResourceBlock;
use App\Models\Block;
use App\Models\BLockLink;

class ResourceBlockController extends Controller
{
    public function index()
	{
		
	}

	public function create(Block $block)
	{
		return view('blog.admin.resource-block.create', get_defined_vars());
	}

	public function store(RequestManageResourceBlock $request)
	{
		$block = Block::create([
			'visible' => $request->published,
			'title' => $request->title,
			'description' => $request->description,
			'slug' => Str::slug($request->title),
			'position' => 0,
			'user_id' => auth()->user()->id
		]);

		$appDomain = env('APP_DOMAIN');
		$position = 1;
		$blockLinks = [];
		$requestLinks = $request->links;

		if(empty($request->allLinks) === false) {
			$requestLinks = array_merge($requestLinks, explode(PHP_EOL, $request->allLinks));
		}

		foreach($requestLinks as $link) {
			$linkParsed = parse_url($link);
			$pageId = null;
			// CREATE HELPER isInternalResourcePage (Verifier que c'est bien une page url /resource/page/ID
			if($appDomain === $linkParsed['host'] and Str::startsWith($linkParsed['path'], '/ressource/page/') === TRUE) {
				// CREATE HELPER buildInternalResourcePageUrl
				// UTILISER TRIM POUR RETIRER /resource/page
				// V2 list($pageId, $pageSlug) = explode('/', trim($linkParsed['path'], '/ressource/page')²);
				list( , , $pageId, $pageSlug) = explode('/', trim($linkParsed['path'], '/'));

				$link = route('resource.show', [
					'resource_page_from_block' => $block->id,
					'page_id' => $pageId,
					'block_link_position' => $position,
					'block_slug' => $block->slug,
					'page_slug' => $pageSlug
				]);
			}

			$blockLinks[] = [
				'block_id' => $block->id,
				'page_id' => $pageId,
				'user_id' => auth()->user()->id,
				'url' => $link,
				'position' => $position
			];

			$position++;
		}

		$block->blockLinks()->createMany($blockLinks);
		
		echo 'saved';
		
		exit(__METHOD__);
		/*
		
		model block_page block_id, block_page_id, position
		*/
	}
}
