        @php 
        $current_route=request()->route()->getName();
        @endphp

        <!-- Main Sidebar Container -->
        <aside class="main-sidebar sidebar-dark-primary elevation-4">
            <!-- Brand Logo -->
            <a href="index3.html" class="brand-link">
            <img src="../dist/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
            <span class="brand-text font-weight-light">Admin Panel</span>
            </a>
    
            <!-- Sidebar -->
            <div class="sidebar">
            <!-- Sidebar user panel (optional) -->
            <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image ">
              {{-- @if(isset($user) && $user->image) --}}
              <div class="form-group text-center">
              <img src="{{ asset('storage/' . Auth::user()->image) }}" alt="Existing Profile Image"
              class="img-circle elevation-3" style="width: 60px; height: 60px;">
            </div>            
              {{-- @endif --}}
            </div>
            <div class="info">
              <a href="#" class="d-block m-3">{{auth('web')->user()->name}} </a>
            </div>
            </div>
    
            <!-- SidebarSearch Form -->
            <div class="form-inline">
            <div class="input-group" data-widget="sidebar-search">
            <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
            <div class="input-group-append">
            <button class="btn btn-sidebar">
            <i class="fas fa-search fa-fw"></i>
            </button>
            </div>
            </div>
            </div>
    
            <!-- Sidebar Menu -->
            <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
            <!-- Add icons to the links using the .nav-icon class
            with font-awesome or any other icon font library -->
            <li class="nav-item">
            <a href="{{route('dashboard')}}" class="nav-link {{$current_route=='dashboard'?'active':''}}">
            <i class="nav-icon fas fa-tachometer-alt"></i>
            <p>
              Dashboard
            </p>
            </a>
            </li>
            
    
            <li class="nav-item {{$current_route=='index'?'menu-open':''}}">
            <a href="#" class="nav-link {{$current_route=='index'?'active':''}} ">
            <i class="nav-icon fas  fas fa-users"></i>
            <p>
            User Management
            <i class="right fas fa-angle-left"></i>
            </p>
            </a>
            <ul class="nav nav-treeview">
            <li class="nav-item">
            <a href="{{route('index')}}" class="nav-link {{$current_route=='index'?'active':''}} ">
            <i class="far fas fa-user"></i>
            <p>Users List</p>
            </a>
            </li>
            </ul>

            <li class="nav-item {{$current_route=='home'?'menu-open':''}}">
              <a href="#" class="nav-link {{$current_route=='home'?'active':''}} ">
              <i class="fa fa-address-book" aria-hidden="true"></i>
              <p>
              Category Management
              <i class="right fas fa-angle-left"></i>
              </p>
              </a>
              <ul class="nav nav-treeview">
              <li class="nav-item">
              <a href="{{route('home')}}" class="nav-link {{$current_route=='home'?'active':''}} ">
                <i class="fa fa-list" aria-hidden="true"></i>
              <p>Categories List</p>
              </a>
              </li>
              </ul>

            <li class="nav-item {{$current_route=='home'?'menu-open':''}}">
            <a href="#" class="nav-link {{$current_route=='home'?'active':''}} ">
            <i class="nav-icon fas  fas fa-blog"></i>
            <p>
            Blog Management
            <i class="right fas fa-angle-left"></i>
            </p>
            </a>
            <ul class="nav nav-treeview">
            <li class="nav-item">
            <a href="{{route('home')}}" class="nav-link {{$current_route=='home'?'active':''}} ">
              <i class="fa fa-list" aria-hidden="true"></i>
            <p>Blog List</p>
            </a>
            </li>
            </ul>

            </li>
            </li>
            </ul>
            </nav>
            <!-- /.sidebar-menu -->
            </div>
            <!-- /.sidebar -->
            </aside>