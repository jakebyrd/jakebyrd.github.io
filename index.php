<?php

// Function to make sure name is valid.
function filterName($field){
    $field = filter_var(trim($field), FILTER_SANITIZE_STRING);

    if(filter_var($field, FILTER_VALIDATE_REGEXP, array("options"=>array("regexp"=>"/^[a-zA-Z\s]+/")))){
        return $field;
    }else{
        return FALSE;
    }
}    

// Function to make sure email is valid.
function filterEmail($field){
    $field = filter_var(trim($field), FILTER_SANITIZE_EMAIL);
    
    if(filter_var($field, FILTER_VALIDATE_EMAIL)){
        return $field;
    }else{
        return FALSE;
    }
}

$name = "";
$email = "";
$nameErr = "";
$emailErr = "";

// Check to see if form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){
 
    // Make sure name is not empty.
    if(empty($_POST["name"])){
        $nameErr = 'Please enter your name.';
    }
    // Make sure name is valid.
        else{
            $name = filterName($_POST["name"]);
            if($name == FALSE){
                $nameErr = 'Please enter a valid name.';
            }
        }
    // Make sure email label is not empty.
    if(empty($_POST["email"])){
        $emailErr = 'Please enter an email.';
    }
    // Make sure email is valid.
        else{
            $email = filterEmail($_POST['email']);
            if($email == FALSE){
                $emailErr = 'Please enter a valid email.';
            }
        }
    // Make sure there are no errors
    if(empty($nameErr) && empty($emailErr){
        $to = 'byrdjake126@gmail.com';
        // Set headers
        $headers = 'From: '. $email . "\r\n" .
        'Reply-To: '. $email . "\r\n" .
        'X-Mailer: PHP/' . phpversion();
        // Echo success or error
        if(mail($to, $subject, $headers)){
            echo '<p class="success">Your message has been sent!</p>';
        }else{
            echo '<p class="error">Unable to send email. Please try again later.</p>';
        }
    }
}
?>
