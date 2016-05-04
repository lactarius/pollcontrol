<?php

namespace EtonModule;


/**
 * Class DefaultPresenter
 *
 * @author Petr Blazicek 2016
 */
class DefaultPresenter extends BasePresenter
{

	/** @var \Eton\Components\Addons\IPollControl @inject */
	public $pollControlFactory;


	// factories

	protected function createComponentPollControl()
	{
		return $this->pollControlFactory->create();
	}


	// actions

	public function renderDefault()
	{
		$this->template->title = 'ETON Business Consulting';
	}

}
