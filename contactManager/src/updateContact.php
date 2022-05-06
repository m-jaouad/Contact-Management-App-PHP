<?php
//require_once 'includes/classes/services/GroupeManagement.php';
//require_once 'includes/classes/utilities/utils.php';
require_once 'includes/appHeader.php';
require_once 'includes/header.php';
require_once 'includes/menu.php';
//require_once 'includes/searchButton.php';
require_once 'includes/classes/utilities/utils.php';
//echo Utils::searchButton('searchByName.php', 'search Contact');
$errors =[];


require_once 'includes/classes/services/contactManagement.php';
require_once 'includes/classes/services/Contact.php';
if( !empty($_GET['id'])){
    
    $contactManager = new ContactManagement();
    $contact = new Contact();

    $contact = $contactManager->getById($_GET['id']);
    
}
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
        <form action="formAction.php" method="POST" enctype="multipart/form-data">
            <div class="row mt-3">
                <div class="col-lg-6">
                    <input type="text" class="form-control mt-1" placeholder="First Name" name="nom" value ="
                    <?php if(isset($contact["fname"])){
                        
                    } 
                    ?>
                    ">
                    
                                        
                </div>
                <div class="col-lg-6">
                    <input type="text" class="form-control mt-1" placeholder="Last Name" name="prenom">
                    <?php if(isset($errors["lname"])){
                        echo arrayToList($errors["lname"],"text-danger");
                    } 
                    ?>
                </div>

            </div>
            <div class="row mt-3">
                <div class="col-lg-6">
                    <input type="text" class="form-control mt-1" placeholder="Mobile Number 1" name="tel1">
                    <?php if(isset($errors["fonction"])){
                        echo arrayToList($errors["fonction"],"text-danger");
                    } 
                    ?>
                </div>
                <div class="col-lg-6">
                    <input type="text" class="form-control mt-1" placeholder="Mobile Number 2" name="tel2">
                    <?php if(isset($errors["age"])){
                        echo arrayToList($errors["age"],"text-danger");
                    } 
                    ?>
                </div>
            </div>
            
            <div class="row mt-3">
                <div class="col-lg-6">
                    <input type="text" class="form-control mt-1" placeholder=" Professionel email" name="emaiPro">
                    <?php if(isset($errors["fonction"])){
                        echo arrayToList($errors["fonction"],"text-danger");
                    } 
                    ?>
                </div>
                <div class="col-lg-6">
                    <input type="text" class="form-control mt-1" placeholder="Personnel email" name="emailPerso">
                    <?php if(isset($errors["age"])){
                        echo arrayToList($errors["age"],"text-danger");
                    } 
                    ?>
                </div>
            </div>
            
            <!-- c'est le code qui permet l'envoi du fichier photo -->
            <div class="row mt-3">
                <div class="col-lg-6">
                    <input type="file" class="form-control mt-1" placeholder="photo of the contact" name="photo">
                    <?php if(isset($errors["fonction"])){
                        echo arrayToList($errors["fonction"],"text-danger");
                    } 
                    ?>
                </div>
                
                <div class="col-lg-6">
                    <input type="text" class="form-control mt-1" placeholder="adress of the contact" name="adress">
                    <?php if(isset($errors["age"])){
                        echo arrayToList($errors["age"],"text-danger");
                    } 
                    ?>
                </div>
            </div>
            <div class="row mt-3">
                <div class="col-6">
                   <p class="mt-1">Groups :</p>
                    <?php 
                    $groupManager = new GroupeManagement();
                    $groups = $groupManager->getAllGroups();
                    foreach($groups as $groupe){
                      echo  Utils::createRadioBox($groupe);
                    }
                    ?>
                    
                </div>
                <div class="col-6">
                    <p class="mt-1">gender:</p>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="gender" id="female" value= "F">
                        <label class="form-check-label" for="female">
                            female
                        </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="gender" id="male"
                             value="M">
                        <label class="form-check-label" for="male"  >
                            male
                        </label>
                    </div>
                    
                </div>
            </div>
            <div class="d-flex flex-row-reverse p-3">
                <input type="submit" class="btn btn-primary  m-2" value="Submit">
                <input type="submit" class="btn btn-secondary  m-2" value="reset">
            </div>
        </form>
    </div>

<?php 

require_once 'includes/footer.php';


