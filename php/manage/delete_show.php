<!DOCTYPE html>
<?php  
    $id=$_POST['id'];

    $con=mysqli_connect("localhost", "root", "dbqlsl2232!", "esql_yubin");
    
    if (mysqli_connect_errno()) echo "Failed to connect to MySQL: " . mysqli_connect_error();
    else { 
?>

<html>
    <head>
        <meta charset="UTF-8">
        <title>삭제 결과</title>
        <style>input, button, select{font-size:20pt; margin:5px}</style>
    </head>

    <body>
    <center>
    <?php 
        $sql="SELECT IF(EXISTS (SELECT userid FROM rate WHERE userid='".$id."'), 1, 0) as result;";
        # res는 id가 존재하는지 여부를 판단하는 변수. 있으면 1을 갖고, 없으면 0을 갖도록 쿼리를 만들어줌
        $res = mysqli_fetch_array(mysqli_query($con, $sql))[0];
        
        if ($res==1) { 
            mysqli_query($con, "DELETE FROM rate WHERE userid='".$id."'")
            ?>
            <h3><?=$id?> 님의 후기가 성공적으로 삭제되었습니다.</h3><br><br>
            <button onclick="location.href='/view.php';">목록에서 확인하기</button>
            <button onclick="location.href='/index.php';">처음으로 돌아가기</button>
        <?php }
        else echo "<h3>등록되지 않은 아이디입니다. 등록 먼저 해주세요.</h3><br><button onclick=\"location.href='/manage/insert.php';\">등록하러 가기</button>";
    }
    ?>


    <button onclick="location.href='/manage/delete.php';">이전페이지</button>
    <br><br>
    <?php
        mysqli_close($con);

        date_default_timezone_set('Asia/Seoul');
        echo date("y-m-d, H:i:s");
    ?>
    </center>
    </body>
</html>    

