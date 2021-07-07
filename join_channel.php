<?php include_once "dbname.php"; global $connect;?>
<html>
<head>
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
<link rel="stylesheet" href="bootstrap.min.css">
</head>
<hr><a href="index.php">main page</a>
<h2>create channel:</h2>
<?php
    if (isset($_POST['chan_id']) && isset($_POST['userid'])){
        if ($_POST['chan_id']!="" && $_POST['userid']!=""){
            if(isset($_POST["submit"])){
            $sql="SELECT user_bin_Channel_id FROM users WHERE users.id='".$_POST['userid']."'";
            $result = pg_query($db_connection, $sql);
            $bin_id = pg_fetch_result($result, 0 , 0); 
            $sql ="INSERT INTO user_bin_Channel (id, channel_membership_id, channel_created_id) VALUES ('".$bin_id."','".$_POST['chan_id']."','0')";
            $result = pg_query($db_connection, $sql);

            $sql="SELECT channel_bin_member_id FROM channel WHERE channel.id='".$_POST['chan_id']."'";
            $result = pg_query($db_connection, $sql);
            $bin_id = pg_fetch_result($result, 0 , 0); 

            $sql ="INSERT INTO channel_bin_member (id, member_id) VALUES ('".$bin_id."','".$_POST['userid']."')";
            $result = pg_query($db_connection, $sql);

            }
            if(isset($_POST["submit2"])){
                $sql="SELECT user_bin_Channel_id FROM users WHERE users.id='".$_POST['userid']."'";
                $result = pg_query($db_connection, $sql);
                $bin_id = pg_fetch_result($result, 0 , 0); 
                $sql ="DELETE FROM user_bin_Channel WHERE user_bin_Channel.id='".$bin_id."' and user_bin_Channel.channel_membership_id='".$_POST['chan_id']."'";
                $result = pg_query($db_connection, $sql);

                $sql="SELECT channel_bin_member_id FROM channel WHERE channel.id='".$_POST['chan_id']."'";
                $result = pg_query($db_connection, $sql);
                $bin_id = pg_fetch_result($result, 0 , 0); 

                $sql ="DELETE FROM channel_bin_member WHERE channel_bin_member.id='".$bin_id."' and channel_bin_member.member_id='".$_POST['userid']."'";
                $result = pg_query($db_connection, $sql);
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
                <span class="col-2">عضو</span>
                <input class=" col-md-2 form-control" name="chan_id" type="text" placeholder="ایدی کانال">
                </div><input class="offset-2 col-md-2 form-control alert-success" type="submit" name="submit" value="ثبت">
                <input class="offset-2 col-md-2 form-control alert-success" type="submit" name="submit2" value="کنسل عضویت">
            </form>
            </div>
            </body>
</html>