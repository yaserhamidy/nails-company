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
<form action="{{ route('EditProduction_detail', $production_detail->production_detail_id) }}" method="post">
    @csrf
    @method('PUT') 
    <div class="card">
                            <div class="card-body">
                                <div class="card-title">ویرایش جزئیات تولید</div>
                                <hr>

                                <input type="hidden" name="production_detail_id" value="{{ $production_detail->id }}">

                                <div class="form-group">
                                    <label for="product_id">نام محصول</label>
                                    <select name="product_id" class="form-control form-control-rounded" required>
                                        <option value="">انتخاب کنید</option>
                                        @foreach($products as $product)
                                            <option value="{{ $product->product_id }}" {{ $product->product_id == $production_detail->product_id ? 'selected' : '' }}>
                                                {{ $product->product_name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label for="row_material_id">نام مواد اولیه</label>
                                    <select name="row_material_id" class="form-control form-control-rounded" required>
                                        <option value="">انتخاب کنید</option>
                                        @foreach($row_materials as $row_material)
                                            <option value="{{ $row_material->row_material_id }}" {{ $row_material->row_material_id == $production_detail->row_material_id ? 'selected' : '' }}>
                                                {{ $row_material->row_material_name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label for="quantity_used">مقدار استفاده شده</label>
                                    <input type="number" name="quantity_used" class="form-control form-control-rounded" value="{{ old('quantity_used', $production_detail->quantity_used) }}" placeholder="Enter quantity used" required>
                                </div>

                                <div class="form-group">
                                    <label for="date">تاریخ</label>
                                    <input type="date" name="date" class="form-control form-control-rounded" value="{{ old('date', $production_detail->date) }}" required>
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




