<?php  
    ob_start();
    session_start();
    $pageTitle = 'Sell Your Car';
    include "init1.php";
    if (isset($_SESSION['user'])){
        

        if ($_SERVER['REQUEST_METHOD'] == 'POST'){
            $formErrors = array();

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

            $make = filter_var($_POST['make'], FILTER_SANITIZE_STRING);
            $model = filter_var($_POST['model'], FILTER_SANITIZE_STRING);
            $price = filter_var($_POST['price'], FILTER_SANITIZE_NUMBER_INT);
            $first = filter_var($_POST['first'], FILTER_SANITIZE_NUMBER_INT);
            $status = filter_var($_POST['status'], FILTER_SANITIZE_NUMBER_INT);
            $fuel = filter_var($_POST['fuel'], FILTER_SANITIZE_NUMBER_INT);
            $gearbox = filter_var($_POST['gearbox'], FILTER_SANITIZE_NUMBER_INT);
            $color = filter_var($_POST['color'], FILTER_SANITIZE_NUMBER_INT);
            $category = filter_var($_POST['category'], FILTER_SANITIZE_NUMBER_INT);
            $tags = filter_var($_POST['tags'], FILTER_SANITIZE_STRING);

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
            
            
                

            
            
               //check if there is no error proceed the insert process
            if (empty($formErrors)){

                
                for($i = 0; $i < $filesCount ; $i++){
                    //get random name for file 
                    // $image_random[$i] = rand(0, 1000000) ;
                    // move_uploaded_file($imgTmp[$i], "admin/uploads/images2//" . $image_random[$i] . $imgName[$i] . "." . $imgExtension1[$i] );
                    $image_random[$i] = rand(0, 1000000) . $imgName[$i] . "." . $imgExtension1[$i];
                    move_uploaded_file($imgTmp[$i], "admin/uploads/images2//" . $image_random[$i] );
                    $all_images[] = $image_random[$i];
                    $img_field = implode(",", $all_images);
                    
                    
                }
               
                $stmt = $con->prepare("INSERT INTO cars(Make, Model, Color, Price, `Status`, Fuel, Gearbox, `First registration`, cat_ID, `user_ID`, tags, img, Add_Date) VALUES( :zmake, :zmodel, :zcolor, :zprice, :zstatus, :zfuel, :zgearbox, :zfirst, :zcategory, :zuser, :ztags, :zimg, now() )");

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
                    'zuser' => $_SESSION['uid'],
                    'ztags' => $tags,
                    
                    'zimg' => $img_field,
                ));
                //echo success msg
                if($stmt){
                    $successMsg = "your Car has been added";
                    

                }

            }


        }
        
        echo '<div class="container">';
            if (!empty($formErrors)){
                foreach($formErrors as $error){
                    echo '<div class="alert alert-danger">' . $error . '</div>';
                }
            }
            if (isset($successMsg)){
                $theMsg = '<div class="alert alert-success">' . $successMsg . '</div>';
                redirectHome($theMsg, 'back');
            }
        echo '</div>';




                    
    
    
    
    ?>


<h1 class="text-center"><?php echo $pageTitle;   ?></h1>
<div class="create-ad block">
    <div class="container">
        <div class="panel panel-primary">
            <div class="panel-heading"><?php echo $pageTitle;   ?></div>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-md-8">
                            <form class="form-horizontal main-form" action="<?php echo $_SERVER['PHP_SELF']     ?>" method="POST" enctype="multipart/form-data" >
                                
                                <!--start make field -->
                                <div class="form-group form-group-lg">
                                    <label class="col-sm-3 control-label">Make</label>
                                    <div class="col-sm-10 col-md-9">
                                        <input type="text" name="make" class="form-control live" required="required" placeholder=" Make of the Car" value="<?php if(isset($make)){echo $make;}  ?>" data-class=".live-make"/>
                                    </div>
                                </div>
                                <!--end make field -->
                            
                                <!--start model field -->
                                <div class="form-group form-group-lg">
                                    <label class="col-sm-3 control-label">Model</label>
                                    <div class="col-sm-10 col-md-9">
                                        <input type="text" name="model" class="form-control live" required="required" placeholder=" Model of the Car" value="<?php if(isset($model)){echo $model;}  ?>"data-class=".live-model"/>
                                    </div>
                                </div>
                                <!--end model field -->
                                <!--start price field -->
                                <div class="form-group form-group-lg">
                                    <label class="col-sm-3 control-label">Price</label>
                                    <div class="col-sm-10 col-md-9">
                                        <input type="text" name="price" class="form-control live" required="required"  placeholder=" Price of the Car" value="<?php if(isset($price)){echo $price;}  ?>" data-class=".live-price"/>
                                    </div>
                                </div>
                                <!--end price field -->
                                
                                <!--start first-registration field -->
                                <div class="form-group form-group-lg">
                                    <label class="col-sm-3 control-label">First registration</label>
                                    <div class="col-sm-10 col-md-9">
                                        <input type="text" name="first" class="form-control" required="required" placeholder=" Date of First registration" value="<?php if(isset($first)){echo $first;}  ?>"/>
                                    </div>
                                </div>
                                <!--end first-registration field -->
                                <!--start status field -->
                                <div class="form-group form-group-lg">
                                    <label class="col-sm-3 control-label">Status</label>
                                    <div class="col-sm-10 col-md-9">
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
                                    <label class="col-sm-3 control-label">Fuel</label>
                                    <div class="col-sm-10 col-md-9">
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
                                    <label class="col-sm-3 control-label">Gearbox</label>
                                    <div class="col-sm-10 col-md-9">
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
                                    <label class="col-sm-3 control-label">Color</label>
                                    <div class="col-sm-10 col-md-9">
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
                                
                             
                                <!--start categories field -->
                                <div class="form-group form-group-lg">
                                    <label class="col-sm-3 control-label">Catgory</label>
                                    <div class="col-sm-10 col-md-9">
                                        <select name="category">
                                            <option value="0">...</option>
                                            <?php
                                                $cats = getAllFrom('*', 'categories', 'WHERE parent=0', '', 'ID', 'ASC');
                                
                                                foreach($cats as $cat){
                                                    echo "<option value='" . $cat['ID'] . "'>" . $cat['Name'] . "</option>";

                                                }
                                            ?>
                                        </select>
                                    </div>
                                </div>
                                <!--end categories field -->
                                <!--start tags field -->
                                <div class="form-group form-group-lg">
                                    <label class="col-sm-3 control-label">Tags</label>
                                    <div class="col-sm-10 col-md-9">
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
                                    <div class="col-sm-offset-3 col-sm-9 ">
                                        <input type="submit" value="Add Car" class="btn btn-primary btn-sm" />
                                    </div>
                                </div>
                                <!--end submit field -->
                                
                            </form>
                            
                            

                        </div>
                        <div class="col-md-4">
                            <div class="thumbnail item-box live-preview">
                                <span class="price-tag ">
                                    $<span class="live-price">0</span>
                                </span>
                                <img  class="img-responsive live-img" src="sell.jpg" alt="" />
                                <div class="caption">
                                    <h3 class="live-make"> title</h3>
                                    Model <span class="live-model"> desc </span>

                                </div>
                            </div>
                        </div>
                    </div>
                    

                </div>
        </div>
    </div>
</div>



</script>


 <?php
    } else{

        header('Location: login1.php');
        exit();
    }
 
    include $tpl . 'footer1.php';
    ob_end_flush();
 ?>

 