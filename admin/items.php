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
                                                    //Join
            $stmt=$con->prepare("SELECT items.*, 
                                categories.Name AS Category_Name,
                                users.username FROM items
                                INNER JOIN categories ON categories.ID=items.Cat_ID 
                                INNER JOIN users ON users.userID=items.Member_ID
                                ORDER BY Item_ID DESC");
            //Execute The State
            $stmt->execute();
            //Assign To Variable
            $items=$stmt->fetchAll(); 
            if(! empty($items)){  
        ?> 
        <h1 class="text-center mem" > Manage Cars</h1>
        <div class="container ">  
            <div class ="table-responsive">
            <table class="main-table table table-bordered text-center ">
                <tr>
                    <td>#ID</td>
                    <td>Image</td>
                    <td>Name</td>
                    <td>Description</td>
                    <td>Price</td>
                    <td>Brand</td>
                    <td>Adding Date</td>
                    <td>Category</td>
                    <td>Username</td>
                    <td>Control</td>
                </tr>
                <?php
                    foreach($items as $item){
                        echo"<tr>";
                            echo"<td>".$item['Item_ID']."</td>";
                            echo"<td class='user-image'>";
                            if (empty($item['avater']) ){
                                echo"<img src='img.jpg' class='avater' >";  
                            }else{
                                    $img8 = explode(',',$item['img']);
                                    echo"<img src='uploads\images\\" . $img8[0] . " 'class=''>";
                                }                                
                           
                            echo"</td>" ;

                            echo"<td>".$item['Name']."</td>";
                            echo"<td>".$item['Description']."</td>";
                            echo"<td>".$item['Price']."</td>";
                            echo"<td>".$item['Brand']."</td>";
                            echo"<td>".$item['Add_Data']."</td>";
                            echo"<td>".$item['Category_Name']."</td>";
                            echo"<td>".$item['username']."</td>";
                            echo"<td >
                                <a href='items.php?do=Edit&itemid=".$item['Item_ID']."' class='btn btn-success control-item btn-edit-delete-active'><i class='fa fa-edit'></i> Edit</a>
                                <a href='Items.php?do=Delete&itemid=".$item['Item_ID']."' class='btn btn-danger confirm control-item btn-edit-delete-active'><i class='fa fa-close'></i> Delete</a>";
                                 if ($item['Approve']==0){

                                     echo "<a href='items.php?do=Approve&itemid=".$item['Item_ID']."' class='btn btn-info confirm activate control-item btn-edit-delete-active'><i class='fa fa-magic'></i>Active</a>";

                                 }
                            echo "</td>";
                                

                            echo"</tr>";
                    }
                ?>
            

            </table>
        </div>          
            <a href="items.php?do=Add" class="btn btn-primary"><i class="fa fa-plus" ></i>Add Car</a>
    </div>
        <?php }else{

            echo '<div class="container">';
            echo '<div class="nice-message">There\'s No Items To Show</div> ';
            echo'<a href="items.php?do=Add" class="btn btn-primary"><i class="fa fa-plus" ></i>Add Car</a>'; 
            echo '</div>';

        }?>
    <?php } elseif ($do=='Add'){?>

                <h1 class="text-center mem" > Add New Car </h1>
                <div class="container edit">
                    <form class="form-horizontal" action="?do=Insert" method="POST" enctype="multipart/form-data">
                        
                    <!-- start Name field-->
                    <div class="form-group">
                        <label class="col-sm-2 control-label" >Name</label>
                        <div class=" col-sm-7">
                            <input type="text" name="name" class="form-control" required="required"   placeholder="Name of Item">
                        </div>
                    </div>
                    <!--end Name Field-->
                     <!-- start Description field-->
                     <div class="form-group">
                        <label class="col-sm-2 control-label" >Description</label>
                        <div class=" col-sm-7">
                            <input type="text" name="description" class="form-control"  required="required"  placeholder="Description of Item">
                        </div>
                    </div>
                    <!--end Description Field-->
                    <!-- start Price field-->
                        <div class="form-group">
                        <label class="col-sm-2 control-label" >Price</label>
                        <div class=" col-sm-7">
                            <input type="text" name="price" class="form-control" required="required"  placeholder="Price of Item">
                        </div>
                    </div>
                    <!--end Price Field-->
                    <!-- start Country field-->
                    <div class="form-group">
                        <label class="col-sm-2 control-label" >Country</label>
                        <div class=" col-sm-7">
                            <input type="text" name="country" class="form-control" required="required"  placeholder="Country Of Made">
                        </div>
                    </div>
                    <!--end Country Field-->
                    <!-- start color field-->
                    <div class="form-group">
                        <label class="col-sm-2 control-label" >Color</label>
                        <div class=" col-sm-7">
                            <select  name='color'>
                                <option value="0"> .  .  . </option>
                                <option value="red">red</option>
                                <option value="black">black</option>
                                <option value="blue">blue</option>
                                <option value="yollow">yollow</option>
                                <option value="white">white</option>
                                <option value="green">green </option>
                                <option value="gray">gray</option>
                                <option value="gold">gold</option>
                                <option value="orange">orange</option>
                                <option value="silver">silver</option>

                            </select>
                        </div>
                    </div>
                    <!--end color Field-->
                    <!-- start Status field-->
                    <div class="form-group">
                        <label class="col-sm-2 control-label" >Status</label>
                        <div class=" col-sm-7">
                            <select  name='status'>
                                <option value="0"> .  .  . </option>
                                <option value="1">New</option>
                                <option value="2">Like New</option>
                                <option value="3">Used</option>
                                <option value="4">Old</option>

                            </select>
                        </div>
                    </div>
                    <!--end Status Field-->
                    
                    <!-- start brand field-->
                    <div class="form-group">
                        <label class="col-sm-2 control-label" >Brand</label>
                        <div class=" col-sm-7">
                            <select  name='brand'>
                                <option value="0"> .  .  . </option>
                                <option value="nissan">Nissan</option>
                                <option value="mazada">Mazada</option>
                                <option value="bmw">Bmw</option>
                                <option value="ford">Ford</option>
                                <option value="mercedes">Mercedes</option>
                                <option value="toyota">Toyota</option>

                            </select>
                        </div>
                    </div>
                    <!--end brand Field-->
                    <!-- start Members field-->
                    <div class="form-group">
                        <label class="col-sm-2 control-label" >Member</label>
                        <div class=" col-sm-7">
                            <select  name='member'>
                            <option value="0"> .  .  . </option>
                                <?php
                                    $stmt = $con->prepare("SELECT* FROM users");
                                    $stmt->execute();
                                    $users=$stmt->fetchAll();
                                    foreach ($users as $user){
                                        echo "<option value='".$user['userID']."'>" .$user['username']."</option>";
                                    }
                                ?>
                              

                            </select>
                        </div>
                    </div>
                    <!--end Members Field-->
                    <!-- start categories field-->
                        <div class="form-group">
                        <label class="col-sm-2 control-label" >Category</label>
                        <div class=" col-sm-7">
                            <select  name='category'>
                            <option value="0"> .  .  . </option>
                                <?php
                                    $stmt2= $con->prepare("SELECT* FROM categories");
                                    $stmt2->execute();
                                    $cats=$stmt2->fetchAll();
                                    foreach ($cats as $cat){
                                        echo "<option value='".$cat['ID']."'>" .$cat['Name']."</option>";
                                    }
                                ?>
                              

                            </select>
                        </div>
                    </div>
                    <!--end categories Field-->
                <!-- start Avater field-->
                <div class="form-group">
                    <label class="col-sm-2 control-label" >Car-Image</label>
                    <div class="col-sm-7 ">
                    <label class="custom-file-label upload-image  " for="customFile">Choose Image</label>
                    <input type="file" class="form-control" id="customFile" name="avater">
                    </div>   
                </div>
            <!--end Avater Field-->


                    
                    <!-- start submit field-->
                        <div class="form-group">
                        <div class=" col-sm-offset-2 col-sm-7">
                            <input type="submit" value="Add car" class="btn btn-primary">
                        </div>
                    </div>
                    <!--end submit Field-->
                    </form>
                    
                </div>
        
            <?php


            }elseif ($do=='Insert'){

                if($_SERVER['REQUEST_METHOD']=='POST'){

                    echo "<h1 class='text-center mem'>Insert Item</h>"."<br>";
                    echo "<div class='container'>";
                     //upload variables
                     $avaterName=$_FILES['avater']['name'];
                     $avaterSize=$_FILES['avater']['size'];
                     $avaterTmp=$_FILES['avater']['tmp_name'];
                     $avaterType=$_FILES['avater']['type'];
                     //list of allowed file typed to upload
                     $avaterAllowedExtention = array("jpg","png","jpeg","gif");
                        //get variable from the form
                       
                        $name       = $_POST['name'];
                        $desc       =$_POST['description'];
                        $price      = $_POST['price'];
                        $country    = $_POST['country'];
                        $color     = $_POST['color'];
                        $status     = $_POST['status'];
                        $brand     = $_POST['brand'];
                        $member     = $_POST['member'];
                        $cat        = $_POST['category'];
                        
                        
                    //validate the form 
                     $formErrors=array();
                     if(empty($name)){
                         $formErrors[]='<div class="alert alert-danger">Name Can\'t Be <strong>Empty</strong></div>';
                     }
                     if(empty($desc)){
                        $formErrors[]='<div class="alert alert-danger">Description Can\'t Be <strong>Empty</strong></div>';
                    }
                    if(empty($price)){
                        $formErrors[]='<div class="alert alert-danger">Price Can\'t Be <strong>Empty</strong></div>';
                    }
                    if(empty($country)){
                        $formErrors[]='<div class="alert alert-danger">Country Can\'t Be <strong>Empty</strong></div>';
                    }
                    if($status === "0"){
                        $formErrors[]='<div class="alert alert-danger">You Must Choose The <strong>Status</strong></div>';

                    }
                    if($color === "0"){
                        $formErrors[]='<div class="alert alert-danger">You Must Choose The <strong>Color</strong></div>';

                    }
                    if($brand === "0"){
                        $formErrors[]='<div class="alert alert-danger">You Must Choose The <strong>Brand</strong></div>';

                    }
                    if($member === "0"){
                        $formErrors[]='<div class="alert alert-danger">You Must Choose The <strong>Member</strong></div>';

                    }
                    if($cat === "0"){
                        $formErrors[]='<div class="alert alert-danger">You Must Choose The <strong>Category</strong></div>';

                    }if(empty($avaterName)){
                        $formErrors[]='<div class="alert alert-danger">Image Is Required</div>';
    
                    }
                    foreach($formErrors as $error){
                        echo $error.'<br>';
                    }
                    //check if there's no error  //statment
                    if (empty($formErrors)){
                        
                        $avater = rand(0,100000000).'_'.$avaterName;
                        move_uploaded_file($avaterTmp,"uploads\avater\\".$avater);
                        ///////////
                        //insert userInfo In Database
                        $stmt =$con->prepare("INSERT INTO 
                        items (Name ,Description,Price,Country_Made,Status,Color,Brand,Add_Data,Cat_ID,Member_ID,avater)
                        VALUES (:zname,:zdesc,:zprice,:zcountry,:zstatus ,:zcolor,:zbrand,now(),:zcat,:zmember,:zavater)");
                        $stmt->execute(array(
                           'zname'=>$name,
                           'zdesc'=>$desc,
                           'zprice'=>$price,
                           'zcountry'=>$country,
                           'zstatus'=>$status,
                           'zcolor'=>$color,
                           'zbrand'=>$brand,
                           'zcat'  => $cat,
                           'zmember'=>$member,
                           'zavater' => $avater
                           
                    
                       ));
                     $count=$stmt->rowCount(); //count 
                        //echo success message
                     
                        $theMsg= "<div class='alert alert-success'>".$stmt->rowCount().'Record Insert</div>';
                        redirectHome( $theMsg,'back',3);
                    }
                    
    
                   
                    
    
                 }else{
    
                     echo '<div class="container">';
                     $theMsg= '<div class="mem text-center alert-danger">Sorry You Cant Browse This Page Directly</div>';
                     redirectHome( $theMsg);
                     echo '</div>';
                 }
    
                 echo "</div>";


            }elseif ($do=='Edit'){
                            //if(isset($_GET['userID']) && is_numeric($_GET['userID'])){       //لو فيه رجويست جيه ف الرابط يوزر اي دي وهل كان رقم 
                    //echo intval($_GET['userID'] ) ;                      //integer value
           // }else{
             //   echo 0; 
           // }
                   //دي اختصار للاف اللي فوق بحيث؟ تعني الصح وال: تعني الالس
                   $itemid = isset($_GET['itemid']) && is_numeric($_GET['itemid']) ? intval($_GET['itemid']) : 0;
                   //استعلام:statment
                    $stmt=$con->prepare("SELECT * FROM  items WHERE Item_ID =? ");

                    $stmt ->execute(array($itemid));

                    $item=$stmt->fetch(); //fetch data 

                    $count=$stmt->rowCount(); //count 
        if($count >0){ ?>

                    <h1 class="text-center mem" > Edit Item </h1>
                <div class="container edit">

                    <form class="form-horizontal" action="?do=Update" method="POST" >

                    <input type="hidden" name="itemid"  value="<?php echo $itemid ?>">
   
                    <!-- start Name field-->
                    <div class="form-group">
                        <label class="col-sm-2 control-label" >Name</label>
                        <div class=" col-sm-7">
                            <input type="text" name="name" class="form-control" required="required"   placeholder="Name of Item" value="<?php echo $item['Name']?>">
                        </div>
                    </div>
                    <!--end Name Field-->
                     <!-- start Description field-->
                     <div class="form-group">
                        <label class="col-sm-2 control-label" >Description</label>
                        <div class=" col-sm-7">
                            <input type="text" name="description" class="form-control"  required="required"  placeholder="Description of Item"value="<?php echo $item['Description']?>">
                        </div>
                    </div>
                    <!--end Description Field-->
                    <!-- start Price field-->
                        <div class="form-group">
                        <label class="col-sm-2 control-label" >Price</label>
                        <div class=" col-sm-7">
                            <input type="text" name="price" class="form-control" required="required"  placeholder="Price of Item" value="<?php echo $item['Price']?>">
                        </div>
                    </div>
                    <!--end Price Field-->
                    <!-- start Country field-->
                    <div class="form-group">
                        <label class="col-sm-2 control-label" >Country</label>
                        <div class=" col-sm-7">
                            <input type="text" name="country" class="form-control" required="required"  placeholder="Country Of Made" value="<?php echo $item['Country_Made']?>">
                        </div>
                    </div>
                    <!--end Country Field-->
                    <!-- start color field-->
                    <div class="form-group">
                        <label class="col-sm-2 control-label" >Color</label>
                        <div class=" col-sm-7">
                            <select  name='color'>
                                
                                <option value="red" <?php if ($item['Color']=="red"){echo 'selected';}?>>Red</option>
                                <option value="blue" <?php if ($item['Color']=="blue"){echo 'selected';}?>>Blue</option>
                                <option value="white" <?php if ($item['Color']=="white"){echo 'selected';}?>>White</option>
                                <option value="green" <?php if ($item['Color']=="green"){echo 'selected';}?>>Green</option>
                                <option value="gray" <?php if ($item['Color']=="gray"){echo 'selected';}?>>Gray</option>
                                <option value="silver" <?php if ($item['Color']=="silver"){echo 'selected';}?>> Silver</option>
                                <option value="gold" <?php if ($item['Color']=="gold"){echo 'selected';}?>>Gold</option>
                                <option value="black" <?php if ($item['Color']=="black"){echo 'selected';}?>>Black</option>
                                <option value="orange" <?php if ($item['Color']=="orange"){echo 'selected';}?>>Orange</option>
                                

                            </select>
                        </div>
                    </div>
                    <!--end color Field-->
                    <!-- start Status field-->
                    <div class="form-group">
                        <label class="col-sm-2 control-label" >Status</label>
                        <div class=" col-sm-7">
                            <select  name='status'>
                                
                                <option value="1" <?php if ($item['Status']=="1"){echo 'selected';}?>>New</option>
                                <option value="2" <?php if ($item['Status']=="2"){echo 'selected';}?>>Like New</option>
                                <option value="3" <?php if ($item['Status']=="3"){echo 'selected';}?>>Used</option>
                                <option value="4" <?php if ($item['Status']=="4"){echo 'selected';}?>>Old</option>

                            </select>
                        </div>
                    </div>
                    <!--end Status Field-->
                    <!-- start brand field-->
                    <div class="form-group">
                        <label class="col-sm-2 control-label" >Brand</label>
                        <div class=" col-sm-7">
                            <select  name='brand'>
                                
                                <option value="bmw" <?php if ($item['Brand']=="bmw"){echo 'selected';}?>>Bmw</option>
                                <option value="toyota" <?php if ($item['Brand']=="toyota"){echo 'selected';}?>>Toyota</option>
                                <option value="nissan" <?php if ($item['Brand']=="nissan"){echo 'selected';}?>>Nissan</option>
                                <option value="ford" <?php if ($item['Brand']=="ford"){echo 'selected';}?>>Ford</option>
                                <option value="mercedes" <?php if ($item['Brand']=="mercedes"){echo 'selected';}?>>Mercedes</option>
                                <option value="mazada" <?php if ($item['Brand']=="mazada"){echo 'selected';}?>>Mazada</option>
                            </select>
                        </div>
                    </div>
                    <!--end brand Field-->
                    <!-- start Members field-->
                    <div class="form-group">
                        <label class="col-sm-2 control-label" >Member</label>
                        <div class=" col-sm-7">
                            <select  name='member'>
                        
                                <?php
                                    $stmt = $con->prepare("SELECT* FROM users");
                                    $stmt->execute();
                                    $users=$stmt->fetchAll();
                                    foreach ($users as $user){
                                        echo "<option value='".$user['userID']."'";
                                         if ($item['Member_ID']==$user['userID']) {echo 'selected';} 
                                         echo">" .$user['username']."</option>";
                                    }
                                ?>
                              

                            </select>
                        </div>
                    </div>
                    <!--end Members Field-->
                    <!-- start categories field-->
                        <div class="form-group">
                        <label class="col-sm-2 control-label" >Category</label>
                        <div class=" col-sm-7">
                            <select  name='category'>

                                <?php
                                    $stmt2= $con->prepare("SELECT* FROM categories");
                                    $stmt2->execute();
                                    $cats=$stmt2->fetchAll();
                                    foreach ($cats as $cat){

                                        echo "<option value='".$cat['ID']."'";
                                        if ($item['Cat_ID']==$cat['ID']) {echo 'selected';} 
                                        echo ">" .$cat['Name']."</option>";
                                    }
                                ?>
                              

                            </select>
                        </div>
                    </div>
                    <!--end categories Field-->
                    


                    
                    <!-- start submit field-->
                        <div class="form-group">
                        <div class=" col-sm-offset-2 col-sm-7">
                            <input type="submit" value="Save" class="btn btn-primary">
                        </div>
                    </div>
                    <!--end submit Field-->
                    </form>
                    </div>
                    <?php 
                    $stmt=$con->prepare("SELECT 
                                            comments.*,users.username AS Member
                                        FROM
                                             comments 
                                        
                                        INNER JOIN 
                                            users
                                        ON
                                            users.UserID = comments.user_id
                                        WHERE item_id = ?");


                //Execute The State
            $stmt->execute(array($itemid));
            //Assign To Variable
            $rows=$stmt->fetchAll(); 
            
                if(! empty ($rows)){

                
             
        ?> 
    <div class='container'>

        <h1 class="text-center mem" > Manage ( <?php echo $item['Name']?> ) Comments</h1>
            <div class ="table-responsive">
            <table class="main-table table table-bordered text-center ">
                <tr>
                    <td>Comment</td>
                    <td>User Name</td>
                    <td>Added Date</td>
                    <td>Control</td>
                </tr>
                <?php
                    foreach($rows as $row){
                        echo"<tr>";
                            
                            echo"<td>".$row['comment']."</td>";
                            echo"<td>".$row['Member']."</td>";
                            echo"<td>".$row['comment_date']."</td>";
                            echo"<td>
                                <a href='comments.php?do=Edit&comid=".$row['c_id']."' class='btn btn-success btn-edit-delete-active'><i class='fa fa-edit'></i> Edit</a>
                                <a href='comments.php?do=Delete&comid=".$row['c_id']."' class='btn btn-danger confirm btn-edit-delete-active'><i class='fa fa-close'></i> Delete</a>";
                                 if ($row['status']==0){

                                     echo "<a href='comments.php?do=Approve&comid=".$row['c_id']."' class='btn btn-info confirm activate btn-edit-delete-active'><i class='fa fa-magic'></i> Approve</a>";

                                 }
                                echo "</td>";
                            echo"</tr>";
                    }
                ?>
            

            </table>
        </div>          
    </div>
    
                <?php }else{

            echo '<div class="container">';
            echo '<div class="nice-message">There\'s No Comments To Show</div> ';
            echo '</div>'; 

            }?>
                    
                </div>
        

        
        <?php }else{
            echo '<div class="container">';
            $theMsg='<div class="alert alert-danger">theres No Such ID</div>';
            redirectHome($theMsg,'back');
            echo'</div>';
        
            }
   
                

            }elseif ($do=='Update'){
            
                echo "<h1 class='text-center mem'>Update Edit</h>"."<br>";
             echo "<div class='container'>";
             if($_SERVER['REQUEST_METHOD']=='POST'){
                    //get variable from the form
                    $id   = $_POST['itemid'];
                    $name = $_POST['name'];
                    $desc= $_POST['description'];
                    $price = $_POST['price'];
                    $country = $_POST['country'];
                    $color = $_POST['color'];
                    $status = $_POST['status'];
                    $brand = $_POST['brand'];
                    $member = $_POST['member'];
                    $cat = $_POST['category'];
                
     
                 $formErrors=array();
                    //validate the form 
                    $formErrors=array();
                    if(empty($name)){
                        $formErrors[]='<div class="alert alert-danger">Name Can\'t Be <strong>Empty</strong></div>';
                    }
                    if(empty($desc)){
                        $formErrors[]='<div class="alert alert-danger">Description Can\'t Be <strong>Empty</strong></div>';
                    }
                    if(empty($price)){
                        $formErrors[]='<div class="alert alert-danger">Price Can\'t Be <strong>Empty</strong></div>';
                    }
                    if(empty($country)){
                        $formErrors[]='<div class="alert alert-danger">Country Can\'t Be <strong>Empty</strong></div>';
                    }
                    if($color === "0"){
                        $formErrors[]='<div class="alert alert-danger">You Must Choose The <strong>Color</strong></div>';

                    }
                    if($status === "0"){
                        $formErrors[]='<div class="alert alert-danger">You Must Choose The <strong>Status</strong></div>';

                    }
                    if($brand === "0"){
                        $formErrors[]='<div class="alert alert-danger">You Must Choose The <strong>Brand</strong></div>';

                    }
                    if($member === "0"){
                        $formErrors[]='<div class="alert alert-danger">You Must Choose The <strong>Member</strong></div>';

                    }
                    if($cat === "0"){
                        $formErrors[]='<div class="alert alert-danger">You Must Choose The <strong>Category</strong></div>';

                    }
                    foreach($formErrors as $error){
                        echo $error.'<br>';
                    }



        if (empty($formErrors)){
                              
                    $stmt=$con -> prepare("UPDATE items SET     Name=?,Description=?,Price=?,Country_Made=? , Status=?,Color=?,Brand=?, Cat_ID=?,Member_ID=? WHERE Item_ID =?");

                    $stmt->execute(array($name,$desc,$price,$country,$status,$color,$brand,$cat,$member,$id));

                    //echo success message
                   $theMsg=  "<div class='alert alert-success'>" . $stmt->rowCount().'Record Updated</div>';
                    redirectHome($theMsg,'back');
                
            
                //update the data with info
                }

             }else{
                $theMsg= "<div class alert alert-danger>Sorry You Cant Browse This Page Directly</div>";
                redirectHome($theMsg);
                }


             echo "</div>";

            }elseif($do=='Delete'){
                echo "<h1 class='text-center mem'>Delete Item</h>"."<br>";
                echo "<div class='container'>";
                $itemid=isset($_GET['itemid']) && is_numeric($_GET['itemid']) ? intval($_GET['itemid'] ) : 0;
                //استعلام:statment
                $stmt=$con->prepare("SELECT * FROM  items WHERE Item_ID =?  LIMIT  1");
                $stmt ->execute(array($itemid));
                $count=$stmt->rowCount(); //count 
                if($stmt->rowCount()>0){ 
                    $stmt=$con->prepare("DELETE FROM items WHERE Item_ID=:zuser");
                    $stmt->bindparam(":zuser",$itemid); //bind parameter بتربط بين القيمه اللي ف الريجويست واللي موجوده ف الداتا
                    $stmt->execute();
                    $theMsg = "<div class='alert alert-success mem text-center'>".$stmt->rowCount().'Record Delete</div>';
                    redirectHome($theMsg);
                }else{
                    $theMsg ="<div class='alert alert-danger mem  text-center'>This ID is Not Exist</div>";
                    redirectHome($theMsg);
                }
                echo"</div>";
    


            }elseif ($do=='Approve'){
                echo "<h1 class='text-center mem'>Approve Item</h>"."<br>";
                echo "<div class='container'>";
                $itemid=isset($_GET['itemid']) && is_numeric($_GET['itemid']) ? intval($_GET['itemid'] ) : 0;
                //استعلام:statment
                $stmt=$con->prepare("SELECT * FROM  items WHERE Item_ID =?  LIMIT  1");
                $stmt ->execute(array($itemid));
                $count=$stmt->rowCount(); //count 
                if($stmt->rowCount()>0){ 
                    $stmt=$con->prepare("UPDATE  items SET Approve=1 WHERE Item_ID=? ");
                    $stmt->execute(array($itemid));
                    $theMsg = "<div class='alert alert-success mem text-center'>".$stmt->rowCount().'Record Updated</div>';
                    redirectHome($theMsg,'back');
                }else{
                    $theMsg ="<div class='alert alert-danger mem  text-center'>This ID is Not Exist</div>";
                    redirectHome($theMsg);
                }
                echo"</div>";


            }


        
            include "includes/tempalets/footer.php";
        }else{
            header('location:index.php');
            exit();
        }