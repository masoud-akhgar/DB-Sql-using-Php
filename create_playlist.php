<?php include_once "dbname.php"; global $connect;?>
<html>
<head>
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
<link rel="stylesheet" href="bootstrap.min.css">
</head>
<hr><a href="index.php">main page</a>
<h2>create Playlist:</h2>
<?php
    if (isset($_POST['name']) && isset($_POST['description']) && isset($_POST['userid'])){
        if ($_POST['name']!="" && $_POST['description']!=""){
        $sql="SELECT * FROM Playlist_Bin_id";
        $result = pg_query($db_connection, $sql);
        $rows = pg_num_rows($result);   //num row
        $Playlist_Bin_id_id = pg_fetch_result($result, $rows-1 , 0);   // last id
        $Playlist_Bin_id_id+=1;

        $sql = "INSERT INTO public.Playlist_Bin_id (id,video_id) VALUES ('".$Playlist_Bin_id_id."','0')";
        $result = pg_query($db_connection, $sql);
        /////////////////////////////////////////////////////////////////////////////////////////
        $sql="SELECT * FROM Playlist";
        $result = pg_query($db_connection, $sql);
        $rows = pg_num_rows($result);   //num row
        $Playlist_id = pg_fetch_result($result, $rows-1 , 0);   // last id
        $Playlist_id+=1;

        $sql = "INSERT INTO Playlist (id, name, privacy, user_id, playlist_bin_id) 
        VALUES ('".$Playlist_id."','".$_POST['name']."','".$_POST['description']."','".$_POST['userid']."','".$Playlist_Bin_id_id."')";
        $result = pg_query($db_connection, $sql);
}}
?>
<body>
<div class="w-100">
<form action="" method="post" id="form">
<div class="d-flex">
                <span class="col-2">add channel for user with ID?</span>
        </div>
            <div class="d-flex">
                <span class="col-2">اضافه کردن  پلی لیست</span>
                <input class=" col-md-2 form-control" name="name" type="text" placeholder="نام">
                <br>
                <input class=" col-md-2 form-control" name="description" type="text" placeholder="privacy">
                <br>
                <input class=" col-md-2 form-control" name="userid" type="text" placeholder="یوزرآیدی">
                </div>
                <input class="offset-4 col-md-2 form-control alert-success" type="submit" value="ثبت پلی لیست حدید">
            </form>
            </div>
            </body>
</html>