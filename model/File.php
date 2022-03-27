<?php

require_once('interfaces/FileInterface.php');

class File implements FileInterface{
	public $id = 'FILE';
	protected $name;
	private $extension;
	protected $parent = null;

	public function __construct($name=''){
		$explode = explode(".", $name);

		$this->name = $explode[0];
		$this->extension = $explode[1];
	}

	public function getID(): String{
		return $this->id;
	}

	public function getName(): String{
		return $this->name;
	}

	public function getParent(): ?String{
		return $this->parent;
	}

	public function setParent(String $parent=''): void{
		$this->parent = $parent;
	}

	public function getExtension(): String{
		return $this->extension;
	}


}