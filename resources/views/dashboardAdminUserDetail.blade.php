<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Projek Tubes</title>
    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Google Font: Bayon -->
    <link href='https://fonts.googleapis.com/css?family=Bayon' rel='stylesheet'>
    <!-- Google Font: Lato -->
    <link href='https://fonts.googleapis.com/css?family=Lato' rel='stylesheet'>
    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <!-- Google Font: Poppins -->
    <link href='https://fonts.googleapis.com/css?family=Poppins' rel='stylesheet'>
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset('css/adminlte.min.css') }}">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <!-- Boostrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css"
    rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN"
    crossorigin="anonymous">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css" rel="stylesheet">

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

    <style>
        .bar {
            background-color: #2d3142;
            color: #ffffff;
        }

        .welcome {
            font-family: 'Poppins';
        }
    </style>
</head>
<body class="hold-transition sidebar-mini">
    <div class="wrapper welcome">
        <nav class="main-header navbar navbar-expand bar">
             <!-- sidebar push button -->
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a href="#" data-widget="pushmenu" class="nav-link text-white" role="button">
                        <i class="fas fa-bars"></i>
                    </a>
                </li>
            </ul>
            <!--welcome -->
            <ul class="navbar-nav ms-4">
                <li class="nav-item">
                    <h5 class="m-0">
                        Millenial Auction
                    </h5>

                </li>
            </ul>
            <!--Right navbar links -->
            <ul class="navbar-nav ml-auto">
                <li class="nav-item d-flex align-items-center">
                    <i class="bi bi-person-circle fs-1"></i>
                </li>
                <li class="nav-item d-flex align-items-right">
                    <a href="#" class="nav-link text-white" role="button">
                        <p class="m-0" style="font-size: 14px;">Admin</p>
                    </a>
                </li>
            </ul>
        </nav>

        <aside class="main-sidebar bar elevation-4 p-2" style="position: fixed; height: 100vh">
            <a href="#" class="brand-link text-decoration-none">
                <img src="{{ asset('images/logo5.png') }}" alt="logo" class="brand-image img-circle elevation-3" style="opacity: .8;">
                <span class="brand-text font-weight-light" style="color: white;">Millenial Auction</span>
            </a>
            <!-- Sidebar -->
            <div class="sidebar">
                
                <!-- SidebarSearch Form -->
                <div class="form-inline">
                    <div class="input-group" data-widget="sidebar-search">
                        <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
                        <div class="input-group-append">
                            <button class="btn btn-sidebar">
                                <i class="fas fa-search fa-fw text-white"></i>
                            </button>
                        </div>
                    </div>
                </div>
                <!-- Sidebar Menu -->
                <nav class="mt-2">
                    
                    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                        <li class="nav-item">
                            <a href="{{ url('auction') }}" class="nav-link">
                                <i class="nav-icon fa-solid fa-house"></i>
                                <p> Dashboard</p>
                            </a>
                        </li>
                    </ul>

                    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                        <li class="nav-item">
                            <a href="{{ url('auction') }}" class="nav-link">
                                <i class="nav-icon fa-solid fa-user"></i>
                                <p> User</p>
                            </a>
                        </li>
                    </ul>

                    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                        <li class="nav-item">
                            <a href="{{ route('auction') }}" class="nav-link">
                                <i class="nav-icon fa-solid fa-gavel"></i>
                                <p> Auction</p>
                            </a>
                        </li>
                    </ul>
                </nav>
                <!-- /.sidebar-menu -->
            </div>
            <!-- /.sidebar -->
        </aside>
        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper" style="background-color: #2d3142;">
            @yield('content')
        </div>
        <!-- /.content-wrapper -->
        
    </div>
    <!-- ./wrapper -->
    <!-- REQUIRED SCRIPTS -->
    <!-- jQuery -->
    <script src="{{ asset('plugins/jquery/jquery.min.js') }}"></script>
    <!-- Bootstrap 5.3 -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL"
        crossorigin="anonymous"></script>
    <!-- AdminLTE App -->
    <script src="{{ asset('js/adminlte.min.js') }}"></script>
    <script>
        const toastTrigger = document.getElementById('toastPresensiBtn');
        const toastLiveExample = document.getElementById('toastPresensi');

        if (toastTrigger) {
            const toastBootstrap = new bootstrap.Toast(toastLiveExample); // Updated initialization
            toastTrigger.addEventListener('click', () => {
                console.log('Button clicked');
                toastBootstrap.show();
            });
        }
    </script>
</body>
</html>