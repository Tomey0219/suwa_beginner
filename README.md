#勤怠管理システム
　各従業員の勤務開始/終了時間、休憩開始/終了時間を記録するシステム

 ![app_image](https://github.com/user-attachments/assets/12525de4-5154-40b6-827d-942b50ba85f2)

#目的
　人事評価のため

#アプリケーションURL
　・勤怠打刻ページ：http://localhost/
　・ログインページ：http://localhost/login
　・会員登録ページ：http://localhost/register
　・日付別勤怠ページ：http://localhost/attendance
　・ユーザ一覧ページ（追加実装項目）：http://localhost/alluser
　・ユーザ別勤怠ページ（追加実装項目）：http://localhost/eachuser

#機能一覧
　・会員登録
　・ログイン
　・ログアウト
　・勤務開始/終了
　・休憩開始/終了
　・日付別勤怠情報閲覧
　・ユーザ別勤怠情報閲覧

#使用技術

　・php:7.4.9
　・Laravel:8.83.27
　・mysql:8.0.26
  ・nginx:1.21.1

#テーブル設計

![table_stracture](https://github.com/user-attachments/assets/3cbce79a-e022-4f68-9aec-b53a117c764b)

#ER図

![ER_diagram](https://github.com/user-attachments/assets/9b23bd58-faa2-4138-b7f8-64a5cdc06a2d)

#環境構築

　1. docker-compose exec php bash
　2. composer install
　3. .env.exampleファイルから.envを作成し、環境変数を変更
　4. 時間設定を変更・・・app.phpの'timezone'を変更し、"$ php artisan tinker"
　5. php artisan key:generate
　6. php artisan migrate
　7. php artisan db:seed
