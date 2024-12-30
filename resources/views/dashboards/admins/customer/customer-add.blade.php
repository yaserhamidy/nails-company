



         


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
            @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

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
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <!-- Small boxes (Stat box) -->
        <div class="row">
          
<div class="col-md-12">
           
             
            <form action="addCustomer" method="post" id="customerForm">
@csrf
<div class="card">
           <div class="card-body">
           <div class="card-title">اضافه کردن مشتری </div>
           <hr>
            <form>
           <div class="form-group">
            <label for="">نام</label>
            <input type="text" name="customer_name" class="form-control form-control-rounded"  placeholder="Enter customer name Name">
           </div>
           <div class="form-group">
            <label for="">شماره تماس</label>
            <input type="text" name="phone" class="form-control form-control-rounded"  placeholder="Enter category phone">
           </div>
           <div class="form-group">
            <label for="">آدرس مشتری </label>
            <input type="text" name="address" class="form-control form-control-rounded"  placeholder="Enter category address">
           </div>
           
          
           <div class="form-group">
           
            <input type="submit" class="btn btn-primary btn-round px-5" value="اضافه کردن مشتری">
          </div>
          </form>
         </div>
         </div>
</form>
  

    
        
      
        </div>

@endsection




