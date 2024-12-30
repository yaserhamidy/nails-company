@extends('layout.main')
@section('content')

</aside>

<div class="content-wrapper">
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
    
    <div class="card-body col-md-4">
        <form method="GET" action="{{ route('sale-show') }}">
            <div class="input-group mb-3">
                <input type="text" name="query" class="form-control" placeholder="جستجو بر اساس نام محصول" value="{{ request()->get('query') }}">
                <div class="input-group-append">
                    <button class="btn btn-primary" type="submit">جستجو</button>
                </div>
            </div>
        </form>
    </div>

    <div class="card-body col-md-2">
                               
                               <button class="btn btn-primary btn-round px-4" onclick="printTable()">چاپ</button> <!-- Print Button -->
                           </div>

    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card card-info">
                        <div class="card-header d-flex justify-content-between">
                            <h3 class="card-title">فروش‌ها</h3>
                     
                        </div>

                        <div class="table-responsive">
                            <table class="table align-items-center table-flush table-borderless">
                                <thead>
                                    <tr>
                                        <th>شماره</th>
                                        <th>محصول نهایی</th>
                                        <th>نام مشتری</th>
                                        <th>مقدار فروش</th>
                                        <th>قیمت فی دانه</th>
                                        <th>قیمت کل</th>
                                        <th>تاریخ فروش</th>
                                        <th>وضعیت</th>
                                        <th>عملیات</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $counter = 0; ?>
                                    @foreach($sales as $sale)
                                    <tr>
                                        <th scope="row">{{ ++$counter }}</th>
                                        <td>{{ $sale->product_name }}</td>
                                        <td>{{ $sale->customer_name }}</td>
                                        <td>{{ $sale->quantity }}</td>
                                        <td>{{ $sale->unit_price }}</td>
                                        <td>{{ $sale->total_price }}</td>
                                        <td>{{ $sale->sale_date }}</td>
                                        <td>{{ $sale->status }}</td>
                                        <td>
                                            <div class="row" style="gap:10px">
   <form action="{{ route('sale.cancel', $sale->sale_id) }}" method="POST" style="display:inline;">
                                                    @csrf
                                                    <button type="submit" class='btn btn-warning' onclick="return confirm('آیا مطمئن هستید که می‌خواهید این فروش را لغو کنید؟')">لغو</button>
                                                </form>
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
        </div>
    </section>
</div>

<script>
function printTable() {
    const printContent = document.querySelector('.table-responsive').innerHTML; // Get the HTML of the table
    const printWindow = window.open('', '', 'height=600,width=800'); // Open a new window

    printWindow.document.write('<html><head><title>Print Sales</title>');
    printWindow.document.write('<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">'); // Add Bootstrap CSS for styling
    printWindow.document.write('</head><body>');
    printWindow.document.write('<h3>فروش‌ها</h3>'); // Title for printed page
    printWindow.document.write(printContent); // Write the table content
    printWindow.document.write('</body></html>');

    printWindow.document.close(); // Close the document
    printWindow.print(); // Open print dialog
}
</script>

@endsection