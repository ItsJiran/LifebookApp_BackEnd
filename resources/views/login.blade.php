@extends('layouts.auth')

@section('title', 'Login')

@section('auth-form')
    <div class='auth-form-top'>

        <h1>My Own Life Book Digital</h1>
        <p>Masukkan data untuk login</p>
    </div>
    <form class='auth-form' method='POST' action='/login'>
        <div class='auth-input-container'>
            <label>Email</label>
            <input name='email' type='email' required placeholder='Isi Email'/>
        </div>
        <div class='auth-input-container'>
            <label>Password</label>
            <input name='password' type='password' required placeholder="Isi Password"/>
        </div>
    </form>
@endsection

