











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
@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
<form action="{{ route('EditOrder', $order->order_id) }}" method="post" id="orderForm">
                            @csrf
                             @method('PUT') 
                        <div class="card">
                            <div class="card-body">
                                <div class="card-title">ویرایش سفارشات</div>
                                <hr>

                                <div class="form-group">
                                    <label>نام محصول نهایی</label>
                                    <select name="product_id" class="form-control form-control-rounded" id="cat-id">
                                        @foreach($products as $product)
                                            <option value="{{ $product->product_id }}" {{ $product->product_id == $order->product_id ? 'selected' : '' }}>
                                                {{ $product->product_name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label>نام مشتری</label>
                                    <select name="customer_id" class="form-control form-control-rounded" id="cat-id">
                                        @foreach($customers as $customer)
                                            <option value="{{ $customer->customer_id }}" {{ $customer->customer_id == $order->customer_id ? 'selected' : '' }}>
                                                {{ $customer->customer_name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label for="quantity">Quantity</label>
                                    <input type="number" name="quantity" id="quantity" class="form-control" value="{{ $order->quantity }}" required>
                                </div>

                                <div class="form-group">
                                    <label for="unit_price">Unit Price</label>
                                    <input type="number" name="unit_price" id="unit_price" class="form-control" value="{{ $order->unit_price }}" required step="0.01">
                                </div>

                                <div class="form-group">
                                    <label for="total_price">Total Price</label>
                                    <input type="number" name="total_price" id="total_price" class="form-control" value="{{ $order->total_price }}" required step="0.01">
                                    <div class="form-check">
                                        <input type="checkbox" id="auto-calculate" class="form-check-input" checked>
                                        <label class="form-check-label" for="auto-calculate">Auto-calculate total price</label>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="date"> تاریخ سفارش</label>
                                    <input type="date" name="order_date" class="form-control form-control-rounded" value="{{ $order->order_date }}" required>
                                </div>

                                <div class="form-group">
                                    <input type="submit" class="btn btn-primary btn-round px-5" value="به‌روزرسانی سفارش">
                                </div>
                            </div>
                        </div>
                    </form>


        </div>
        <script>
                    document.addEventListener('DOMContentLoaded', function() {
                        function calculateTotalPrice() {
                            const quantity = parseFloat(document.getElementById('quantity').value) || 0;
                            const unitPrice = parseFloat(document.getElementById('unit_price').value) || 0;
                            const totalPrice = quantity * unitPrice;
                            document.getElementById('total_price').value = totalPrice.toFixed(2); // Format to 2 decimal places
                        }

                        document.getElementById('quantity').addEventListener('input', function() {
                            if (document.getElementById('auto-calculate').checked) {
                                calculateTotalPrice();
                            }
                        });

                        document.getElementById('unit_price').addEventListener('input', function() {
                            if (document.getElementById('auto-calculate').checked) {
                                calculateTotalPrice();
                            }
                        });

                        document.getElementById('auto-calculate').addEventListener('change', function() {
                            if (this.checked) {
                                calculateTotalPrice(); // Recalculate if the checkbox is checked
                            }
                        });
                    });
                </script>     
@endsection




