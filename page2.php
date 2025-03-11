<?php

$users = array(
	array('name' => 'nana', 'surname' => 'nono', 'group' => 'A')
);

if( isset($_POST['name']) && isset($_POST['surname']) && isset($_POST['group']) ){
	
	$name = $_POST['name'];
	$surname = $_POST['surname'];
	$group = $_POST['group'];
	
	$newUser = array('name' => $name, 'surname' => $surname, 'group' => $group);
	array_push($users, $newUser);
	
	foreach($users as $rows){
		echo 'Nom: ' .$rows['name']. ', Prénom: ' .$rows['surname']. ', Groupe: ' .$rows['group']. '<br>';
	}
}

?>
