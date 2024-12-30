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
                            <form method="GET" action="{{ route('row_materail-show') }}">
                                <div class="input-group mb-3">
                                    <input type="text" name="query" class="form-control" placeholder="جستجو بر اساس نام محصولات" value="{{ request()->get('query') }}">
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
	     <div class="d-flex justify-content-between card-header">مواد اولیه 
       <div class=''>
<a href="row_material-add" class="btn btn-primary btn-round px-5"> اضافه کردن مواد اولیه</a>

</div>
      
</div>	

	       <div class="table-responsive">
                 <table class="table align-items-center table-flush table-borderless">
                  <thead>
                   <tr>
                     <th>شماره</th>
                     <th>نام</th>
                     <th>توضیحات</th>
                     <th>قیمت</th>
                     <th>واحد محصول</th>
                     <th>موجودی محصول</th>
                     <th>نام کتگوری</th>
                     
                     
                <th>عملیات</th>
                     
                   </tr>
                   </thead>
                   <tbody>
                   <?php $counter = 0; ?>
                            @foreach($row_materials as $row_material)
                    <tr>
                    <th scope="row">{{++$counter}}</th>
                                <td>{{$row_material->row_material_name}}</td>
                                <td>{{$row_material->description}}</td>
                                <td> {{$row_material->price}} </td>
                                <td> {{$row_material->unit}} </td>
                                <td>{{$row_material->stock}}</td>
                                <td>{{$row_material->category_name}}</td>
                            
                                <td>
    <div class="row" style="gap:5px">
        <a href="row_materialEdit/{{$row_material->row_material_id}}" class='btn btn-primary' style="margin: 0 10px;">ویرایش</a>
        <a href="row_materialDelete/{{$row_material->row_material_id}}" class='btn btn-danger' style="margin: 0 10px;">حذف</a>
        <button class='btn btn-warning' style="margin: 0 10px;" data-toggle="modal" data-target="#addStockModal{{$row_material->row_material_id}}">افزودن موجودی</button>
    </div>

    <!-- Modal for Adding Stock -->
    <div class="modal fade" id="addStockModal{{$row_material->row_material_id}}" tabindex="-1" role="dialog" aria-labelledby="addStockModalLabel{{$row_material->row_material_id}}" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 style="margin:10px" class="modal-title" id="addStockModalLabel{{$row_material->row_material_id}}">افزودن موجودی</h5>
                    <button style="margin:10px" type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form method="POST" action="{{ route('row_material.addStock', $row_material->row_material_id) }}">
    @csrf
    <div class="modal-body">
        <div class="form-group">
            <label for="stock">مقدار موجودی جدید</label>
            <input type="number" class="form-control" name="stock" required>
        </div>
    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">بستن</button>
        <button type="submit" class="btn btn-primary">افزودن</button>
    </div>
</form>
            </div>
        </div>
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

