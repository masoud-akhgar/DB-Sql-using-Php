<?php include_once "dbname.php"; global $connect;?>
<html>
<head>
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
<link rel="stylesheet" href="bootstrap.min.css">
</head>
<hr><a href="index.php">main page</a>
<h2>detail:</h2>
<?php
    if( (isset($_POST['vid_id']) )){
        if(($_POST['vid_id']!="" ) ){
            if($_POST['vid_id']!=""){
                $sql="SELECT watched_bin_id FROM video WHERE video.id='".$_POST['vid_id']."'";
                $result = pg_query($db_connection, $sql);
                $bin_id = pg_fetch_result($result, 0 , 0); 

                $sql="SELECT * FROM watched_bin WHERE watched_bin.id='".$bin_id."'";
                $result = pg_query($db_connection, $sql);
                $rows = pg_num_rows($result); 
                echo "watched number: ".$rows."<br>";

                $sql="SELECT like_bin_id FROM video WHERE video.id='".$_POST['vid_id']."'";
                $result = pg_query($db_connection, $sql);
                $bin_id = pg_fetch_result($result, 0 , 0); 

                $sql="SELECT * FROM like_bin WHERE like_bin.id='".$bin_id."' and like_bin.liked='1'";
                $result = pg_query($db_connection, $sql);
                $rows = pg_num_rows($result); 
                echo "liked number: ".$rows."<br>";

                $sql="SELECT like_bin_id FROM video WHERE video.id='".$_POST['vid_id']."'";
                $result = pg_query($db_connection, $sql);
                $bin_id = pg_fetch_result($result, 0 , 0); 

                $sql="SELECT * FROM like_bin WHERE like_bin.id='".$bin_id."' and like_bin.liked='0'";
                $result = pg_query($db_connection, $sql);
                $rows = pg_num_rows($result); 
                echo "disliked number: ".$rows."<br>";
//////////////////////////////////////////////////
                echo "<h4>comments:</h4>";
                $sql="SELECT comment_bin_id FROM video WHERE video.id='".$_POST['vid_id']."'";
                $result = pg_query($db_connection, $sql);
                $bin_id = pg_fetch_result($result, 0 , 0); 

                $sql="SELECT comment_bin.comment_id FROM comment_bin WHERE comment_bin.id='".$bin_id."'";
                $result = pg_query($db_connection, $sql);
                $rows = pg_num_rows($result); 
                
                $commnet_id=array("");
                for ($i=0;$i<$rows;$i+=1){
                    array_push($commnet_id, pg_fetch_array($result, $i, $result_type = PGSQL_BOTH)[0]);
                }
                for ($i=0;$i<sizeof($commnet_id);$i+=1){
                    $tmp = (int)$commnet_id[$i];
                    $sql="SELECT description FROM comment WHERE comment.id='".$tmp."'";
                    $result = pg_query($db_connection, $sql);
                    $rows = pg_num_rows($result); 
                    if($rows!=0){
                        $desc = pg_fetch_result($result, 0 , 0); 
                        echo "      - ".$desc."";
                        echo "<br>";
                    }
                }
                
                // $sql ="INSERT INTO video_Bin_id (id,video_id) VALUES ('".$bin_id."','".$_POST['vid_id']."')";
                // $result = pg_query($db_connection, $sql);
            }
        }
    }
?>
<body>
<div class="w-100">
<form action="" method="post" id="form">
            <div class="d-flex">
                <span class="col-2"> ویدوئو </span>
                <input class=" col-md-2 form-control" name="vid_id" type="text" placeholder=" آیدی ویدئو">
                <br>
            </div>
                <input class="offset-4 col-md-2 form-control alert-success" type="submit" name="submit" value="جزییات  ">
            </form>
            </div>
        </body>
</html>