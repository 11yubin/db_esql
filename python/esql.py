import pymysql

# db 연결
db = pymysql.connect(host='localhost', user='root', db='esql_yubin', password='dbqlsl2232!', charset='utf8', 
                    client_flag=pymysql.constants.CLIENT.MULTI_STATEMENTS)
curs = db.cursor()

# 안내 함수
def guide():
    print("검색, 평점 등록, 평점 삭제, 평점 수정 작업을 할 수 있습니다.")
    print("검색하고 싶다면 <검색>이라는 단어를, 평점 등록을 원하신다면 <등록>이라는 단어를,")
    print("평점을 삭제하고 싶다면 <삭제>라는 단어를, 평점 수정을 원하신다면 <수정>이라는 단어를,")
    print("평점 목록을 보고싶다면 <보기>라는 단어를 입력해주세요.")
    print("프로그램을 종료하고 싶다면 <종료>라는 단어를 입력해주세요.\n\n")

    
# 명령에 따라 쿼리를 만드는 함수
def query(mtd):
    # 이미 존재하는 영화 제목 리스트를 미리 설정하여 등록, 삭제, 수정 확인에 사용
    t_sql = "SELECT m.title FROM movie m;"
    curs.execute(t_sql)
    titles = list(c[0] for c in curs.fetchall())

    # 이미 존재하는 아이디 리스트를 생성
    i_sql = "SELECT userid FROM rate;"
    curs.execute(i_sql)
    global ids
    ids = list(c[0] for c in curs.fetchall())

    # movie, actor, director 테이블에 새로운 값을 추가할 때 Primary key를 설정하기 위해, 현재 등록된 값들 중 가장 마지막 pk를 찾음
    m_sql = "SELECT m.mnum FROM movie m;"
    curs.execute(m_sql)
    nums = (curs.fetchall())
    m_lnum = int(nums[-1][0])

    a_sql = "SELECT a.anum FROM actor a;"
    curs.execute(a_sql)
    nums = curs.fetchall()
    a_lnum = int(nums[-1][0])

    d_sql = "SELECT d.dnum FROM director d;"
    curs.execute(d_sql)
    nums = curs.fetchall()
    d_lnum = int(nums[-1][0])

    sql = ""
    data = ()

    if mtd == "검색":
        n = input("검색하고 싶은 항목을 알려주세요. 배우는 a, 영화 제목은 m, 감독은 d를 입력해주세요.")

        if (n=="a"):
            try:            
                act = input("배우 이름을 입력하세요.\n")
                sql = "SELECT * FROM community c WHERE c.a1name=%s or c.a2name=%s;";
                curs.execute(sql, (act, act))

                result = curs.fetchall()
                for r in result:
                    print(r)
                print()
            except: print("해당 배우가 참여한 영화가 데이터베이스에 존재하지 않습니다.")


        elif (n=="d"):
            try:
                dir = input("감독 이름을 입력하세요.\n")
                sql = "SELECT * FROM community c WHERE c.dname=%s;";
                curs.execute(sql, dir)

                result = curs.fetchall()
                for r in result:
                    print(r)
                print()

            except: print("해당 감독이 만든 영화가 데이터베이스에 존재하지 않습니다.")

        elif (n=="m"):
            try:           
                mov = input("영화 제목 키워드를 입력하세요.\n")
                sql = "SELECT * FROM community c WHERE c.title REGEXP %s;";
                curs.execute(sql, mov)
                
                result = curs.fetchall()
                for r in result:
                    print(r)
                print()
            except: print("해당 키워드를 가진 영화가 데이터베이스에 존재하지 않습니다.")


        else: 
            print("알파벳을 잘못 입력하였습니다. 처음부터 다시 시작해주세요.")
            

    elif mtd == "등록":
        print("평점을 등록할 영화 제목을 정확히 입력해주세요.")

        title = input()
        if title in (titles):
            print("이미 있는 영화입니다.\n평점과 한줄평을 입력해주세요.")
            rate(title)

        else: 
            print("새로 등록해주세요.")
            dir = input("감독: ")
            act1 = input("배우: ")
            act2 = input("배우: ")

            # 새로운 배우 정보 등록
            actors = [(a_lnum+1, act1), (a_lnum+2, act2)]
            sql = "INSERT INTO actor(anum, name) VALUES (%s, %s);"
            curs.executemany(sql, actors)

            # 새로운 감독 정보 등록
            sql = "INSERT INTO director(dnum, name) VALUES (%s, %s);"
            curs.execute(sql, (d_lnum+1, dir))

            # 새로운 영화 정보 등록
            data = (m_lnum+1, title, a_lnum+1, a_lnum+2, d_lnum+1)
            sql = "INSERT INTO movie(mnum, title, actor1, actor2, director) VALUES(%s, %s, %s, %s, %s);"
            curs.execute(sql, data)

            print("영화가 등록되었습니다. 해당 영화에 대한 평점을 등록해주세요.\n")

            rate(title)

    elif mtd == "삭제":
        id = input("아이디를 입력하세요. ")
        if id not in ids: print("등록되지 않은 아이디입니다.")
        else: 
            sql = "SELECT title FROM rate WHERE userid=%s;"
            curs.execute(sql, id)
            title = curs.fetchone()[0]

            print("%s 영화에 대한 평점을 삭제합니다." %title)
            sql = "DELETE FROM rate WHERE userid=%s"
            curs.execute(sql, id)
            print("삭제가 완료되었습니다. \n")

    elif mtd == "수정":
        id = input("아이디를 입력하세요. ")
        if id not in ids: print("등록되지 않은 아이디입니다.")
        else:
            sql = "SELECT title FROM rate WHERE userid=%s"
            curs.execute(sql, id)
            title = curs.fetchone()[0]
            print("%s 영화에 대한 평점을 수정합니다." %title)

            score = input("새로운 평점을 0.0 ~ 5.0 사이로 입력하세요. ")
            txt = input("새로운 한줄평을 입력하세요. ")
            data = (txt, score, id)
            sql = "UPDATE rate SET txt=%s, score=%s WHERE userid=%s"
            curs.execute(sql, data)
            sql = """
            CREATE OR REPLACE VIEW rates AS
                SELECT title, ROUND(AVG(score), 1) as score FROM rate GROUP BY title;
            SELECT * FROM rates;
            CREATE OR REPLACE view txts as select rate.title, group_concat(txt separator ' / ') as cont from rate, movie
            where rate.title=movie.title group by rate.title;
            select * from txts;
            CREATE OR REPLACE VIEW community AS
                SELECT m.title, m.country, m.makeyear, m.genre, d.name dname, a1.name a1name, a2.name a2name, r.score, t.cont
                FROM movie m, actor a1, actor a2, director d, rates r, txts t
                WHERE a1.anum=m.actor1 and a2.anum=m.actor2 and d.dnum=m.director and r.title=m.title and t.title=m.title;
            """
            curs.execute(sql)
            print("수정이 완료되었습니다. \n")
            print()

    
    elif mtd=="보기":
        sql = "SELECT * FROM community;"
        curs.execute(sql)
        result = curs.fetchall()
        for res in result:
            for r in res:
                if r is not None:
                    print(r, end=', ')
            print()

    elif mtd == "종료":
        print("프로그램이 종료되었습니다.")
        return 0
    
    else: 
        print("잘못된 방법을 입력하였습니다. 다시 입력해주세요.")
        mtd = input()
        query(mtd)
    
# 평점 등록 함수
def rate(title):
    id = input("당신의 아이디를 입력하세요. ")
    if id in ids: print("이미 존재하는 아이디입니다. 등록할 수 없습니다."); return 0
    score = input("0.0 ~ 5.0까지 자유롭게 평점을 입력하세요. ")
    txt = input("한줄평을 입력하세요. ")

    sql = "INSERT INTO rate VALUES(%s, %s, %s, %s);"
    data = (id, title, score, txt)
    curs.execute(sql, data)
    curs.execute("SELECT * FROM rate;")
    print("등록이 완료되었습니다.\n")

def main():
    print("2115888 송유빈이 만든 영화 커뮤니티 입니다.\n")
    guide()
    mtd = input()

    query(mtd)
    db.commit()
    db.close()
    

main()