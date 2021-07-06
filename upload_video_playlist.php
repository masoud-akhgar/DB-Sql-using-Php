<?php include_once "dbname.php"; global $connect;?>
<html>
<head>
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
<link rel="stylesheet" href="bootstrap.min.css">
</head>
<hr><a href="index.php">main page</a>
<h2>upload and delete video in channel:</h2>
<?php
    if( (isset($_POST['vid_id']) && isset($_POST['chan_id'])) || 
    (isset($_POST['vid_name']) && isset($_POST['chan_name'])) ){
        if(($_POST['vid_id']!="" && $_POST['chan_id']!="") || ($_POST['vid_name']!="" && $_POST['chan_name']!="")){
            echo "here";
            if($_POST['vid_id']!="" && $_POST['chan_id']!="" && isset($_POST["submit"])){
                $sql="SELECT Playlist_Bin_id FROM public.Playlist WHERE public.Playlist.id='".$_POST['chan_id']."'";
                $result = pg_query($db_connection, $sql);
                $bin_id = pg_fetch_result($result, 0 , 0); 
                $sql ="INSERT INTO public.Playlist_Bin_id (id,video_id) VALUES ('".$bin_id."','".$_POST['vid_id']."')";
                $result = pg_query($db_connection, $sql);

            }else if($_POST['vid_id']!="" && $_POST['chan_id']!="" && isset($_POST["submit2"])){
                $sql="SELECT Playlist_Bin_id FROM public.Playlist WHERE public.Playlist.id='".$_POST['chan_id']."'";
                $result = pg_query($db_connection, $sql);
                $bin_id = pg_fetch_result($result, 0 , 0); 
                $sql ="DELETE FROM public.Playlist_Bin_id WHERE Playlist_Bin_id.id='".$bin_id."' and Playlist_Bin_id.video_id='".$_POST['vid_id']."'";
                $result = pg_query($db_connection, $sql);
            }
        }
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
                <span class="col-2">اپلود ویدوئو در  پلی لیست</span>
                <input class=" col-md-2 form-control" name="vid_id" type="text" placeholder=" آیدی ویدئو">
                <br>
                <input class=" col-md-2 form-control" name="chan_id" type="text" placeholder=" آیدی پلی">
            </div>
                <input class="offset-4 col-md-2 form-control alert-success" type="submit" name="submit" value="اپلود ویدئو در کانال ">
                <input class="offset-4 col-md-2 form-control alert-success" type="submit" name="submit2" value="حذف ویدئو در کانال ">
            </form>
            </div>
        </body>
</html>