<?php include_once "dbname.php"; global $connect;?>
<html>
<head>
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
<link rel="stylesheet" href="bootstrap.min.css">
</head>
<hr><a href="index.php">main page</a>
<h2>create channel:</h2>
<?php
// if (isset($_POST['userid'])){
    if (isset($_POST['name']) && isset($_POST['description']) && isset($_POST['pass']) && isset($_POST['dy']) && isset($_POST['dy2']) && isset($_POST['dy3'])){
        $sql="INSERT INTO `image`(`Id`, `image_source`) VALUES ('','".$_POST['img']."')";
        $stmt = $connect->prepare($sql);
        $stmt->execute();
    
        // get id = profile_id
        $stmt = $connect->prepare("SELECT * FROM `image` ");
        $stmt->execute();
        $users = $stmt->fetchAll();
        $profile_id=strval($users[sizeof($users)-1]["Id"]);
        /////////////////////////////////////////////////////////////////////////////////////////
        $sql="INSERT INTO `date`(`ID`, `day`, `month`, `year`) 
        VALUES ('','".$_POST['dy']."','".$_POST['dy2']."','".$_POST['dy3']."')";
        $stmt = $connect->prepare($sql);
        $stmt->execute();
    
        // get id = date_id
        $stmt = $connect->prepare("SELECT * FROM `date` ");
        $stmt->execute();
        $users = $stmt->fetchAll();
        $date_id=strval($users[sizeof($users)-1]["ID"]);
        /////////////////////////////////////////////////////////////////////////////////////////
        $sql="INSERT INTO `channel_bin_video`(`ID`, `video_id`) VALUES ('','')";
        $stmt = $connect->prepare($sql);
        $stmt->execute();
    
        // get id = date_id
        $stmt = $connect->prepare("SELECT * FROM `channel_bin_video` ");
        $stmt->execute();
        $users = $stmt->fetchAll();
        $channel_bin_video_id=strval($users[sizeof($users)-1]["ID"]);
        /////////////////////////////////////////////////////////////////////////////////////////
        $sql="INSERT INTO `channel_bin_member`(`ID`, `member_id`) VALUES ('','')";
        $stmt = $connect->prepare($sql);
        $stmt->execute();
    
        // get id = date_id
        $stmt = $connect->prepare("SELECT * FROM `channel_bin_member` ");
        $stmt->execute();
        $users = $stmt->fetchAll();
        $channel_bin_member_id=strval($users[sizeof($users)-1]["ID"]);
        /////////////////////////////////////////////////////////////////////////////////////////
    
        $sql="INSERT INTO `channel`(`ID`, `name`, `date_of_made`, `picture`, `description`, 
        `Channel_Bin_video_id`, `Channel_Bin_member_id`)  
        VALUES ('','".$_POST['name']."','".$date_id."','".$profile_id."','".$_POST['description']."',
        '".$channel_bin_video_id."','".$channel_bin_member_id."')";//?
        $stmt = $connect->prepare($sql);
        $stmt->execute();
    }
// }
?>
<body>
<?php 
$stmt = $connect->prepare("SELECT * FROM `channel` ");
$stmt->execute();
$users = $stmt->fetchAll();
foreach ($users as $user)
echo " {$user['id']} {$user['name']} {$user['comment']}";
?>
<div class="w-100">
<form action="" method="post" id="form">
<div class="d-flex">
                <span class="col-2">add channel for user with ID?</span>
                <input class=" col-md-2 form-control" name="userid" type="text" placeholder="یوزرآیدی">
        </div>
            <div class="d-flex">
                <span class="col-2">اپلود ویدوئو در  کانال</span>
                <input class=" col-md-2 form-control" name="name" type="text" placeholder=" آیدی ویدئو">
                <br>
                <input class=" col-md-2 form-control" name="name" type="text" placeholder=" آیدی کانال">
                </div>
                <input class="offset-4 col-md-2 form-control alert-success" type="submit" value="اپلود ویدئو در کانال ">
            </form>
            </div>
            </body>
</html>