<?php

namespace Eton\Model;

use Core\Model\CommonEntity;
use Doctrine\ORM\Mapping as ORM;


/**
 * Class Poll
 * 
 * @ORM\Entity
 * @ORM\Table(name="et_poll")
 * 
 * @author Petr Blazicek 2016
 */
class Poll extends CommonEntity
{

	/**
	 * @ORM\Column(length=16)
	 * @var string
	 */
	private $ip;

	/**
	 * @ORM\Column(type="integer")
	 * @var integer
	 */
	private $value;


	// getters & setters

	public function getIp()
	{
		return $this->ip;
	}


	public function getValue()
	{
		return $this->value;
	}


	public function setIp( $ip )
	{
		$this->ip = $ip;
		return $this;
	}


	public function setValue( $value )
	{
		$this->value = $value;
		return $this;
	}

}
