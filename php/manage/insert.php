<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>upload page</title>
        <style>
            button {font-size:20pt; padding:10px; margin-bottom:30px; margin-left:5px}
            input {font-size:20pt; margin:5px}
        </style>
    </head>

    <body>
        <center>
        <h1>재미있게 보신 영화의 후기를 작성해주세요.</h1>
        <hr><br>
        <form method="POST" action="insert_show.php">
            아이디: <input type="text" name="id"/><br>
            영화 제목: <input type="text" name="mov"/><br>
            감독 이름: <input type="text" name="dir"/><br>
            배우 이름: <input type="text" name="act1"/><br>
            배우 이름: <input type="text" name="act2"/><br>
            점수: <input type="text" name="sco"/><br>
            한줄평: <input type="text" name="txt"/><br/>

            <button>등록하기</button>
        </form>

        <button onclick="location.href='/manage.php';">이전페이지</button><br><br>
        <!-- 현재 시간 표시 -->
        <?php
            date_default_timezone_set('Asia/Seoul');
            echo date("y-m-d, H:i:s");
        ?>        
        </center>
    </body>
</html>
    