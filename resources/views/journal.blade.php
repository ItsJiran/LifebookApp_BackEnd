@extends('layouts.journal')

@section('layout-main-content')
    <div class='layout-main-content flex-column'>
        <div class='page-hero border-rounded-1 white-1'>
            <h1 class='page-hero-head-1 head-2 bold'>My Own Life Book Digital</h1>
        </div>
        <div class='journals-container'>
            <div class='journals-header flex-center-between'>
                <label class='label-2 semibold blue-3'>Daftar Jurnal</label>
                <a href='/create/journals'> <img class='filter-yellow-1' src='/public/library/iconsax/bold/add-square.svg' /> </a>
            </div>
            <ul class='journals-list flex-column'>
                <label class='para-3 dark-blue-4 semibold flex-center' style='margin:0px auto; margin-top:10px;' >End Content</label>
            </ul>
        </div>
    </div>
@endsection
