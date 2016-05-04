<?php

namespace Eton\Components\Addons;

use Eton\Model\PollFacade;
use Nette\Application\UI\Control;
use Nette\ComponentModel\IContainer;
use Nette\Http\IRequest;


/**
 * Class PollControl
 *
 * @author Petr Blazicek 2016
 */
class PollControl extends Control
{

	const HEADER = 'Líbí se vám naše stránky?';
	const VOTE = [
		1	 => 'Líbí se mi zuřivě',
		2	 => 'Viděl jsem i lepší',
		3	 => 'Vůbec se mi nelíbí',
	];
	const VOTE_CLASS = [ 1 => 'success', 2 => 'warning', 3 => 'danger', ];

	/** @var bool */
	private $checkIp;

	/** @var IRequest */
	private $httpRequest;

	/** @var PolFacade */
	private $facade;

	/** @var array */
	private $percentage = [ 1 => 0, 2 => 0, 3 => 0, ];


	public function __construct( $checkIp, IRequest $request, PollFacade $facade,
							  IContainer $parent = NULL, $name = NULL )
	{
		parent::__construct( $parent, $name );

		$this->checkIp = $checkIp;
		$this->httpRequest = $request;
		$this->facade = $facade;

		$this->getData();
	}


	/**
	 * AJAX vote handler
	 * 
	 * @param int $value
	 */
	public function handleVote( $value )
	{
		$this->facade->saveVote( [
			'ip'	 => $this->httpRequest->getRemoteAddress(),
			'value'	 => $value,
			'unique'=>  $this->checkIp,
		] );

		$this->getData();

		if ( $this->presenter->isAjax() ) {
			$this->redrawControl( 'vote' );
		}
	}


	/**
	 * Fills data from database
	 * 
	 * @return self (fluent interface)
	 */
	private function getData()
	{
		$data = $this->facade->getSummary();

		$summary = array_sum( array_column( $data, 'cnt' ) );

		foreach ( $data as $sum ) {
			$this->percentage[ $sum[ 'value' ] ] = round( 100 / $summary * $sum[ 'cnt' ],
												 1 );
		}

		return $this;
	}


	/**
	 * Renders control template
	 */
	public function render()
	{
		$template = $this->template;
		$template->setFile( __DIR__ . '/template.latte' );

		$template->header = self::HEADER;
		$template->vote = self::VOTE;
		$template->voteClass = self::VOTE_CLASS;
		$template->percentage = $this->percentage;
		$template->render();
	}

}
