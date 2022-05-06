<?php 

/*
 * ce script permet d'afficher les groups by le nom du groupe
 */
require_once 'includes/classes/utilities/utils.php';
require_once 'includes/classes/services/GroupeManagement.php';
require_once 'includes/menuWithoutSearchButton.php';


$groupManager = new GroupeManagement();
$allGroupByName = $groupManager->getGroupByName($_GET['search']);

if(empty($allGroupByName)){
    header('location: notFound.php');
    exit();
}


$html = '<table class="table table-striped ">
    <thead>
        <tr>
            <th scope="col">Icone</th>
            <th scope="col">Group Name</th>
             <th scope="col">Action</th>
        </tr>
    </thead>
    <tbody>';

foreach ($allGroupByName as $contact){
    $html .=  $contact->rowTableForGroup();
}

$html .= '   </tbody>
</table>';

echo $html;
require_once 'includes/footer.php';
