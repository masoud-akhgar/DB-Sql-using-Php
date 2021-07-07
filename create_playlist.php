<?php include_once "dbname.php"; global $connect;?>
<html>
<head>
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
<link rel="stylesheet" href="bootstrap.min.css">
</head>
<hr><a href="index.php">main page</a>
<h2>create and delete Playlist:</h2>
<?php
    if ( isset($_POST['description']) && isset($_POST['userid'])){
        if ($_POST['userid']!="" && $_POST['description']!=""){
            if(isset($_POST["submit"])){
                $sql="SELECT * FROM Playlist_Bin_id";
                $result = pg_query($db_connection, $sql);
                $rows = pg_num_rows($result);   //num row
                $Playlist_Bin_id_id = pg_fetch_result($result, $rows-1 , 0);   // last id
                $Playlist_Bin_id_id+=1;
        
                $sql = "INSERT INTO Playlist_Bin_id (id,video_id) VALUES ('".$Playlist_Bin_id_id."','0')";
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
        
                ////////////////////////////////////////////////////////////////////////////////////////////
                $sql="SELECT * FROM Playlist";
                $result = pg_query($db_connection, $sql);
                $rows = pg_num_rows($result);   //num row
                $Playlist_id = pg_fetch_result($result, $rows-1 , 0);   // last id
                ////////////////////////////////////////////////////////////////////////////////////////////
                $sql="SELECT user_bin_playlist_id FROM users WHERE users.id='".$_POST['userid']."'";
                $result = pg_query($db_connection, $sql);
                $bin_id = pg_fetch_result($result, 0 , 0); 
                $sql ="INSERT INTO user_bin_playlist (id, playlist_create_id) VALUES ('".$bin_id."','".$Playlist_id."')";
                $result = pg_query($db_connection, $sql);
            }
            if(isset($_POST["submit2"])){
                $sql="SELECT user_bin_playlist_id FROM users WHERE users.id='".$_POST['userid']."'";
                $result = pg_query($db_connection, $sql);
                $bin_id = pg_fetch_result($result, 0 , 0); 

                $sql="SELECT Playlist.name FROM Playlist WHERE Playlist.id='".$_POST['description']."'";
                $result = pg_query($db_connection, $sql);
                $Playlist_name = pg_fetch_result($result, 0 , 0);  
                if($Playlist_name=="watch_later")echo "watch later cant be deleted";
                else{
                    $sql ="DELETE FROM user_bin_playlist WHERE user_bin_playlist.id='".$bin_id."' and user_bin_playlist.playlist_create_id='".$_POST['description']."'";
                    $result = pg_query($db_connection, $sql);
                }
            }
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
                <input class="offset-4 col-md-2 form-control alert-success" type="submit" name="submit" value="ثبت پلی لیست حدید">
            </form>
            </div>

            <div class="w-100">
<form action="" method="post" id="form">
<div class="d-flex">
                <span class="col-2">delete channel for user with ID?</span>
        </div>
            <div class="d-flex">
                <span class="col-2">حذف کردن  پلی لیست</span>
                <input class=" col-md-2 form-control" name="description" type="text" placeholder="آیدی پلی لیست">
                <br>
                <input class=" col-md-2 form-control" name="userid" type="text" placeholder="یوزرآیدی">
                </div>
                <input class="offset-4 col-md-2 form-control alert-success" type="submit" name="submit2"  value="حذف پلی لیست حدید">
            </form>
            </div>

            </body>
</html>