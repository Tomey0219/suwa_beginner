#勤怠管理システム
　各従業員の勤務開始/終了時間、休憩開始/終了時間を記録するシステム

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
　・ログイン（メール認証）
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


#ER図

#環境構築

　1. docker-compose up -d --build
　2. docker-compose exec php bash
　3. composer install
　4. .env.exampleファイルから.envを作成し、環境変数を変更
　5. 時間設定を変更・・・app.phpの'timezone'を変更し、"$ php artisan tinker"
　6. php artisan key:generate
　7. php artisan migrate
