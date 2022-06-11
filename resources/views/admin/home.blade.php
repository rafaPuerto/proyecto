@extends('layouts.admin')
<nav class="main-header navbar navbar-expand bg-white navbar-light border-bottom">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
        <li class="nav-item">
            <a class="nav-link" data-widget="pushmenu" href="#"><i class="fa fa-bars"></i></a>
        </li>
    </ul>

    <!-- Right navbar links -->
        <div class="navbar-nav ml-auto">
            <input type="text" id="buscar" placeholder="Buscar alumno">
        </div>
</nav>
@section('content')

<div class="card card-solid">
    <div class="card-body pb-0">
            <div class="row" id="alumnos">
                @foreach ($myStudents as $myStudent)
                    <div class="col-12 col-sm-6 col-md-4 d-flex align-items-stretch flex-column" id="alumno_{{ $loop->iteration }}">
                        <a class="card bg-light d-flex flex-fill" href="{{ route('admin.users.show', $myStudent->id) }}" >
                            <div class="card-header text-muted border-bottom-0">
                                <p class="badge badge-success">{{ $myStudent->roles()->first()->title }}</p>
                            </div>
                            <div class="card-body pt-0">
                                <div class="row">
                                    <div class="col-7">
                                        <h2 class="lead"><b>{{ $myStudent->nombre }}</b></h2>
                                        <h5><small>{{ $myStudent->apellidos }}</small></h5>
                                        <p class="text-muted text-sm"><b>Edad: </b> {{ $myStudent->age()." años." }} </p>
                                        <ul class="ml-4 mb-0 fa-ul text-muted">
                                            <li class="small">
                                                <span class="fa-li">
                                                    <i class="fas fa-at"></i>
                                                </span>
                                                Email: @if (isset($myStudent->email))  {{ $myStudent->email }} @else No tiene @endif
                                            </li>
                                            <li class="small">
                                                <span class="fa-li">
                                                    <i class="fas fa-lg fa-phone"></i>
                                                </span> 
                                                Telefono: @if (isset($myStudent->telefono))  {{ $myStudent->telefono }} @else No tiene @endif
                                            </li>
                                        </ul>
                                    </div>
                                    <div class="col-5 text-center">
                                        <img src="{{ asset('img/admin/users/default_user.png') }}" alt="user-avatar" class="img-circle img-fluid">
                                    </div>
                                </div>
                            </div>            
                        </a>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
@endsection
@section('scripts')
@parent
<script type="text/javascript">
$(document).ready(function(){
    $("#buscar").on("keyup", function() {
        var value = $(this).val().toLowerCase();
        $('div[id^="alumno_"]').filter(function() {
            $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
        });
    });
});
</script>
@endsection