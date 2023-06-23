<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>평점 관리</title>
        <style>button {font-size:20pt; padding:10px; margin-bottom:30px; margin-left:5px}</style>
    </head>

    <body>
        <center>
        <h1>평점 등록/수정/삭제하기</h1>
        <h3>평점 등록/수정/삭제 중 원하는 것을 선택하세요</h3>
        <hr><br>

        <button onclick="location.href='/manage/insert.php';">등록하기</button>
        <button onclick="location.href='/manage/update.php';">수정하기</button>
        <button onclick="location.href='/manage/delete.php';">삭제하기</button>
        <br><br>
        <button onclick="location.href='/index.php';">이전페이지</button>
        <br><br>
        <!-- 현재 시간 표시 -->
        <?php
            date_default_timezone_set('Asia/Seoul');
            echo date("y-m-d, H:i:s");
        ?>        
        </center>
    </body>
</html>
    