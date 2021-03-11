@extends('layouts.sysadmin')
@section('content')
<div class="row">
          <!-- left column -->
          <div class="col-md-12">
            <!-- general form elements -->
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">Category</h3>
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
              {!! Form::model(isset($category)?$category:null, ['route' => ['sysadmin.category.store',isset($category)?$category:null]]) !!}
                <div class="card-body">
                  <div class="form-group">
                    {!! Form::label('name', 'Name')!!}
                    {!! Form::text('name', null, ['class' => 'form-control', 'id' => 'name', 'placeholder' => ""])!!}
                  </div>
                <!-- /.card-body -->

                <div class="card-footer">
                {!! Form::submit('Submit', ['class' => 'btn btn-primary']) !!}
                </div>
              {!! Form::close() !!}
            </div>
            <!-- /.card -->
          </div>
          <!--/.col (right) -->
        </div>
        <!-- /.row -->
@endsection
