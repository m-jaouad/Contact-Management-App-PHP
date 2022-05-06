<?php 

require_once 'includes/classes/objects_business/Groupe.php';
require_once 'includes/classes/services/GroupeManagement.php';

require_once 'includes/header.php';
require_once 'includes/menu.php';

require_once 'includes/classes/utilities/utils.php';
echo Utils::searchButton('searchGroup.php','search Group');

?>

<div class="container-lg p-lg-2">
        <div class=" bg-info bg-light hero text-center ">
            <h1 class="display-4">MY Groups</h1>
            
        </div>
    </div>
<?php 

$groupManager = new GroupeManagement();
$allGroup = $groupManager->getAllGroups();



$html = '<table class="table table-striped ">
    <thead>
        <tr>
            <th scope="col">Icone</th>
            <th scope="col">Group Name</th>
             <th scope="col">Action</th>
        </tr>
    </thead>
    <tbody>';

foreach ($allGroup as $contact){
    $html .=  $contact->rowTableForGroup();
}

$html .= '   </tbody>
</table>';

echo $html;
require_once 'includes/footer.php';
