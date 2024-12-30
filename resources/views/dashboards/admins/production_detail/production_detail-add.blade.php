@extends('layout.main')
@section('content')

</aside>

<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">داشبورد</h1>
                </div>
            </div>
        </div>
    </div>

    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    
                    <form action="{{ route('addProduction_detail') }}" method="post" id="productForm">
                        @csrf
                        <div class="card">
                            <div class="card-body">
                                <div class="card-title">اضافه کردن جزیات محصول</div>
                                <hr>

                                <div class="form-group">
                                    <label>نام محصول نهایی</label>
                                    <select name="product_id" class="form-control form-control-rounded">
                                        @foreach($products as $product)
                                            <option value="{{ $product->product_id }}">{{ $product->product_name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                
                                <div class="form-group">
                                    <label>نام محصول اولیه</label>
                                    <select name="row_material_id" class="form-control form-control-rounded">
                                        @foreach($row_materials as $row_material)
                                            <option value="{{ $row_material->row_material_id }}">{{ $row_material->row_material_name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                
                                <div class="form-group">
                                    <label for="integer">مقدار استفاده برای فی دانه</label>
                                    <input type="integer" name="quantity_used" class="form-control form-control-rounded" placeholder="Enter product's integer">
                                </div>

                                <div class="form-group col-md-4">
                <label for="inputEmail3" class=" control-label"> @lang('layout.Date') </label>
                <div >
                    <input id="normal-example1" type="text" name="date" class="form-control" id="inputEmail3"autocomplete="off">
                    </div>
                </div>
                                <div class="form-group">
                                    <input type="submit" class="btn btn-primary btn-round px-5" value="اضافه کردن محصولات">
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
</div>



<script>
    $(document).ready(function () {
        $('#normal-example1').persianDatepicker({
            format: 'YYYY/MM/DD',
            initialValue: false,
            autoClose: true
        });
    });
</script>

@endsection
