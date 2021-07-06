<?php include_once "dbname.php"; global $connect;?>
<html>
<head>
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
<link rel="stylesheet" href="bootstrap.min.css">
</head>
<hr><a href="index.php">main page</a>
<h2>upload and delete video in channel:</h2>
<?php
    if( (isset($_POST['vid_id']) || isset($_POST['vid_name']) ) && isset($_POST['comment']) && isset($_POST['userid']) ){
        if(($_POST['vid_id']!="" || $_POST['vid_name']!="") && $_POST['comment']!="" ) {
            
            if($_POST['vid_id']!=""){   
                $sql = "INSERT INTO public.comment ( description, video_id, user_id, reply_id) VALUES ('".$_POST['comment']."','".$_POST['vid_id']."','".$_POST['userid']."','0')";
                $result = pg_query($db_connection, $sql);

                $sql="SELECT * FROM comment";
                $result = pg_query($db_connection, $sql);
                $rows = pg_num_rows($result);   //num row
                $comment_id = pg_fetch_result($result, $rows-1 , 0);   // last id

                $sql="SELECT comment_bin_id FROM public.video WHERE video.id='".$_POST['vid_id']."'";
                $result = pg_query($db_connection, $sql);
                $bin_id = pg_fetch_result($result, 0 , 0); 

                $sql ="INSERT INTO public.comment_bin (comment_id,id) VALUES ('".$comment_id."','".$bin_id."')";
                $result = pg_query($db_connection, $sql);

            }else if($_POST['vid_name']!=""){
                $sql = "SELECT video.id FROM public.video WHERE video.name='".$_POST['vid_name']."'";
                $result = pg_query($db_connection, $sql);
                $id = pg_fetch_result($result, 0 , 0); 

                $sql = "INSERT INTO public.comment ( description, video_id, user_id, reply_id) VALUES ('".$_POST['comment']."','".$id."','".$_POST['userid']."','0')";
                $result = pg_query($db_connection, $sql);

                $sql="SELECT * FROM comment";
                $result = pg_query($db_connection, $sql);
                $rows = pg_num_rows($result);   //num row
                $comment_id = pg_fetch_result($result, $rows-1 , 0);   // last id

                $sql="SELECT comment_bin_id FROM public.video WHERE video.id='".$id."'";
                $result = pg_query($db_connection, $sql);
                $bin_id = pg_fetch_result($result, 0 , 0); 

                $sql ="INSERT INTO public.comment_bin (comment_id,id) VALUES ('".$comment_id."','".$bin_id."')";
                $result = pg_query($db_connection, $sql);

            }
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
                <input class=" col-md-2 form-control" name="vid_name" type="text" placeholder=" نام ویدئو">
                <input class=" col-md-2 form-control" name="comment" type="text" placeholder=" کامنت">
                <input class="col-md-2 form-control alert-success" type="submit" name="submit" value="ارسال کامنت">
            </div>
            </form>
            </div>
        </body>
</html>