<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>수정 결과</title>
    </head>
    <body><center>
        <?php
            $id=$_GET['id'];
            $sco=$_POST['sco'];
            $txt=$_POST['txt']; 
        
            $con=mysqli_connect("localhost", "root", "dbqlsl2232!", "esql_yubin");
    
            if (mysqli_connect_errno()) {
                echo "Failed to connect to MySQL: " . mysqli_connect_error();
            }
            
            else { 
                $sql="UPDATE rate SET txt='".$txt."', score=".intval($sco)." WHERE userid='".$id."'";
                mysqli_query($con, $sql);
            }?>
                        
        <h3><?=$id?> 님의 후기가 성공적으로 수정되었습니다.</h3>
        <button onclick="location.href='/view.php';">목록에서 확인하기</button>
        <br><br>
    </center></body>
</html>