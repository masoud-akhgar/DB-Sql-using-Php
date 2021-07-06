<?php include_once "dbname.php"; global $connect;?>
<html>
<head>
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
<link rel="stylesheet" href="bootstrap.min.css">
</head>
<hr><a href="index.php">main page</a>
<h2>add video:</h2>
<?php
if (isset($_POST['userid'])){
    if (isset($_POST['name']) && isset($_POST['description']) && isset($_POST['pass']) && isset($_POST['dy']) && isset($_POST['dy2']) && isset($_POST['dy3'])){
        if ($_POST['name']!="" && $_POST['description']!=""){
        $sql = "INSERT INTO image (image_source) VALUES ('".$_POST['img']."')";
        $result = pg_query($db_connection, $sql);   
    
        $sql="SELECT * FROM image";
        $result = pg_query($db_connection, $sql);
        $rows = pg_num_rows($result);   //num row
        $profile_id = pg_fetch_result($result, $rows-1 , 0);   // last id
        /////////////////////////////////////////////////////////////////////////////////////////
        $sql = "INSERT INTO date (day, month, year) VALUES ('".$_POST['dy']."','".$_POST['dy2']."','".$_POST['dy3']."')";
        $result = pg_query($db_connection, $sql);

        $sql="SELECT * FROM date";
        $result = pg_query($db_connection, $sql);
        $rows = pg_num_rows($result);   //num row
        $date_id = pg_fetch_result($result, $rows-1 , 0);   // last id
        /////////////////////////////////////////////////////////////////////////////////////////
        $sql="SELECT * FROM comment_bin";
        $result = pg_query($db_connection, $sql);
        $rows = pg_num_rows($result);   //num row
        $comment_bin_id = pg_fetch_result($result, $rows-1 , 0);   // last id
        $comment_bin_id+=1;

        $sql = "INSERT INTO public.comment_bin (id,comment_id) VALUES ('".$comment_bin_id."','0')";
        $result = pg_query($db_connection, $sql);
        /////////////////////////////////////////////////////////////////////////////////////////
        $sql="SELECT * FROM like_bin";
        $result = pg_query($db_connection, $sql);
        $rows = pg_num_rows($result);   //num row
        $like_bin_id = pg_fetch_result($result, $rows-1 , 0);   // last id
        $like_bin_id+=1;

        $sql = "INSERT INTO public.like_bin (id,liked,user_id,video_id) VALUES ('".$like_bin_id."','0','0','0')";
        $result = pg_query($db_connection, $sql);
        /////////////////////////////////////////////////////////////////////////////////////////
    
        $sql = "INSERT INTO video (name, date_of_load, description,
        length, thumbnail, comment_bin_id, watched_number,like_bin_id) VALUES ('".$_POST['name']."','".$date_id."','".$_POST['description']."','".$_POST['pass']."',
        '".$profile_id."','".$comment_bin_id."','0','".$like_bin_id."')";
        $result = pg_query($db_connection, $sql);
    
    }}
}
?>
<body>
<div class="w-100">
<form action="" method="post" id="form">
<div class="d-flex">
                <span class="col-2">add video for user with ID?</span>
                <input class=" col-md-2 form-control" name="userid" type="text" placeholder="یوزرآیدی">
        </div>
            <div class="d-flex">
                <span class="col-2">اضافه کردن  ویدئو</span>
                <input class=" col-md-2 form-control" name="name" type="text" placeholder="نام">
                <br>
                <input class=" col-md-2 form-control" name="description" type="text" placeholder="توضیح">
                <br>
                <input class=" col-md-2 form-control" name="pass" type="text" placeholder="مدت ویدئو">
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
                <input class=" col-md-2 form-control" name="img" type="text" placeholder="عکس">
                <br>
                </div><input class="offset-4 col-md-2 form-control alert-success" type="submit" value="ثبت ویدئو حدید">
            </form>
            </div>
            </body>
</html>