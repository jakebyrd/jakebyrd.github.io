<?php

function filterName($field){
    // Sanitize name
    $field = filter_var(trim($field), FILTER_SANITIZE_STRING);
    
    // Validate name
    if(filter_var($field, FILTER_VALIDATE_REGEXP, array("options"=>array("regexp"=>"/^[a-zA-Z\s]+/")))){
        return $field;
    }else{
        return FALSE;
    }
}    

function filterEmail($field){
    // Sanitize e-mail address
    $field = filter_var(trim($field), FILTER_SANITIZE_EMAIL);
    
    // Validate e-mail address
    if(filter_var($field, FILTER_VALIDATE_EMAIL)){
        return $field;
    }else{
        return FALSE;
    }
}

$name = $email = "";
$nameErr = $emailErr = "";

if($_SERVER["REQUEST_METHOD"] == "POST"){
 
    // Validate name
    if(empty($_POST["name"])){
        $nameErr = 'Please enter your name.';
    }else{
        $name = filterName($_POST["name"]);
        if($name == FALSE){
            $nameErr = 'Please enter a valid name.';
        }
    }

    if(empty($_POST["email"])){
        $emailErr = 'Please enter an email.';
    }else{
        $email = filterEmail($_POST['email']);
        if($email == FALSE){
            $emailErr = 'Please enter a valid email.';
        }
    }

    if(empty($nameErr) && empty($emailErr){
        // Recipient email address
        $to = 'byrdjake126@gmail.com';
        
        // Create email headers
        $headers = 'From: '. $email . "\r\n" .
        'Reply-To: '. $email . "\r\n" .
        'X-Mailer: PHP/' . phpversion();
                
        // Sending email
        if(mail($to, $subject, $message, $headers)){
            echo '<p class="success">Your message has been sent successfully!</p>';
        }else{
            echo '<p class="error">Unable to send email. Please try again!</p>';
        }
    }
}

