
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
           
<main class="bmd-layout-content">
			<div class="container-fluid ">

				<!-- content -->
				<!-- breadcrumb -->

				
             
				<form action="{{route('EditCategory')}}" method="post">
				@csrf
                <input type="hidden" name="cat_id"  value="{{$catagory->cat_id}}">
				<div class="card" style="margin-top:40px;">
				<div class="card-header">ویرایش کتگوری</div>
				<div class="row m-1 mb-2">
					<div class="col-md-12 ">
						<label for="" style="margin-top:20px;">نام</label>
                        <input type="text"   value="{{$catagory->name}}"  name="name" class="form-control">
                    </div>
					<div class="col-md-12 mt-4">
						<label for="">توضیحات </label>
                        <input type="text"  value="{{$catagory->description}}"   name="description" class="form-control">
                    </div>
				</div>
				 
               <div class="col-md-2">
			   <input type="submit" class="btn btn-primary btn-round px-5" value='ذخیره' style="margin:20px;">

			   </div>				 
				</div>
				</form>

			


				
				

                

                
				

				</div>


				




			</div>
		</main>
			
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




