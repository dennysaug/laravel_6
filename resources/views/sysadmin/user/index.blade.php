@extends('layouts.sysadmin')

@section('content')
      <!-- Main content -->
      <section class="content">
      <div class="row">
        <div class="col-12">
          <div class="card">
            <!-- /.card-header -->
              @can('permission', 'sysadmin.user.new')
                  <div class="card-body text-right">
                    <a class="btn btn-primary" href="{{ route('sysadmin.user.new') }}">
                          <i class="fas fa-plus"></i> Add
                    </a>
                  </div>
              @endcan
            @if(isset($list) && $list->count() >0)
              <table id="example2" class="table table-bordered table-hover">
                <thead>
                <tr>
                  <th>Name</th>
                  <th>Group</th>
                  <th>Email</th>
                  <th>Active</th>
                  <th>Actions</th>
                </tr>
                </thead>
                <tbody>
                @foreach($list as $data)
                  <tr>
                    <td>{{ $data->name }}</td>
                    <td>{{ $data->group->name }}</td>
                    <td>{{ $data->email }}</td>
                    <td>{{ ($data->active=='Y')?'YES':'NO' }}</td>
                    <td>
                    @can('permission', 'sysadmin.user.edit')
                        <a class="btn btn-primary btn-sm" href="{{ route('sysadmin.user.edit', $data) }}" title="Edit">
                          <i class="fas fa-edit"></i>
                        </a>
                    @endcan
                        @can('permission','sysadmin.user.permission')
                    <a class="btn btn-warning btn-sm" href="{{ route('sysadmin.user.permission', $data) }}" title="Permission">
                        <i class="fas fa-lock"></i>
                    </a>
                    @endcan
                    @can('permission', 'sysadmin.user.delete')
                        <a class="btn btn-danger btn-sm modal-delete"  data-toggle="modal" data-target="#modal-delete" href="{{ route('sysadmin.user.delete', $data) }}" title="Delete">
                          <i class="fas fa-trash"></i>
                        </a>
                    @endcan
                    </td>
                  </tr>
                @endforeach
                </tfoot>
              </table>
            @endif
            </div>
            <!-- /.card-body -->
          </div>
          <!-- /.card -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
    </section>
    <!-- /.content -->
  </div>
@endsection

@include('sysadmin.includes.modal_delete')

@section('scripts')
<!-- DataTables -->
<script src="/plugins/datatables/jquery.dataTables.js"></script>
<script src="/plugins/datatables-bs4/js/dataTables.bootstrap4.js"></script>
<script>
 $('#example2').DataTable({
      "paging": true,
      "lengthChange": false,
      "searching": false,
      "ordering": true,
      "info": true,
      "autoWidth": false,
    });


</script>
@endsection
