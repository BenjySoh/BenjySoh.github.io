<?php

    $error = "";
    $successMessage = "";

    if($_POST){

        if(!$_POST["name"]){

            $error .= "Name field is required<br>";

        }

        if(!$_POST["email"]){

            $error .= "An emaill address is required<br>";

        }

        if(!$_POST["message"]){

            $error .= "Message field is required<br>";

        }

        if($_POST["email"] && filter_var($_POST["email"], FILTER_VALIDATE_EMAIL) === false ){

            $error .= "Email is invalid.";

        }

        if($error != ""){

            $error = '<div class="alert alert-danger" role="alert><p>Error(s) on enquiry form, please check below and try again. </p>' . $error . '</div>';

        }
        else{

            $to = "fussypug@gmail.com"; // Recipient's email address
            $subject = "Your Subject"; // Your email subject
            $message = $_POST['message']; // Message content
            $from = $_POST['email']; // Sender's email address
            $headers = "From: $from\r\n"; // Sender's email address
            $headers .= "Reply-To: $from\r\n"; // Reply-To address
            $headers .= "MIME-Version: 1.0\r\n"; // MIME version
            $headers .= "Content-Type: text/html; charset=UTF-8\r\n"; // Content type
            
            // Additional headers to help prevent email from being marked as spam
            $headers .= "X-Priority: 1\r\n"; // Urgent message
            $headers .= "X-Mailer: PHP/" . phpversion() . "\r\n"; // PHP mailer

            if(mail($to, $subject, $message, $headers)){

                $successMessage = '<div class="alert alert-success" role="alert">Enquiry has been delivered successfully, we will be in touch with you shortly.</div>';

            }else{

                $error = '<div class="alert alert-danger" role="alert">Opps something does not right, please check below and try again.</div>';

            }

        }

    }

?>


<!DOCTYPE html>
<html lang="en" data-bs-theme="dark">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fil=no">
        <meta http-equiv="x-ua-compatible" content="ie=edge">
        
        <!--bootStrap--->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" 
            rel="stylesheet" 
            integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" 
            crossorigin="anonymous">
        <!--bootStrap--->

        <title>Get Connected</title>

        <!--CSS-->
            <style type="text/css">

                .modal-sheet .modal-dialog {
                width: 380px;
                transition: bottom .75s ease-in-out;
                }
                
                .modal-sheet .modal-footer {
                padding-bottom: 2rem;
                }

                h1{
                    margin-top: 50px;
                    margin-bottom: 50px;
                    text-align: center;
                }
                
                body{

                    background: url(contactUsWallPaper.jpg) no-repeat center center fixed;
                    background-size: cover;

                }
    
            </style>
        <!--CSS-->

    </head>
    
        <body>

            <main>

                <div class="container py-5">

                    <h1>Get connected!</h1>

                    <!---errorDisplay--->

                        <?php

                            echo $error . $successMessage; 

                        ?>

                    <!---errorDisplay--->

                    <form method="post" id="contactForm">

                        <div class="row">

                            <div class="col-mb-3 col-lg-3">

                                <label for="name" class="form-label py-1">Preferable Name</label>
                                <input type="text" class="form-control" id="name" name="name" placeholder="John Doe...">                      

                                <label for="email" class="form-label py-1">Email Address</label>
                                <input type="email" class="form-control" id="email" name="email" placeholder="johndoe@example.com">  

                            </div>

                            <div class="col-mb-9 col-lg-9">
                                
                                <label for="message" class="form-label py-1">Message</label>
                                <textarea class="form-control" id="message" name="message" rows="15" placeholder="Hi, I've had came across your webpage, I'd liked to connect with you!"></textarea>

                            </div>

                        </div>

                        <div class="row py-5 col-5 mx-auto">

                            <button type="submit" id="submit" class="btn btn-primary btn-mb">Connect</button>

                        </div>

                    </form>

                </div>

                <!--JQuery-->

                <script src="https://code.jquery.com/jquery-3.7.1.min.js">
                </script>

                <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" 
                integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" 
                crossorigin="anonymous">
                </script>

                <!--JQuery-->

                <!--Js-->

                <script type="text/javascript">

                    $("form").submit(function(e){

                        let error = "";

                        if($("#name").val() == "" ){

                            error += "Name field is required<br>";
                        }
                        if($("#email").val() == ""){
                            
                            error += "Email field is required<br>";

                        }
                        if($("#message").val() == ""){

                            error += "Message field is required<br>";

                        }

                        if(error != "") { // test if there's an error. 
                    
                            $("#error").html('<div class="alert alert-danger"' + 
                            'role="alert"><p><strong>There were errors, please check below and try again.</strong></p>' 
                            + error + 
                            '</div>');

                        
                            return false;

                        }
                        else { // no errors then run else 
                    
                            return true;

                        }

                    })

                </script>

                <!--Js-->

            </main>

        </body>
</html>
