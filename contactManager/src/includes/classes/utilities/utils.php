<?php 

require_once 'C:\xampp\htdocs\contactAppPhp\src\includes\classes\services\GroupeManagement.php';

class Utils {
    public static function warnMsg($msg){
        
        return '<div class="text-warning">' .$msg. '</div>';
    }
    
    public static function  alertMsg(){
        
    }
    
    /*
     * method qui a pour but de générer le code html pour lae button search
     */
    
    public  static function searchButton($link, $placeHolder = 'search'){
        
       return   
           
           '<form class="d-flex" method="GET" action =" ' .$link. ' ">
                <input class="form-control me-2" type="search" placeholder="'.$placeHolder.'" aria-label="Search" name="search">
                <button class="btn btn-outline-success" type="submit">Search</button>
                </form>
            </div>
          </div>
       </nav>';
    }
    
    public static function getGroups(){
        
    }
    /*
     * une procedure qui va générer le code html qui va contenir le checkBox
     */ 
    
    public static function createCheckbox($key, $val){
        
        ?>
    <div class="form-check">
        <input name="Groups[]" class="form-check-input" type="checkbox" value="<?php echo $key ?>" id="<?php echo $val ?>">
        <label class="form-check-label" for="<?php echo $val ?>">
            <?php echo $val ?>
        </label>
    </div>
	<?php
    }
    
    public static function createRadioBox($groupe){
      return  '<div class="form-check">
        <input class="form-check-input" type="radio" name="idGroupe" id="' .$groupe->getNom(). '" value= " ' .$groupe->getId().'">
        <label class="form-check-label" for="'.$groupe->getNom().'">'.
        $groupe->getNom()
        .'</label>
        </div> ';
        
}


}
