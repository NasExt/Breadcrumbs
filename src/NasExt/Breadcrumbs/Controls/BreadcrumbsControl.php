<?php
/**
 * This file is part of the NasExt extensions of Nette Framework
 * Copyright (c) 2013 Dusan Hudak (http://dusan-hudak.com)
 * For the full copyright and license information, please view
 * the file license.txt that was distributed with this source code.
 */

namespace NasExt\Breadcrumbs\Controls;

use Nette\Application\UI\Control;

class BreadcrumbsControl extends Control {

	/** @var  string */
	public $templateFile;

	/** @var BreadcrumbsNode */
	private $current;

	public function __construct() {
		parent::__construct();

		$reflection = $this->getReflection();
		$dir = dirname($reflection->getFileName());
		$name = $reflection->getShortName();
		$this->templateFile = $dir . DIRECTORY_SEPARATOR . $name . '.latte';
	}

	/**
	 * Set node as current
	 * @param BreadcrumbsNode $node
	 */
	public function setCurrentNode(BreadcrumbsNode $node) {
		if (isset($this->current)) {
			$this->current->isCurrent = FALSE;
		}
		$node->isCurrent = TRUE;
		$this->current = $node;
	}

	/**
	 * @return BreadcrumbsNode
	 */
	public function getCurrentNode() {
		return $this->current;
	}

	/**
	 * Add Breadcrumbs node as a child
	 * @param string      $title
	 * @param string|NULL $link
	 * @param array       $linkArgs
	 * @return BreadcrumbsNode
	 */
	public function add($title, $link = NULL, $linkArgs = array()) {
		$currentNode = $this->getCurrentNode();
		if ($currentNode) {
			return $currentNode->add($title, $link, $linkArgs);
		}

		return $this->setupHomepage($title, $link, $linkArgs);
	}

	/**
	 * @param string      $title
	 * @param string|NULL $link
	 * @param array       $linkArgs
	 * @return BreadcrumbsNode
	 */
	public function setupHomepage($title, $link = NULL, $linkArgs = array()) {
		/** @var BreadcrumbsNode $homepage */
		$homepage = $this->getComponent('homepage');
		$homepage->title = $title;
		$homepage->link = $link;
		$homepage->linkArgs = $linkArgs;
		return $homepage;
	}

	/**
	 * Homepage factory
	 * @param string $name
	 * @return BreadcrumbsNode
	 */
	protected function createComponentHomepage($name) {
		$homepage = new BreadcrumbsNode();
        $this->addComponent($homepage, $name);
		$homepage->isCurrent = TRUE;
		$this->setCurrentNode($homepage);
		return $homepage;
	}

	public function render() {
		$items = array();
		$node = $this->getCurrentNode();
		while ($node instanceof BreadcrumbsNode) {
			$parent = $node->getParent();
			array_unshift($items, $node);
			$node = $parent;
		}
		$this->template->setFile($this->templateFile);
		$this->template->items = $items;
		$this->template->render();
	}
}
