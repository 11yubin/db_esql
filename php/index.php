<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>index page</title>
        <style>
            button {font-size:20pt; padding:10px; margin-bottom:30px; margin-left:5px}
        </style>
    </head>

    <body>
        <center>
        <h2>2115888 송유빈의</h2>
        <h1>영화 커뮤니티에 오신 것을 환영합니다</h1>
        <hr>
        <br>
        <button onclick="location.href='/manage.php';">평점 등록/관리</button>
        <button onclick="location.href='/view.php';">전체 글 보기</button>
        <button onclick="location.href='/search.php';">검색하기</button>
        <br>
        <!-- 현재 시간 표시 -->
        <?php
            date_default_timezone_set('Asia/Seoul');
            echo date("y-m-d, H:i:s");
        ?>
        </center>
    </body>
</html>
    