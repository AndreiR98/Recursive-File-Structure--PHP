<?xml version="1.0"?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
	"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
	<title>Recursive File Structure</title>
</head>

<body>
	<div id='content'>
		<table id='main-form'>
			<tr>
				<th colspan="2">Recursie File Structure</th>
			</tr>
			<tr style="text-align:center">
				<td>Assign Structure</td>
				<td>Search</td>
			</tr>
			<tr>
				<td>
					<form action="index.php?action=add" method="POST">
						<input id='addButton' type='submit' value='Add'></td>
					</form>
					
				<td>Search:<input id='searchText' type='text'> - <input id='addButton' type='button' value='Search'></td>
			</tr>
			<tr>
				<td><div id='searchResponse'></div></td>
			</tr>
		</table>
	</div>
</body>

</html>
<?php
if(isset($_GET['action'])){
	if($_GET['action'] == 'add'){
		require_once('model/Structure.php');
		require_once('Database.php');

		$db = new Database();

		$open = @fopen('structure.txt', 'r');

		$structure = new Structure();

		while(!feof($open)){
			$getLine = fgets($open);

			if($getLine != ''){
				$structure->setStructure($getLine);
			}
		}

		$uniques = [];

		/*foreach($structure->dirs as $key=>$struct){
			if(!$db->CheckFieldName($key)){
				$db->InsertField($key);
			}
			echo "<pre>";
			

			$uniques =  [$structure->dirs[$key]->uniques];
			
		}*/

		
        $db->Delete();
		foreach($structure->dirs as $key=>$struct){
			//print_r($struct->uniques);
			if(!$db->CheckFieldName($key)){
				$db->InsertField($key);
			}
			foreach($struct->uniques as $key2=>$item){
				if(($item->id == 'FOLDER')&&($item->getName() != $key)){
					$db->InsertFieldDependent($item->getName(), $item->getParent(), $key);
				}
				if(($item->id == 'FILE')){
					$db->InsertFieldDependent($item->getName(), $item->getParent(), $key, $item->getExtension());
				}
			}
		}

		/**
		 * Compare each object's with it's parent's parent
		 * For example:
		 * C:/Documents/Photos/Images/Img1.jpg
		 * D:/Documents/Photos/Images/Img2.jpg
		 * 
		 * We're set fro C: and D:
		 * We're also set for Documents having 2 tables with diferent parent's id
		 * Then For Photos we will only have one table of Photos instead of 2
		 * So we compare against the hierachy we will compare Photos' parent witch is Documents then we wil compare Documents's parent witch is C: or D: then choose accordingly
		 * */

		

		//echo "<pre>";
		//print_r($struct->getData());
	}
}
?>









<?php



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