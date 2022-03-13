<?php
    ob_start();
    session_start();
    if(isset($_SESSION['username'])){
        include "connect.php";
        include "includes/tempalets/header.php"; 
        
        include "includes/languages/arbic.php";
        include 'includes/tempalets/Navbar.php';
        include "includes/functions/functions.php";
                /*Start Dashboard Page*/
            
            $numUsers = 4; //Number Of Latest Users
            $latestUsers= getLatest ("*","users","userID",$numUsers);//Latest Users Array
            $numItems=4; //Number Of Latest Items
            $latestItems=  getLatest("*","items","Item_ID",$numItems); //Latest Items Array 
            $numComments=4; //Number Of Latest Items
            $latestComments=  getLatest("*","comments","c_id",$numComments); //Latest Comments Array 


        
        ?>
        <div class="container home-stats text-center">
            <h1 class='mem'>Dahboard</h1>
            <div class="row">
                
                <a href='member.php' > <div class="col-lg-3 col-sm-6"> <div class="stat st-total">
                <i class="fa fa-users"></i>
                <div class="info">
                         Total Members
                    <span> <?php echo countItems('userID','users')?> </span>
                    </div>
                </div></a>
                

          
                </div>
                <a href='member.php?do=Manage&page=Pending'><div class="col-lg-3 col-sm-6">
                <div class="stat st-peding">
                    <i class="fa fa-user-plus"></i>
                        <div class="info">
                        Peding  Members
                        <span> <?php echo checkItem("RegStatus","users",0) ?> </span>
                    </div></div></a>
                </div>
                <a href='items.php?do=Manage'><div class="col-lg-3 col-sm-6">
                    <div class="stat st-items ">
                    <i class="fa fa-tag"></i>
                        <div class="info">
                        Total Items
                        <span> <?php echo countItems('Item_ID','items')?> </span>
                    </div></div></a>
                </div>
                <a href='comments.php?do=Manage'><div class="col-lg-3  col-sm-6">

                <div class="stat st-coments"> 
                <i class="fa fa-comments"></i>
                        <div class="info">
                        
                        Total Comments
                        <span><?php echo countItems('c_id','comments')?></span>
                    </div>
                </div></a>
            </div>  
        </div>
    <div class="container latest">
        <div class="row">
            <div class="col-sm-6">
            <div class="panel panel-default">
                
                <div class="panel-heading">
                    <i class="fa fa-users"></i> -Latest <?php echo $numUsers?> Registerd Users
               <!-- <span class="pull-right">
                    <i class='toggle-info fa fa-plus fa-lg'></i>
                </span>-->
                </div>

                <div class="panel-body">
                <ul class="list-unstyled latest-users">
                    <?php 
                    if(! empty($latestUsers)){              
                        foreach ($latestUsers as $user){
                            echo '<li>'.$user['username'].
                            '<a href="member.php?do=Edit&userid='.$user['userID'].'"><span class="btn btn-success pull-right"><i class="fa fa-edit">
                            </i>-Edit</span></a>';

                            if ($user['RegStatus']==0){
                            echo "<a href='member.php?do=Activate&userid=".$user['userID'].
                            "' class='btn btn-info confirm activate pull-right'><i class='fa fa-magic'>
                            </i> Activate</a>";


                            }
                            echo "</li>";
                        }
                    }else{
                        echo 'There\'s No Members To Show';
                        
                    }
                    ?>
                </ul>
                
                 </div>
                </div>
            </div>
            <div class="col-sm-6">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <i class="fa fa-tags"></i> - Latest <?php echo $numItems?> Items
                </div>
                <div class="panel-body">
                <ul class="list-unstyled latest-users">
                    <?php 
                        if(! empty ($latestItems)) {           
                        foreach ($latestItems as $item){
                            echo '<li>'.$item['Name'].
                            '<a href="items.php?do=Edit&itemid='.$item['Item_ID'].'"><span class="btn btn-success pull-right"><i class="fa fa-edit">
                            </i>-Edit</span></a>';

                            if ($item['Approve']==0){
                            echo "<a href='items.php?do=Approve&itemid=".$item['Item_ID'].
                            "' class='btn btn-info confirm activate pull-right'><i class='fa fa-magic'>
                            </i> Approve</a>";


                            }
                            echo "</li>";
                        }
                    }else{
                        echo 'There\'s No Items To Show  ';
                        echo'<div> <a href="items.php?do=Add" class="btn btn-primary "><i class="fa fa-plus" ></i> Add item </a></div>'; 

                    }
                    ?>
                </ul>
                
                 </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-6">
            <div class="panel panel-default">
                
                <div class="panel-heading">
                    <i class="fa fa-comments"></i> -Latest <?php echo $numComments?> comments
               <!-- <span class="pull-right">
                    <i class='toggle-info fa fa-plus fa-lg'></i>
                </span>-->
                </div>

                <div class="panel-body">
                <?php 
                    $stmt=$con->prepare("SELECT 
                                            comments.*,users.username AS Member
                                        FROM
                                             comments 
                                        
                                        INNER JOIN 
                                            users
                                        ON
                                            users.UserID = comments.user_id
                                        ORDER by c_id DESC LIMIT 4 ");


                //Execute The State
            $stmt->execute(array());
            //Assign To Variable
            $comments=$stmt->fetchAll();
            
             foreach ($comments as $comment ){
                 
                
                 echo'<div class="comment-box">';
                        echo '<span class="member-n">'.$comment['Member'].'</span>';
                        echo '<p class="member-c">'.$comment['comment'].'</p>';
                        

                echo'</div>';

             }
            ?>

                
                 </div>
                </div>
            </div>
            </div>
    </div>


          


        <?php
        include "includes/tempalets/footer.php";

    }else{
        header('location:index.php');
        exit();
    }
    ob_end_flush();
?>