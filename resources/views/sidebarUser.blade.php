<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Millennial Auction</title>

    <!-- font -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">

    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

    <!-- Boostrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">

    <!-- admin lte -->
    <script src="https://cdn.jsdelivr.net/npm/admin-lte@3.1/dist/js/adminlte.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/admin-lte@3.1/dist/css/adminlte.min.css">

    <!-- Google Font: Poppins -->
    <link href='https://fonts.googleapis.com/css?family=Poppins' rel='stylesheet'>
</head>

<style>
    .nav-item:hover {
        background-color: #ef8354;
    }

    .user-panel:hover {
        background-color: #ef8354;
    }
</style>

<body class="hold-transition sidebar-mini">
    <div class="wrapper">
        <!-- Navbar -->
        <div class="main-header" style="border: none;">
            <nav class="navbar navbar-expand navbar-white navbar-light">
                <div class="d-flex" style="width: 100%;">
                    <a class="nav-link" data-widget="pushmenu" href="#" role="button">
                        <i class="fas fa-bars"></i>
                    </a>
                    <div class="d-flex mx-auto align-items-center gap-2 px-2" style="background-color: white; width: 50%; height: 40px; border-radius: 20px; color: #000000; padding: 4px; border: solid 1px #000000; overflow: hidden;">
                        <i class="fa-solid fa-magnifying-glass" style="color: #000000;"></i>
                        <input onchange="search()" type="text" id="searchInput" class="form-control border-0" placeholder="Search" aria-label="Search" style="border: none;" name="nama_produk">
                    </div>
                    <a class="text-light btn btn-small me-3" onclick="fungsilogout()" id="logoutbtn" role="button" style="background-color: #ef8354;">
                        LOGOUT
                    </a>
                </div>
            </nav>

        </div>
        <!-- /.navbar -->
        <!-- Main Sidebar Container -->
        <aside class="main-sidebar sidebar-light-primary elevation-4">
            <!-- Brand Logo -->
            <a href="#" class="brand-link mx-auto">
                <img src=" {{ asset('img/logobaru.png') }}" alt="Millenial Logo" style="width: 80%;">
                <!-- <span class="brand-text font-weight-bold">Millenial Auction</span> -->
            </a>

            <!-- Sidebar -->
            <div class="sidebar">
                <!-- Sidebar user panel (optional) -->
                <div class="user-panel pt-3 pb-3 mb-3 d-flex">
                    <div class="ml-2">
                        <img src="{{ asset('img/profil_pic.jpg') }}" class="img-circle elevation-2 img-fluid object-fit-cover" alt="User Image" id="imageprofil" style="height:35px; width:35px;">
                    </div>
                    <a href="{{ url('userprofil') }}" id="profileLink" class="d-block">
                        <div class="info" id="usernameprofil">
                        </div>
                    </a>
                    <div id="loading-icon" style="display: none;">
                        <div class="spinner-border text-light" role="status">
                            <span class="visually-hidden">Loading...</span>
                        </div>
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
                        <li class="nav-item">
                            <a href="{{ url('/home') }}" class="nav-link"> <!-- masukin url sendiri -->
                                <i class="fa-solid fa-house"></i>
                                <p class="m-0 p-2">Home</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ url('sell') }}" class="nav-link">
                                <i class="fa-solid fa-tags"></i>
                                <p class="m-0 p-2">Sell With Us</p>
                            </a>
                        </li>
                    </ul>
                </nav>
                <!-- /.sidebar-menu -->
            </div>
            <!-- /.sidebar -->
        </aside>

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper mb-0 mt-0" style="background-color: #2d3142; padding-block: 20px;">
            @yield('content')
        </div>

        <!-- /.content-wrapper -->
        <!-- Main Footer -->
        <footer class="main-footer" style="padding: 0; border: none; font-family: 'Poppins', sans-serif; background-color: #1a1e29;">
            <div class="d-flex text-white justify-content-between">
                <div style="width: 35%;">
                    <div class="text-white d-flex justify-content-between" style="width: 100%; padding-block: 20px; padding-inline: 30px;">
                        <div class="mb-0 d-flex align-items-center gap-2" style="width: 100%; text-align: justify;">
                            <img src="{{asset('img/logo4.png')}}" alt="" width="60">
                            <h1 class="m-0 fw-bold fs-2">Millennial Auction</h1>
                        </div>
                    </div>
                    <div class="d-flex text-white gap-2" style="padding-top: 20px; padding-inline: 40px;">
                        <i class="fa-solid fa-phone"></i>
                        <p>+628888888888</p>
                    </div>
                    <div class="d-flex text-white gap-2" style="padding-inline: 40px;">
                        <i class="fa-solid fa-envelope"></i>
                        <p>millennialauction@email.com</p>
                    </div>
                </div>
                <div style="width: 30%; padding-top: 45px;">
                    <h1 class="mb-1 fw-bold fs-5">About Us</h1>
                    <p class="m-0 fw-light fs-6 text-justify">Millennial Auction merupakan website lelang terpercaya yang berbasis online.
                        Website ini dibuat untuk menyelesaikan Ujian Tengah semester.</p>
                </div>
                <div style="padding-inline: 50px; padding-top: 50px;">
                    <div class="d-flex gap-3 pt-3 align-items-center justify-content-center">
                        <img src="{{asset ('images/instagram.svg')}}" alt="">
                        <img src="{{asset ('images/facebook.svg')}}" alt="">
                        <img src="{{asset ('images/twitter.svg')}}" alt="">
                    </div>
                    <h1 class="mb-0 fs-5 fw-bold">Contact Us</h1>
                </div>
            </div>
            <div class="text-white" style="background-color: #1f2538; width: 100%; padding-inline: 60px;">
                <p class="text-center mb-0">© 2023 Kelompok Lelang. Seluruh hak cipta dilindungi.</p>
            </div>
        </footer>
    </div>



    <!-- ./wrapper -->
    <!-- REQUIRED SCRIPTS -->
    <!-- jQuery -->

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <!-- Bootstrap 5.3 -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>

    <script>
        // get all products
        const search = () => {
            var a = document.getElementById("searchInput");

            console.log(a.value);
        }

        $(document).ready(function() {
            fetchUserData();
        });

        //untuk tampilkan username dan profile picture di sidebar
        function fetchUserData() {
            const accessToken = localStorage.getItem('access_token');
            const baseUrl = 'http://127.0.0.1:8000';
            $("#loading-icon").show();

            $.ajax({
                url: baseUrl + '/api/profile',
                type: 'GET',
                headers: {
                    'Authorization': 'Bearer ' + accessToken,
                    'Accept': 'application/json',
                    'Content-Type': 'application/json'
                },
                success: function(response) {
                    // Process the user data as needed
                    console.log(response);

                    var user = response.user;

                    // Update profile picture
                    $("#imageprofil").attr('src', user.profile_pic ? "{{ asset('storage/img') }}/" + user.profile_pic : "{{ asset('img/profil_pic.jpg') }}");

                    // Update other user information
                    $("#usernameprofil").html(`<strong>${user.username}</strong>`);

                },
                error: function(response) {
                    console.log(response);
                },
                complete: function() {
                    // Hide loading icon when the request is complete
                    $("#loading-icon").hide();
                }
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