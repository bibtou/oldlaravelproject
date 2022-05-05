<?php

namespace App\Services\Resource;

use App\DataContainers\BlockPageDataContainer;
use App\Models\{
	Page, Block, BlockLink
};
use Illuminate\Support\Facades\Storage;

class PageResourceService
{
	protected $blockPageDataContainer;

	/**
	 * @param BlockPageDataContainer $blockPageDataContainer
	 */
	public function __construct(BlockPageDataContainer $blockPageDataContainer)
	{
		$this->blockPageDataContainer = $blockPageDataContainer;
	}
	/**
	 * Retourne une collection contenant les informations du bloc et la page associee
	 *
	 * @return \Illuminate\Support\Collection
	 */
	public function completeResource()
	{
		$clauses = [
			'blockId' => $this->blockPageDataContainer->getBlockId(),
			'blockSlug' => $this->blockPageDataContainer->getBlockSlug(),
			'pageId' => $this->blockPageDataContainer->getPageId(),
			'pageSlug' => $this->blockPageDataContainer->getPageSlug(),
			'position' => $this->blockPageDataContainer->getLinkPosition()
		];

		// Recuperation de la page associee a un bloc si celui-ci existe
		$resource = Block::with(['pages' => function($query) use($clauses) {
				return $query->without(['user', 'link'])
					->wherePivot('block_id', $clauses['blockId'])
					->wherePivot('position', $clauses['position'])
					->wherePivot('page_id', $clauses['pageId'])
					->where('published', Page::PUBLISHED)
					->whereSlug($clauses['pageSlug'])
					->firstOrFail();
			}])
			->whereId($clauses['blockId'])
			->whereVisible(Block::VISIBLE)
			->whereSlug($clauses['blockSlug'])
			->firstOrFail();
			
		$resourcePrev = Block::with(['pages' => function($query) use($clauses) {
				return $query->select('title')
					->without(['user', 'link'])
					->wherePivot('block_id', $clauses['blockId'])
					->wherePivot('position', '<', $clauses['position'])
					->wherePivot('page_id', '<', $clauses['pageId'])
					->where('published', Page::PUBLISHED)
					->orderBy('position', 'desc');
			}])
			->select('id')
			->whereId($clauses['blockId'])
			->whereVisible(Block::VISIBLE)
			->whereSlug($clauses['blockSlug'])
			->first();
			
		$resourceNext = Block::with(['pages' => function($query) use($clauses) {
				return $query->select('title')
					->without(['user', 'link'])
					->wherePivot('block_id', $clauses['blockId'])
					->wherePivot('position', '>', $clauses['position'])
					->wherePivot('page_id', '>', $clauses['pageId'])
					->where('published', Page::PUBLISHED)
					->orderBy('position', 'asc');
			}])
			->select('id')
			->whereId($clauses['blockId'])
			->whereVisible(Block::VISIBLE)
			->whereSlug($clauses['blockSlug'])
			->first();

		$page = $resource->pages->first();
		$page->prevLink = $resourcePrev->pages->first()->pivot->url ?? '';
		$page->nextLink = $resourceNext->pages->first()->pivot->url ?? '';

		unset($resource->pages);
		$resource->page = $page;

		return $resource;
	}
}