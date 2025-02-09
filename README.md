# atte-system
勤怠登録システム

■環境構築
Dockerビルド<br>
1.git clone リンク<br>
2.dorker-compose up -d-build<br>
*MySQLは、OSによって起動しない場合があるのでそれぞれのPCに合わせてdocker-compose.ymlファイルを編集してください。<br>

Laravel環境構築<br>
1.docker-compose exec php bash<br>
2.composer install<br>
3.enc.exampleファイルから.envを作成し、環境変数を変更<br>
4.php artisan migrate<br>
5.php artisan db:seed<br>

■テストアカウント<br>
・testuser1<br>
  email：user1@attetest.com<br>
  PW：11111111<br>
・testuser2<br>
  email：user2@attetest.com<br>
  PW：11111111<br>

■使用技術<br>
・PHP 8.0<br>
・Laravel 10.0<br>
・MySQL 8.0<br>

■ER図<br>
![draw_io](https://github.com/user-attachments/assets/06515e16-0cdb-44f2-a8f8-86cec1d4438b)

■URL<br>
・開発環境:http://localhost/<br>
・phpMyAdmin：http://localhost:8080/<br>
