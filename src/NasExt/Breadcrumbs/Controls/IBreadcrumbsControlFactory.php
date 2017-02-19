<?php
/**
 * This file is part of the NasExt extensions of Nette Framework
 * Copyright (c) 2013 Dusan Hudak (http://dusan-hudak.com)
 * For the full copyright and license information, please view
 * the file license.txt that was distributed with this source code.
 */

namespace NasExt\Breadcrumbs\Controls;

interface IBreadcrumbsControlFactory {

	/**
	 * @return BreadcrumbsControl
	 */
	public function create();
}
