<?php include_once "dbname.php"; global $connect;?>
<html>
<head>
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
<link rel="stylesheet" href="bootstrap.min.css">
</head>
<hr><a href="index.php">main page</a>
<h2>insert user:</h2>
<?php
// POSTGRES
if (isset($_POST['username']) && isset($_POST['email']) && isset($_POST['pass']) && isset($_POST['dy']) && isset($_POST['dy2']) && isset($_POST['dy3'])){
    if ($_POST['username']!="" && $_POST['email']!=""){
    $password=md5($_POST['pass']);
    /////////////////////////////////////////////////////////////////////////////////////////
    $sql = "INSERT INTO image (image_source) VALUES ('".$_POST['img']."')";
    $result = pg_query($db_connection, $sql);

    $sql="SELECT * FROM image";
    $result = pg_query($db_connection, $sql);
    $rows = pg_num_rows($result);   //num row
    $profile_id = pg_fetch_result($result, $rows-1 , 0);   // last id
    ///////////////////////////////////////////////////////////////////////////////////////// profile_id

    $sql = "INSERT INTO date (day, month, year) VALUES ('".$_POST['dy']."','".$_POST['dy2']."','".$_POST['dy3']."')";
    $result = pg_query($db_connection, $sql);

    $sql="SELECT * FROM date";
    $result = pg_query($db_connection, $sql);
    $rows = pg_num_rows($result);   //num row
    $date_id = pg_fetch_result($result, $rows-1 , 0);   // last id
    /////////////////////////////////////////////////////////////////////////////////////////date_id
    $sql="SELECT * FROM user_bin_channel";
    $result = pg_query($db_connection, $sql);
    $rows = pg_num_rows($result);   //num row
    $user_bin_channel_id = pg_fetch_result($result, $rows-1 , 0);   // last id
    $user_bin_channel_id+=1;

    $sql = "INSERT INTO public.user_bin_channel (id,channel_created_id, channel_membership_id) VALUES ('".$user_bin_channel_id."','0','0')";
    $result = pg_query($db_connection, $sql);
    /////////////////////////////////////////////////////////////////////////////////////////user_bin_channel_id
    $sql="SELECT * FROM user_bin_playlist";
    $result = pg_query($db_connection, $sql);
    $rows = pg_num_rows($result);   //num row
    $user_bin_playlist_id = pg_fetch_result($result, $rows-1 , 0);   // last id
    $user_bin_playlist_id+=1;

    $sql = "INSERT INTO public.user_bin_playlist (id, playlist_create_id) VALUES ('".$user_bin_playlist_id."','0')";
    $result = pg_query($db_connection, $sql);
    /////////////////////////////////////////////////////////////////////////////////////////user_bin_playlist_id

    $sql = "INSERT INTO users (username, email, password,
    date_of_membership, profile_id, User_Bin_Channel_id, User_Bin_Playlist_id) VALUES ('".$_POST['username']."','".$_POST['email']."','".$password."',
    '".$date_id."','".$profile_id."','".$user_bin_channel_id."','".$user_bin_playlist_id."')";
    $result = pg_query($db_connection, $sql);
}}

?>
<body>
<div class="w-100">
<form action="" method="post" id="form">
<div class="d-flex">
                <span class="col-2">اضافه کردن  ادمین</span>
                <input class=" col-md-2 form-control" name="username" type="text" placeholder="نام کاربری ادمین">
                <br>
                <input class=" col-md-2 form-control" name="email" type="text" placeholder="ایمیل ادمین">
                <br>
                <input class=" col-md-2 form-control" name="pass" type="text" placeholder="رمز عبور ادمین">
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
                </div><input class="offset-4 col-md-2 form-control alert-success" type="submit" value="ثبت ادمین حدید">
            </form>
            </div>
            </body>
</html>