<?php 

require_once 'C:\xampp\htdocs\contactAppPhp\src\includes\classes\dabasehelpers\GenericDaoImpl.php';
require_once 'C:\xampp\htdocs\contactAppPhp\src\includes\classes\objects_business\Contact.php';

/**
 * @author jaouad  
 *
 */
class ContactManagement {
    
    private $daoContact;
    
    public function getDaoContact(){
        return $this->daoContact;
    }
    
    public function __construct() {
        $this->daoContact = new GenericDaoImpl("Contact");
    }
     /**
     * une methode qui permet d'enregister  un contact dans la based de données
     */
    public function createAccount($contact){
        $this->daoContact->save($contact);
    }
    /**
     * une methode qui permet de selectionner tous les contacts existants sous formes d'un tableau des objets de type contacts
     */
    public function getAll(){
       return $this->daoContact->getAll();
        
    }
    
    /**
     * une methode qui permet de surpprimer un contact by son id
     */
    public function deleteContact($idContact){
       return  $this->daoContact->remove($idContact);
    }
    
    /**
     * une methode qui permet de retourner un objet de type contact
     * cette methode ne fonctionne pas 
     */
    public function getContactByName($nom){
       return $this->daoContact->getByColumnValue('nom', $nom);
    }

    
    public function getByTel($tel){
        $res  =  $this->daoContact->getByColumnValue('tel1', $tel) ;
        
        if($res == NULL )
            $res = $this->daoContact->getByColumnValue('tel2', $tel) ;
        
        return $res;
        
    }

    public function addToGroup($idGroup){
        $this->daoContact->update($idGroup);
    }

    
    /*  
     * 
     * puisque il ya un probleme au niveau de la methode mapToEntity dans la classe GenericdaoImpl
        cette methode va etre lieu
     * 
     */ 
    public function getAllContact(){
        
        $query = "SELECT * FROM CONTACT";
        $stmt = $this->daoContact->getConnection()->prepare($query);
        
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
     * cette method permet de retourner un tableau d'objets de type contact qui ont le meme nom passe en parameters
     */
    
    public function getByNom($nom){
        $query = 'SELECT * FROM contact WHERE nom = '.'"'. $nom .'"';
        $stmt = $this->daoContact->getConnection()->prepare($query);
        
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
    
    public function getByMobile($tel){
        $query = 'SELECT * FROM contact WHERE tel1 = '.'"'. $tel .'"' .'OR tel2 = '.'"'. $tel .'"';
        $stmt = $this->daoContact->getConnection()->prepare($query);
        
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
     * 
     * TODO: a compeleter cette methode dans un autre temps
     */
    public function getById($idContact) {
        $query = 'SELECT * FROM contact WHERE id = '.'"'. $idContact .'"';
        $stmt = $this->daoContact->getConnection()->prepare($query);
        
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
        
        return $arrContact[0];
    }
    
    /*
     * 
     * fonction pour la mise a jour 
     */
    public function updateContact($idContact) {
        
    }

}



