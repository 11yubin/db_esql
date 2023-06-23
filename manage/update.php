<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>평점 수정</title>
        <style>input, button, select{font-size:20pt; margin:5px}</style>
    </head>

    <body>
        <center>
        <h1>평점 수정하기</h1>
        <hr><br>
        <form method="POST" action="update_show.php">
            아이디: <input type="text" name="id"/>
            <br><br>
            <button>수정하기</button>
        </form>
        <br><br>
        <button onclick="location.href='/manage.php';">이전페이지</button>
        <br><br>
        <!-- 현재 시간 표시 -->
        <?php
            date_default_timezone_set('Asia/Seoul');
            echo date("y-m-d, H:i:s");
        ?>        
        </center>
    </body>
</html>
    