@extends('layouts.auth')
@section('content')
    <!-- /.login-logo -->
    <div class="card">
        <div class="card-body login-card-body">
            <p class="login-box-msg">Sign in to start your session</p>
            {!! Form::open(['route' => 'auth.login.authenticate']) !!}
                <div class="input-group mb-3">
                    {!! Form::email('email', null, ['class' => 'form-control', 'placeholder' => 'Email']) !!}
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-envelope"></span>
                        </div>
                    </div>
                </div>
                <div class="input-group mb-3">
                    {!! Form::password('password', ['class' => 'form-control', 'placeholder' => 'Password']) !!}
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-lock"></span>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <!-- /.col -->
                    <div class="col-4">
                        {!! Form::submit('Sign In', ['class' => 'btn btn-primary btn-block']) !!}
                    </div>
                    <!-- /.col -->
                </div>
            {!! Form::close() !!}
        </div>
        <!-- /.login-card-body -->
    </div>
@stop
