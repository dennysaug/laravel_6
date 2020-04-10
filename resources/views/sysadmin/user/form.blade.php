@extends('layouts.sysadmin')
@section('content')
<div class="row">
          <!-- left column -->
          <div class="col-md-12">
            <!-- general form elements -->
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">User</h3>
              </div>

              @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
              @endif
              <!-- /.card-header -->
              <!-- form start -->
              {!! Form::model(isset($user)?$user:null, ['route' => ['sysadmin.user.store',isset($user)?$user:null]]) !!}
                <div class="card-body">
                  <div class="form-group">
                    {!! Form::label('name', 'Name')!!}
                    {!! Form::text('name', null, ['class' => 'form-control', 'id' => 'name', 'placeholder' => ""])!!}
                  </div>
                  <div class="form-group">
                    {!! Form::label('email', 'E-mail')!!}
                    {!! Form::email('email', null, ['class' => 'form-control', 'id' => 'email', 'placeholder' => ""])!!}
                  </div>
                  <div class="form-group">
                    {!! Form::label('user_group_id', 'User Group')!!}
                    {!! Form::select('user_group_id', []+$userGroups, null,['class' => 'form-control', 'id' => 'user_group_id', 'placeholder' => ""])!!}
                  </div>

                <!-- /.card-body -->
                @can('permission', 'sysadmin.store.edit')
                    <div class="card-footer">
                    {!! Form::submit('Submit', ['class' => 'btn btn-primary']) !!}
                    </div>
                @endcan
              {!! Form::close() !!}
            </div>
            <!-- /.card -->
          </div>
          <!--/.col (right) -->
        </div>
        <!-- /.row -->
@endsection
