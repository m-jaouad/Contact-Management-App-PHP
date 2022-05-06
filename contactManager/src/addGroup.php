<?php 
require_once 'includes/classes/services/GroupeManagement.php';
require_once 'includes/classes/utilities/utils.php';
require_once 'includes/appHeader.php';
require_once 'includes/header.php';
require_once 'includes/menu.php';
//require_once 'includes/searchButton.php';
require_once 'includes/classes/utilities/utils.php';
echo Utils::searchButton('searchGroup.php', 'search Group ');
$errors =[];

?>


<!-- hero section -->
    <div class="container-lg p-lg-2">
        <div class=" bg-info bg-gradient hero text-center text-light">
            <h1 class="display-4">Manage Your Contact Easily with our App</h1>
            <hr>
            <p>We are the best Contact Manager App</p>
        </div>
    </div>


    <!-- form qui permet d'envoi des data au niveau serveur-->
    
    <div class="container-lg p-4">
        <form action="includes/addGroupAction.php" method="POST" enctype="multipart/form-data">
            <div class="row mt-3">
                <div class="col-lg-6">
                    <input type="text" class="form-control mt-1" placeholder="Group Name" name="nom">
                    <?php if(isset($errors["fname"])){
                        echo arrayToList($errors["fname"],"text-danger");
                    } 
                    ?>
                    
                    
                </div>
                 <!-- c'est le code qui permet l'envoi du fichier photo -->
                <div class="col-lg-6">
                    <input type="file" class="form-control mt-1" placeholder="icone of the group" name="icone" >
                    <?php if(isset($errors["fonction"])){
                        echo arrayToList($errors["fonction"],"text-danger");
                    } 
                    ?>
                
            </div>

            </div>    
        </form>
    </div>

<?php 

require_once 'includes/footer.php';

