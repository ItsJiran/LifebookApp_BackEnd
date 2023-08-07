@extends('layouts.auth')

@section('title', 'Register')

@section('auth-form')
    <form class='auth-form shadow-2 bg-white-1 border-rounded-1' method='POST' action='/register'>
        @csrf
        <input class='input-2' value='{{old("name")}}' name='name' required placeholder='Name'/>
        <input class='input-2' value='{{old("email")}}' name='email' type='email' required placeholder='Email'/>
        <input class='input-2' name='password' type='password' required placeholder="Password"/>
        <input class='input-2 mb-20' name='password_confirmation' type='password' required placeholder="Re-Password"/>

        @if($errors->any())
            <div>
                <div class='red-1 medium mb-10'>Error : </div>
                <div style='padding:10px;gap:10px;' class='bg-light-blue-3 flex-column error-message-container mb-20'>
                    @foreach($errors->all() as $error)
                        <p class='label-4'>{{$error}}</p>
                    @endforeach
                </div>
            </div>
        @endif

        <input class='btn bold white-1 head-5 mb-10 prevent-multiple-submit' type='submit' value='REGISTRASI'/>
        <p class='dark-blue-1 regular label-4 text-center'> Sudah punya akun ? <a href='/login' class='medium blue-2'>Login Sekarang</a></p>
    </form>
@endsection

