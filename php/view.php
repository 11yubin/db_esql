<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>view page</title>
        <style>
            button {font-size:10pt; margin:10px}
            select {font-size:10pt; margin-bottom:20px}
        </style>
    </head>

    <body>
        <center>
        <h1>커뮤니티에 등록된 영화</h1>
        <hr>       
        <br>
        <table border="1">
            <th>제목</th>
            <th>국가</th>
            <th>연도</th>
            <th>장르</th>
            <th>감독</th>
            <th>배우</th>
            <th>평점</th>
            <th>한줄평</th>

        <!-- mysql -->            
        <?php
        $con=mysqli_connect("localhost", name, pwd, dbname);
        if (mysqli_connect_errno()) {
            echo "Failed to connect to MySQL: " . mysqli_connect_error();
        }
        else { 
            $con=mysqli_connect("localhost", "root", "dbqlsl2232!", "esql_yubin");

            $result = mysqli_query($con,"SELECT * from community");
            while($row = mysqli_fetch_array($result)) {
        ?>
            <tr>
                <td><?=$row['title']?></a></td>
                <td><?=$row['country']?></td>
                <td><?=$row['makeyear']?></td>
                <td><?=$row['genre']?></td>
                <td><?=$row['dname']?></td>
                <td><?=$row['a1name']?>, <?=$row['a2name']?></td>
                <td><?=$row['score']?></td>
                <td><?=$row['cont']?></td>
            </tr>
        <?php }} mysqli_close($con);?>
        </table>
        <button onclick="location.href='/index.php';">이전페이지</button>
        <br>
        <!-- 현재 시간 표시 -->
        <?php
            date_default_timezone_set('Asia/Seoul');
            echo date("y-m-d, H:i:s ");
            echo "2115888 송유빈"
        ?>
        
        </center>
    </body>
</html>
    
