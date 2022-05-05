<?php

namespace App\Interfaces;

interface BlockPageInterface
{
	public function setBlockId(int $blockId);

	public function getBlockId();

	public function setBlockSlug(string $blockSlug);

	public function getBlockSlug();

	public function setPageId(int $pageId);

	public function getPageId();

	public function setPageSlug(string $pageSlug);

	public function getPageSlug();

	public function setLinkPosition(int $linkPosition);

	public function getLinkPosition();
}