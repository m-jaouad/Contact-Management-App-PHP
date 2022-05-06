<?php 

require_once 'classes/services/GroupeManagement.php';


$contactManager = new GroupeManagement();
$contactManager->deleteGroupe($_GET['id']);



header('location: ../myGroups.php');
