@extends('layouts.journal')


@section('layout-main-header')
    <div class='layout-main-header flex-center-between semibold'>
        <div class=''>@yield('layout-main-header-left')</div>
        <div class='page-info center flex-center'>
            <img class='svg-icon filter-blue-2' src='/public/library/iconsax/bold/book.svg' />
            <label class='blue-2'>Journal</label>
        </div>
        <div class=''>@yield('layout-main-header-right')</div>
    </div>
@endsection

@section('head-content')
    <script src='https://cdn.jsdelivr.net/npm/@editorjs/editorjs@latest'></script>
    <script src='https://cdn.jsdelivr.net/npm/@editorjs/simple-image@latest'></script>
    <script src='https://cdn.jsdelivr.net/npm/@editorjs/image@latest'></script>
    <script src='https://cdn.jsdelivr.net/npm/@editorjs/header@latest'></script>
    <script src='https://cdn.jsdelivr.net/npm/@editorjs/link@latest'></script>
    <script src='https://cdn.jsdelivr.net/npm/@editorjs/paragraph@latest'></script>
    <script src='https://cdn.jsdelivr.net/npm/@editorjs/list@latest'></script>
    <script src='https://cdn.jsdelivr.net/npm/@editorjs/checklist@latest'></script>
    @yield('journal-data')
@endsection

@section('nav-menu-content')
    <a href='javascript:confirmSwitchPage("/home")' class='nav-menu'>
        <div class='icon-container'>
            <img class='svg-icon' src='/public/library/iconsax/outline/home-1.svg'/>
        </div>
        <label class='para-6 regular blue-2'>Home</label>
    </a>
    <a href='javascript:confirmSwitchPage("/journal")' class='nav-menu active'>
        <div class='icon-container'>
            <img class='svg-icon' src='/public/library/iconsax/outline/book.svg'/>
        </div>
        <label class='para-6 regular blue-2'>Journal</label>
    </a>
    <a href='javascript:confirmSwitchPage("/logout")' class='nav-menu'>
        <div class='icon-container'>
        <img class='svg-icon' src='/public/library/iconsax/outline/logout.svg'/>
        </div>
        <label class='para-6 regular blue-2'>Logout</label>
    </a>
@endsection

@section('footer-script-content')
   <script src='/public/assets/js/script.editor.js?v={{ time() }}'></script>
   <script src='/public/assets/js/script.navigation.js?v={{ time() }}'></script>
   <script src='/public/assets/js/script.navigation.confirmback.js?v={{ time() }}'></script>
@endsection

