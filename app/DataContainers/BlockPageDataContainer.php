<?php

namespace App\DataContainers;

use App\Interfaces\BlockPageInterface;

class BlockPageDataContainer implements BlockPageInterface
{
	protected $blockId = 0;

	protected $blockSlug = '';

	protected $pageId = 0;

	protected $pageSlug = '';

	protected $linkPosition = 0;

	public function setBlockId(int $blockId)
	{
		$this->blockId = $blockId;

		return $this;
	}

	public function getBlockId()
	{
		return $this->blockId;
	}

	public function setBlockSlug(string $blockSlug)
	{
		$this->blockSlug = $blockSlug;

		return $this;
	}

	public function getBlockSlug()
	{
		return $this->blockSlug;
	}

	public function setPageId(int $pageId)
	{
		$this->pageId = $pageId;

		return $this;
	}

	public function getPageId()
	{
		return $this->pageId;
	}

	public function setPageSlug(string $pageSlug)
	{
		$this->pageSlug = $pageSlug;

		return $this;
	}

	public function getPageSlug()
	{
		return $this->pageSlug;
	}

	public function setLinkPosition(int $linkPosition)
	{
		$this->linkPosition = $linkPosition;

		return $this;
	}

	public function getLinkPosition()
	{
		return $this->linkPosition;
	}
}