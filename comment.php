<?php include_once "dbname.php"; global $connect;?>
<html>
<head>
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
<link rel="stylesheet" href="bootstrap.min.css">
</head>
<hr><a href="index.php">main page</a>
<h2>upload and delete comment in video:</h2>
<?php
    if( ((isset($_POST['vid_id']) ) && isset($_POST['comment']) && isset($_POST['userid'])) || ((isset($_POST['vid_id']) ) && isset($_POST['cm_id']) ) ){
        if(($_POST['vid_id']!="") ) {
            if(isset($_POST["submit"])){
                if($_POST['vid_id']!=""){   
                    if($_POST["comment_id"]!=""){
                        $sql = "INSERT INTO public.comment ( description, video_id, user_id, reply_id) VALUES ('".$_POST['comment']."','".$_POST['vid_id']."','".$_POST['userid']."','".$_POST['comment_id']."')";
                    }else{
                        $sql = "INSERT INTO public.comment ( description, video_id, user_id, reply_id) VALUES ('".$_POST['comment']."','".$_POST['vid_id']."','".$_POST['userid']."','0')";
                    }
                    
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
                }
            }
            
            if(isset($_POST["submit2"])){
                $sql="SELECT comment_bin_id FROM public.video WHERE video.id='".$_POST['vid_id']."'";
                $result = pg_query($db_connection, $sql);
                $bin_id = pg_fetch_result($result, 0 , 0); 
                echo $bin_id;
                echo $_POST['cm_id'];

                $sql = "UPDATE comment_bin 
                SET comment_id='0',id='".$bin_id."' 
                WHERE comment_id='".$_POST['cm_id']."'";
                //correct:
                // $sql ="DELETE FROM public.Playlist_Bin_id WHERE Playlist_Bin_id.id='".$bin_id."' and Playlist_Bin_id.video_id='".$_POST['vid_id']."'";
                // $result = pg_query($db_connection, $sql);
            }
            if(isset($_POST["submit3"])){
                $sql = "INSERT INTO public.comment ( description, video_id, user_id, reply_id) VALUES ('".$_POST['comment']."','".$_POST['vid_id']."','".$_POST['userid']."','".$_POST['comment_id']."')";
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
                //correct:
                // $sql ="DELETE FROM public.Playlist_Bin_id WHERE Playlist_Bin_id.id='".$bin_id."' and Playlist_Bin_id.video_id='".$_POST['vid_id']."'";
                // $result = pg_query($db_connection, $sql);
            }
        }
    }
?>
<body>
            <div class="w-100">
<form action="" method="post" id="form">
            <div class="d-flex">
            <span class="col-2">ارسال کامنت در ویددئو</span>
                <input class=" col-md-2 form-control" name="userid" type="text" placeholder="یوزرآیدی">
                <input class=" col-md-2 form-control" name="vid_id" type="text" placeholder=" آیدی ویدئو">
                <input class=" col-md-2 form-control" name="comment_id" type="text" placeholder=" ایدی کامنت دیگر">
                <input class=" col-md-2 form-control" name="comment" type="text" placeholder=" کامنت">
                <input class="col-md-2 form-control alert-success" type="submit" name="submit" value="ارسال کامنت">
            </div>
            </form>
    </div>

            <div class="w-100">
<form action="" method="post" id="form">
            <div class="d-flex">
            <span class="col-2">حذف کامنت</span>
                <input class=" col-md-2 form-control" name="vid_id" type="text" placeholder=" آیدی ویدئو">
                <input class=" col-md-2 form-control" name="cm_id" type="text" placeholder=" آیدی کامنت">
                <input class="col-md-2 form-control alert-success" type="submit" name="submit2" value="حذف کامنت">
            </div>
            </form>
            </div>
        </body>
</html>