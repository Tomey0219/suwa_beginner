@extends('layout.layout')

@section('ttl')
    RegisterPage    
@endsection

@section('css')
    <link rel="stylesheet" href="{{ asset('css/register.css') }}">
@endsection

@section('header_btn')
    <div></div>
@endsection

@section('content')
    <h2>会員登録</h2>

    <form class="form_reg_tbl" action="/register" method="post">
    @csrf
        <table class="reg_tbl">
            <tr>
                <td>
                    <input class="reg_tbl_input" type="text" name="name" placeholder="名前" value="{{ old('name') }}" >
                </td>
            </tr>
            <tr>
                <td class="reg_tbl_margin">
                    @error('name')
                        @foreach ($errors->get('name') as $error)
                            {{ $error }}
                        @endforeach
                    @enderror
                </td>
            </tr>
            <tr>
                <td>
                    <input class="reg_tbl_input" type="text" name="email" placeholder="メールアドレス" value="{{ old('email') }}" >
                </td>
            </tr>
            <tr>
                <td class="reg_tbl_margin">
                    @error('email')
                        @foreach ($errors->get('email') as $error)
                            {{ $error }}
                        @endforeach
                    @enderror
                </td>
            </tr>
            <tr>
                <td>
                    <input class="reg_tbl_input" type="text" name="password" placeholder="パスワード">
                </td>
            </tr>
            <tr>
                <td class="reg_tbl_margin">
                    @error('password')
                        @foreach ($errors->get('password') as $error)
                            {{ $error }}
                        @endforeach
                    @enderror
                </td>
            </tr>
            <tr>
                <td>
                    <input class="reg_tbl_input" type="text" name="password_confirmation" placeholder="確認用パスワード">
                </td>
            </tr>
            <tr>
                <td class="reg_tbl_margin">
                    @error('password_confirmation')
                        @foreach ($errors->get('password_confirmation') as $error)
                            {{ $error }}
                        @endforeach
                    @enderror
                </td>
            </tr>
            <tr>
                <td>
                    <button class="reg_btn" type="submit">会員登録</button>
                </td>
            </tr>
            <tr><td class="reg_tbl_margin"></td></tr>
            <tr>
                <td class="reg_tbl_loginlink">
                    <p>アカウントをお持ちの方はこちらから</p>
                    <a class="reg_tbl_loginlink_btn" href="http://localhost/login">ログイン</a>
                </td>
            </tr>
        </table>
    </form>
@endsection