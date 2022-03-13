<?php 
SESSION_start();
include "connect.php";

include "includes/functions/functions.php";

include "includes/tempalets/header.php"; 

if(isset($_SESSION['user'])){
if($_SERVER['REQUEST_METHOD'] == 'POST' ){
    $formErrors=array();
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

    $name       =filter_var($_POST['name'],FILTER_SANITIZE_STRING);
    $desc       =filter_var($_POST['description'],FILTER_SANITIZE_STRING);
    $price      =$_POST['price'];
    $country    =filter_var($_POST['country'],FILTER_SANITIZE_STRING);
    $first      =filter_var($_POST['first'], FILTER_SANITIZE_NUMBER_INT);
    $tags       =filter_var($_POST['tags'], FILTER_SANITIZE_STRING);
    $status     =filter_var($_POST['status'],FILTER_SANITIZE_NUMBER_INT);
    $brand      =$_POST['brand'];
    $color      =$_POST['color'];
    $category   =filter_var($_POST['category'],FILTER_SANITIZE_NUMBER_INT);
    $fuel       = $_POST['fuel'];
    $gearbox    = $_POST['gear'];
    
    if(strlen($name)<4){
        $formErrors[]=' Title Must Be At Least 4 Characters';

    }
    if(strlen($desc)<10){
        $formErrors[]=' Description Must Be At Least 4 Characters';
        
    }
    if(strlen($country)<2){
        $formErrors[]=' Country Must Be At Least 4 Characters';
        
    }
    if(empty($price)){
        $formErrors[]=' Price Must Be Not Empty';
        
    }
    if(empty($status)){
        $formErrors[]=' Status Must Be Not Empty';
        
    }
    if(empty($color)){
        $formErrors[]=' color Must Be Not Empty';
        
    }
    if(empty($brand)){
        $formErrors[]=' Brand Must Be Not Empty';
        
    }
    if(empty($category)){
        $formErrors[]=' Category Must Be Not Empty';
        
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
                if($imgSize[$i] > 400000){
                    $formErrors[] = 'file can not be more than x';
                }
                //check file extension
                if(! in_array($imgExtension1[$i], $allowedExtension)){
                    $formErrors[] = 'file is not valid';
                }

                
            }
        }
    }




    if (empty($formErrors)){
        
        for($i = 0; $i < $filesCount ; $i++){
            //get random name for file 
            // $image_random[$i] = rand(0, 1000000) ;
            // move_uploaded_file($imgTmp[$i], "admin/uploads/images2//" . $image_random[$i] . $imgName[$i] . "." . $imgExtension1[$i] );
            $image_random[$i] = rand(0, 1000000) . $imgName[$i] . "." . $imgExtension1[$i];
            move_uploaded_file($imgTmp[$i], "admin/uploads/images//" . $image_random[$i] );
            $all_images[] = $image_random[$i];
            $img_field = implode(",", $all_images);
            
            
        }


    $stmt =$con->prepare("INSERT INTO 
    items (Name ,Description,Price,Country_Made,Status,Color,Brand,Add_Data,Cat_ID,Member_ID,`First registration`,Fuel,Gearbox,tags,img)
    VALUES (:zname,:zdesc,:zprice,:zcountry,:zstatus ,:zcolor,:zbrand,now(),:zcat,:zmember, :zfirst, :zfuel,:zgear,:ztags,:zimg)");
    $stmt->execute(array(
       'zname'=>$name,
       'zdesc'=>$desc,
       'zprice'=>$price,
       'zcountry'=>$country,
       'zstatus'=>$status,
       'zcolor'=>$color,
       'zbrand'=>$brand,
       'zcat'  => $category,
       'zmember'=>$_SESSION['uid'],
       
       'zfirst' => $first,
       'zfuel' => $fuel,
       'zgear' => $gearbox,
       'ztags' => $tags,
       'zimg' => $img_field
       

   ));

    if ($stmt){
   //echo success message

   echo '<div class="alert alert-success the-success text-center"> Item Added...</div>';
    }
}
}






