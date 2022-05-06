<?php 

require_once 'includes/classes/objects_business/Contact.php';

require_once 'includes/classes/services/ContactManagement.php';
require_once 'includes/header.php';
require_once 'includes/menu.php';
// pour le button
require_once 'includes/classes/utilities/utils.php';
echo Utils::searchButton('searchByName.php', 'Search Contact');

?>
<div class="container-lg p-lg-2">
        <div class=" bg-info bg-light hero text-center ">
            <h1 class="display-4">MY Contacts</h1>
            
        </div>
    </div>
<?php 

$contactManager = new ContactManagement();
$allContact = $contactManager->getAllContact();

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

foreach ($allContact as $contact){
    $html .=  $contact->rowTableForContact();
}

$html .= '   </tbody>
</table>';

echo $html;
require_once 'includes/footer.php';