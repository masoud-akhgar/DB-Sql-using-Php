<?php include_once "dbname.php"; global $connect;?>
<html>
<head>
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
<link rel="stylesheet" href="bootstrap.min.css">
</head>
<hr><a href="index.php">main page</a>
<h2>upload and delete video in channel:</h2>
<?php
    if( (isset($_POST['vid_id'])  ) && isset($_POST['userid']) ){
        if(($_POST['vid_id']!="" )  ) {
            $sql = "SELECT video.watched_number FROM public.video WHERE video.id='".$_POST['vid_id']."'";
            $result = pg_query($db_connection, $sql);
            $like_bin_id = pg_fetch_result($result, 0 , 0); // all likes related sp. video
            echo "watched_number: ".$like_bin_id."";

            $sql = "SELECT video.like_bin_id FROM public.video WHERE video.id='".$_POST['vid_id']."'";
            $result = pg_query($db_connection, $sql);
            $like_bin_id = pg_fetch_result($result, 0 , 0); // all likes related sp. video

            $sql="SELECT * FROM like_bin WHERE like_bin.id='".$like_bin_id."' and like_bin.liked='1'";
            $result = pg_query($db_connection, $sql);
            $rows = pg_num_rows($result);   //all likes related sp. video and user
            echo "likes: ".$rows."";

            $sql="SELECT * FROM like_bin WHERE like_bin.id='".$like_bin_id."' and like_bin.liked='0'";
            $result = pg_query($db_connection, $sql);
            $rows = pg_num_rows($result);   //all likes related sp. video and user
            echo "dislikes: ".$rows."";
        }
    }
?>
<body>
            <div class="w-100">
<form action="" method="post" id="form">
            <div class="d-flex">
            <span class="col-2">اپلود ویدوئو در  کانال</span>
                <input class=" col-md-2 form-control" name="userid" type="text" placeholder="یوزرآیدی">
                <input class=" col-md-2 form-control" name="vid_id" type="text" placeholder=" آیدی ویدئو">
                <input class="col-md-2 form-control alert-success" type="submit" name="submit" value="ok">
            </div>
            </form>
            </div>
        </body>
</html>