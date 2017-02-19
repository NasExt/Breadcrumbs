<?php
/**
 * This file is part of the NasExt extensions of Nette Framework
 * Copyright (c) 2013 Dusan Hudak (http://dusan-hudak.com)
 * For the full copyright and license information, please view
 * the file license.txt that was distributed with this source code.
 */

namespace NasExt\Breadcrumbs\Controls;

use Nette\ComponentModel\Container;

class BreadcrumbsNode extends Container {

	/** @var string */
	public $title;

	/** @var string */
	public $link;

	/** @var array */
	public $linkArgs = array();

	/** @var bool */
	public $isCurrent = FALSE;

	/**
	 * Add Breadcrumbs node as a child
	 * @staticvar int $counter
	 * @param string      $title
	 * @param string|NULL $link
	 * @param array       $linkArgs
	 * @return BreadcrumbsNode
	 */
	public function add($title, $link = NULL, $linkArgs = array()) {
		$node = new self;
		$node->title = $title;
		$node->link = $link;
		$node->linkArgs = $linkArgs;
		$node->isCurrent = TRUE;

		static $counter;
		$this->addComponent($node, ++$counter);

		$this->lookup(BreadcrumbsControl::class)->setCurrentNode($node);

		return $node;
	}
}
