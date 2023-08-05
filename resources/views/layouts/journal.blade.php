@extends('layouts.app')

@section('title','Journal')

@section('layout-main-header')
    <div class='layout-main-header flex-center semibold flex-justify-center'>
        <div class='page-info center flex-center'>
            <img class='svg-icon filter-blue-2' src='/public/library/iconsax/bold/book.svg' />
            <label class='blue-2'>Home</label>
        </div>
    </div>
@endsection

@section('nav-menu-content')
    <a href='/home' class='nav-menu'>
        <div class='icon-container'>
            <img class='svg-icon' src='/public/library/iconsax/outline/home-1.svg'/>
        </div>
        <label class='para-6 regular blue-2'>Home</label>
    </a>
    <a href='/journal' class='nav-menu'>
        <div class='icon-container'>
            <img class='svg-icon' src='/public/library/iconsax/outline/book.svg'/>
        </div>
        <label class='para-6 regular blue-2'>Journal</label>
    </a>
    <a href='/settings' class='nav-menu'>
        <div class='icon-container'>
        <img class='svg-icon' src='/public/library/iconsax/outline/setting-2.svg'/>
        </div>
        <label class='para-6 regular blue-2'>Settings</label>
    </a>
@endsection

