<?php
    
/*
**Get  All Function v1.0
**Function To Get All Records From  Any Database
*/

    /**get All function */

    function getAllFroms($field, $table, $where = NULL, $and = NULL, $orderfield, $ordering = "DESC"){
        global $con;
        
        $getAll = $con->prepare("SELECT $field FROM $table $where $and ORDER BY $orderfield $ordering ");
        $getAll->execute();
        $all = $getAll->fetchAll();

        return $all;

    }
/***/
function getAllFrom($tableName,$orderBy,$where = Null){
    global $con;
    if($where==NULL){
        
        $sql='';

    }else{
        $sql = $where;
    }

    $getAll=$con->Prepare("SELECT * FROM $tableName  $sql ORDER BY $orderBy DESC  ");
    $getAll->execute();
    $all=$getAll->fetchAll();
    return $all;
}
/**/ 
/*from cat only*/
function getCat(){
    global $con;
    $getCat=$con->Prepare("SELECT * FROM categories ORDER BY ID ASC ");
    $getCat->execute();
    $cats=$getCat->fetchAll();
    return $cats;
}
/*
**Get AD Items Function v1.0
**Function To Get AD Items From Database[Users,Items,Comments] 
*/
function getItems($where,$value,$approve=NULL){
    global $con;
    if($approve==NULL){
        
        $sql='AND Approve = 1';

    }else{
        $sql = NULL;
    }
    $getItems=$con->Prepare("SELECT * FROM Items WHERE $where=? $sql ORDER BY Item_ID DESC  ");
    $getItems->execute(array($value));
    $items=$getItems->fetchAll();
    return $items;
}

/*
** [Title Function ] v1.0
**Title Function That Echo The Page Title In Case Page
**Has The Variable $pageTitle And Echo Defult Title For Other Pages
*/ 
function getTitle(){
    global $pageTitle;
    if(isset($pageTitle)){
        echo $pageTitle;
    }else{
        echo 'Default';
    }
}
/*
**Redirect function v1.0
**[this Function Accept Parameters] 
**$theMsg=Echo The  Message[Error | success| warning]
**$url=The Link You Want To Redirect To
**$seconds=Seconds Before Redirectind
*/ 
function redirectHome($theMsg,$url=null,$second=3){
    if($url===null){
        $url='dashboard.php';
        $link='Homepage';
        //لو مكتبتش رابط هيحولك لصفحة الاندكس
    }else {
        //لو مكنش جاي من رابط صريح هيحولك للاندكس
        //$url=isset($_SERVER['HTTP_REFERER'])&& $_SERVER['HTTP_REFERER'] !==''? $_SERVER['HTTP_REFERER']:'index.php';
        if(isset($_SERVER['HTTP_REFERER'])&& $_SERVER['HTTP_REFERER'] !==''){
            $url=$_SERVER['HTTP_REFERER'];

            $link='Previous page';
        }else{

           $url='dashboard.php'; 
           $link='Homepage'; 
        }
                
    }
    echo$theMsg;
    echo "<div class='alert alert-info'>You Will Be Redirected To $link After $second Seconds.</div> ";
    header("refresh:$second;url= $url");
    exit();
}
/*
**Check Items Function v1.0
**Function  To Check Item In Database[Function Accept Parameters]
**$select=The Item to Select [Example:use,item,category]
**$from=The Table To Select From[Example:users,items,categories]
**$value=The Value Of Select[Example:islam,box]
**احنا هنعمل فحص ليوزر لو موجود مش هينفع تعمل ادد لنفس اليوزر تاني خصوصا لو الاسم نفسه
*/ 
function checkItem($select,$from,$value){
    global $con;
    $statement =  $con->prepare("SELECT $select FROM $from WHERE $select = ?");
    $statement->execute(array($value));
    $count = $statement->rowCount();
    return $count;
}
/*
** Check Number Of Items Function V1.0
** Function To Count Number Of Items Rows
**$item =The Item To Count 
**$tble=The Table To Choose From
**هيحسب عدد العناصر سواء اليوزر او وااللي محناجين اكتيف 
*/ 
function countItems($item,$table){   

    global $con;

    $stmt = $con->prepare("SELECT COUNT($item) FROM $table ");
    $stmt->execute();
    return $stmt->fetchColumn();
}
/*
**Get Latest Records Function v1.0
**Function To Get  Latest Items From Database[Users,Items,Comments]
**$table=The Table To Choose From
**$limit=Number Of Records To Get 
*/
 function getLatest($select,$table,$order,$limit=5 ){
     global $con;
     $getStmt=$con->Prepare("SELECT $select FROM $table ORDER BY $order DESC LIMIT $limit ");
     $getStmt->execute();
     $rows=$getStmt->fetchAll();
     return $rows;
 }
 /*
 **check if User Is Not Activated
 **function To Checkk  The RegStatus Of The User
 **
 */
/* front - end*/
function checkUserStatus($user){
global $con;
$stmtx=$con->prepare("SELECT            
            *               
FROM 
    users
WHERE
    Username=? 
AND RegStatus=0");
$stmtx ->execute(array($user));
$status=$stmtx->rowCount(); //count 
return $status;
}
