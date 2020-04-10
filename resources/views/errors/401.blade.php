@extends('layouts.sysadmin')
@section('content')
    <!-- Main content -->
    <section class="content">
        <div class="error-page">
            <h2 class="headline text-warning"> 401</h2>

            <div class="error-content">
                <h3><i class="fas fa-exclamation-triangle text-warning"></i> Oops! Permission denied.</h3>

                <p>
                    You don't have permission to access this page.
                    Meanwhile, you may <a href="{{ route('sysadmin.dashboard.index') }}">return to dashboard</a>.
                </p>

            </div>
            <!-- /.error-content -->
        </div>
        <!-- /.error-page -->
    </section>
    <!-- /.content -->
@endsection
