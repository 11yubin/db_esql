<!DOCTYPE html>
<?php  
    $id=$_POST['id'];

    $con=mysqli_connect("localhost", name, pwd, dbname);
    
    if (mysqli_connect_errno()) {
        echo "Failed to connect to MySQL: " . mysqli_connect_error();
    }
    
    else { 
?>

<html>
    <head>
        <meta charset="UTF-8">
        <title>수정 가능 여부</title>
        <style>input, button, select{font-size:20pt; margin:5px; margin-bottom:15px}</style>
    </head>

    <body>
    <center>
    <?php 
        $sql="SELECT IF(EXISTS (SELECT userid FROM rate WHERE userid='".$id."'), 1, 0) as result;";
        # res는 id가 존재하는지 여부를 판단하는 변수. 있으면 1을 갖고, 없으면 0을 갖도록 쿼리를 만들어줌
        $res = mysqli_fetch_array(mysqli_query($con, $sql))[0];
        
        if ($res==1) { 
            $mov = mysqli_fetch_array(mysqli_query($con, "SELECT title FROM rate WHERE userid='".$id."'"))[0]
            ?>
            <h4>영화 제목: <?=$mov?></h4>
            <form method="POST" action="update_result.php?id=<?=$id?>">
                평점: <input type="text" name="sco"/>
                한줄평: <input type="text" name="txt"/>
                <button>수정하기</button>
            </form>
        <?php }
        else echo "<h3>등록되지 않은 아이디입니다. 등록 먼저 해주세요.</h3><br><button onclick=\"location.href='/manage/insert.php';\">등록하러 가기</button>";
    }
    ?>


    <button onclick="location.href='/manage/update.php';">이전페이지</button>
    <br><br>
    <?php
        date_default_timezone_set('Asia/Seoul');
        echo date("y-m-d, H:i:s");
    ?>
    </center>
    </body>
</html>    

