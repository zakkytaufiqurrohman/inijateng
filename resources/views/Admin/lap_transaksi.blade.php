@extends('layouts.app')
@section('body')

<div class="card text-center ms-4 mt-3">
    <div class="card-header bg-info">
    <h3 class="card-title">Seleksi ALB</h3>
    </div>
    <div class="card-body">
     
            <p class="card-text mt-3">Jumlah Peserta: {{$alb_total}}</p>        
            <p class="card-text">Jumlah Peserta Terverifikasi Bendahara: {{$alb_bendahara}} / {{ $alb_total}}</p>
            <p class="card-text">Jumlah Peserta Terverifikasi Verifikator: {{$alb_verif}}/ {{ $alb_total}}</p>
    </div>
</div>
<div class="row ms-3 mt-5">
    <div class="col-sm-6">
      <div class="card">
        <div class="card-header bg-primary">
        <h3 class="card-title">Magang Bersama I</h3>
        </div>
        <div class="card-body">
        
            <p class="card-text mt-3">Jumlah Peserta: {{$magber_total}}</p>        
            <p class="card-text">Jumlah Peserta Terverifikasi Bendahara: {{$magber_bendahara}} / {{ $magber_total}}</p>
            <p class="card-text">Jumlah Peserta Terverifikasi Verifikator: {{$magber_verif}}/ {{ $magber_total}}</p>
        </div>
      </div>
    </div>
    <div class="col-sm-6">
      <div class="card">
        <div class="card-header bg-success">
        <h3 class="card-title">Magang Bersama II</h3>
        </div>
        <div class="card-body">
         
            <p class="card-text mt-3">Jumlah Peserta: {{ $magber_total2}}</p>
            <p class="card-text">Jumlah Peserta Terverifikasi Bendahara: {{ $magber_bendahara2}} / {{ $magber_total2}}</p>
            <p class="card-text">Jumlah Peserta Terverifikasi Verifikator: {{$magber_verif2}} / {{ $magber_total2}}</p>
        </div>
      </div>
    </div>
  </div>

<div class="row mt-5 ms-3">
    <div class="col-sm-6">
      <div class="card">
        <div class="card-header bg-danger">
        <h3 class="card-title">Magang Bersama III</h3>
        </div>
        <div class="card-body">
         
          <p class="card-text mt-3">
            Jumlah Peserta: {{ $magber_total3}}</p>
            <p class="card-text">Jumlah Peserta Terverifikasi Bendahara: {{$magber_bendahara3}} / {{ $magber_total3}}</p>
            <p class="card-text">Jumlah Peserta Terverifikasi Verifikator: {{$magber_verif3}} / {{ $magber_total3}}</p>
          
        </div>
      </div>
    </div>
    <div class="col-sm-6">
      <div class="card">
        <div class="card-header bg-warning">
        <h3 class="card-title">Magang Bersama IV</h3>
        </div>
        <div class="card-body">
        
          <p class="card-text mt-3">
            Jumlah Peserta: {{ $magber_total4}}</p>
            <p class="card-text">Jumlah Peserta Terverifikasi Bendahara: {{$magber_bendahara4}} / {{ $magber_total4}}</p>
            <p class="card-text">Jumlah Peserta Terverifikasi Verifikator: {{$magber_verif4}} / {{ $magber_total4}}</p>
          
        </div>
      </div>
    </div>
  </div>

@endsection