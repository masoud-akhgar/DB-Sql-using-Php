<?php include_once "dbname.php"; global $connect;?>
<html>
<head>
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
<link rel="stylesheet" href="bootstrap.min.css">
</head>
<hr><a href="index.php">main page</a>
<h2>upload and delete video in channel:</h2>
<?php
    if(isset($_POST['vid_id']) || isset($_POST['vid_name'])){
        if($_POST['vid_id']!="" || $_POST['vid_name']!=""){
            
            if($_POST['vid_id']!=""){   
                $sql = "SELECT * FROM public.video WHERE video.id='".$_POST['vid_id']."'";
                $result = pg_query($db_connection, $sql);
                $id = pg_fetch_result($result, 0 , 0); $name = pg_fetch_result($result, 0 , 1); $date = pg_fetch_result($result, 0 , 2); 
                $desc = pg_fetch_result($result, 0 , 3); $len = pg_fetch_result($result, 0 , 4); 
                $len5 = pg_fetch_result($result, 0 , 5); $len6 = pg_fetch_result($result, 0 , 6); $watched_number = pg_fetch_result($result, 0 , 7); 
                $len8 = pg_fetch_result($result, 0 , 8); 
                $watched_number+=1;
                $sql = "UPDATE video SET id=".$id.",name='".$name."',date_of_load='".$date."',description='".$desc."',length='".$len."',thumbnail='".$len5."',
                comment_bin_id=".$len6.",watched_number=".$watched_number.",like_bin_id=".$len8." WHERE video.id=".$_POST['vid_id']."";
                $result = pg_query($db_connection, $sql);

            }else if($_POST['vid_name']!=""){
                $sql = "SELECT * FROM public.video WHERE video.name='".$_POST['vid_name']."'";
                $result = pg_query($db_connection, $sql);
                $id = pg_fetch_result($result, 0 , 0); $name = pg_fetch_result($result, 0 , 1); $date = pg_fetch_result($result, 0 , 2); 
                $desc = pg_fetch_result($result, 0 , 3); $len = pg_fetch_result($result, 0 , 4); 
                $len5 = pg_fetch_result($result, 0 , 5); $len6 = pg_fetch_result($result, 0 , 6); $watched_number = pg_fetch_result($result, 0 , 7); 
                $len8 = pg_fetch_result($result, 0 , 8); 
                $watched_number+=1;
                $sql = "UPDATE video SET id=".$id.",name='".$name."',date_of_load='".$date."',description='".$desc."',length='".$len."',thumbnail='".$len5."',
                comment_bin_id=".$len6.",watched_number='".$watched_number."',like_bin_id='".$len8."' WHERE video.name='".$_POST['vid_name']."'";
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
                <span class="col-2">اپلود ویدوئو در  کانال</span>
                <input class=" col-md-2 form-control" name="vid_id" type="text" placeholder=" آیدی ویدئو">
                <input class=" col-md-2 form-control" name="vid_name" type="text" placeholder=" نام ویدئو">
                <input class="col-md-2 form-control alert-success" type="submit" name="submit" value="دیدن ویدئو ">
            </div>

            </form>
            </div>
        </body>
</html>