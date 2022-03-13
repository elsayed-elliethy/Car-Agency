<?php
    session_start();
    if(isset($_SESSION['username'])){
        include "connect.php";
        include "includes/tempalets/header.php"; 
        include "includes/functions/functions.php";
        include "includes/languages/arbic.php";
        include 'includes/tempalets/Navbar.php';
  
        $do=isset($_GET['do']) ? $_GET['do'] : 'Manage';
        
        if($do =='Manage'){
            $sort='ASC';
            $sort_array=array('ASC','DESC');
            if (isset($_GET['sort']) && in_array($_GET ['sort'],$sort_array)){
                $sort=$_GET['sort'];
            }
           $stmt2=$con->prepare("SELECT * FROM categories ORDER BY Ordering $sort");
           $stmt2->execute();
           $cats=$stmt2->fetchAll();?>
           <h1 class="text-center mem">Manage Cars</h1>
                <div class="container">
                    <div class="manage panel panel-default">
                        <div class="panel-heading"> <i class='fa fa-edit'></i>   Manage Cars
                                                    <div class="option pull-right">
                                <i class='fa fa-sort'></i>  Ordering:
                                <a href="?sort=ASC" class="<?php if ($sort =='ASC'){ echo 'active';}?>">Asc</a> |
                                <a href="?sort=DESC" class="<?php if ($sort =='DESC'){ echo 'active';}?>">Desc</a>
                                 - <i class='fa fa-eye'></i> View:
                                <span class='active' data-view="full">Full</span> | 
                                <span data-view="classic">Classic</span>

                            </div>
                        </div>
                        <div class="panel-body">
                        <?php 
                            foreach($cats as $cat){
                                echo '<div class="cat">';
                                    echo "<div class='hidden-button'>";
                                        echo "<a href='categories.php?do=Edit&catid=".$cat['ID']."' class='btn btn-xs btn-primary'><i class='fa fa-edit'></i> Edit</a>";
                                        echo "<a href='categories.php?do=Delete&catid=" .$cat['ID'] . "' class=' confirm btn btn-xs btn-danger'><i class='fa fa-close'></i> Delete</a>";
                                    echo "</div>";
                                    echo '<h3 class="name-cat">'.$cat['Name'].'</h3>';
                                    echo "<div class='full-view'>";
                                        echo '<p>'; if ($cat['Description'] == '') { echo 'This Category Has No Description';} else{ echo $cat['Description']; } echo'</p>';
                                        if($cat['Visibility']==1){echo '<span class="Visibility"><i class="fa fa-eye"></i> Hidden </span>';}
                                        if($cat['Allow_Comment']==1){echo '<span class="commenting"><i class="fa fa-close"></i> Comment Disabled </span>';}
                                        if($cat['Allow_Ads']==1){echo '<span class="advertises"><i class="fa fa-close"></i> Ads Disabled </span>';}
                                    echo "</div>";
                                        
                                echo "</div>";
                                
                                
                                
                            }
                        ?>
                        </div>
                    </div>
                    <a  class="add-category btn btn-primary" href="categories.php?do=Add"><i class="fa fa-plus"></i> Add New Category</a>
                </div>

           <?php

       }elseif($do=='Add'){?>

        <h1 class="text-center mem" > Add New Category </h1>
        <div class="container edit">
            <form class="form-horizontal" action="?do=Insert" method="POST">
                
            <!-- start Name field-->
            <div class="form-group">
                <label class="col-sm-2 control-label" >Name</label>
                <div class=" col-sm-7">
                    <input type="text" name="name" class="form-control"  autocomplete="off" required="required" placeholder="Name of Category">

                </div>
            </div>
            <!--end Name Field-->
            <!-- start Dwscription field-->
            <div class="form-group ">
                <label class="col-sm-2 control-label" >Description</label>
                <div class=" col-sm-7">
                    <input type="text" name="description" class="form-control"   placeholder="Describe The Category">
                </div>
            </div>
            <!--end Description Field-->
            <!-- start Ordering field-->
            <div class="form-group">
                <label class="col-sm-2 control-label" >Ordering</label>
                <div class=" col-sm-7">
                    <input type="text" name="ordering" class="form-control"   autocomplete="off" placeholder="Number To Arrange The Categories">
                </div>
            </div>
            <!--end Ordering Field-->
            <!-- start Visibility field-->
            <div class="form-group">
                <label class="col-sm-2 control-label" >Visible</label>
                <div class=" col-sm-7">
                <div>
                    <input id="vis-yes" type="radio" name="visibility" value="0" checked> <!--0=yes-->
                    <label for="vis-yes"> - Yes</label> 
                </div>
                <div>
                    <input id="vis-no" type="radio" name="visibility" value="1" > <!--0=no-->
                    <label for="vis-no"> - No</label> 
                </div>

                </div>
            </div>
            <!--end Visibility Field-->
            <!-- start Commention Field-->
                <div class="form-group">
                <label class="col-sm-7 control-label" >Allow - Commenting</label>
                <div class=" col-sm-7">
                <div>
                    <input id="com-yes" type="radio" name="commenting" value="0" checked> <!--0=yes-->
                    <label for="com-yes"> - Yes</label> 
                </div>
                <div>
                    <input id="com-no" type="radio" name="commenting" value="1" > <!--0=no-->
                    <label for="com-no"> - No</label> 
                </div>

                </div>
            </div>
            <!--end Commenting Field-->
                <!-- start Ads Field-->
                <div class="form-group">
                <label class="col-sm-7 control-label" >Allow - Ads</label>
                <div class=" col-sm-7">
                <div>
                    <input id="ads-yes" type="radio" name="ads" value="0" checked> <!--0=yes-->
                    <label for="ads-yes"> - Yes</label> 
                </div>
                <div>
                    <input id="ads-no" type="radio" name="ads" value="1" > <!--0=no-->
                    <label for="ads-no"> - No</label> 
                </div>

                </div>
            </div>
            <!--end Ads Field-->
            
            <!-- start submit field-->
                <div class="form-group">
                <div class=" col-sm-offset-4 col-sm-7">
                    <input type="submit" value="Add Category" class="btn btn-primary">
                </div>
            </div>
            <!--end submit Field-->
            </form>
            
        </div>

        <?php
    }elseif($do=='Insert'){

    if($_SERVER['REQUEST_METHOD']=='POST'){
        echo "<h1 class='text-center mem'>Insert Category</h>"."<br>";
        echo "<div class='container'>";
            //get variable from the form
            
            $name       =   $_POST['name'];
            $desc       =   $_POST['description'];
            $order      =   $_POST['ordering'];
            $visible    =   $_POST['visibility'];
            $comment    =   $_POST['commenting'];
            $ads        =   $_POST['ads'];
              
            //Check If Category Exist in Database
            $check=checkItem("Name","categories",$name);
            if($check==1){
                $theMsg="<div class='alert alert-danger'>Sorry This Category Is Exist</div>";
                redirectHome($theMsg,'back');
            }else{
            //insert Category Info In Database
            $stmt =$con->prepare("INSERT INTO 
                                categories (Name ,Description,Ordering,Visibility,Allow_Comment,Allow_Ads)
                                VALUES (:zname,:zdesc,:zorder,:zvisible,:zcomment,
                                :zads)");
            $stmt->execute(array(
                'zname'=>$name,
                'zdesc'=>$desc,
                'zorder'=>$order,
                'zvisible'=>$visible,
                'zcomment'=>$comment,
                'zads'=>$ads
            ));
            $count=$stmt->rowCount(); //count 
            //echo success message
            
            $theMsg= "<div class='alert alert-success'>".$stmt->rowCount().'Record Insert</div>';
            redirectHome( $theMsg,'back',3);
        }

        
        
        }else{

             echo '<div class="container">';
             $theMsg= '<div class="mem text-center alert-danger">Sorry You Cant Browse This Page Directly</div>';
             redirectHome( $theMsg,'back',3);
             echo '</div>';
         }

         echo "</div>";

       }elseif($do=='Edit'){
                      
            //if(isset($_GET['userID']) && is_numeric($_GET['userID'])){       //لو فيه رجويست جيه ف الرابط يوزر اي دي وهل كان رقم 
                    //echo intval($_GET['userID'] ) ;                      //integer value
           // }else{
             //   echo 0; 
           // }
                   //دي اختصار للاف اللي فوق بحيث؟ تعني الصح وال: تعني الالس
                   $catid = isset($_GET['catid']) && is_numeric($_GET['catid']) ? intval($_GET['catid']) : 0;
                   //استعلام:statment
                    $stmt=$con->prepare("SELECT * FROM  categories WHERE ID =? ");

                    $stmt ->execute(array($catid));

                    $cat=$stmt->fetch(); //fetch data 

                    $count=$stmt->rowCount(); //count 
                    if($count >0){ ?>   

                        <h1 class="text-center mem" > Edit Category </h1>
                        <div class="container edit">

                        <form class="form-horizontal" action="?do=Update" method="POST">
                        <input type="hidden" name="catid"  value="<?php echo $catid ?>"> 
                        <!-- start Name field-->
                        <div class="form-group">
                            <label class="col-sm-2 control-label" >Name</label>
                            <div class=" col-sm-7">
                                <input type="text" name="name" class="form-control"  required="required" placeholder="Name of Category" value="<?php echo $cat['Name']?>" >

                            </div>
                        </div>
                        <!--end Name Field-->
                        <!-- start Dwscription field-->
                        <div class="form-group ">
                            <label class="col-sm-2 control-label" >Description</label>
                            <div class=" col-sm-7">
                                <input type="text" name="description" class="form-control"   placeholder="Describe The Category"  value="<?php echo $cat['Description']?>" >
                            </div>
                        </div>
                        <!--end Description Field-->
                        <!-- start Ordering field-->
                        <div class="form-group">
                            <label class="col-sm-2 control-label" >Ordering</label>
                            <div class=" col-sm-7">
                                <input type="text" name="ordering" class="form-control"  placeholder="Number To Arrange The Categories " value="<?php echo $cat['Ordering']?>">
                            </div>
                        </div>
                        <!--end Ordering Field-->
                        <!-- start Visibility field-->
                        <div class="form-group">
                            <label class="col-sm-2 control-label" >Visible</label>
                            <div class=" col-sm-7">
                            <div>
                                <input id="vis-yes" type="radio" name="visibility" value="0" <?php if ($cat['Visibility']==0){echo 'checked ';} ?> > <!--0=yes-->
                                <label for="vis-yes"> - Yes</label> 
                            </div>
                            <div>
                                <input id="vis-no" type="radio" name="visibility" value="1" <?php if ($cat['Visibility']==1){echo 'checked ';} ?> > <!--0=no-->
                                <label for="vis-no"> - No</label> 
                            </div>

                            </div>
                        </div>
                        <!--end Visibility Field-->
                        <!-- start Commention Field-->
                            <div class="form-group">
                            <label class="col-sm-7 control-label" >Allow - Commenting</label>
                            <div class=" col-sm-7">
                            <div>
                                <input id="com-yes" type="radio" name="commenting" value="0"   <?php if ($cat['Allow_Comment']==0){echo 'checked ';} ?>> <!--0=yes-->
                                <label for="com-yes"> - Yes</label> 
                            </div>
                            <div>
                                <input id="com-no" type="radio" name="commenting" value="1"  <?php if ($cat['Allow_Comment']==1){echo 'checked ';} ?> > <!--0=no-->
                                <label for="com-no"> - No</label> 
                            </div>

                            </div>
                        </div>
                        <!--end Commenting Field-->
                            <!-- start Ads Field-->
                            <div class="form-group">
                            <label class="col-sm-7 control-label" >Allow - Ads</label>
                            <div class=" col-sm-7">
                            <div>
                                <input id="ads-yes" type="radio" name="ads" value="0"  <?php if ($cat['Allow_Ads']==0){echo 'checked ';} ?>> <!--0=yes-->
                                <label for="ads-yes"> - Yes</label> 
                            </div>
                            <div>
                                <input id="ads-no" type="radio" name="ads" value="1"  <?php if ($cat['Allow_Ads']==1){echo 'checked ';} ?>> <!--0=no-->
                                <label for="ads-no"> - No</label> 
                            </div>

                            </div>
                        </div>
                        <!--end Ads Field-->
                        
                        <!-- start submit field-->
                            <div class="form-group">
                            <div class=" col-sm-offset-4 col-sm-7">
                                <input type="submit" value="Save" class="btn btn-primary">
                            </div>
                        </div>
                        <!--end submit Field-->
                        </form>
                        
                    </div>

                    <?php 
                    }else{
                        echo '<div class="container">';
                        $theMsg='<div class="alert alert-danger">theres No Such ID</div>';
                        redirectHome($theMsg,'back');
                        echo'</div>';
                    
                }

        }elseif($do=='Update'){

            echo "<h1 class='text-center mem'>Update Category</h>"."<br>";
            echo "<div class='container'>";
            if($_SERVER['REQUEST_METHOD']=='POST'){
                   //get variable from the form
                   $id      = $_POST['catid'];
                   $name    = $_POST['name'];
                   $desc    = $_POST['description'];
                   $order   = $_POST['ordering'];
                   $visible = $_POST['visibility'];
                   $comment = $_POST['commenting'];
                   $ads     = $_POST['ads'];
               
                        
                $stmt=$con->prepare("UPDATE
                                                categories
                                        SET 
                                                Name =?,
                                                Description = ?,
                                                Ordering = ?,
                                                Visibility = ?,
                                                Allow_Comment = ?,
                                                Allow_Ads = ?
                                        WHERE 
                                                ID=?" );
                $stmt->execute(array($name,$desc,$order,$visible,$comment,$ads,$id));

                //echo success message
                $theMsg=  "<div class='alert alert-success'>" . $stmt->rowCount().'Record Updated</div>';
                redirectHome($theMsg,'back');
            }else{
               $theMsg= "<div class alert alert-danger>Sorry You Cant Browse This Page Directly</div>";
               redirectHome($theMsg);
               }


            echo "</div>";

        }elseif($do=='Delete'){
                   
                    echo "<h1 class='text-center mem'>Delete Category</h>"."<br>";
                    echo "<div class='container'>";
                    $catid=isset($_GET['catid']) && is_numeric($_GET['catid']) ? intval($_GET['catid'] ) : 0;
                    //استعلام:statment
                    $stmt=$con->prepare("SELECT * FROM  categories WHERE ID =?  LIMIT  1");
                    $stmt ->execute(array($catid));
                    $count=$stmt->rowCount(); //count 
                    if($stmt->rowCount()>0){ 
                        $stmt=$con->prepare("DELETE FROM categories WHERE ID=:zcat");
                        $stmt->bindparam(":zcat",$catid); //bind parameter بتربط بين القيمه اللي ف الريجويست واللي موجوده ف الداتا
                        $stmt->execute();
                        $theMsg = "<div class='alert alert-success mem text-center'>".$stmt->rowCount().'Record Delete</div>';
                        redirectHome($theMsg,'back');
                    }else{
                        $theMsg ="<div class='alert alert-danger mem  text-center'>This ID is Not Exist</div>";
                        redirectHome($theMsg,'back');
                    }
                    echo"</div>";
        }

    
    include "includes/tempalets/footer.php";
       }else{
           header('location:index.php');
           exit();
       }