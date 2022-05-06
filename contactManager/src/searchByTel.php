<?php 
/*
*
* ce script permet de d'afficher tous les résultats des contacts par NOM
*/

require_once 'includes/classes/services/ContactManagement.php';
require_once 'includes/menuWithoutSearchButton.php';
require_once 'includes/classes/utilities/utils.php';




$contactManager = new ContactManagement();
$contactByName = $contactManager->getByMobile($_GET['search']);

if(empty($contactByName)){
    if(empty($contactByName)){
        header('location: notFound.php');
    }
    
    exit();
}


$html = '<table class="table table-striped ">
    <thead>
        <tr>
            <th scope="col">Photo</th>
            <th scope="col">First Name</th>
            <th scope="col">Last Name</th>
            <th scope="col">Mobile1</th>
            <th scope="col">Mobile2</th>
            <th scope="col">Adress</th>
            <th scope="col">Professional Email</th>
            <th scope="col">Personnal Email</th>
            <th scope="col">Gender</th>
             <th scope="col">Action</th>
        </tr>
    </thead>
    <tbody>';

foreach ($contactByName as $contact){
    $html .=  $contact->rowTableForContact();
}

$html .= '   </tbody>
</table>';

echo $html;


require_once 'includes/footer.php';





