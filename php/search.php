<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>검색</title>
        <style>input, button, select{font-size:20pt; margin:5px}</style>
    </head>

    <body>
        <center>
        <h1>검색하기</h1>
        <h3>검색하고 싶은 분야를 고르고, 키워드를 입력하세요</h3>
        <hr><br>
        <form method="POST" action="search_show.php">
        <select name="mtd">
            <option value='movie'>영화</option>
            <option value='director'>감독</option>
            <option value='actor'>배우</option>
        </select>

        <input type='text' name="key"/>
        <button>검색하기</button>
        </form>

        <br><br>
        <button onclick="location.href='/index.php';">이전페이지</button>
        <br><br>
        <?php
            date_default_timezone_set('Asia/Seoul');
            echo date("y-m-d, H:i:s");
        ?>
        </center>
    </body>
</html>
    