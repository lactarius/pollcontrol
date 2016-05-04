<?php

namespace Eton\Model;

use Core\Model\BaseFacade;
use Kdyby\Doctrine\EntityManager;


/**
 * Class PollFacade
 *
 * @author Petr Blazicek 2016
 */
class PollFacade extends BaseFacade
{

	const POLL_CLASS = 'Eton\Model\Poll';


	public function __construct( EntityManager $em )
	{
		parent::__construct( $em );
	}


	/**
	 * Returns voting summary
	 * 
	 * @return array
	 */
	public function getSummary()
	{
		return $this->em->createQueryBuilder()
				->select( 'count(p.id) AS cnt, p.value' )
				->from( self::POLL_CLASS, 'p' )
				->groupBy( 'p.value' )
				->getQuery()
				->getArrayResult();
	}


	/**
	 * Saves new vote
	 * When unique is on, checks IP uniqueness
	 * 
	 * @param array $data
	 * @return boolean
	 */
	public function saveVote( array $data )
	{
		if ( $data[ 'unique' ] && $this->em->getRepository( self::POLL_CLASS )->findOneByIp( $data[ 'ip' ] ) ) {
			return FALSE;
		}

		/* @var $entity \Eton\Model\Poll */
		$entity = $this->prepareEntity( self::POLL_CLASS, $data );

		$entity->setIp( $data[ 'ip' ] );
		$entity->setValue( $data[ 'value' ] );

		$this->saveAll( $entity );

		return TRUE;
	}

}
