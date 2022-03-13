<?php 

        //cars page

        ob_start();
        session_start();
        $pageTitle = 'Cars';
        if (isset($_SESSION['user'])){

            include "init1.php"; 

        $do = '';

        if(isset($_GET['do'])){
            $do = $_GET['do'];
        } else {
            $do = 'Manage';
        }
        if($do == 'Manage'){
        
        $stmt = $con->prepare("SELECT cars.*, categories.Name AS cat_name, users.username  FROM cars
        INNER JOIN categories ON categories.ID = cars.cat_ID
        INNER JOIN users ON users.userID = cars.user_ID ORDER BY car_ID DESC");
        $stmt->execute(array());
        $cars = $stmt->fetchAll();

        if(!empty($cars)){

        ?>
        <h1 class="text-center">Manage Cars</h1>
        <div class="container">
            <div class="table-responsive">
                <table class="main-table manage text-center table table-bordered">
                    <tr>
                        <td>#ID</td>
                        <td>Image</td>
                        <td>Make</td>
                        <td>Model</td>
                        <td>Color</td>
                        <td>Price</td>
                        <td>First registration</td>
                        <td>Add_Date</td>
                        <td>Category</td>
                        <td>Username</td>
                        <td>Control</td>

                    </tr>
                    <?php  
                        foreach($cars as $car){
                            echo "<tr>";
                                echo "<td>" . $car['car_ID'] . "</td>";
                                echo "<td>";
                                if(empty($car['Image'])){
                                    echo "no img";
                                }else{
                                    echo "<img src='uploads/images/" . $car['Image'] . "' alt=''/>";
                                }
                                echo "</td>";
                                echo "<td>" . $car['Make'] . "</td>";
                                echo "<td>" . $car['Model'] . "</td>";
                                echo "<td>" . $car['Color'] . "</td>";
                                echo "<td>" . $car['Price'] . "</td>";
                                echo "<td>" . $car['First registration'] . "</td>";
                                echo "<td>" . $car['Add_Date'] . "</td>";
                                echo "<td>" . $car['cat_name'] . "</td>";
                                echo "<td>" . $car['username'] . "</td>";
                                echo "<td>
                                        <a href='cars.php?do=Edit&carid=" . $car['car_ID'] ." ' class='btn btn-success'><i class='fa fa-edit'></i>Edit</a>
                                        <a href='cars.php?do=Delete&carid=" . $car['car_ID'] ." ' class='btn btn-danger confirm'><i class='fa fa-close'></i>Delete</a>";
                                        if ($car['Approve'] == 0){
                                            echo "<a href='cars.php?do=Approve&carid=" . $car['car_ID'] ." ' class='btn btn-info activate'><i class='fa fa-check'></i>Approve</a>";
                                        }
                                        

                                echo "</td>";

                            echo "</tr>";
                        }




                    ?>
                    
                </table>
            </div>
            <a href="cars.php?do=Add" class="btn btn-sm btn-primary"><i class="fa fa-plus"></i>New Car</a>
        </div>
        <?php } else{
            echo '<div class="container">';
                echo '<div class="nice-message"> there is no cars to show</div>';
                echo '<a href="cars.php?do=Add" class="btn btn-sm btn-primary"><i class="fa fa-plus"></i>New Car</a>';

            echo '</div>';

        }?>

    <?php
        
            /*********************************************************************************************************************/
        }elseif($do == 'Add'){ ?>
            <h1 class="text-center">Add Car</h1>
            <div class="container">
                <form class="form-horizontal" action="?do=Insert" method="POST" enctype="multipart/form-data">
                 
                    <!--start make field -->
                    <div class="form-group form-group-lg">
                        <label class="col-sm-2 control-label">Make</label>
                        <div class="col-sm-10 col-md-6">
                            <input type="text" name="make" class="form-control" required="required" placeholder=" Make of the Car"/>
                        </div>
                    </div>
                    <!--end make field -->
                
                    <!--start model field -->
                    <div class="form-group form-group-lg">
                        <label class="col-sm-2 control-label">Model</label>
                        <div class="col-sm-10 col-md-6">
                            <input type="text" name="model" class="form-control" required="required" placeholder=" Model of the Car"/>
                        </div>
                    </div>
                    <!--end model field -->
                    <!--start price field -->
                    <div class="form-group form-group-lg">
                        <label class="col-sm-2 control-label">Price</label>
                        <div class="col-sm-10 col-md-6">
                            <input type="text" name="price" class="form-control" required="required"  placeholder=" Price of the Car"/>
                        </div>
                    </div>
                    <!--end price field -->
                   
                     <!--start first-registration field -->
                    <div class="form-group form-group-lg">
                        <label class="col-sm-2 control-label">First registration</label>
                        <div class="col-sm-10 col-md-6">
                            <input type="text" name="first" class="form-control" required="required" placeholder=" Date of First registration"/>
                        </div>
                    </div>
                    <!--end first-registration field -->
                    <!--start status field -->
                    <div class="form-group form-group-lg">
                        <label class="col-sm-2 control-label">Status</label>
                        <div class="col-sm-10 col-md-6">
                            <select name="status">
                                <option value="0">...</option>
                                <option value="1">New Vehicle</option>
                                <option value="2">Used vehicle</option>

                            </select>
                        </div>
                    </div>
                    <!--end status field -->
                    <!--start fuel field -->
                    <div class="form-group form-group-lg">
                        <label class="col-sm-2 control-label">Fuel</label>
                        <div class="col-sm-10 col-md-6">
                            <select name="fuel">
                                <option value="0">...</option>
                                <option value="1">Diesel</option>
                                <option value="2">Electric</option>
                                <option value="3">Gas</option>
                                <option value="4">Petrol</option>
                            </select>
                        </div>
                    </div>
                    <!--end fuel field -->
                    <!--start Gearbox field -->
                    <div class="form-group form-group-lg">
                        <label class="col-sm-2 control-label">Gearbox</label>
                        <div class="col-sm-10 col-md-6">
                            <select name="gearbox">
                                <option value="0">...</option>
                                <option value="1">Automatic</option>
                                <option value="2">Manual</option>
                                <option value="3">Semi-Automatic</option>
                            </select>
                        </div>
                    </div>
                    <!--end Gearbox: field -->
                
                     <!--start color field -->
                     <div class="form-group form-group-lg">
                        <label class="col-sm-2 control-label">Color</label>
                        <div class="col-sm-10 col-md-6">
                            <select name="color">
                                <option value="0">...</option>
                                <option value="1">Black</option>
                                <option value="2">Blue</option>
                                <option value="3">Red</option>
                                <option value="4">White</option>
                                <option value="5">Silver</option>
                                <option value="6">Grey</option>
                            </select>
                        </div>
                    </div>
                    <!--end color field -->
                    
                    <!--start users field -->
                    <div class="form-group form-group-lg">
                        <label class="col-sm-2 control-label">User</label>
                        <div class="col-sm-10 col-md-6">
                            <select name="user">
                                <option value="0">...</option>
                                <?php
                                    $allUsers = getAllFrom("*", "users", "","", "userID");
                                    
                                    foreach($allUsers as $user){
                                        echo "<option value='" . $user['userID'] . "'>" . $user['username'] . "</option>";

                                    }
                                ?>
                            </select>
                        </div>
                    </div>
                    <!--end users field -->
                    <!--start categories field -->
                    <div class="form-group form-group-lg">
                        <label class="col-sm-2 control-label">Catgory</label>
                        <div class="col-sm-10 col-md-6">
                            <select name="category">
                                <option value="0">...</option>
                                <?php
                                    $allCats = getAllFrom("*", "categories", "where parent = 0","", "ID","ASC");
                                    foreach($allCats as $cat){
                                        echo "<option value='" . $cat['ID'] . "'>" . $cat['Name'] . "</option>";

                                        $childCats = getAllFrom("*", "categories", "where parent = {$cat['ID']}","", "ID");
                                        foreach($childCats as $child){
                                            echo "<option value='" . $child['ID'] . "'>--- " . $child['Name'] . "</option>";
                                        }

                                    }
                                ?>
                            </select>
                        </div>
                    </div>
                    <!--end categories field -->
                    <!--start tags field -->
                    <div class="form-group form-group-lg">
                        <label class="col-sm-2 control-label">Tags</label>
                        <div class="col-sm-10 col-md-6">
                            <input type="text" name="tags" class="form-control" placeholder=" type tags"/>
                        </div>
                    </div>
                    <!--end tags field -->
                     <!--start avatar field -->
                                
                     <div class="form-group form-group-lg">
                        <label class="col-sm-3 control-label">Images</label>
                        
                        <div style="margin-top:10px;margin-bottom:10px" class="col-sm-10 col-md-9">
                                    
                            <input style="display:none"type="file" id="file"name="car_images[]" multiple="multiple" value="add"placeholder="Add only 3 images for your car"/>
                            <label for="file" style="background-color:#95a5a6;padding:10px; width:550px">
                            <i class="fa fa-image fa-lg"></i>
                            choose 3 images</label>                                 
                        </div>
                    </div>
                    <!--end avatar field -->
                  
                   
    
                    <!--start submit field -->
                    <div class="form-group form-group-lg">
                        <div class="col-sm-offset-2 col-sm-10 ">
                            <input type="submit" value="Add Car" class="btn btn-primary btn-sm" />
                        </div>
                    </div>
                    <!--end submit field -->
                    
                </form>  
            </div>


        <?php
/*********************************************************************************************************************/
        }elseif($do == 'Insert'){
            if ($_SERVER['REQUEST_METHOD'] == 'POST'){
                echo "<h1 class='text-center'>Insert Car </h1>";
                echo '<div class="container">';

                        //upload variable
        
                //upload variable //img
        
                $imgName = $_FILES['img']['name'];
                $imgSize = $_FILES['img']['size'];
                $imgTmp = $_FILES['img']['tmp_name'];
                $imgType = $_FILES['img']['type'];

                $imgAllowedExtension = array("jpeg", "jpg", "png", "gif");//list of allowed file types to upload

                //get avatar extension
                $imgExtension1 = explode('.',$imgName);
                $imgExtension2 = strtolower(end($imgExtension1));;


                //upload variable //img1
        
                $imgName = $_FILES['img1']['name'];
                $imgSize = $_FILES['img1']['size'];
                $imgTmp = $_FILES['img1']['tmp_name'];
                $imgType = $_FILES['img1']['type'];

                $imgAllowedExtension = array("jpeg", "jpg", "png", "gif");//list of allowed file types to upload

                //get avatar extension
                $imgExtension1 = explode('.',$imgName);
                $imgExtension2 = strtolower(end($imgExtension1));;


                //upload variable //img2
        
                $imgName = $_FILES['img2']['name'];
                $imgSize = $_FILES['img2']['size'];
                $imgTmp = $_FILES['img2']['tmp_name'];
                $imgType = $_FILES['img2']['type'];

                $imgAllowedExtension = array("jpeg", "jpg", "png", "gif");//list of allowed file types to upload

                //get avatar extension
                $imgExtension1 = explode('.',$imgName);
                $imgExtension2 = strtolower(end($imgExtension1));;



                    //get variable from the form
                    $make = $_POST['make'];
                    $model = $_POST['model'];
                    $price = $_POST['price'];//بجيبهم من الname بتاع الانبوتس اللى ف الفورم
                    $first = $_POST['first'];
                    $status = $_POST['status'];
                    $fuel = $_POST['fuel'];
                    $gearbox = $_POST['gearbox'];
                    $color = $_POST['color'];
                    $category = $_POST['category'];
                    $users = $_POST['user'];
                    $tags = $_POST['tags'];
            
                    //validate the form
                    $formErrors = array();
        
                    if (empty($make)){
                        $formErrors[] = 'Make can not be <strong> empty </strong> ';  
                    }
                    if (empty($model)){
                        $formErrors[] = 'Model can not be <strong> empty </strong> ';  
                    }
                    
                    if (empty($price)){
                        $formErrors[] = 'price can not be <strong> empty </strong> ';
                    }
                    if (empty($first)){
                        $formErrors[] = 'First registration can not be <strong> empty </strong>';
                    }
                    if ($status == 0){
                        $formErrors[] = 'You must choose the <strong> Status </strong> ';
                    }
                    if ($fuel == 0){
                        $formErrors[] = 'You must choose the <strong> Fuel </strong> ';
                    }
                    if ($gearbox == 0){
                        $formErrors[] = 'You must choose the <strong> Gearbox </strong> ';
                    }
                    if ($color == 0){
                        $formErrors[] = 'You must choose the <strong> Color </strong> ';
                    }
                    if ($category == 0){
                        $formErrors[] = 'You must choose the <strong> Category </strong> ';
                    }
                    if (! empty($imgName) && ! in_array($imgExtension2, $imgAllowedExtension)){
                        $formErrors[] = 'this extension is not <strong> allowed </strong> ';
                    }
                    if (empty($imgName)){
                        $formErrors[] = 'avatar is <strong> required </strong> ';
                    }
                    if ($imgSize > 4194304){
                        $formErrors[] = 'avatar can not be larger than <strong> 4MB </strong> ';
                    }
                    
                    foreach($formErrors as $error){
                        echo '<div class="alert alert-danger">' . $error . '</div>';
                    }
                    //check if there is no error proceed the insert process
                    if (empty($formErrors)){

                        $img = rand(0, 1000000) . '-' . $imgName;
                        $img1 = rand(0, 1000000) . '-' . $imgName;
                        $img2 = rand(0, 1000000) . '-' . $imgName;
                        move_uploaded_file($imgTmp, "uploads/images//" . $img);
                        move_uploaded_file($imgTmp, "uploads/images//" . $img1);
                        move_uploaded_file($imgTmp, "uploads/images//" . $img2);

                        $stmt = $con->prepare("INSERT INTO cars(Make, Model, Color, Price, `Status`, Fuel, Gearbox, `First registration`, cat_ID, `user_ID`, tags, `Image`, Image1, Image2, Add_Date) VALUES( :zmake, :zmodel, :zcolor, :zprice, :zstatus, :zfuel, :zgearbox, :zfirst, :zcategory, :zuser, :ztags, :zImage, :zImage1, :zImage2, now() )");

                        $stmt->execute(array(
                            
                            'zmake' => $make,
                            'zmodel' => $model,
                            'zcolor' => $color,
                            'zprice' => $price,
                            'zstatus' => $status,
                            'zfuel' => $fuel,
                            'zgearbox' => $gearbox,
                            'zfirst' => $first,
                            'zcategory' => $category,
                            'zuser' => $users,
                            'ztags' => $tags,
                            'zImage' => $img,
                            'zImage1' => $img1,
                            'zImage2' => $img2,
                            
                        ));
                        /*
                        $stmt = $con->prepare("INSERT INTO makes(make_name) VALUES( :zmake)");
                        $stmt->execute(array(
                            'zmake' => $make,
                        ));
                        $stmt = $con->prepare("INSERT INTO models(model_name) VALUES( :zmodel)");
                        $stmt->execute(array(
                            'zmodel' => $model,
                        ));
                        $stmt = $con->prepare("INSERT INTO colors(color_name) VALUES( :zcolor)");
                        $stmt->execute(array(
                            'zcolor' => $color,
                        ));
                        */
                        //echo success message
                        echo "<div class='container'>";
                            $theMsg = "<div class='alert alert-success'>" . $stmt->rowCount() . " record inserted </div>";
                            redirectHome($theMsg, 'back');
                        echo "</div>";
                        
                    }
        
        
        
                } else {
                    echo "<div class='container'>";
                        $theMsg = '<div class="alert alert-danger"> Sorry you can not browse this page directly </div>';
                        redirectHome($theMsg);
                    echo "</div>";
                }
            echo '</div>';
/*********************************************************************************************************************/
        }elseif($do == 'Edit'){
            $carid = isset($_GET['carid']) && is_numeric($_GET['carid']) ? intval($_GET['carid']) : 0;//لازم الايدى يكون رقم مينفعش يكون حروف لو رقم اطبعهولى ولو اى حاجة غير رقم اطبعى 0
            
            $stmt = $con->prepare("SELECT * FROM cars WHERE car_ID = ?");
            $stmt->execute(array($carid));
            $car = $stmt->fetch();
            $count = $stmt->rowCount();//موجود ف كام صف

            if($count > 0){  ?>
                <h1 class="text-center">Edit Car</h1>
            <div class="container">
                <form class="form-horizontal" action="?do=Update" method="POST" enctype="multipart/form-data">
                <input type="hidden" name="carid" value="<?php echo $carid ; ?>" />
                 
                    <!--start make field -->
                    <div class="form-group form-group-lg">
                        <label class="col-sm-2 control-label">Make</label>
                        <div class="col-sm-10 col-md-6">
                            <input type="text" name="make" class="form-control" required="required" placeholder=" Make of the Car" value="<?php echo $car['Make']  ?>"/>
                        </div>
                    </div>
                    <!--end make field -->
                
                    <!--start model field -->
                    <div class="form-group form-group-lg">
                        <label class="col-sm-2 control-label">Model</label>
                        <div class="col-sm-10 col-md-6">
                            <input type="text" name="model" class="form-control" required="required" placeholder=" Model of the Car" value="<?php echo $car['Model']  ?>"/>
                        </div>
                    </div>
                    <!--end model field -->
                    <!--start price field -->
                    <div class="form-group form-group-lg">
                        <label class="col-sm-2 control-label">Price</label>
                        <div class="col-sm-10 col-md-6">
                            <input type="text" name="price" class="form-control" required="required"  placeholder=" Price of the Car" value="<?php echo $car['Price']  ?>"/>
                        </div>
                    </div>
                    <!--end price field -->
                   
                      <!--start first-registration field -->
                      <div class="form-group form-group-lg">
                        <label class="col-sm-2 control-label">First registration</label>
                        <div class="col-sm-10 col-md-6">
                            <input type="text" name="first" class="form-control" required="required" placeholder=" Date of First registration" value="<?php echo $car['First registration']  ?>"/>
                        </div>
                    </div>
                    <!--end first-registration field -->
                    <!--start status field -->
                    <div class="form-group form-group-lg">
                        <label class="col-sm-2 control-label">Status</label>
                        <div class="col-sm-10 col-md-6">
                            <select name="status">
                                
                                <option value="1" <?php if($car['Status'] == 1){echo 'selected';}    ?> >New Vehicle</option>
                                <option value="2"<?php if($car['Status'] == 2){echo 'selected';}    ?> >Used vehicle</option>

                            </select>
                        </div>
                    </div>
                    <!--end status field -->
                    <!--start fuel field -->
                    <div class="form-group form-group-lg">
                        <label class="col-sm-2 control-label">Fuel</label>
                        <div class="col-sm-10 col-md-6">
                            <select name="fuel">
                                
                                <option value="1" <?php if($car['Fuel'] == 1){echo 'selected';}    ?> >Diesel</option>
                                <option value="2" <?php if($car['Fuel'] == 2){echo 'selected';}    ?> >Electric</option>
                                <option value="3" <?php if($car['Fuel'] == 3){echo 'selected';}    ?> >Gas</option>
                                <option value="4" <?php if($car['Fuel'] == 4){echo 'selected';}    ?> >Petrol</option>
                            </select>
                        </div>
                    </div>
                    <!--end fuel field -->
                    <!--start Gearbox field -->
                    <div class="form-group form-group-lg">
                        <label class="col-sm-2 control-label">Gearbox</label>
                        <div class="col-sm-10 col-md-6">
                            <select name="gearbox">
                                
                                <option value="1" <?php if($car['Gearbox'] == 1){echo 'selected';}    ?> >Automatic</option>
                                <option value="2" <?php if($car['Gearbox'] == 2){echo 'selected';}    ?> >Manual</option>
                                <option value="3" <?php if($car['Gearbox'] == 3){echo 'selected';}    ?> >Semi-Automatic</option>
                            </select>
                        </div>
                    </div>
                    <!--end Gearbox: field -->
                
                     <!--start color field -->
                     <div class="form-group form-group-lg">
                        <label class="col-sm-2 control-label">Color</label>
                        <div class="col-sm-10 col-md-6">
                            <select name="color">
                                
                                <option value="1" <?php if($car['Color'] == 1){echo 'selected';}    ?>>Black</option>
                                <option value="2" <?php if($car['Color'] == 2){echo 'selected';}    ?>>Blue</option>
                                <option value="3" <?php if($car['Color'] == 3){echo 'selected';}    ?>>Red</option>
                                <option value="4" <?php if($car['Color'] == 4){echo 'selected';}    ?>>White</option>
                                <option value="5" <?php if($car['Color'] == 5){echo 'selected';}    ?>>Silver</option>
                                <option value="6" <?php if($car['Color'] == 6){echo 'selected';}    ?>>Grey</option>
                            </select>
                        </div>
                    </div>
                    <!--end color field -->
                    
                    <!--start users field -->
                    <div class="form-group form-group-lg">
                        <label class="col-sm-2 control-label">User</label>
                        <div class="col-sm-10 col-md-6">
                            <select name="user">
                                
                                <?php
                                    $stmt = $con->prepare("SELECT * FROM users");
                                    $stmt->execute();
                                    $users = $stmt->fetchAll();
                                    foreach($users as $user){
                                        echo "<option value='" . $user['userID'] . "'";
                                        if($car['user_ID'] == $user['userID']){echo 'selected';} 
                                        echo ">" . $user['username'] . "</option>";

                                    }
                                ?>
                            </select>
                        </div>
                    </div>
                    <!--end users field -->
                    <!--start categories field -->
                    <div class="form-group form-group-lg">
                        <label class="col-sm-2 control-label">Catgory</label>
                        <div class="col-sm-10 col-md-6">
                            <select name="category">
                                
                                <?php
                                    $stmt2 = $con->prepare("SELECT * FROM categories");
                                    $stmt2->execute();
                                    $cats = $stmt2->fetchAll();
                                    foreach($cats as $cat){
                                        echo "<option value='" . $cat['ID'] . "'"; 
                                        if($car['cat_ID'] == $cat['ID']){echo 'selected';} 
                                        echo ">" . $cat['Name'] . "</option>";

                                    }
                                ?>
                            </select>
                        </div>
                    </div>
                    <!--end categories field -->
                     <!--start tags field -->
                     <div class="form-group form-group-lg">
                        <label class="col-sm-2 control-label">Tags</label>
                        <div class="col-sm-10 col-md-6">
                            <input type="text" name="tags" class="form-control" placeholder=" type tags" value="<?php echo $car['tags']  ?>"/>
                        </div>
                    </div>
                    <!--end tags field -->
                    <!--start avatar field -->
                                
                    <div style="margin-right:32%;"class="form-group form-group-lg">
                        <label class="col-sm-3 control-label">Images</label>
                        
                        <div style="margin-top:10px;margin-bottom:10px" class="col-sm-10 col-md-9">
                                    
                            <input style="display:none"type="file" id="file"name="car_images[]" multiple="multiple" value="add"placeholder="Add only 3 images for your car"/>
                            <label for="file" style="background-color:#95a5a6;padding:10px; width:550px">
                            <i class="fa fa-image fa-lg"></i>
                            choose 3 images</label>                                 
                        </div>
                    </div>
                    <!--end avatar field -->
                
                  
                   
    
                    <!--start submit field -->
                    <div class="form-group form-group-lg">
                        <div class="col-sm-offset-2 col-sm-10 ">
                            <input type="submit" value="Save" class="btn btn-primary btn-sm" />
                        </div>
                    </div>
                    <!--end submit field -->
                    
                </form>  
            </div>

        

        <?php 
            }else{
                echo "<div class='container'>";
                    $theMsg = "<div class='alert alert-danger'> ther is no such id </div>";
                    redirectHome($theMsg);
                echo "</div>";
            }   

        /*********************************************************************************************************************/

        }elseif($do == 'Update'){
            echo "<h1 class='text-center'>Update Car </h1>";
        echo '<div class="container">';
        if ($_SERVER['REQUEST_METHOD'] == 'POST'){

          
    
            //setting db image name
            $all_images = array();
            //get info erom the form
            $uploaded_files = $_FILES['car_images'];
            $imgName = $uploaded_files['name'];
            $imgSize = $uploaded_files['size'];
            $imgTmp = $uploaded_files['tmp_name'];
            $imgType = $uploaded_files['type'];
            $imgError = $uploaded_files['error'];
            // echo $imgSize;
            $allowedExtension = array("jpeg", "jpg", "png", "gif");//list of allowed file types to upload


            //get variable from the form
            $id = $_POST['carid'];
            $make = $_POST['make'];
            $model = $_POST['model'];
            $color = $_POST['color'];//بجيبهم من الname بتاع الانبوتس اللى ف الفورم
            $price = $_POST['price'];
            $first = $_POST['first'];
            $status = $_POST['status'];
            $fuel = $_POST['fuel'];
            $gearbox = $_POST['gearbox'];
            $category = $_POST['category'];
            $users = $_POST['user'];
            $tags = $_POST['tags'];
            
            //validate the form
            $formErrors = array();
    
               
            if (empty($make)){
                $formErrors[] = 'Make can not be <strong> empty </strong> ';  
            }
            if (empty($model)){
                $formErrors[] = 'Model can not be <strong> empty </strong> ';  
            }
            
            if (empty($price)){
                $formErrors[] = 'price can not be <strong> empty </strong> ';
            }
            if (empty($first)){
                $formErrors[] = 'First registration can not be <strong> empty </strong>';
            }
            if ($status == 0){
                $formErrors[] = 'You must choose the <strong> Status </strong> ';
            }
            if ($fuel == 0){
                $formErrors[] = 'You must choose the <strong> Fuel </strong> ';
            }
            if ($gearbox == 0){
                $formErrors[] = 'You must choose the <strong> Gearbox </strong> ';
            }
            if ($color == 0){
                $formErrors[] = 'You must choose the <strong> Color </strong> ';
            }
            if ($category == 0){
                $formErrors[] = 'You must choose the <strong> Category </strong> ';
            }
            if ($users == 0){
                $formErrors[] = 'You must choose the <strong> User </strong> ';
            }
            //check user upload file or not
            if($imgError[0] == 4){
                $formErrors[] = 'no file uploaded> ';

            }else{
                $filesCount = count($imgName);
                //check file count
                if($filesCount != 3){
                    $formErrors[] = 'you must choose 3 images';
                }else{
                    for($i = 0; $i < $filesCount; $i++){
                        //getting errors array
                        $formErrors = array();

                        //get img extension
                        $imgExtension[$i] = explode('.',$imgName[$i]);
                        $imgExtension1[$i] = strtolower(end($imgExtension[$i]));
                        
                        
                        //check file size
                        if($imgSize[$i] > 100000){
                            $formErrors[] = 'file can not be more than x';
                        }
                        //check file extension
                        if(! in_array($imgExtension1[$i], $allowedExtension)){
                            $formErrors[] = 'file is not valid';
                        }

                        
                    }
                }
            }
            
            
                foreach($formErrors as $error){
                    echo '<div class="alert alert-danger">' . $error . '</div>';
                }
            //check if there is no error proceed the update process
            if (empty($formErrors)){

                for($i = 0; $i < $filesCount ; $i++){
                    //get random name for file 
                    $image_random[$i] = rand(0, 1000000) . $imgName[$i] . "." . $imgExtension1[$i];
                    move_uploaded_file($imgTmp[$i], "admin/uploads/images2//" . $image_random[$i] );
                    $all_images[] = $image_random[$i];
                    $img_field = implode(",", $all_images);
                    
                    
                }
                //update the db with this info Make, Model, Color, Price, `Status`, Fuel, Gearbox, `First registration`, cat_ID, `user_ID`, Add_Date) نفس ترتيب الانسيرت
                $stmt = $con->prepare("UPDATE cars SET Make = ?, Model = ?, Color = ?, Price = ?, `Status` = ?, Fuel = ?, Gearbox = ?, `First registration` = ?, cat_ID  = ?, `user_ID` = ?, tags =?, img = ? WHERE car_ID = ?");
                $stmt->execute(array( $make, $model, $color, $price, $status, $fuel, $gearbox, $first, $category, $users, $tags, $img_field, $id));
                //echo success message
                echo "<div class='container'>";
                    $theMsg = "<div class='alert alert-success'>" . $stmt->rowCount() . " record updated </div>";
                    redirectHome($theMsg, 'back');
                echo "</div>";
            }
   


        } else {
            echo "<div class='container'>";
                $theMsg = "<div class='alert alert-danger'>sorry you can not browse this page directly </div>";
                redirectHome($theMsg);
            echo "</div>";
        }
        echo '</div>';
/*********************************************************************************************************************/
        }elseif($do == 'Delete'){
            echo '<h1 class="text-center">Delete Car</h1>';
        echo '<div class="container">';
            $carid = isset($_GET['carid']) && is_numeric($_GET['carid']) ? intval($_GET['carid']) : 0;//لازم الايدى يكون رقم مينفعش يكون حروف لو رقم اطبعهولى ولو اى حاجة غير رقم اطبعى 0

            $check = checkItem('car_ID', 'cars', $carid);//اعمل تشيك هل الايدى موجود ف الداتابيز والا لا بل ما تمسحه
            
            if($check > 0){  
                $stmt = $con->prepare("DELETE FROM cars WHERE car_ID = ?");
                $stmt->execute(array($carid));
                //echo success message
                echo "<div class'container'>";
                    $theMsg = "<div class='alert alert-success'>" . $stmt->rowCount() . " record deleted </div>";
                    redirectHome($theMsg, 'back');
                echo "</div>";
            }else{
                echo "<div class'container'>";
                    $theMsg = "<div class='alert alert-danger'>this id is not exist </div>";
                    redirectHome($theMsg);
                echo "</div>";

            }
        
        echo '</div>';
/*********************************************************************************************************************/
        }elseif($do == 'Approve'){
            echo '<h1 class="text-center">Approve car</h1>';
            echo '<div class="container">';
                $carid = isset($_GET['carid']) && is_numeric($_GET['carid']) ? intval($_GET['carid']) : 0;//لازم الايدى يكون رقم مينفعش يكون حروف لو رقم اطبعهولى ولو اى حاجة غير رقم اطبعى 0
    
                $check = checkItem('car_ID', 'cars', $carid);//اعمل تشيك هل الايدى موجود ف الداتابيز والا لا بل ما تمسحه
                
                if($check > 0){  
                    $stmt = $con->prepare("UPDATE cars SET Approve = 1 WHERE car_ID = ?");
                    $stmt->execute(array($carid));
                    //echo success message
                    echo "<div class'container'>";
                        $theMsg = "<div class='alert alert-success'>" . $stmt->rowCount() . " record approved </div>";
                        redirectHome($theMsg, 'back');
                    echo "</div>";
                }else{
                    echo "<div class'container'>";
                        $theMsg = "<div class='alert alert-danger'>this id is not exist </div>";
                        redirectHome($theMsg);
                    echo "</div>";
    
                }
            
            echo '</div>';;

        }

        include $tpl . 'footer1.php';
    } else {
            header('location: index1.php');
            exit();
    }
    ob_end_flush();

?>
