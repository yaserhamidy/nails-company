@extends('layout.main')
@section('content')

</aside>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">داشبورد</h1>
                    <div style='margin-top:10px'>
<button class="btn btn-primary float-right" onclick="printPage()">چاپ</button>

</div>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-left">
                        <li class="breadcrumb-item"><a href="#">خانه</a></li>
                        <li class="breadcrumb-item active">داشبورد ورژن 2</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>

    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">فعالیت های روزانه</h3>
                            <!-- Print Button -->
                        </div>
                        <div class="card-body">
                            <h1 class="mb-4 text-center text-primary">فعالیت های روزانه برای {{ now()->toDateString() }}</h1>

                            <table class="table table-striped table-bordered">
                                <thead class="thead-dark">
                                    <tr>
                                        <th>شماره</th>
                                        <th>نوع فعالیت</th>
                                        <th>توضیحات</th>
                                        <th>مقدار</th>
                                        <th>تاریخ فعالیت</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $counter = 0; ?>
                                    @foreach($tasks as $task)
                                    <tr>
                                        <th scope="row">{{ ++$counter }}</th>
                                        <td>{{ $task->task_type }}</td>
                                        <td>{{ $task->description }}</td>
                                        <td>{{ $task->quantity }}</td>
                                        <td>{{ $task->task_date }}</td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

<script>
    function printPage() {
        window.print();
    }
</script>

@endsection