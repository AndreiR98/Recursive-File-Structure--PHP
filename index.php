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
				<td>Assign Structure:</td>
				<td>Search by keyword:</td>
			</tr>
			<tr>
				<td>
					<form action="index.php?action=add" method="POST">
						<input id='addButton' type='submit' value='Add'></td>
					</form>
					
					<td>Search:
						<form action="index.php?action=search" method="POST">
							<input id='searchText' name='keyword' type='text'> - <input id='addButton' type='submit' value='Search'></td>
						</form>

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
	require_once('Database.php');
	require_once('model/Structure.php');
	
	$db = new Database();
	
	if($_GET['action'] == 'add'){
        
        $open = @fopen('structure.txt', 'r');
		$structure = new Structure();
				
		while(!feof($open)){
			$getLine = fgets($open);
				if($getLine != ''){
					$structure->setStructure($getLine);
				}
		}
				
		$db->Delete();
				
		foreach($structure->dirs as $key=>$struct){
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
	}elseif($_GET['action'] == 'search'){
		$files = $db->SearchByKeyword($_POST['keyword']);


		$parents = [];

		foreach($files as $item){
			$h = [];

			$parent = $item['file_parent_id'];

			$parents[$item['file_id']] = [];

			do{
				if($parent){
					$h[] = $parent;
				}

				$parent = $db->getFile($parent)['file_parent_id'];
			}while($parent);

			$parents[$item['file_id']] = $h;

		}

		foreach($parents as $key=>$p){
			asort($p);
			$hierachy = [];
					
			foreach($p as $id){

				$name = $db->getFile($id)['file_name'];

				$hierachy[] = $name;
			}
					
			$extension = $db->getFile($key)['file_extension'];

			$root = $db->getFile($key)['file_name'];

			if(!($extension=='folder')&&!($extension=='dir')){
				$root .= ".".$extension;
			}




			array_push($hierachy, $root);

			$string = implode("/", $hierachy);
            echo "<pre>";
            echo "<br/>";
			print_r($string);
		}	

	}
}

