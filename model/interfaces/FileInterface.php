<?php
Interface FileInterface{
	public function getID(): String;

	public function getName(): String;

	public function getParent(): ?String;

	public function getExtension(): String;

	public function setParent(): void;
}