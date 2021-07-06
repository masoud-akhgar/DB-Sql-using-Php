<?php include_once "dbname.php"; global $connect;?>
<html>
<head>
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
<link rel="stylesheet" href="bootstrap.min.css">
</head>
<hr><a href="index.php">main page</a>
<h2>upload and delete video in channel:</h2>
<?php
    if(isset($_POST['vid_id']) ){
        if($_POST['vid_id']!="" ){
            if($_POST['vid_id']!=""){   
                $sql = "SELECT * FROM Playlist, video,channel WHERE Playlist.name LIKE '%".$_POST['vid_id']."%' OR channel.name LIKE '%".$_POST['vid_id']."%' OR video.name LIKE '%".$_POST['vid_id']."%'";
                $result = pg_query($db_connection, $sql);
                while ($row = pg_fetch_row($result)) {
                    var_dump($row);
                    echo "<br>";
                  }
            }
    }}
?>
<body>
            <div class="w-100">
<form action="" method="post" id="form">
    <div class="d-flex">
                <span class="col-2">add channel for user with ID?</span>
                <input class=" col-md-2 form-control" name="userid" type="text" placeholder="یوزرآیدی">
        </div>
            <div class="d-flex">
                <span class="col-2">اپلود ویدوئو در  کانال</span>
                <input class=" col-md-2 form-control" name="vid_id" type="text" placeholder=" متن">
                <input class="col-md-2 form-control alert-success" type="submit" name="submit" value="تایید">
            </div>

            </form>
            </div>
        </body>
</html>