<?php

class File{
	private $id = 'FILE';
	protected $name;
	protected $extension;

	public function __construct($name=''){
		$explode = explode(".", $name);

		$this->name = $explode[0];
		$this->extension = $explode[1];
	}

	public function getID(){
		return $this->id;
	}


}