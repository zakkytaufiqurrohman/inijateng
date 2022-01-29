{{-- Base Head & Script --}}
@extends('layouts.base')
{{-- Body --}}
@section('body')
    {{-- Sidebar & Navbar --}}
    @include('layouts.sidebar')
    @include('layouts.navbar')
    
    {{-- Main Content --}}
    @yield('content')

    {{-- Footer --}}
    @include('layouts.footer')
@endsection
{{--  /Body --}}