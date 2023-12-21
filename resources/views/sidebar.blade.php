<!-- Color Pallete
    Biru tua : #2d3142
    Biru muda : #4f5d75
    Oren : #ef8354
    Abu : #bfc0c0
    Putih : #ffffff
-->
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Millennial Auction</title>
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
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/admin-lte@3.1/dist/js/adminlte.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/admin-lte@3.1/dist/css/adminlte.min.css">

    <!-- Boostrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css" rel="stylesheet">

    <!-- ./wrapper -->
    <!-- Bootstrap 5.3 -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>

    <style>
        .bar {
            background-color: #2d3142;
            color: #ffffff;
        }

        .welcome {
            font-family: 'Poppins';
        }

        .utkhover:hover {
            background-color: #ef8354;
            color: white;
        }

        .nav-icon {
            color: white;
        }

        .tekshover {
            color: white;
        }

        .tekshover:hover {
            color: white;
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
            <!-- <ul class="navbar-nav ms-4">
                <li class="nav-item">
                    <img src="{{ asset('img/logobaruadmin.png') }}" alt="logo" style="height: 55px; width:140px;">
                </li>
            </ul> -->
            <!--Right navbar links -->
            <ul class="navbar-nav ml-auto">
                <li class="nav-item d-flex align-items-center">
                    <a class="text-light btn btn-small me-3" onclick="fungsilogout()" id="logoutbtn" role="button" style="background-color: #ef8354;">
                        <i class="far fa-window-close"></i> Logout
                    </a>
                </li>
            </ul>
        </nav>

        <aside class="main-sidebar bar elevation-4 p-2" style="position: fixed; height: 100vh">
            <a href="#" class="brand-link text-decoration-none">
                <img src=" {{ asset('img/logobaruadmin.png') }}" alt="Millenial Logo" style="width: 80%;">
            </a>
            <!-- Sidebar -->
            <div class="sidebar">

                <!-- SidebarSearch Form -->
                <div class="form-inline">
                    <div class="input-group" data-widget="sidebar-search">
                        <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
                        <div class="input-group-append">
                            <button class="btn btn-sidebar">
                                <i class="fas fa-search fa-fw text-light"></i>
                            </button>
                        </div>
                    </div>
                </div>
                <!-- Sidebar Menu -->
                <nav class="mt-2">

                    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                        <li class="nav-item utkhover">
                            <a href="{{ url('homeadmin') }}" class="nav-link">
                                <i class="nav-icon fa-solid fa-house"></i>
                                <p class="tekshover"> Dashboard</p>
                            </a>
                        </li>
                    </ul>

                    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                        <li class="nav-item utkhover">
                            <a href="{{ url('manageuser') }}" class="nav-link">
                                <i class="nav-icon fa-solid fa-user"></i>
                                <p class="tekshover"> User</p>
                            </a>
                        </li>
                    </ul>

                    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                        <li class="nav-item utkhover">
                            <a href="{{ url('auction') }}" class="nav-link">
                                <i class="nav-icon fa-solid fa-gavel"></i>
                                <p class="tekshover"> Auction</p>
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

        function fungsilogout() {
            const accessToken = localStorage.getItem('access_token');
            const baseUrl = 'http://127.0.0.1:8000';

            $.ajax({
                url: baseUrl + '/api/logout',
                type: 'POST',
                headers: {
                    'Authorization': 'Bearer ' + accessToken,
                    'Accept': 'application/json',
                    'Content-Type': 'application/json'
                },
                success: function(response) {
                    console.log(response);
                    localStorage.removeItem('access_token');
                    window.location.href = baseUrl + '/api/login';
                },
                error: function(response) {
                    console.log(response);
                }
            })
        }
    </script>
</body>

</html>