?>
<h1 class="mem text-center">Sell Your Car</h1>
<div class="create-ad block" >
    <div class="container">
        <div class="panel-heading">Sell Your Car</div>
        <div class="panel-body">
            <div class='row'>
                <div class='col-md-7 ad-form'>
                    <form class="form-horizontal" action="<?php echo $_SERVER['PHP_SELF']?>" method="POST" enctype="multipart/form-data">
                        <!-- start Name field-->
                        <div class="form-group">
                            
                            <div class=" col-sm-10">
                                <input type="text" name="name" class="form-control live-name the-success3"  required='required'  placeholder="Make of Car">
                            </div>
                        </div>
                        <!--end Name Field-->
                         <!-- start Description field-->
                         <div class="form-group">
                            <div class=" col-sm-10">
                                <input type="text" name="description" class="form-control live-desc the-success3"  required='required' placeholder="Model of Car">
                            </div>
                        </div>
                        <!--end Description Field-->
                        <!-- start Price field-->
                            <div class="form-group">
                            <div class=" col-sm-10">
                                <input type="text" name="price" class="form-control live-price the-success3" required='required'  placeholder="Price of Item">
                            </div>
                        </div>
                        <!--end Price Field-->
                        <!-- start Country field-->
                        <div class="form-group">
                            <div class=" col-sm-10">
                                <input type="text" name="country" class="form-control the-success3"  required='required'  placeholder="Country Of Made">
                            </div>
                        </div>
                        <!--end Country Field-->
                        <!--start tags field -->
                    
                        <div class="form-group">
                            <div class=" col-sm-10">
                                <input type="text" name="tags" class="form-control  the-success3"  required='required' placeholder="Type Tags">
                            </div>
                        </div>
                        
                        <!--end tags field -->
              
                                
                                <!--start avatar field -->
                            

                                <div class="form-group form-group-lg">
                                    <label class="col-sm-4 col-lg-2 control-label the-success3 newad-select">Images</label>
                                   
                                    <div style="margin-top:10px;margin-bottom:10px" class="col-sm-10 col-lg-10">
                                                
                                        <input style="display:none"type="file" id="file"name="car_images[]" multiple="multiple" value="add"placeholder="Add only 3 images for your car"/>
                                        <label for="file" style="padding:8px ; " class="the-success3 col-sm-12 col-lg-12 ">
                                        <i class="fa fa-image fa-lg"></i>
                                        choose 3 images</label>                                 
                                    </div>
                                </div>
                                <!--end avatar field -->
                                
                              
                      
                       
                         <!-- start color field-->
                    <div class="form-group select-ad">
                        <label class="col-sm-4  col-lg-2 control-label the-success3 newad-select" >Color</label>
                        <div class=" col-sm-10">
                            <select  name='color' class="the-success3 ">
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
                        <div class="form-group  select-ad ">
                            <label class="col-sm-4 control-label the-success3 newad-select col-lg-2 " >Status</label>
                            <div class=" col-sm-10">
                                <select  name='status' class="the-success3 "> 
                                    <option value="0"> .  .  . </option>
                                    <option value="1">New Vechile</option>
                                    <option value="2">Like New Vechile</option>
                                    <option value="3">Used Vechile</option>
                                    
    
                                </select>
                            </div>
                        </div>
                        <!--end Status Field-->
                        <!-- start fuel field-->
                        <div class="form-group  select-ad ">
                            <label class="col-sm-4 control-label the-success3 newad-select col-lg-2 " >Fuel</label>
                            <div class=" col-sm-10">
                                <select  name='fuel' class="the-success3 "> 
                                    <option value="0"> .  .  . </option>
                                    <option value="diesel">Diesel</option>
                                    <option value="electric">Electric</option>
                                    <option value="gas">Gas</option>
                                    <option value="petrol">Petrol</option>
    
                                </select>
                            </div>
                        </div>
                        <!--end fuel Field-->
                        <!-- start gearbox field-->
                        <div class="form-group  select-ad ">
                            <label class="col-sm-4 control-label the-success3 newad-select  col-lg-2" >Gearbox</label>
                            <div class=" col-sm-10">
                                <select  name='gear' class="the-success3 "> 
                                    <option value="0"> .  .  . </option>
                                    <option value="automatic">Automatic</option>
                                    <option value="manual">Manual</option>
                                    <option value="semi-Automatic">Semi-Automatic</option>
                                
                                </select>
                            </div>
                        </div>
                        <!--end gearbox Field-->
                        <!-- start first field-->
                        <div class="form-group  select-ad ">
                            <label class="col-sm-6 control-label the-success3 newad-select " >First Registiration</label>
                            <div class=" col-sm-10">
                            <?php 
                             function years($start,$end){
                                echo "<select name='first'>";
                                echo"<option value='0'> .  .  . </option>";
                                for($years=$start;$years<=$end;$years++ ){
                                    
                                    echo "<option value='$years'>".$years."</option>";
                            
                                    
                                }
                                echo "</select>";
                            }
                            years(1990,2020);
                            
                            ?>
                            </div>
                        </div>
                        <!--end first Field-->

                        <!-- start brand field-->
                        <div class="form-group select-ad">
                            <label class="col-sm-4 control-label the-success3 newad-select col-lg-2" >Brand</label>
                            <div class=" col-sm-10">
                            <select  name='brand'  class="the-success3 ">
                                <option value="0"> .  .  . </option>
                                <option value="nissan">Nissan</option>
                                <option value="alfa-romeo">Alfa Romeo</option>
                                <option value="chevrolet">Chevrolet</option>
                                <option value="ferrari">Ferrari</option>
                                <option value="fiat">FIAT</option>
                                <option value="hyundai">Hyundai</option>
                                <option value="jeep">Jeep</option>
                                <option value="kia">Kia</option>
                                <option value="land rover">Land Rover</option>
                                <option value="lamborghini">Lamborghini</option>
                                <option value="mitsubishi">Mitsubishi</option>
                                <option value="bmw">Bmw</option>
                                <option value="honda">Honda</option>
                                <option value="ford">Ford</option>
                                <option value="mercedes">Mercedes</option>
                                <option value="toyota">Toyota</option>

                            </select>
                        </div>
                    </div>
                    <!--end brand Field-->

                        <!-- start categories field-->
                            <div class="form-group select-ad">
                            <label class="col-sm-4 control-label the-success3 newad-select col-lg-2" >Category</label>
                            <div class=" col-sm-10">
                                <select  name='category' class="the-success3 ">
                                <option value="0"> .  .  . </option>
                                    <?php
                                        $stmt2= $con->prepare("SELECT* FROM categories ORDER BY ID DESC");
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


                        
                        <!-- start submit field-->
                            <div class="form-group">
                            <div class=" col-sm-offset-2 col-sm-10">
                                <input type="submit" value="Add Item" class="btn btn-success btn-block the-success3">
                            </div>
                        </div>
                        <!--end submit Field-->
                    </form>
                </div>
                <div class="col-sm-8 col-md-4">
                    <div class="thumbnail live-preview">
                                <span class="price-tag">$0000</span>
                                <img  src="img1.jpg" alt="">
                            <div class="caption text-center" >
                                <h3>Title</h3>

                                <p>Description</p>
                            </div>
                    </div>
                </div>
            </div>
                <!--Start Looping Through Errors-->
                 <?php
                    if(! empty($formErrors)){
                        foreach($formErrors as $error){
                            echo'<div class="alert alert-danger the-error text-center">'.$error.'</div>';
                        }
                    }
                

                ?>

                <!--End Looping Through Errors-->
            </div>
        </div>   
    </div>
</div>
<?php 

} else{

    header('Location: login.php');
    exit();
}
 include "includes/tempalets/footer.php";
 ?>
