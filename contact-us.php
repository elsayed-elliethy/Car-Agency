<?php 
    ob_start();
    session_start();
    include "connect.php";
    include "includes/functions/functions.php";
    include "includes/tempalets/header.php"; 
   
    include "includes/languages/arbic.php";
    include 'includes/tempalets/Navbar.php';
    
//check if user coming from a request
    if($_SERVER['REQUEST_METHOD'] == 'POST'){
        //assign variables
        $user = filter_var( $_POST['username'],FILTER_SANITIZE_STRING  );
        $email = filter_var($_POST['email'],FILTER_SANITIZE_EMAIL );
        $cell = filter_var( $_POST['cellphone'],FILTER_SANITIZE_NUMBER_INT  );
        $msg = filter_var( $_POST['message'],FILTER_SANITIZE_STRING );
    
        //creating arra of errors
        
        $formErrors = array();
        if(strlen($user) <= 3){
            $formErrors[] = 'username must be larger than <strong> 3 </strong> characters';
        }
        if (strlen($msg) < 10){
            $formErrors[] = 'message cannot be less than <strong> 10 </strong>characters';
        }
        if (strlen($cell) < 11){
            $formErrors[] = 'cellphone cannot be less than <strong> 11 </strong> number';
        }
        if (empty($email)){
            $formErrors[] = 'email cannot be empty';
        }



        //if no error send the email[mail(to,subject,message,headers,parameters)]
        $myEmail = 'elsayed.elliethy5@gmail.com';
        $subject = 'contact form';
        $headers = 'from:' .$email . '\r\n';
        if(empty($formErrors)){
           // mail($myEmail,$subject,$msg,$headers);
            $user = '';
            $email = '';
            $cell = '';
            $msg = '';
            $success = '<div class="alert alert-success">we have recieved your message </div>';
        }


        
    }

    if (isset($_SESSION['user'])){

        $getUser = $con->prepare("SELECT * FROM users WHERE username = ?");
       // $getUser->execute(array($sessionUser));
        $info = $getUser->fetch();
        $userid = $info['userID'];
    }
    



    ?>





   
        <!--start form -->
        <div class="title-img"> &nbsp; 
        
        <h2 class=" the-success text-center alert alert-light "> Contact Us </h2>
        
        </div>
        <div  class="con-back">
        <div class="container">
            
            <h1 class="text-center mem ">Get In Touch</h1>
        
            <form class="contact-form sub-margin" action="<?php echo $_SERVER['PHP_SELF'] ?>" method="POST">
              
                <?php if ( !empty($formErrors)  ) { ?> 
                    <div class="alert alert-danger alert-dismissible" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                
               
                
                    <!-- Check if there are errors and send it to client -->
                    <?php if ( isset($formErrors) ) { 
                                foreach ( $formErrors as $error) { 
                                    echo $error . "</br>";
                                }
                         }  ?>
                </div>
                <?php } ?>
                <?php if (isset($success)){echo $success;}  ?>
                            
                <div class="form-group ">
                    <input class="username form-control the-success22" type="text" name="username" placeholder="type your username" value="<?php if (isset($_SESSION['user'])){ echo $info['fullName']; }?>" />
                    <i class="fa fa-user fa-fw contact-fa" aria-hidden="true"></i>
                    <span class="asterisk">*</span>
                    <div class="alert alert-danger custom-alert">
                         username must be larger than <strong> 3 </strong> characters

                    </div>
                </div>


                <div class="form-group">
                    <input class="email form-control the-success22" type="email" name="email" required placeholder="please type a valid email" value="<?php if (isset($_SESSION['user'])){echo $info['email'];} ?>"/>
                    <i class="fa fa-envelope fa-fw contact-fa" aria-hidden="true"></i>
                    <span class="asterisk">*</span>  
                    <div class="alert alert-danger custom-alert">
                         email cannot be empty

                    </div>     
                </div>

                <div class="form-group">
                    <input class="form-control the-success22" type="text" name="cellphone" placeholder="type your phone" value="<?php if (isset($_SESSION['user'])){ echo $info['phone'];} ?>"/>
                    <i class="fa fa-phone fa-fw contact-fa" aria-hidden="true"></i>
                    <div class="alert alert-danger custom-alert">
                         cellphone cannot be less than <strong> 11 </strong> number

                    </div>
                </div>
                         
                <div class="form-group">
                     
                <textarea class="message form-control the-success22" name="message" placeholder="your message ..."><?php if (isset($msg)){echo $msg;} ?></textarea>
                   
                <div class="alert alert-danger custom-alert">

                        message cannot be less than <strong> 10 </strong>characters

                    </div>
                </div>

                <input class="btn btn-success the-success22 btn-block " type="submit" value="Send message" />
                <i class="fa fa-paper-plane fa-fw contact-fa" aria-hidden="true"></i>


            </form>


        </div>
                         

        </div>

        <!--end form -->

      


  
        <?php 
    include "includes/tempalets/footer.php";
    ob_end_flush();
?>
