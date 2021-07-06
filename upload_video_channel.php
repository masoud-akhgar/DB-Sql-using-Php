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
            if($_POST['vid_id']!="" && $_POST['chan_id']!="" && isset($_POST["submit"])){
                $sql="SELECT channel_bin_video_id FROM public.channel WHERE public.channel.id='".$_POST['chan_id']."'";
                $result = pg_query($db_connection, $sql);
                $bin_id = pg_fetch_result($result, 0 , 0); 
                $sql ="INSERT INTO public.channel_bin_video(id,video_id) VALUES ('".$bin_id."','".$_POST['vid_id']."')";
                $result = pg_query($db_connection, $sql);

            }else if($_POST['vid_name']!="" && $_POST['chan_name']!="" && isset($_POST["submit"])){
                $sql="SELECT channel_bin_video_id FROM public.channel WHERE public.channel.name='".$_POST['chan_name']."'";
                $result = pg_query($db_connection, $sql);
                $bin_id = pg_fetch_result($result, 0 , 0); 
                $sql="SELECT video.id FROM public.video WHERE public.video.name='".$_POST['vid_name']."'";
                $result = pg_query($db_connection, $sql);
                $vid_id = pg_fetch_result($result, 0 , 0); 
                $sql ="INSERT INTO public.channel_bin_video(id,video_id) VALUES ('".$bin_id."','".$vid_id."')";
                $result = pg_query($db_connection, $sql);



            }else if($_POST['vid_id']!="" && $_POST['chan_id']!="" && isset($_POST["submit2"])){
                $sql="SELECT channel_bin_video_id FROM public.channel WHERE public.channel.id='".$_POST['chan_id']."'";
                $result = pg_query($db_connection, $sql);
                $bin_id = pg_fetch_result($result, 0 , 0); 
                $sql ="DELETE FROM public.channel_bin_video WHERE channel_bin_video.id='".$bin_id."' and channel_bin_video.video_id='".$_POST['vid_id']."'";
                $result = pg_query($db_connection, $sql);

            }else if($_POST['vid_name']!="" && $_POST['chan_name']!="" && isset($_POST["submit2"])){
                $sql="SELECT channel_bin_video_id FROM public.channel WHERE public.channel.name='".$_POST['chan_name']."'";
                $result = pg_query($db_connection, $sql);
                $bin_id = pg_fetch_result($result, 0 , 0); 
                $sql="SELECT video.id FROM public.video WHERE public.video.name='".$_POST['vid_name']."'";
                $result = pg_query($db_connection, $sql);
                $vid_id = pg_fetch_result($result, 0 , 0); 

                $sql ="DELETE FROM public.channel_bin_video WHERE channel_bin_video.id='".$bin_id."' and channel_bin_video.video_id='".$vid_id."'";
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
                <br>
                <input class=" col-md-2 form-control" name="chan_id" type="text" placeholder=" آیدی کانال">
            </div>
            <div class="d-flex">
                <span class="col-2">اپلود ویدوئو در  کانال</span>
                <input class=" col-md-2 form-control" name="vid_name" type="text" placeholder=" نام ویدئو">
                <br>
                <input class=" col-md-2 form-control" name="chan_name" type="text" placeholder=" نام کانال">
            </div>
                <input class="offset-4 col-md-2 form-control alert-success" type="submit" name="submit" value="اپلود ویدئو در کانال ">
                <input class="offset-4 col-md-2 form-control alert-success" type="submit" name="submit2" value="حذف ویدئو در کانال ">
            </form>
            </div>
        </body>
</html>