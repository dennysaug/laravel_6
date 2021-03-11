@extends('layouts.sysadmin')
@section('style')
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <link rel="stylesheet" href="/plugins/summernote/summernote-bs4.css">
    <style>
        #sortable { list-style-type: none; margin: 0; padding: 0; width: auto; }
        #sortable li { margin: 3px 3px 3px 0; padding: 21px; float: left; width: 239px; height: 246px; font-size: 4em; text-align: center; }
    </style>
@endsection
@section('content')
<div class="row">
          <!-- left column -->
          <div class="col-md-12">
            <!-- general form elements -->
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">Product</h3>
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
              {!! Form::model(isset($product)?$product:null, ['route' => ['sysadmin.product.store',isset($product)?$product:null], 'files' => true]) !!}
                <div class="card-body">
                  <div class="form-group">
                    {!! Form::label('name', 'Name')!!}
                    {!! Form::text('name', null, ['class' => 'form-control', 'id' => 'name', 'placeholder' => ""])!!}
                  </div>
                <div class="form-group">
                    {!! Form::label('category_id', 'Category')!!}
                    {!! Form::select('category_id', []+$categories, null,['class' => 'form-control', 'id' => 'category_id', 'placeholder' => ""])!!}
                </div>
                  <div class="form-group">
                    {!! Form::label('text', 'Text')!!}
                    {!! Form::textarea('text', null, ['class' => 'form-control textarea', 'id' => 'text', 'placeholder' => "", 'style' => 'min-height: 350px;'])!!}
                  </div>
                <div class="form-group">
                    {!! Form::label('price', 'Price')!!}
                    {!! Form::text('price', null, ['class' => 'form-control', 'id' => 'price', 'placeholder' => ""])!!}
                </div>
                <div class="form-group">
                    <label for="InputFile">Images</label>
                    <div class="input-group">
                        <div class="custom-file">
                            {!! Form::file('images[]',['class' => 'custom-file-input', 'id' => 'InputFile', 'multiple' => 'multiple']) !!}
                            {!! Form::label('Inputfile', 'Choose images', ['class' => 'custom-file-label']) !!}
                        </div>
                        <div class="input-group-append">
                            <span class="input-group-text" id="">Upload</span>
                        </div>
                    </div>
                </div>
                @if(isset($product) && ($product->count() > 0))
                <div class="row">
                    <div class="col-md-6">
                        @if(isset($product->images) && $product->images->count())
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">
                                    <i class="fas fa-image"></i>
                                    Images
                                </h3>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                                <ul id="sortable">
                                    @foreach($product->images as $image)
                                        <li class="ui-state-default" id="item-{{ $image->id }}">
                                            <img src="{{ route('site.media.image',['images','product','small', $image->name]) }}" alt="">
                                            <div style="margin: -7px 4px">
                                                <a class="btn btn-sm modal-delete"  data-toggle="modal" data-target="#modal-delete" href="{{ route('sysadmin.product.delete',1) }}" title="Delete">
                                                    <i class="fas fa-trash fa-2x"></i>
                                                </a>
                                            </div>

                                        </li>
                                    @endforeach
                                </ul>
                            </div><!-- /.card-body -->
                        </div><!-- /.card -->
                        @endif

                    </div>
                </div>
                @endif
                <div class="form-group">
                    <div class="custom-control custom-switch">
                        {!! Form::checkbox('actived', 'Y', null, ['class' => 'custom-control-input', 'id' => 'customSwitchActived']) !!}
                        {!! Form::label('customSwitchActived', 'Actived', ['class' => 'custom-control-label']) !!}
                    </div>
                </div>
                <div class="form-group">
                    <div class="custom-control custom-switch">
                        {!! Form::checkbox('featured', 'Y', null, ['class' => 'custom-control-input', 'id' => 'customSwitchFeatured']) !!}
                        {!! Form::label('customSwitchFeatured', 'Featured', ['class' => 'custom-control-label']) !!}
                    </div>
                </div>
                <!-- /.card-body -->
                @can('permission', 'sysadmin.product.store')
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

@section('scripts')
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <!-- Summernote -->
    <script src="/plugins/summernote/summernote-bs4.min.js"></script>
    <!-- bs-custom-file-input -->
    <script src="/plugins/bs-custom-file-input/bs-custom-file-input.min.js"></script>
    <script type="text/javascript">
        $(document).ready(function () {
            bsCustomFileInput.init();
            $('.textarea').summernote({height: 300});
            $( "#sortable" ).sortable({
                axis: 'y',
                update: function (event, ui) {
                    var data = $(this).sortable('serialize');
                    console.log('Console.log', data);

                    // POST to server using $.post or $.ajax
                    $.ajax({
                        data: data,
                        type: 'POST',
                        url: '{{ route('sysadmin.product.order') }}'
                    });
                }
            }).disableSelection();


        });
    </script>
@endsection
