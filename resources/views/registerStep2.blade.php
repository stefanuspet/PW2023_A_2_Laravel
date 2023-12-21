<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Millennial Auction</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <!-- font -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap" rel="stylesheet">

    <style>
        body {
            font-family: 'Roboto', sans-serif;
            background-image: url("{{ asset('images/lukisan.jpg') }}");
            background-size: cover;
            background-repeat: no-repeat;
            background-attachment: fixed;
        }

        .login-container {
            background-color: #2f3042;
            min-height: 100vh;
            width: 50%;
            margin-left: auto;
            display: flex;
            flex-direction: column;
            justify-content: center;
            padding-inline: 60px;
            color: white;
            overflow-y: auto;
        }



        .image-container {
            position: relative;
            cursor: pointer;
            width: 150px;
            height: 150px;
            overflow: hidden;
            position: relative;
            border-radius: 50%;
            background-color: black;
        }

        /* .overlay-text {
            position: absolute;
            width: 100%;
            height: 100%;
            top: 0;
            left: 0;
            background-color: rgba(0, 0, 0, 0.7);
            color: white;
            display: flex;
            justify-content: center;
            align-items: center;
            opacity: 0;
            pointer-events: none;
            transition: opacity 0.3s ease-in-out;
        }


        .image-container:hover .overlay-text {
            opacity: 1;
        } */
    </style>
</head>

<body>

    <div class="login-container">

        <h1 class="fw-bold py-5">Register</h1>

        <form action="{{ url('api/register2/' . request('idregistered')) }}" method="post" enctype="multipart/form-data" id="registerForm2">
            @method('PUT')
            @csrf
            <div class="d-flex justify-content-center">
                <label for="profile_pic" class="image-container">
                    <input type="file" style="display:none;">
                    <img id="preview" class="img-fluid rounded" src="{{ asset('img/profil_pic.jpg') }}" alt="">
                </label>
            </div>

            <div class="mb-2">
                <label class="form-label" for="alamat">Alamat</label>
                <input class="form-control" type="text" name="alamat" id="alamat">
            </div>
            <div class="mb-2 d-flex justify-content-between">
                <div style="width: 48%;">
                    <label class="form-label" for="negara">Negara</label>
                    <input class="form-control" type="text" name="negara" id="negara">
                </div>
                <div style="width: 48%;">
                    <label class="form-label" for="provinsi">Provinsi</label>
                    <input class="form-control" type="text" name="provinsi" id="provinsi">
                </div>
            </div>
            <div class="mb-2 d-flex justify-content-between">
                <div style="width: 48%;">
                    <label class="form-label" for="kota_kabupaten">Kabupaten/Kota</label>
                    <input class="form-control" type="text" name="kota_kabupaten" id="kota_kabupaten">
                </div>
                <div style="width: 48%;">
                    <label class="form-label" for="kecamatan">Kecamatan</label>
                    <input class="form-control" type="text" name="kecamatan" id="kecamatan">
                </div>
            </div>
            <div class="mb-4">
                <label class="form-label" for="kode_pos">Kode Pos</label>
                <input class="form-control" type="text" name="kode_pos" id="kode_pos">
            </div>
            <div class="mb-4">
                <button type="submit" class="btn text-white text-center" style="background-color: #ed8359; width: 100%;">
                    Register
                </button>
            </div>

        </form>
        <div class="text-center">
            <p>Already have an account? <a href="/" style="color: #ed8359; text-decoration: none;">Login</a></p>
        </div>
        <div id="alert-container" class="pt-2 pb-2"></div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            $("#registerForm2").submit(function(e) {
                e.preventDefault();

                var idregistered = sessionStorage.getItem('idregistered')
                // Perform form submission using AJAX
                $.ajax({
                    type: "PUT",
                    url: $(this).attr("action"),
                    data: $(this).serialize(),
                    success: function(response) {
                        console.log(response);
                        $("#alert-container").html(`
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                <strong>Success!</strong> Link verifikasi telah dikirim ke email anda. Silahkan cek email anda untuk mengaktifkan akun.
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        `);
                        setTimeout(() => {
                            window.location.href = "{{ route('login') }}";
                        }, 5000);
                    },
                    error: function(response) {
                        // Display error alert
                        console.log(response);
                        var errorMessage = response.responseJSON.message;

                        if (errorMessage && typeof errorMessage === 'object') {
                            // If the message is an object, use the first message
                            errorMessage = errorMessage[Object.keys(errorMessage)[0]];
                        } else {
                            // If the message is not an object, use the entire message
                            errorMessage = errorMessage || 'Changing password failed. Please try again.';
                        }
                        showAlert('danger', errorMessage);
                    }
                });
            });

            function showAlert(type, message) {
                // Clear existing alerts
                $("#alert-container").empty();

                // Create alert element
                var alertElement = $('<div class="alert alert-' + type + ' alert-dismissible fade show" role="alert">' +
                    '<strong>' + message + '</strong>' +
                    '<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>' +
                    '</div>');

                // Append alert to the container
                $("#alert-container").append(alertElement);
            }
        });
    </script>

</body>

</html>