@extends('layouts.sysadmin')

@section('content')
    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <!-- Main content -->
            <section class="content">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <!-- /.card-header -->
                            <div class="card-body">
                                <h3>Cooking</h3>
                            </div>
                            <table id="example2" class="table table-bordered table-hover">
                                <thead>
                                <tr>
                                    <th>Batch</th>
                                    <th>Product</th>
                                    <th>Target Time</th>
                                    <th>Finish Time</th>
                                    <th>Cooking</th>
                                </tr>
                                </thead>
                                <tbody>
                                @for($i=3;$i<=10;$i++)
                                <tr id="tr{{ $i }}">
                                    <td>RPJ070332{{ $i }}</td>
                                    <td>3105{{ $i+13 }}</td>
                                    <td>10:30:00</td>
                                    <td>17:00:00</td>
                                    <td>Not in cook</td>
                                </tr>
                                @endfor
                                </tfoot>
                            </table>
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
