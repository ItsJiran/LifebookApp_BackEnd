@extends('layouts.app')

@section('title','Home')

@section('layout-main-header')
    <div class='layout-main-header flex-center semibold flex-justify-center'>
        <div class='page-info center flex-center'>
            <img class='svg-icon filter-blue-2' src='./public/library/iconsax/bold/home.svg' />
            <label class='blue-2'>Home</label>
        </div>
    </div>
@endsection

@section('layout-main-content')
    <div class='page-hero border-rounded-1 white-1'>
        <label class='label-5 medium'>Selamat Datang Di</label>
        <h1 class='page-hero-head-1 head-2 bold'>My Own Life Book Digital</h1>
    </div>
    <div class='journals-container'>
        <div class='journals-header flex-center-between'>
            <label class='label-2 semibold blue-3'>Daftar Jurnal</label>
            <a href='#'> <img class='filter-yellow-1' src='./public/library/iconsax/bold/add-square.svg' /> </a>
        </div>
        <ul class='journals-list flex-column'>
            <li class='journal-container border-rounded-1 bg-white-1 shadow-1 flex-center'>
                <a class='journal-photo bg-light-blue-1 flex-center flex-justify-center border-rounded-1'>
                    <img src='./public/library/iconsax/bold/book-1.svg' class='svg-icon filter-blue-3'/>
                </a>
                <div class='journal-info dark-blue-2'>
                    <a href='#'><h2 class='para-3 dark-blue-2 semibold' >Jurnal Semester 2</h2></a>
                    <p class='para-6'>2023-08-01</p>
                </div>
            </li>
            <h2 class='para-3 dark-blue-4 semibold flex-center' style='margin:0px auto; margin-top:20px;' >End Content</h2>
        </ul>
    </div>

@endsection

@section('nav-menu-content')
    <a href='/home' class='nav-menu active'>
        <div class='icon-container'>
            <img class='svg-icon filter-white-1' src='./public/library/iconsax/outline/home-1.svg'/>
        </div>
        <label class='para-6 regular blue-2'>Home</label>
    </a>
    <a href='/journal' class='nav-menu'>
        <div class='icon-container'>
        <img class='svg-icon filter-blue-2' src='./public/library/iconsax/outline/book.svg'/>
        </div>
        <label class='para-6 regular blue-2'>Journal</label>
    </a>
    <a href='/settings' class='nav-menu'>
        <div class='icon-container'>
        <img class='svg-icon filter-blue-2' src='./public/library/iconsax/outline/setting-2.svg'/>
        </div>
        <label class='para-6 regular blue-2'>Settings</label>
    </a>
@endsection

