<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <!-- bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <!-- font -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap" rel="stylesheet">
    <!-- fontawesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

    <style>
        body {
            font-family: 'Roboto', sans-serif;
            color: white;
        }

        .sidebar {
            width: 20%;
            background-color: #2f3042;
            margin: 0 0;
        }

        /* CSS untuk modal */
        .modal {
            display: none;
            position: absolute;
            top: 0;
            right: 0;
            width: 200px;
            /* Sesuaikan dengan lebar modal */
            background-color: #fff;
            border: 1px solid #888;
        }

        .modal-content {
            padding: 20px;
        }
    </style>
</head>

<body>
    <div class="d-flex">

        <!-- sidebar -->
        <div class="sidebar">
            <div class="d-flex gap-2 ml-3 p-4 align-items-center">
                <img src=" {{ asset('images/Logo.png') }}" alt="logo">
                <h1 class="fs-5 pt-2 pl-2">Millenial Auction</h1>
            </div>
            <div class="d-flex align-items-center justify-content-center" style="width: 90%; height: 45px; margin: 0 auto; background-color: #f2f4f8;">
                <i class="fas fa-search fa-lg" style="color: #697077; padding-inline: 10px;"></i>
                <input type="text" class="form-control" style="border: none; box-shadow: none; background-color: #f2f4f8;">
            </div>
            <div class="d-flex align-items-center justify-content-start" style="background-color: #ed8359; width: 90%; height: 45px; margin: 20px auto 0 auto; border-bottom: 1px solid white;">
                <i class="fas fa-home fa-lg p-3"></i>
                <p class="m-0 fw-medium fs-5">Dashboard</p>
            </div>
            <div class="d-flex align-items-center justify-content-start" style="background-color: transparent; width: 90%; height: 45px; margin: 0 auto 0 auto; border-bottom: 1px solid white;">
                <i class="fas fa-tags fa-lg p-3"></i>
                <p class="m-0 fw-medium fs-5">Auction</p>
            </div>
            <div class="d-flex align-items-center justify-content-start" style="background-color: transparent; width: 90%; height: 45px; margin: 0 auto 0 auto; border-bottom: 1px solid white;">
                <i class="fas fa-user fa-lg p-3"></i>
                <p class="m-0 fw-medium fs-5">User</p>
            </div>
        </div>
        <div class="flex-grow-1">
            <!-- header -->
            <div class="header" style="background-color: #2f3042; padding-inline: 30px; padding-block: 10px;">
                <div class="d-flex justify-content-between">
                    <div>
                        <h1 class="m-0 fs-3 fw-bold">Dashboard</h1>
                        <p class="m-0 fs-">Hi Admin ! Welcome to Dashboard</p>
                    </div>
                    <div class="d-flex align-items-center gap-2">
                        <div style="width: 30px; height: 30px; background-color: white; border-radius: 50%;"></div>
                        <p class="m-0 fw-medium">Admin</p>
                    </div>
                </div>
            </div>
            <div class="container-fluid" style="padding-inline: 32px; padding-block: 20px;">
                @yield('content')
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    <script>
        // Fungsi untuk menampilkan modal
        function showModal() {
            var modal = document.getElementById("myModal");
            modal.style.display = "block";
        }

        // Fungsi untuk menyembunyikan modal
        function hideModal() {
            var modal = document.getElementById("myModal");
            modal.style.display = "none";
        }

        // Menambahkan event listener untuk ikon
        var icons = document.querySelectorAll(".fa-ellipsis");
        icons.forEach(function(icon) {
            icon.addEventListener("click", showModal);
        });
    </script>


</body>

</html>