<?php
/**
 * This file is part of the NasExt extensions of Nette Framework
 * Copyright (c) 2013 Dusan Hudak (http://dusan-hudak.com)
 * For the full copyright and license information, please view
 * the file license.txt that was distributed with this source code.
 */

namespace NasExt\Breadcrumbs\DI;

use NasExt\Breadcrumbs\Controls\IBreadcrumbsControlFactory;
use Nette\DI\CompilerExtension;

class BreadcrumbsExtension extends CompilerExtension {

	public function loadConfiguration() {
		$builder = $this->getContainerBuilder();

		// BreadcrumbsControl
		$builder->addDefinition($this->prefix('breadcrumbsControl'))
			->setImplement(IBreadcrumbsControlFactory::class);
	}
}
