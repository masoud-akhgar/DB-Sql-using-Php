<?php include_once "dbname.php"; global $connect;?>
<html>
<head>
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
<link rel="stylesheet" href="bootstrap.min.css">
</head>
<hr><a href="index.php">main page</a>
<h2>create channel:</h2>
<?php
    if (isset($_POST['name']) && isset($_POST['description']) && isset($_POST['img']) && isset($_POST['dy']) && isset($_POST['dy2']) && isset($_POST['dy3'])){
        echo "here";
        $sql = "INSERT INTO image (image_source) VALUES ('".$_POST['img']."')";
        $result = pg_query($db_connection, $sql);   
    
        $sql="SELECT * FROM image";
        $result = pg_query($db_connection, $sql);
        $rows = pg_num_rows($result);   //num row
        $profile_id = pg_fetch_result($result, $rows-1 , 0);   // last id
        /////////////////////////////////////////////////////////////////////////////////////////profile_id
        $sql = "INSERT INTO date (day, month, year) VALUES ('".$_POST['dy']."','".$_POST['dy2']."','".$_POST['dy3']."')";
        $result = pg_query($db_connection, $sql);

        $sql="SELECT * FROM date";
        $result = pg_query($db_connection, $sql);
        $rows = pg_num_rows($result);   //num row
        $date_id = pg_fetch_result($result, $rows-1 , 0);   // last id
        /////////////////////////////////////////////////////////////////////////////////////////date_id
        $sql = "INSERT INTO channel_bin_video (video_id) VALUES ('0')";
        $result = pg_query($db_connection, $sql);

        $sql="SELECT * FROM channel_bin_video";
        $result = pg_query($db_connection, $sql);
        $rows = pg_num_rows($result);   //num row
        $channel_bin_video_id = pg_fetch_result($result, $rows-1 , 0);   // last id
        /////////////////////////////////////////////////////////////////////////////////////////
        $sql = "INSERT INTO channel_bin_member (member_id) VALUES ('0')";
        $result = pg_query($db_connection, $sql);

        $sql="SELECT * FROM channel_bin_member";
        $result = pg_query($db_connection, $sql);
        $rows = pg_num_rows($result);   //num row
        $channel_bin_member_id = pg_fetch_result($result, $rows-1 , 0);   // last id
        /////////////////////////////////////////////////////////////////////////////////////////
        $sql = "INSERT INTO channel (name, date_of_made, picture,
        description,channel_bin_video_id, channel_bin_member_id) VALUES ('".$_POST['name']."','".$date_id."','".$profile_id."',
        '".$_POST['description']."','".$channel_bin_video_id."','".$channel_bin_member_id."')";
        $result = pg_query($db_connection, $sql);
}
?>
<body>
<div class="w-100">
<form action="" method="post" id="form">
<div class="d-flex">
                <span class="col-2">add channel for user with ID?</span>
                <input class=" col-md-2 form-control" name="userid" type="text" placeholder="یوزرآیدی">
        </div>
            <div class="d-flex">
                <span class="col-2">اضافه کردن  کانال</span>
                <input class=" col-md-2 form-control" name="name" type="text" placeholder="نام">
                <br>
                <input class=" col-md-2 form-control" name="description" type="text" placeholder="توضیح">
                <br>
                <input class=" col-md-2 form-control" name="img" type="text" placeholder="عکس">
                <br>
                </div>
                <div class="d-flex">
                <span class="col-2">تاریخ</span>
                <br>
                <input class=" col-md-2 form-control" name="dy" type="text" placeholder="روز">
                <br>
                <input class=" col-md-2 form-control" name="dy2" type="text" placeholder="ماه">
                <br>
                <input class=" col-md-2 form-control" name="dy3" type="text" placeholder="سال">
                
                <br>
                </div><input class="offset-4 col-md-2 form-control alert-success" type="submit" value="ثبت ویدئو حدید">
            </form>
            </div>
            </body>
</html>