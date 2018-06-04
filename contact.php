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


<html>
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">

<!--Bootstrap style page-->
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" integrity="sha384-WskhaSGFgHYWDcbwN70/dfYBj47jz9qbsMId/iRN3ewGhXQFZCSftd1LZCfmhktB" crossorigin="anonymous">

<!--Custom style page-->
<link rel="stylesheet" href="styles.css">
</head>

<body>
<!-- Navbar -->
<nav class="navbar navbar-expand-lg navbar-dark bg-dark" role="navigation">
    <a class="navbar-brand" href="#">Jake Byrd</a>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav">
                <li class="nav-item active">
                  <a class="nav-link" href="#home">Home <span class="sr-only"></span></a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="https://github.com/jakebyrd">GitHub</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="https://jakebyrd.github.io/aboutme">About Me</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link disabled" href="https://jakebyrd.github.io/contact">Contact Me</a>
                </li>
            </ul>
        </div>
</nav>

<!--Top content-->
<div class="jumbotron jumbotron fluid">
    <div class="container">
        <div class="main-jumbotron-content">
            <h1>Contact Jake Byrd</h1>
        </div>
    </div>
</div>

<!-- Form -->
<div class="main-page-content">
    <div class= "container">
        <div class="row justify-content-center">
            <form class="form-horizontal" role="form" method="post" action="contact.php">
                <fieldset>                                 
                    <!-- Text input-->
                    <div class="form-group col-md-12">
                        <label class="control-label" id="emaillabel" for="name">Name</label>  
                            <input id="name" name="name" type="text" placeholder="Ex. John Doe" class="form-control input-md" value = "">
                    </div>
                    <div class="form-group col-md-12">
                        <label class="control-label" id="emaillabel" for="email">Email</label>  
                            <input id="email" name="email" type="text" placeholder="Ex. johndoe@domain" class="form-control input-md" value ="">                            
                    </div>
                    <div class="form-group col-md-12">
                        <label class="control-label" id="messagelabel" for="message">Message</label>  
                            <input id="message" name="message" type="text" placeholder="" class="form-control input-md" required="">
                    </div>
                    <!-- Button -->
                    <div class="form-group col-md-12">
                        <label class="col-md-4 control-label" for="singlebutton">Submit</label>
                            <button id="singlebutton" name="Submit" class="btn btn-primary">Submit</button>
                    </div>
                </fieldset>
            </form>
        </div>
    </div>
</div>
              
<!--Footer-->
<div class="container">
        <div class="row">
            <div class="col">
                <h5>Copyright Jake Byrd 2018</h5>
            </div>
            <div class="col">
                <a class="btn btn-secondary" href="https://jakebyrd.github.io/contact" role="button">Contact me here</a>
            </div>
        </div>
    </div>
    

</body>

<!-- Bootstrap scripts that must be ran at the end of the page. -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js"></script>

</html>