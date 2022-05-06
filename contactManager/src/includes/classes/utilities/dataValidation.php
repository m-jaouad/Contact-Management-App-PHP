<?php 


class dataValidation {
    
    public static function sanitize($data) {
        return isset($data) ? htmlspecialchars(trim($data)) : "";
    }
    
    public static function sanitizePost($data) {
        return isset($_POST[$data]) ? self::sanitize($_POST[$data]) : "";
    }
    
}


