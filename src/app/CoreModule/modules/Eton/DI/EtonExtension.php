<?php

namespace EtonModule\DI;

use Flame\Modules\Providers\IRouterProvider;
use Kdyby\Doctrine\DI\IEntityProvider;
use Nette\Application\Routers\Route;
use Nette\Application\Routers\RouteList;
use Nette\DI\CompilerExtension;


/**
 * Class EtonExtension
 *
 * @author Petr Blazicek 2016
 */
class EtonExtension extends CompilerExtension implements IEntityProvider, IRouterProvider
{


	public function getEntityMappings()
	{
		return [ 'Eton\Model' => __DIR__ . '/../model' ];
	}


	public function getRoutesDefinition()
	{
		$routeList	 = new RouteList( 'Eton' );
		$routeList[] = new Route( 'eton/<presenter>/<action>[/<id>]',
							[
			'presenter'	 => 'Default',
			'action'	 => 'default',
			'id'		 => NULL,
			] );

		return $routeList;
	}

}
