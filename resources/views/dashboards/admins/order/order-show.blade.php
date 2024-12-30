


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
     <!-- Search Form -->
     <div class="card-body col-md-4">
                            <form method="GET" action="{{ route('order-show') }}">
                                <div class="input-group mb-3">
                                    <input type="text" name="query" class="form-control" placeholder="جستجو بر اساس نام سفارش" value="{{ request()->get('query') }}">
                                    <div class="input-group-append">
                                        <button class="btn btn-primary" type="submit">جستجو</button>
                                    </div>
                                </div>
                            </form>
                        </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <!-- Small boxes (Stat box) -->
        <div class="row">
          
<div class="col-md-12">
            <!-- Horizontal Form -->
            <div class="card card-info">
             
              <!-- /.card-header -->
              <!-- form start -->
              <div class=" card">
	     <div class="d-flex justify-content-between card-header">سفارش 
       <div class=''>
<a href="order-add" class="btn btn-primary btn-round px-5"> اضافه کردن سفارش</a>

</div>
      
</div>	

	       <div class="table-responsive">
                 <table class="table align-items-center table-flush table-borderless">
                  <thead>
                   <tr>
                     <th>شماره</th>
                     <th>محصول نهایی</th>
                     <th> نام مشتری</th>
                     <th>مقدار سفارش</th>
                     <th> قیمت فی دانه</th>
                     <th>  قیمت کل </th>
                     <th>  وضعیت سفارش </th>
                     <th>  تاریخ سفارش</th>
                     
                     
                     
                <th>عملیات</th>
                     
                   </tr>
                   </thead>
                   <tbody>
    <?php $counter = 0; ?>
    @foreach($orders as $order)
    <tr>
        <th scope="row">{{ ++$counter }}</th>
        <td>{{ $order->product_name }}</td>
        <td>{{ $order->customer_name }}</td>
        <td>{{ $order->quantity }}</td>
        <td>{{ $order->unit_price }}</td>
        <td>{{ $order->total_price }}</td>
        <td>
            <span class="badge {{ $order->status === 'Finished' ? 'badge-success' : 'badge-warning' }}">
                {{ $order->status }}
            </span>
            <form action="{{ route('order.updateStatus', $order->order_id) }}" method="POST" style="display:inline;">
                @csrf
                @method('PATCH')
                <button type="submit" class="btn btn-sm {{ $order->status === 'Finished' ? 'btn-warning' : 'btn-success' }}">
                    {{ $order->status === 'Finished' ? 'در حال پردازش' : ' تمام شده است ' }}
                </button>
            </form>
        </td>
        <td>{{ $order->order_date }}</td>
        <td>
            <div class="row" style="gap:10px">
                <a href="orderEdit/{{$order->order_id}}" class='btn btn-primary' style="margin: 0 10px;">ویرایش</a>
                <a href="orderDelete/{{$order->order_id}}" class='btn btn-danger' style="margin: 0 10px;">حذف</a>
            </div>
        </td>
    </tr>
    @endforeach
</tbody>
                </table>
               </div>
	   </div>
     </div>
        </div>

@endsection

