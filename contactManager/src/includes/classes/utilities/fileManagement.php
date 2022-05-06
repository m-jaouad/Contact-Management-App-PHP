<?php

/*
 * classe qui nous permet de manager l'upolad du file 
 * 
 */
class FileManagement{
    /**
     * Cette fonction permet de d�fint un nom normalis� pour le fichier
     * @param $file
     * 
     * @return @dateString
     */
   private function randomizeFileName($file)
    {
        $number = rand(1111111111, 9999999999);
        
        $dateString = 'photo_' . $number . date('Y_m_d_H_i_s_u') . $file;
        
        return $dateString;
    }
    
    /**
     * permet de t�l�charger (upload) un ficher vers le serveur
     */
  public   function uploadFile($target_dir, $fileToUpload, $extensions, &$fileName, &$errors)
    {
        $uploadOk = true;
        
        $upperExtensions = [];
        foreach ($extensions as $i) {
            $upperExtensions[] = strtoupper($i);
        }
        
        // On normalise le nom du fichier 
        $fileNameRand = self::randomizeFileName(basename($_FILES[$fileToUpload]["name"]));
        $fileName = $fileNameRand;
        
        // $target_dir le dossier qui va contenir les fichier
        // $targetfile est le chemin complet pour notre fichier
        
        $target_file = $target_dir . $fileNameRand;
        
        // Obtenir l'extension du fichiers
        $imageFileType = strtoupper(pathinfo($target_file, PATHINFO_EXTENSION));
        
        // V�rifier que cette extension est acceptable
        if (! in_array($imageFileType, $upperExtensions)) {
            $uploadOk = false;
            $errors.='Extension du fichier non support�e';
            
        }
        
        // TODO: TRES IMPORTANT : Il reste � v�rifier si le fichier est une image ou non
        
        // V�rifier la taille du fichier 4 MO c'est largement suffisant pour une photo d'un contact 
        if ($_FILES[$fileToUpload]["size"] > 4000000) {
            
            $uploadOk = false;
            $errors.='La taille du fichier est non support�e';
        }
        
        // Si y a pas de probl�mes
        if ($uploadOk) {
            
            // D�placer le fichier vers son emplacement sur le serveur
            $upload = move_uploaded_file($_FILES[$fileToUpload]["tmp_name"], $target_file);
            
            if(!$upload){
                $errors.="Le d�palacement du fichier vers le dossier d'upload a echou�";
            }
            
            // On retourne le status de l'upload
            return $upload;
        }
        
        
        
        return false;
    }
}
