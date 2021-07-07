<?php include_once "dbname.php"; global $connect;?>
<html>
<head>
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
<link rel="stylesheet" href="bootstrap.min.css">
</head>
<hr><a href="index.php">main page</a>
<h2>create channel:</h2>
<?php
    if (isset($_POST['chan_id'])){
        if ($_POST['chan_id']!="" ){
            $sql="SELECT channel_bin_member_id FROM channel WHERE channel.id='".$_POST['chan_id']."'";
            $result = pg_query($db_connection, $sql);
            $bin_id = pg_fetch_result($result, 0 , 0); 

            $sql="SELECT member_id FROM channel_bin_member WHERE channel_bin_member.id='".$bin_id."'";
            $result = pg_query($db_connection, $sql);
            $rows = pg_num_rows($result); 

            $member_id=array("");
            for ($i=0;$i<$rows;$i+=1){
                array_push($member_id, pg_fetch_array($result, $i, $result_type = PGSQL_BOTH)[0]);
            }
            echo "user id joined in channel:<br>";
            for ($i=0;$i<sizeof($member_id);$i+=1){
                $tmp = (int)$member_id[$i];
                if($rows!=0){
                    echo "      - ".$tmp."";
                    echo "<br>";
                }
            }
}}
?>
<body>
<div class="w-100">
<form action="" method="post" id="form">
            <div class="d-flex">
                <input class=" col-md-2 form-control" name="chan_id" type="text" placeholder="ایدی">
                </div><input class=" col-md-2 form-control alert-success" type="submit" value="ثبت ">
            </form>
            </div>
            </body>
</html>