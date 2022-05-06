<?php 
require_once 'C:\xampp\htdocs\contactAppPhp\src\includes\classes\dabasehelpers\GenericDaoImpl.php';
require_once 'C:\xampp\htdocs\contactAppPhp\src\includes\classes\objects_business\Groupe.php';
require_once 'C:\xampp\htdocs\contactAppPhp\src\includes\classes\objects_business\Contact.php';

/**
 * @author jaouad
 *
 */
class GroupeManagement{
    private $daoGroup;
    
    public function __construct(){
        $this->daoGroup = new GenericDaoImpl('Groupe');
    }
    
    public function createGroup($groupe){
        $this->daoGroup->save($groupe);
    }
   /* // permet de retourner un tableau de d'obbjets de type groupe
    public function getAllGroups(){
      return  $this->daoGroup->getConnection();
    }
    
    */
    
    // trouver une groupe en utilisant le nom mais il ya un probleme dans le code génerique pour les valeurs nulls
    public function getByName($nom){
        
        return $this->daoGroup->getByColumnValue('nom', $nom);
    }
    
    // surprimmer un goupe en utiliasant leur id
    
    public function deleteGroupe($idGroupe){
        $this->daoGroup->remove($idGroupe);
    }
    /*
     * return un tableau d'objets de type groupe
     */
    public function getAllGroups(){
        $query = "SELECT * FROM GROUPE";
        $stmt = $this->daoGroup->getConnection()->prepare($query);
        
        $stmt->execute();
        $groupObj = new Groupe();
        $arrGroup = [];
        while ($data = $stmt->fetch()) {
            // on fait le mapping vers un objet groupe
            // creation de l'objet premierement
            $groupObj->setId($data['id']);
           $groupObj->init($data['nom'], $data['icone']);
            $arrGroup [ ] = clone $groupObj;
        }
        
        return $arrGroup;
    }
    /*
     *  cette methode a pour objectif de trouver un groupe en utilisant leur nom
     */
    
    public function getGroupByName($nomGroup){
        $query = 'SELECT * FROM GROUPE  WHERE NOM = ' .'"'. $nomGroup .'"';
        $stmt = $this->daoGroup->getConnection()->prepare($query);
        
        $stmt->execute();
        $groupObj = new Groupe();
        $arrGroup = [];
        while ($data = $stmt->fetch()) {
            // on fait le mapping vers un objet groupe
            // creation de l'objet premierement
            $groupObj->setId($data['id']);
            $groupObj->init($data['nom'], $data['icone']);
            $arrGroup [ ] = clone $groupObj;
        }
        
        return $arrGroup;
    }
    
    /*
     * cette fonction permet de retourner tous les objets contact qui appartient a un groupe 
     */
    
    public function getContactByGroup($idGroup){
        $query = "SELECT * FROM GROUPE AS G , CONTACT AS C WHERE G.ID = C.idGroupe and G.id = $idGroup";
        $stmt = $this->daoGroup->getConnection()->prepare($query);
        
        $stmt->execute();
        $contactObj = new Contact();
        $arrContact = [];
        while ($data = $stmt->fetch()) {
            // on fait le mapping vers un objet contact
            // creation de l'objet premierement
            $contactObj->setId($data['id']);
            $contactObj->init($data['nom'], $data['prenom'], $data['photo'],
                $data['tel1'], $data['tel2'], $data['adress'], $data['emailPro'], $data['emailPerso'], $data['genre'], $data['idGroupe']);
            $arrContact [ ] = clone $contactObj;
        }
        
        return $arrContact;
        
    }
    
    /*
     * method qui génere le code html pour checkBox
     */
    
    
}