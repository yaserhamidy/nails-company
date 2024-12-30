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
<form action="{{ route('EditRow_material') }}" method="post">
    @csrf
    <div class="card">
        <input type="hidden" name="row_material_id" value="{{ $row_material->row_material_id }}">
        <div class="card-body">
            <div class="card-title">ویرایش محصولات</div>
            <hr>
            <div class="form-group">
                <label for="">نام</label>
                <input type="text" name="row_material_name" class="form-control form-control-rounded" value="{{ old('row_material_name', $row_material->row_material_name) }}" placeholder="Enter row_material Name" required>
            </div>
            <div class="form-group">
                <label for="">توضیحات</label>
                <input type="text" name="description" class="form-control form-control-rounded" value="{{ old('description', $row_material->description) }}" placeholder="Enter description">
            </div>
            <div class="form-group">
                <label for="">قیمت</label>
                <input type="text" name="price" class="form-control form-control-rounded" value="{{ old('price', $row_material->price) }}" placeholder="Enter last Name" required>
            </div>
            <div class="form-group">
                <label for="">موجودی</label>
                <input type="text" name="stock" class="form-control form-control-rounded" value="{{ old('stock', $row_material->stock) }}" placeholder="Enter last Name" required>
            </div>
            <div class="form-group">
    <label>واحد محصول</label>
    <select name="unit" class="form-control form-control-rounded" id="unit" required>
        <option value="">انتخاب کنید</option> <!-- Default option -->
        <option value="کیلوگرام" {{ $row_material->unit === 'کیلوگرام' ? 'selected' : '' }}>کیلوگرام</option>
        <option value="عدد" {{ $row_material->unit === 'عدد' ? 'selected' : '' }}>عدد</option>
    </select>
</div>
            <label>نام کتگوری</label>
            <div>
                <select name="cat_id" class="form-control form-control-rounded" id="">
                    @foreach($catagory as $cat)
                        <option value="{{ $cat->cat_id }}" @if($cat->cat_id == $row_material->cat_id) selected @endif>{{ $cat->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <input type="submit" class="btn btn-primary btn-round mt-5 px-5" value="ذخیره">
            </div>
        </div>
    </div>
</form>
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


        
      
        </div>

@endsection




