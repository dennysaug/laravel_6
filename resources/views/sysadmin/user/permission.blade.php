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
                @if(isset($areas) && $areas->count())
                    {!! Form::model(isset($user)?$user:null, ['route' => ['sysadmin.user.permission',isset($user)?$user:null]]) !!}
                    <div class="card-body">
                        <div class="form-group">
                            <h3>{{ $user->name }}</h3>
                        </div>
                        @foreach($areas as $area)
                            @if($area->roles()->count())
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="card card-primary card-outline">
                                            <div class="card-header">
                                                <h3 class="card-title">
                                                    {{--                                                    <i class="fas fa-edit"></i>--}}
                                                    {{ $area->name }}
                                                </h3>
                                            </div>
                                            <div class="card-body">
                                                @foreach($area->roles as $role)
                                                    <div class="form-group">
                                                        <div class="custom-control custom-switch">
                                                            {!! Form::checkbox('roles[]', $role->id, in_array($role->id,$rolesUser), ['class' => 'custom-control-input', 'id' => 'customSwitch' . $role->id]) !!}
                                                            {!! Form::label('customSwitch'.$role->id, $role->name, ['class' => 'custom-control-label']) !!}
                                                        </div>
                                                    </div>
                                                @endforeach
                                            </div>
                                            <!-- /.card -->
                                        </div>
                                    </div>
                                    <!-- /.col -->
                                </div>
                            @endif
                        @endforeach
                        @can('permission', 'sysadmin.user.store')
                            <div class="card-footer">
                                {!! Form::submit('Submit', ['class' => 'btn btn-primary']) !!}
                            </div>
                        @endcan
                        {!! Form::close() !!}
                        @else
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="card-body text-center">
                                        <div class="form-control">
                                            <h3>No Areas</h3>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endif
                    </div>
                    <!-- /.card -->
            </div>
            <!--/.col (right) -->
        </div>
        <!-- /.row -->
@endsection
