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
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-left">
                        <li class="breadcrumb-item"><a href="#">خانه</a></li>
                        <li class="breadcrumb-item active">داشبورد ورژن 2</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <!-- Search Form -->
    <div class="card-body col-md-4">
        <form method="GET" action="{{ route('product-show') }}">
            <div class="input-group mb-3">
                <input type="text" name="query" class="form-control" placeholder="جستجو بر اساس نام محصولات" value="{{ request()->get('query') }}">
                <div class="input-group-append">
                    <button class="btn btn-primary" type="submit">جستجو</button>
                </div>
            </div>
        </form>
    </div>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card card-info">
                        <div class="card">
                            <div class="d-flex justify-content-between card-header">محصولات 
                                <div class=''>
                                    <a href="product-add" class="btn btn-primary btn-round px-5">اضافه کردن محصولات</a>
                                </div>
                            </div>

                            <div class="scroll">
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
                                            @foreach($products as $product)
                                            <tr>
                                                <th scope="row">{{ ++$counter }}</th>
                                                <td>{{ $product->product_name }}</td>
                                                <td>{{ $product->description }}</td>
                                                <td>{{ $product->price }}</td>
                                                <td>{{ $product->unit }}</td>
                                                <td>{{ $product->stock }}</td>
                                                <td>{{ $product->category_name }}</td>
                                                <td>
                                                    <div class="row" style="gap:10px">
                                                        <a href="productEdit/{{$product->product_id}}" class='btn btn-primary' style="margin: 0 10px;">ویرایش</a>
                                                        <a href="productDelete/{{$product->product_id}}" class='btn btn-danger' style="margin: 0 10px;">حذف</a>
                                                        <button class='btn btn-warning' style="margin: 0 10px;" data-toggle="modal" data-target="#addStockproductModal{{$product->product_id}}">افزودن موجودی</button>
                                                    </div>
                                                </td>
                                            </tr>
                                            
                                            <!-- Modal for Adding Stock -->
                                            <div class="modal fade" id="addStockproductModal{{$product->product_id}}" tabindex="-1" role="dialog" aria-labelledby="addStockproductModalLabel{{$product->product_id}}" aria-hidden="true">
                                                <div class="modal-dialog" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 style="margin:15px" class="modal-title" id="addStockproductModalLabel{{$product->product_id}}">افزودن موجودی</h5>
                                                            <button style="margin:10px" type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <form method="POST" action="{{ route('product.addStockproduct', $product->product_id) }}">
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
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
@endsection