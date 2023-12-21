@extends('sidebarUser')

@section('content')


<style>
    .btn-custom {
        color: white;
        background-color: #ef8354;
        border: none;
        margin-right: 10px;
    }

    .btn-custom:hover {
        color: white;
        background-color: #ef8354;
        border: none;
        margin-right: 10px;
    }

    .btn-outline-custom {
        color: #ef8354;
        border-color: #ef8354;
    }

    .btn-outline-custom:hover {
        color: #ef8354;
        border-color: #ef8354;
    }

    .img-fluid {
        height: 70%;
        width: 70%;
    }

    /* Add !important to override user agent styles */
    .card#cardprofil,
    .card#cardalamat {
        display: none;
    }

    /* Hide other cards by default */
    .card {
        display: none;
    }

    .btnlogout {
        color: #ef8354;
        border-color: #ef8354;

    }

    .btnlogout:hover {
        color: white;
        border-color: #ef8354;
        background-color: red;
    }
</style>


<div class="container-fluid p-3 " style="background-color: #2d3142;">

    <div class="container-fluid p-3 " style="display: flex; align-items: center; justify-content:center;">
        <h1 class="text-light mr-3"> <strong> Profil </strong></h1>
        <div id="loading-icon" style="display: none;">
            <div class="spinner-border text-light" role="status">
                <span class="visually-hidden">Loading...</span>
            </div>
        </div>
    </div>


    <div class="container-fluid">
        <div class="row">
            <div class="col-2 mr-5"></div>
            <div class="col-6 text-center ml-5">
                <button class="btn btn-custom m-3" onclick="showCard('cardprofil'); buttonKlikProfil()" id="btneditprofil">
                    <strong>Edit Profile</strong>
                </button>
                <button class="btn btn-outline-custom m-3" onclick="showCard('cardalamat'); buttonKlikAlamat();" id="btneditalamat">
                    <strong>Edit Alamat</strong>
                </button>

            </div>
            <div class="col-2">
                <a href="{{ url('/') }}">
                    <button class="btn btnlogout m-3 border-3 font-weight-bolder" onclick="fungsilogout()" id="logoutbtn">
                        <strong>LOGOUT</strong>
                    </button>
                </a>
            </div>
        </div>


        <div class="card m-3" style="border:none;" id="cardprofil" style="display: none;">
            <div class="card-header" id="usernameheader"></div>
            <form method="post" enctype="multipart/form-data" id="form1">
                @method('PUT')
                @csrf
                <div class="card-body">
                    <div class="row">
                        <div class="col-4 pl-5">
                            <div class="row text-center">
                                <img id="profilePicPreview" alt="Profile Picture" class="img-fluid rounded-circle object-fit-cover" style="height:30vh; width:30vh;">
                            </div>
                            <div class="row text-center">
                                <label for="profile_pic" class="btn btn-custom mt-3" style="width: 70%;">
                                    Edit Profile Pic
                                    <input type="file" id="profile_pic" name="profile_pic" style="display: none;" accept="image/*" onchange="previewProfilePic(this)">
                                </label>
                            </div>

                        </div>
                        <div class="col-8 pr-4">
                            <div class="form-group row">
                                <label for="username" class="col-sm-3 col-form-label">Username</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" id="username" name="username">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="nama_user" class="col-sm-3 col-form-label">Name</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" id="nama_user" name="nama_user">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="email_user" class="col-sm-3 col-form-label">Email</label>
                                <div class="col-sm-9">
                                    <input type="email" class="form-control" id="email_user" name="email_user">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="no_telp_user" class="col-sm-3 col-form-label">No. Telepon</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" id="no_telp_user" name="no_telp_user">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="password" class="col-sm-3 col-form-label">Password</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" id="password" name="password" readonly>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-footer text-end " style="background-color: white;">
                    <button class="btn btn-custom" type="submit" id="btnsave" style="width: 200px;">Save</button>
                </div>
                <div id="alert-container1" class="px-4 pb-2 pt-2"></div>
                <div id="alert-container11" class="px-4 pb-2"></div>
            </form>
        </div>

        <div class="card m-3" style="border:none;" id="cardalamat" style="display:none;">
            <div class="card-header" id="usernameheader"></div>
            <form action="{{ url('api/updateProfile2') }}" method="post" enctype="multipart/form-data" id="form2">
                @method('PUT')
                @csrf
                <div class="card-body">
                    <div class="form-group row">
                        <label for="negara" class="col-sm-2 col-form-label">Negara</label>
                        <div class="col-sm-4 pr-3">
                            <input type="text" class="form-control" id="negara" name="negara">
                        </div>
                        <label for="provinsi" class="col-sm-2 col-form-label">Provinsi</label>
                        <div class="col-sm-4">
                            <input type="text" class="form-control" id="provinsi" name="provinsi">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="kota_kabupaten" class="col-sm-2 col-form-label">Kabupaten</label>
                        <div class="col-sm-4  pr-3">
                            <input type="text" class="form-control" id="kota_kabupaten" name="kota_kabupaten">
                        </div>
                        <label for="kecamatan" class="col-sm-2 col-form-label">Kecamatan</label>
                        <div class="col-sm-4">
                            <input type="text" class="form-control" id="kecamatan" name="kecamatan">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="kode_pos" class="col-sm-2 col-form-label">Kode Pos</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="kode_pos" name="kode_pos">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="alamat" class="col-sm-2 col-form-label">Alamat</label>
                        <div class="col-sm-10">
                            <textarea class="form-control" id="alamat" name="alamat" rows="3"></textarea>
                        </div>
                    </div>
                </div>
                <div class="card-footer text-end " style="background-color: white;">
                    <button class="btn btn-custom" type="submit" id="btnsave" style="width: 200px;">Save</button>
                </div>
                <div id="alert-container2" class="p-4"></div>

            </form>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    document.addEventListener("DOMContentLoaded", function() {
        // Show cardprofil by default when the page loads
        var cardprofil = document.getElementById('cardprofil');
        cardprofil.style.display = "block";
    });

    function showCard(cardId, username) {
        // Get all card elements
        var cards = document.querySelectorAll('.card');

        // Hide all cards
        cards.forEach(function(card) {
            card.style.display = "none";
        });

        // Show the specified card
        var cardToShow = document.getElementById(cardId);
        cardToShow.style.display = "block";

        var cardHeader = cardToShow.querySelector('.card-header');
        if (cardHeader) {
            cardHeader.innerHTML = '<strong>' + username + '</strong>';
        }
    }

    function buttonKlikAlamat() {
        var btneditalamat = document.getElementById('btneditalamat');
        var btneditprofil = document.getElementById('btneditprofil');

        btneditalamat.classList.remove('btn-outline-custom');
        btneditalamat.classList.add('btn-custom');

        btneditprofil.classList.remove('btn-custom');
        btneditprofil.classList.add('btn-outline-custom');

    }

    function buttonKlikProfil() {
        var btneditalamat = document.getElementById('btneditalamat');
        var btneditprofil = document.getElementById('btneditprofil');

        btneditprofil.classList.remove('btn-outline-custom');
        btneditprofil.classList.add('btn-custom');

        btneditalamat.classList.remove('btn-custom');
        btneditalamat.classList.add('btn-outline-custom');
    }

    function fungsilogout() {
        const accessToken = localStorage.getItem('access_token');

        $.ajax({
            url: 'api/logout',
            type: 'POST',
            headers: {
                'Authorization': 'Bearer ' + accessToken,
                'Accept': 'application/json',
                'Content-Type': 'application/json'
            },
            success: function(response) {
                console.log(response);
                localStorage.removeItem('access_token');
                window.location.href = 'api/login';
            },
            error: function(response) {
                console.log(response);
            }
        })
    }

    function previewProfilePic(input) {
        var preview = document.getElementById('profilePicPreview');
        var file = input.files[0];
        var reader = new FileReader();

        reader.onloadend = function() {
            preview.src = reader.result;
        };

        if (file) {
            reader.readAsDataURL(file);
        }
    }

    function fetchProfileData() {
        const accessToken = localStorage.getItem('access_token');
        console.log("access token di home " + accessToken);
        if (!accessToken) {
            // Redirect to login when the token is not available
            console.error('Access token not available. Redirect to login.');
            window.location.href = 'api/login';
            return;
        }

        // Show loading icon
        $("#loading-icon").show();

        $.ajax({
            url: 'api/profile',
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
                $("#profilePicPreview").attr('src', user.profile_pic ? "{{ asset('storage/img') }}/" + user.profile_pic : "{{ asset('img/profil_pic.jpg') }}");

                // Update other user information
                $("#username").val(user.username);
                $("#nama_user").val(user.nama_user);
                $("#email_user").val(user.email_user);
                $("#no_telp_user").val(user.no_telp_user);
                $("#negara").val(user.negara);
                $("#provinsi").val(user.provinsi);
                $("#kota_kabupaten").val(user.kota_kabupaten);
                $("#kecamatan").val(user.kecamatan);
                $("#kode_pos").val(user.kode_pos);
                $("#alamat").val(user.alamat);

                $("#usernameheader").html(`<strong>${user.username}</strong>`);

                showCard('cardprofil', user.username);
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


    $(document).ready(function() {
        fetchProfileData();

        $("#form1").submit(function(e) {
            e.preventDefault();
            const accessToken = localStorage.getItem('access_token');

            if (!accessToken) {
                // Redirect to login when the token is not available
                console.error('Access token not available. Redirect to login.');
                window.location.href = 'api/login';
                return;
            }

            // Perform form submission using AJAX
            $.ajax({
                type: "PUT",
                url: 'api/updateProfile1',
                data: $(this).serialize(),
                headers: {
                    'Authorization': 'Bearer ' + accessToken,
                },
                success: function(response) {
                    console.log(response);
                    $("#alert-container1").html(`
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                <strong>Success!</strong> Update Profil part 1 Berhasil!
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        `);
                },
                error: function(response) {
                    console.log(response);
                    $("#alert-container1").html(`
                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                <strong>Error!</strong> ${response.responseJSON.message}
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        `);
                }
            });

            //untuk pp
            var formData = new FormData(this);
            // Check if a file is selected before attempting to upload
            var fileInput = $('#profile_pic')[0];
            if (fileInput.files.length > 0) {
                $.ajax({
                    type: "POST",
                    url: 'api/updateProfilePic',
                    headers: {
                        'Authorization': 'Bearer ' + accessToken,
                        'Accept': 'application/json',
                    },
                    data: formData,
                    contentType: false,
                    processData: false,
                    success: function(response) {
                        console.log(response);
                        $("#alert-container11").html(`
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <strong>Success!</strong> Update Profil Picture Berhasil!
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    `);
                    },
                    error: function(response) {
                        console.log(response);
                        $("#alert-container11").html(`
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <strong>Error!</strong> ${response.responseJSON.message}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    `);
                    }
                });
            } else {
                console.log('No file selected for upload. Skipping file upload.');
                // Add any additional logic or messages for the case where no file is selected
            }
        });

        $("#form2").submit(function(e) {
            e.preventDefault();
            const accessToken = localStorage.getItem('access_token');
            console.log("access token di home " + accessToken);
            if (!accessToken) {
                // Redirect to login when the token is not available
                console.error('Access token not available. Redirect to login.');
                window.location.href = 'api/login';
                return;
            }

            // Perform form submission using AJAX
            $.ajax({
                type: "PUT",
                url: $(this).attr("action"),
                data: $(this).serialize(),
                headers: {
                    'Authorization': 'Bearer ' + accessToken,
                },
                success: function(response) {
                    console.log(response);
                    $("#alert-container2").html(`
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                <strong>Success!</strong> Update Profil part 2 Berhasil!
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        `);
                },
                error: function(response) {
                    console.log(response);
                    $("#alert-container2").html(`
                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                <strong>Error!</strong> ${response.responseJSON.message}
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        `);
                }
            });
        });
    });
</script>


@endsection