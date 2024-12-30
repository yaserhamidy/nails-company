


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
                            <form method="GET" action="{{ route('category-show') }}">
                                <div class="input-group mb-3">
                                    <input type="text" name="query" class="form-control" placeholder="جستجو بر اساس نام کتگوری" value="{{ request()->get('query') }}">
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
	     <div class="d-flex justify-content-between card-header">کتگوری ها
       <div class=''>
<a href="category-add" class="btn btn-primary btn-round px-5"> اضافه کردن کتگوری</a>

</div>
      
</div>	

	       <div class="table-responsive">
                 <table class="table align-items-center table-flush table-borderless">
                  <thead>
                   <tr>
                     <th>شماره</th>
                     <th>نام</th>
                     <th>توضیحات</th>
                     
                <th>عملیات</th>
                     
                   </tr>
                   </thead>
                   <tbody>
                   <?php $counter = 0; ?>
                            @foreach($catagories as $cat)
                    <tr>
                    <th scope="row">{{++$counter}}</th>
                                <td>{{$cat->name}}</td>
                                <td>{{$cat->description}}</td>
                                

                                <td>
                                    <div class="row" style="gap:10px">
                                      <a href="categoryEdit/{{$cat->cat_id}}" class='btn btn-primary' style="margin: 0 10px;">ویرایش</a>
                                      <a href="categoryDelete/{{$cat->cat_id}}" class='btn btn-danger' style="margin: 0 10px;">حذف  </a>
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




