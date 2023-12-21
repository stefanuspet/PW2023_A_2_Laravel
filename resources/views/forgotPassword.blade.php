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
            right: 0;
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
        <h1 class="fw-bold" style="padding-bottom: 24px;">Forgot Password</h1>
        <form method="post" enctype="multipart/form-data" id="forgotForm">
            @method('put')
            @csrf

            <div class="mb-2">
                <label class="form-label" for="email_user">Email</label>
                <input class="form-control" type="email" name="email_user" id="email_user">
            </div>
            <div class="mb-2">
                <label class="form-label" for="password_new">New Password</label>
                <div class="input-group">
                    <input class="form-control" type="password" name="password_new" id="password_new">
                    <span class="input-group-text" id="password-toggle1">
                        <i class="fas fa-eye"></i>
                    </span>
                </div>
            </div>
            <div class="mb-4">
                <label class="form-label" for="password_confirm">Confirm Password</label>
                <div class="input-group">
                    <input class="form-control" type="password" name="password_confirm" id="password_confirm">
                    <span class="input-group-text" id="password-toggle2">
                        <i class="fas fa-eye"></i>
                    </span>
                </div>
            </div>
            <div class="mb-4">
                <button type="submit" class="btn text-white text-center" style="background-color: #ed8359; width: 100%;">
                    Save
                </button>
            </div>

        </form>
        <div class="text-center">
            <a href="/" style="color: #ed8359; text-decoration: none;">Back to Login</a></p>
        </div>

        <div id="alert-container"></div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            $("#password-toggle1").on("click", function() {
                var passwordInput = $("#password_new");
                if (passwordInput.attr("type") === "password") {
                    passwordInput.attr("type", "text");
                } else {
                    passwordInput.attr("type", "password");
                }
            });

            $("#password-toggle2").on("click", function() {
                var passwordInput = $("#password_confirm");
                if (passwordInput.attr("type") === "password") {
                    passwordInput.attr("type", "text");
                } else {
                    passwordInput.attr("type", "password");
                }
            });

            $("#forgotForm").submit(function(e) {
                e.preventDefault();

                // Perform form submission using AJAX
                $.ajax({
                    type: "PUT",
                    url: '/api/forgotPassword',
                    data: $(this).serialize(),
                    success: function(response) {
                        // Display success alert
                        console.log(response);

                        showAlert('success', 'Success, redirecting to login page...');

                        setTimeout(function() {
                            window.location.href = "/";
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