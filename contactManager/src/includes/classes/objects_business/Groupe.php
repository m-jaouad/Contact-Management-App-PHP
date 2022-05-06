<?php 
/**
 * cette permet de representer les objets de type groupe
 */

class Groupe {
    
    private  $id;
    
    private  $nom;
    
    private $icone;
    
    public function init($nom, $icone){
        $this->nom = $nom;
        $this->icone = $icone;
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
    public function getIcone()
    {
        return $this->icone;
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
     * @param mixed $icone
     */
    public function setIcone($icone)
    {
        $this->icone = $icone;
    }

    // methode pour generer le code html d'une ligne du table qui corespandant à un objet contact
    
    public function rowTableForGroup() {
        $target_dir = 'includes/upload/';
        $htmlCode = '<tr>'.
            ' <td> <img src=" '. $target_dir. $this->getIcone() .'"  style="width: 100px; height : 100px ;border-radius:  50% ;"></td>'.
            ' <td>'. $this->getNom() .'</td>'.
            ' <td> <ul>'. '<li><a href="includes/deleteGroup.php?id='.  $this->getId().'">DELETE</a> </li>'.
                    '<li><a href="contactOfSelectedGroup.php?idGroup='.  $this->getId().'">Afficher</a></li> '
                .'</ul></td>'.
            '</tr>';
        
        return $htmlCode;
    }
    
}
