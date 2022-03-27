<?php

Interface FolderInterface{
	public function getID(): String;

	public function getFiles(): Array;

	public function getName(): String;

	public function getFolders(): Array;

	public function getChildrens(): Array;

	public function getParent(): ?String;

	public function addElement(String $item): void;

	public function addFolders(String $child): void;

	public function addFiles(String $file): void;

	public function setName(String $name): void;

	public function setParent(String $parent): void;
}