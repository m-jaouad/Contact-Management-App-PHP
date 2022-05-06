<?php 
require_once 'classes/services/GroupeManagement.php';
require_once 'classes/objects_business/Groupe.php';
require_once 'classes/utilities/dataValidation.php';
require_once 'classes/utilities/fileManagement.php';

// receive the data from the form and sanitize them 
$nom = dataValidation::sanitizePost('nom');
//$icone = dataValidation::sanitizePost('icone');


// upload the file to the server

$fileManager = new FileManagement();

$target_dir = 'C:\xampp\htdocs\contactAppPhp\src\includes\upload\\';
$fileName = "";
$errors = "";

$extensions = ['JPG','png'];

$fileManager->uploadFile($target_dir, 'icone', $extensions, $fileName, $errors);
$icone = $fileName;




$groupManager = new GroupeManagement();
$groupe = new Groupe();


$groupe->init($nom, $icone);

$groupManager->createGroup($groupe);

header('location: ../myGroups.php');