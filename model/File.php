<?php

class File{
	private $id = 'FILE';
	protected $name;
	protected $extension;
	protected $parent;

	public function __construct($name=''){
		$explode = explode(".", $name);

		$this->name = $explode[0];
		$this->extension = $explode[1];
	}

	public function getID(){
		return $this->id;
	}

	public function getName(){
		return $this->name;
	}

	public function setParent($parent){
		$this->parent = $parent;
	}


}