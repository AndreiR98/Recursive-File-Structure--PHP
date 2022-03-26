<?php

require_once('model/Process.php');


$open = @fopen('structure.txt', 'r');

$data = new Process();

while(!feof($open)){
	$getLine = fgets($open);
	if($getLine != ''){
		$data->setData($getLine);
	}
}


echo '<pre>';
print_r($data->getData());

/*	require('Database.php');
	$files = new Database();
	$files = $files->executeStatement("SELECT * FROM files WHERE file_name LIKE '%imag%'");
    
    //print_r($files);

	
	function buildTree(array $elements, $parentId = NULL) {
		$branch = array();

		foreach ($elements as $element) {
			if ($element['file_parent_id'] == $parentId) {
				$children = buildTree($elements, $element['file_id']);
				if ($children) {
					$element['subcategories'] = $children;
				}
				$branch[] = $element;
			}
		}

		return $branch;
	}
	
	//echo '<pre>';
	//print_r(buildTree($files));*/