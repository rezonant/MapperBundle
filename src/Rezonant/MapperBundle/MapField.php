<?php

namespace Rezonant\MapperBundle;

class MapField {
	
	public function __construct($name)
	{
		$this->name = $name;
	}
	
	private $name;
	private $destinationField;
	private $destinationType;
	private $submap;
	
	function getDestinationType() {
		return $this->destinationType;
	}

	function setDestinationType($destinationType) {
		$this->destinationType = $destinationType;
	}
	
	function getSubmap() {
		return $this->submap;
	}

	function setSubmap($submap) {
		$this->submap = $submap;
	}
	
	function getName() {
		return $this->name;
	}

	function getDestinationField() {
		return $this->destinationField;
	}

	function setName($name) {
		$this->name = $name;
	}

	function setDestinationField($destinationField) {
		$this->destinationField = $destinationField;
	}	
}