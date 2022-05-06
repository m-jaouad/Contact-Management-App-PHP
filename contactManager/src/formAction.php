<?php 

require_once 'includes/classes/objects_business/Contact.php';

require_once 'includes/classes/services/ContactManagement.php';

require_once 'includes/classes/utilities/dataValidation.php'; 
require_once 'includes/classes/utilities/fileManagement.php';


// onrecupere les infos envoyées par la formulaire

$nom        = dataValidation::sanitizePost('nom');
$prenom     = dataValidation::sanitizePost('prenom');
$tel1       = dataValidation::sanitizePost('tel1');
$tel2       = dataValidation::sanitizePost('tel2');
$emailPro   = dataValidation::sanitizePost('emailPro');
$emailPerso = dataValidation::sanitizePost('emailPerso');
$genre      = dataValidation::sanitizePost('genre');
$adress     = dataValidation::sanitizePost('adress');
$idGroupe     = dataValidation::sanitizePost('idGroupe');
if(empty($idGroupe)){
    $idGroupe = NULL;
}
//$photo        = dataValidation::sanitizePost('photo');

// upload the file to the server

$fileManager = new FileManagement();

$target_dir = 'C:\xampp\htdocs\contactAppPhp\src\includes\upload\\';
$fileName = "";
$errors = "";

$extensions = ['JPG','png'];

$fileManager->uploadFile($target_dir, 'photo', $extensions, $fileName, $errors);

$photo = $fileName;


// creation d'un objet contact 
$newContact = new Contact;

$newContact->init($nom, $prenom, $photo, $tel1, $tel2, $adress, $emailPro, $emailPerso, $genre, $idGroupe);

$contactManager = new ContactManagement();

$contactManager->createAccount($newContact);

header('location: myContacts.php');








