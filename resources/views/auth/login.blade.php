@extends('layouts.auth')

@section('title', 'Login')

@section('auth-form')
    <form class='auth-form shadow-2 bg-white-1 border-rounded-1' method='POST' action='/login'>
        @csrf
        <input class='input-2' name='email' type='email' required placeholder='Email'/>
        <input class='input-2 mb-20' name='password' type='password' required placeholder="Password"/>

        @if($errors->any())
            <div>
                <div class='red-1 medium mb-5'>Error : </div>
                <div style='padding:10px;gap:5px;' class='bg-light-blue-3 flex-column error-message-container mb-20'>
                    @foreach($errors->all() as $error)
                        <p class='label-4'>{{$error}}</p>
                    @endforeach
                </div>
            </div>
        @endif

        <input class='btn bold white-1 head-5 mb-10 prevent-multiple-submit' type='submit' value='MASUK'/>
        <p class='dark-blue-1 regular label-4 text-center'>Belum punya akun ? <a href='/register' class='medium blue-2'>Register Sekarang</a></p>
    </form>
@endsection

