@extends('layouts.auth')

@section('title', 'Login')

@section('auth-form')
    <div class='auth-form-top text-center'>
        <img class='svg-icon filter-blue-1' src='./public/library/iconsax/bold/book-1.svg' />
        <h1 class='head-1 blue-1 semibold'>My Own Life Book Digital</h1>
        <p>Masukkan data anda untuk masuk ke dalam aplikasi</p>
    </div>
    <form class='auth-form' method='POST' action='/login'>
        <input name='email' type='email' required placeholder='Email'/>
        <input name='password' type='password' required placeholder="Password"/>
        <button class='btn'>Submit</button>
    </form>
@endsection

