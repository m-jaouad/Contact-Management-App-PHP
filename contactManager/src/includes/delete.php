<?php 

require_once 'classes/services/ContactManagement.php';

$contactManager = new ContactManagement();
$contactManager->deleteContact($_GET['id']);

header('location: ../myContacts.php');
