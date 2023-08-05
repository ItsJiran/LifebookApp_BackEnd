@extends('layouts.home')

@section('layout-main-content')
    <div class='layout-main-content flex-column'>
        <div class='page-hero border-rounded-1 white-1'>
            <label class='label-5 medium'>Selamat Datang Di</label>
            <h1 class='page-hero-head-1 head-2 bold'>My Own Life Book Digital</h1>
        </div>
        <div class='materials-container'>
            <div class='materials-header flex-center-between'>
                <label class='label-2 semibold blue-3'>Daftar Jurnal</label>
                @if($user_data['role'] == 'admin')
                    <a href='/create/materials'> <img class='filter-yellow-1' src='/public/library/iconsax/bold/add-square.svg' /> </a>
                @endif
            </div>
            <ul class='materials-list flex-column'>
                <li class='material-container border-rounded-1 bg-white-1 shadow-1 flex-center'>
                    <a class='material-photo bg-light-blue-1 flex-center flex-justify-center border-rounded-1'>
                        <img src='/public/library/iconsax/bold/book-1.svg' class='svg-icon filter-blue-3'/>
                    </a>
                    <div class='material-info dark-blue-2'>
                        <a href='#'><h2 class='para-3 dark-blue-2 semibold' >Jurnal Semester 2</h2></a>
                        <p class='para-6'>2023-08-01</p>
                    </div>
                </li>
                <label class='para-3 dark-blue-4 semibold flex-center' style='margin:0px auto; margin-top:10px;' >End Content</label>
            </ul>
        </div>
    </div>
@endsection
