



         


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
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <!-- Small boxes (Stat box) -->
        <div class="row">
          
<div class="col-md-12">
           
             
            <form action="addCategory" method="post" id="categoryForm">
@csrf
<div class="card">
           <div class="card-body">
           <div class="card-title">اضافه کردن کتگوری </div>
           <hr>
            <form>
           <div class="form-group">
            <label for="">نام</label>
            <input type="text" name="name" class="form-control form-control-rounded"  placeholder="Enter category Name">
           </div>
           <div class="form-group">
            <label for="">توضیحات</label>
            <input type="text" name="description" class="form-control form-control-rounded"  placeholder="Enter category Description">
           </div>
           
          
           <div class="form-group">
           
            <input type="submit" class="btn btn-primary btn-round px-5" value="اضافه کردن کتگوری">
          </div>
          </form>
         </div>
         </div>
</form>
  

    
        
      
        </div>

@endsection




