<body class="hold-transition sidebar-mini">
<div class="wrapper">

  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand bg-white navbar-light border-bottom">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
        <li class="nav-item">
            <a class="nav-link" data-widget="pushmenu" href="#"><i class="fa fa-bars"></i></a>
        </li>
        <li class=" nav-item d-none d-sm-inline-block">
            <a href="index" class="nav-link">خانه</a>
        </li>
       
        <!-- Logout Button -->
        <li class="nav-item d-none d-sm-inline-block">
            <form action="{{ route('logout') }}" method="POST" style="display: inline;">
                @csrf
                <button type="submit" class="btn btn-danger nav-link btn btn-link" style="color: inherit;">
                    خروج
                </button>
            </form>
        </li>
    </ul>

    
</nav>
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="index3.html" class="brand-link">
           
      <span class="brand-text font-weight-light">پنل مدیریت</span>
    </a>

    
    <!-- Sidebar -->
    <div class="sidebar" style="direction: ltr">
      <div style="direction: rtl">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
          <div class="image">
           
          </div>
          <div class="info">
            <a href="#" class="d-block">یاسر حامدی</a>
          </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
          <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
            <!-- Add icons to the links using the .nav-icon class
                 with font-awesome or any other icon font library -->
            <li class="nav-item">
              <a href="index" class="nav-link active">
                <i class="nav-icon fa fa-dashboard"></i>
                <p>
                  داشبوردها
                  
                </p>
              </a>
           
            </li>
            
            <li class="nav-item has-treeview">
              <a href="#" class="nav-link">
                <i class="nav-icon fa fa-table"></i>
                <p>
               کتگوری ها
                  <i class="right fa fa-angle-left"></i>
                </p>
              </a>
              <ul class="nav nav-treeview">
                <li class="nav-item">
                  <a href="category-show" class="nav-link">
                    <i class="fa fa-circle-o nav-icon"></i>
                    <p> نمایش کتگوری</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="category-add" class="nav-link">
                    <i class="fa fa-circle-o nav-icon"></i>
                    <p>اضافه کردن کتگوری </p>
                  </a>
                </li>
                
              </ul>
              
            </li>
            <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
              <i class="nav-icon fa fa-table"></i>
               <p>
                 مواد اولیه 
                  <i class="right fa fa-angle-left"></i>
               </p>
              </a>
              <ul class="nav nav-treeview">
                <li class="nav-item">
                  <a href="row_materail-show" class="nav-link">
                   <i class="fa fa-circle-o nav-icon"></i>
                   <p> نمایش مواد اولیه</p>
                   </a>
                </li>
                <li class="nav-item">
                  <a href="row_materail-add" class="nav-link">
                    <i class="fa fa-circle-o nav-icon"></i>
                    <p>اضافه کردن مواد اولیه</p>
                  </a>
                </li>
              </ul>
            </li>
            <li class="nav-item has-treeview">
              <a href="#" class="nav-link">
                <i class="nav-icon fa fa-table"></i>
                <p>
               محصولات نهایی
                  <i class="right fa fa-angle-left"></i>
                </p>
              </a>
              <ul class="nav nav-treeview">
                <li class="nav-item">
                  <a href="product-show" class="nav-link">
                    <i class="fa fa-circle-o nav-icon"></i>
                    <p> نمایش محصولات</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="product-add" class="nav-link">
                    <i class="fa fa-circle-o nav-icon"></i>
                    <p>اضافه کردن محصول </p>
                  </a>
                </li>
                
              </ul>
              
            </li>
            <li class="nav-item has-treeview">
              <a href="#" class="nav-link">
                <i class="nav-icon fa fa-table"></i>
                <p>
              جزعیات محصولات 
                  <i class="right fa fa-angle-left"></i>
                </p>
              </a>
              <ul class="nav nav-treeview">
                <li class="nav-item">
                  <a href="production_detail-show" class="nav-link">
                    <i class="fa fa-circle-o nav-icon"></i>
                    <p> نمایش جزعیات محصولات</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="production_detail-add" class="nav-link">
                    <i class="fa fa-circle-o nav-icon"></i>
                    <p>اضافه کردن جزعیات محصول </p>
                  </a>
                </li>
                
              </ul>
              
            </li>
            <li class="nav-item has-treeview">
              <a href="#" class="nav-link">
                <i class="nav-icon fa fa-table"></i>
                <p>
               مشتری ها
                  <i class="right fa fa-angle-left"></i>
                </p>
              </a>
              <ul class="nav nav-treeview">
                <li class="nav-item">
                  <a href="customer-show" class="nav-link">
                    <i class="fa fa-circle-o nav-icon"></i>
                    <p> نمایش  مشتری ها</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="customer-add" class="nav-link">
                    <i class="fa fa-circle-o nav-icon"></i>
                    <p>اضافه کردن مشتری ها  </p>
                  </a>
                </li>
                
              </ul>
              
            </li>

            <li class="nav-item has-treeview">
              <a href="#" class="nav-link">
                <i class="nav-icon fa fa-table"></i>
                <p>
               سفارشات 
                  <i class="right fa fa-angle-left"></i>
                </p>
              </a>
              <ul class="nav nav-treeview">
                <li class="nav-item">
                  <a href="order-show" class="nav-link">
                    <i class="fa fa-circle-o nav-icon"></i>
                    <p> نمایش  سفارشات </p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="order-add" class="nav-link">
                    <i class="fa fa-circle-o nav-icon"></i>
                    <p>اضافه کردن سفارشات   </p>
                  </a>
                </li>
                
              </ul>
              
            </li>

            <li class="nav-item has-treeview">
              <a href="#" class="nav-link">
                <i class="nav-icon fa fa-table"></i>
                <p>
               فروشات 
                  <i class="right fa fa-angle-left"></i>
                </p>
              </a>
              <ul class="nav nav-treeview">
                <li class="nav-item">
                  <a href="sale-show" class="nav-link">
                    <i class="fa fa-circle-o nav-icon"></i>
                    <p> نمایش  فروشات </p>
                  </a>
                </li>
              
                
              </ul>
              
            </li>

            <li class="nav-item has-treeview">
              <a href="#" class="nav-link">
                <i class="nav-icon fa fa-table"></i>
                <p>
               فعالیت های روزانه 
                  <i class="right fa fa-angle-left"></i>
                </p>
              </a>
              <ul class="nav nav-treeview">
                <li class="nav-item">
                  <a href="dailyTask-show" class="nav-link">
                    <i class="fa fa-circle-o nav-icon"></i>
                    <p> نمایش  فعالیت های روزانه </p>
                  </a>
                </li>
              
                
              </ul>
              
            </li>


          
      </div>
    </div>