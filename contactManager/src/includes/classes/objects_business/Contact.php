<?php 

class Contact {
    
    private  $id;
    
    private $nom;
    
    private $prenom;
    
    private $photo;
    
    private  $tel1;
    
    private $tel2;
    
    private  $adress;
    
    private  $emailPro;
    
    private  $emailPerso;
    
    private  $genre;
    
    private $idGroupe;
    
    public function init($nom, $prenom, $photo, $tel1, $tel2, $adress, $emailPro, $emailPerso, $genre, $idGroupe){
        $this->nom = $nom;
        $this->prenom = $prenom;
        $this->photo = $photo;
        $this->tel1 = $tel1;
        $this->tel2 = $tel2;
        $this->adress = $adress;
        $this->emailPerso = $emailPerso;
        $this->emailPro = $emailPro ;
        $this->genre = $genre;
        $this->idGroupe = $idGroupe;
    }
    /**
     * @return mixed
     */
    public function getIdGroupe()
    {
        return $this->idGroupe;
    }

    /**
     * @param mixed $idGroupe
     */
    public function setIdGroupe($idGroupe)
    {
        $this->idGroupe = $idGroupe;
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return mixed
     */
    public function getNom()
    {
        return $this->nom;
    }

    /**
     * @return mixed
     */
    public function getPrenom()
    {
        return $this->prenom;
    }

    /**
     * @return mixed
     */
    public function getPhoto()
    {
        return $this->photo;
    }

    /**
     * @return mixed
     */
    public function getTel1()
    {
        return $this->tel1;
    }

    /**
     * @return mixed
     */
    public function getTel2()
    {
        return $this->tel2;
    }

    /**
     * @return mixed
     */
    public function getAdress()
    {
        return $this->adress;
    }

    /**
     * @return mixed
     */
    public function getEmailPro()
    {
        return $this->emailPro;
    }

    /**
     * @return mixed
     */
    public function getEmailPerso()
    {
        return $this->emailPerso;
    }

    /**
     * @return mixed
     */
    public function getGenre()
    {
        return $this->genre;
    }

    /**
     * @param mixed $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @param mixed $nom
     */
    public function setNom($nom)
    {
        $this->nom = $nom;
    }

    /**
     * @param mixed $prenom
     */
    public function setPrenom($prenom)
    {
        $this->prenom = $prenom;
    }

    /**
     * @param mixed $photo
     */
    public function setPhoto($photo)
    {
        $this->photo = $photo;
    }

    /**
     * @param mixed $tel1
     */
    public function setTel1($tel1)
    {
        $this->tel1 = $tel1;
    }

    /**
     * @param mixed $tel2
     */
    public function setTel2($tel2)
    {
        $this->tel2 = $tel2;
    }

    /**
     * @param mixed $adress
     */
    public function setAdress($adress)
    {
        $this->adress = $adress;
    }

    /**
     * @param mixed $emailPro
     */
    public function setEmailPro($emailPro)
    {
        $this->emailPro = $emailPro;
    }

    /**
     * @param mixed $emailPerso
     */
    public function setEmailPerso($emailPerso)
    {
        $this->emailPerso = $emailPerso;
    }

    /**
     * @param mixed $genre
     */
    public function setGenre($genre)
    {
        $this->genre = $genre;
    }
    
    // methode pour generer le code html d'une ligne du table qui corespandant à un objet contact
    
    public function rowTableForContact() {
        $target_dir = 'includes/upload/';
        $htmlCode = '<tr>'.
            ' <td> <img src=" '. $target_dir. $this->getPhoto() .'"  style="width: 100px; height : 100px ;border-radius:  50% ;"></td>'.
            ' <td>'. $this->getNom() .'</td>'.
            ' <td>'. $this->getPrenom() .'</td>'.
            ' <td>'. $this->getTel1() .'</td>'.
            ' <td>'. $this->getTel2() .'</td>'.
            ' <td>'. $this->getAdress() .'</td>'.
            ' <td>'. $this->getEmailPro() .'</td>'.
            ' <td>'. $this->getEmailPerso() .'</td>'.
            ' <td>'. $this->getGenre() .'</td>'.
            ' <td>'. '<a href="includes/delete.php?id='.  $this->getId().'">DELETE</a> ' .'</td>'.
            '</tr>';
        
        return $htmlCode;
    }
    
    // methode qui permet de génerer le code html d'une table de tous les objets contacts qui sont dans la base de données
    
    public function tableAllContact(){
        
    }
  
}