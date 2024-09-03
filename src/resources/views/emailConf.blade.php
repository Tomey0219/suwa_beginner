@extends('layout.layout')

@section('ttl')
    EmailConfirmationPage    
@endsection

@section('css')
    <link rel="stylesheet" href="{{ asset('css/emailConf.css') }}">
@endsection

@section('header_btn')
    <div></div>
@endsection

@section('content')
    <div class="div_top">
        <h2>メール認証をお願いいたします</h2>

        <p class="p_top">
            ご登録いただいたメールアドレスにメールを送信しました<br>
            メールをご確認いただき、メールに記載されたURLをクリックして登録を完了してください。
        </p>
    </div>

    <div class="div_mid">
        <h4>メールが届かない場合</h4>

        <ul>
            <li>迷惑メールフォルダに振り分けけられていたり、フィルターや転送の設定によって受信ボックス以外の場所に保管されていないかご確認ください</li>
            <li>メールの配信に時間がかかる場合がございます。数分程度待った上でメールが届いているか再度ご確認ください</li>
        </ul>

        <h4>認証用メールを削除してしまった場合</h4>


        <form action="http://localhost/email/verification-notification" method="POST">
        @csrf
            <button class="remail_btn" type="submit">メールの再送信</button>
        </form>
    </div>

    <div class="div_loginlink_btn">
        <form action="http://localhost/logout" method="POST">
        @csrf
            <button class="loginlink_btn" type="submit">ログイン画面に戻る</button>
    </div>


@endsection