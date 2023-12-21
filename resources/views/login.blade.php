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
            height: 100vh;
            width: 50%;
            position: absolute;
            left: 0;
            top: 0;
            display: flex;
            flex-direction: column;
            justify-content: center;
            padding-inline: 60px;
            color: white;
        }
    </style>
</head>

<body>
    <div class="login-container">
        <div class="mx-auto">
            <img src="{{asset ('img/logo4.png')}}" alt="" width="150px">
        </div>
        <h1 class="fw-bold" style="padding-bottom: 24px;">Login</h1>
        <form action="{{ url('api/login') }}" id="loginForm" method="post">
            <div class="mb-2">
                <label class="form-label" for="email_user">Email</label>
                <input class="form-control" type="email" name="email_user" id="email_user">
            </div>
            <div class="mb-2">
                <label class="form-label" for="password">Password</label>
                <div class="input-group">
                    <input class="form-control" type="password" name="password" id="password">
                    <span class="input-group-text" id="password-toggle">
                        <i class="fas fa-eye"></i>
                    </span>
                </div>
            </div>

            <div class="d-flex justify-content-between mb-2">
                <div class="form-check">
                    <input type="checkbox" class="form-check-input" id="adminCheckbox">
                    <label class="form-check-label" for="adminCheckbox">Login as Admin</label>
                </div>
                <a href="/forgotpage" style="color: #ed8359; text-decoration: none;">Forgot Password</a>
            </div>
            <div class="mb-4">
                <input type="hidden" id="adminInput" name="admin" value="false"> <!-- Input hidden untuk status admin -->
                <button class="btn text-white text-center" style="background-color: #ed8359; width: 100%;">
                    Login
                </button>
            </div>

        </form>
        <div class="text-center">
            <p>Dont have an account? <a href="/registerStep1" style="color: #ed8359; text-decoration: none;">Register</a></p>
        </div>
        <div id="alert-container"></div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            $("#password-toggle").on("click", function() {
                var passwordInput = $("#password");
                if (passwordInput.attr("type") === "password") {
                    passwordInput.attr("type", "text");
                } else {
                    passwordInput.attr("type", "password");
                }
            });

            $("#adminCheckbox").on("change", function() {
                if (this.checked) {
                    $("#adminInput").val("true"); // Set input hidden menjadi "true" jika checkbox di-check
                } else {
                    $("#adminInput").val("false"); // Set input hidden menjadi "false" jika checkbox tidak di-check
                }
            });

            $("#loginForm").submit(function(e) {
                e.preventDefault();

                //jika login checkbox as admin
                if ($("#adminInput").val() === "true") {
                    console.log("admin try login..");
                    $.ajax({
                        type: "POST",
                        url: '/api/loginadmin',
                        data: $(this).serialize(),
                        success: function(response) {
                            // Display success alert
                            console.log(response);
                            localStorage.setItem('access_token', response.access_token);
                            localStorage.setItem('token', response.access_token);
                            console.log("access token di login " + response.access_token);

                            showAlert('success', 'Login Admin Success!');

                            setTimeout(function() {
                                window.location.href = "/homeadmin";
                            }, 2000);
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
                                errorMessage = errorMessage || 'Login admin failed. Please try again.';
                            }
                            showAlert('danger', errorMessage);
                        }
                    });
                } else {
                    console.log("user try login..");
                    $.ajax({
                        type: "POST",
                        url: '/api/login',
                        data: $(this).serialize(),
                        success: function(response) {
                            // Display success alert
                            console.log(response);
                            localStorage.setItem('access_token', response.access_token);
                            localStorage.setItem('token', response.access_token);
                            console.log("access token di login " + response.access_token);

                            showAlert('success', 'Login Success!');

                            setTimeout(function() {
                                window.location.href = "/home";
                            }, 2000);
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
                                errorMessage = errorMessage || 'Login failed. Please try again.';
                            }
                            showAlert('danger', errorMessage);
                        }
                    });
                }


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