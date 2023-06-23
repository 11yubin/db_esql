<!DOCTYPE html>
<?php  
    $id=$_POST['id'];
    $mov=$_POST['mov'];
    $dir=$_POST['dir'];
    $act1=$_POST['act1'];
    $act2=$_POST['act2'];
    $sco=$_POST['sco'];
    $txt=$_POST['txt']; 
?>

<html>
    <head>
        <meta charset="UTF-8">
        <title>등록 결과</title>
    </head>

    <body>
    <center>
    <?php 
    $con=mysqli_connect("localhost", "root", "dbqlsl2232!", "esql_yubin");
    
    if (mysqli_connect_errno()) {
        echo "Failed to connect to MySQL: " . mysqli_connect_error();
    }
    
    else { 
        // sql query: rate 저장, actor/director 저장, movie 저장, rates/txts 뷰 수정, community 뷰 수정
        $sql="
        INSERT INTO rate VALUES('".$id."', '".$mov."', '".$sco."', '".$txt."');
        INSERT INTO actor(anum, name) VALUES ((select cnt from (select count(name)+1 as cnt from actor a) count), '".$act1."');
        INSERT INTO actor(anum, name) VALUES ((select cnt from (select count(name)+1 as cnt from actor a) count), '".$act2."');
        INSERT INTO director(dnum, name) VALUES((select cnt from (select count(name)+1 as cnt from director d) count), '".$dir."');
        INSERT INTO movie(mnum, title, director, actor1, actor2)
        VALUES ((select cnt from (select count(title)+1 as cnt from movie m) count), 
            '".$mov."',
            (select dnum from director where name='".$dir."'),
            (select anum from actor where name='".$act1."'),
            (select anum from actor where name='".$act2."'));
        CREATE OR REPLACE VIEW rates AS SELECT title, ROUND(AVG(score), 1) as score FROM rate GROUP BY title;
        CREATE OR REPLACE view txts as select rate.title, group_concat(txt separator ' / ') as cont from rate, movie
        where rate.title=movie.title group by rate.title;
        CREATE OR REPLACE VIEW community AS
            SELECT DISTINCT m.title, m.country, m.makeyear, m.genre, d.name dname, a1.name a1name, a2.name a2name, r.score, t.cont
            FROM movie m, actor a1, actor a2, director d, rates r, txts t
            WHERE a1.anum=m.actor1 and a2.anum=m.actor2 and d.dnum=m.director and r.title=m.title and t.title=m.title;";

        $result = mysqli_multi_query($con, $sql);
        mysqli_close($con);
    }
    ?>

    <h3><?=$id?>님의 후기가 성공적으로 등록되었습니다.</h3>
    <button onclick="location.href='/view.php';">목록에서 확인하기</button>
    <br><br>

    <button onclick="location.href='/manage/insert.php';">이전페이지</button>
    <br><br>
    <?php
        date_default_timezone_set('Asia/Seoul');
        echo date("y-m-d, H:i:s");
    ?>
    </center>
    </body>
</html>    

