<!DOCTYPE html>
<?php  
    $key=$_POST['key'];
    $option = filter_input(INPUT_POST, 'mtd', FILTER_DEFAULT);
?>

<html>
    <head>
        <meta charset="UTF-8">
        <title>검색 결과</title>
    </head>

    <body>
    <center>
    <h1><?=$key?> 검색 결과</h1>
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
    $con=mysqli_connect("localhost", "root", "dbqlsl2232!", "esql_yubin");
    
    if (mysqli_connect_errno()) {
        echo "Failed to connect to MySQL: " . mysqli_connect_error();
    }

    else { 
        $sql = "";
        if ($option== "movie") {
            $sql="SELECT * FROM community c WHERE c.title REGEXP '".$key."'";
        }
        else if ($option=="director") {
            $sql="SELECT * FROM community c WHERE dname= '".$key."'";
        }
        else if ($option=="actor") {
            $sql="SELECT * FROM community c WHERE a1name = '".$key."' or a2name = '".$key."'";
        }
        $result = mysqli_query($con,$sql);
        while($row = mysqli_fetch_array($result)) { ?>
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
    <?php }}?>

    <button onclick="location.href='/search.php';">이전페이지</button>
    <br><br>
    <?php
        date_default_timezone_set('Asia/Seoul');
        echo date("y-m-d, H:i:s");
    ?>
    </center>
    </body>
</html>    

