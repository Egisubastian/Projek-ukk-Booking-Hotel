<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Booking Hotel | Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <style>
        /* Importing fonts from Google */
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800;900&display=swap');

        /* Resetting */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Poppins', sans-serif;
        }

        body {
            background: gray url('dist/img/banner.jpg') center/cover fixed no-repeat;
            display: flex;
            align-items: center;
            justify-content: center;
            min-height: 100vh;
        }

        .main {
            height: 100vh;
            box-sizing: border-box;
        }

        .login-box {
            width: 450px;
            /* Adjusted width */
            border: solid 1px;
            padding: 40px;
            /* Adjusted padding */
            background-color: #ecf0f3;
            border-radius: 15px;
            box-shadow: 10px 10px 18px #808080, -10px -10px 18px #808080;
            margin: 10px;
        }

        .logo {
            text-align: center;
            margin-bottom: 20px;
        }

        .logo img {
            width: 80px;
            height: 80px;
            border-radius: 50%;
            box-shadow: 0px 0px 3px #5f5f5f,
                0px 0px 0px 5px #ecf0f3,
                8px 8px 15px #a7aaa7,
                -8px -8px 15px #fff;
        }

        .text-center.mt-4.name {
            font-weight: bold;
            font-weight: 600;
            font-size: 1.5rem;
            color: #000;
            margin-top: 15px;
            letter-spacing: 1px;
        }

        .text-center.mt-4.name span {
            color: #039BE5;
        }

        .text-center {
            margin-top: 10px;
        }

        .login-box label {
            font-weight: 600;
            font-size: 1rem;
            color: #555;
        }

        .login-box input {
            width: 100%;
            display: block;
            border: none;
            outline: none;
            background: none;
            font-size: 1rem;
            color: #666;
            padding: 10px;
            border-radius: 10px;
            box-shadow: inset 5px 5px 5px #cbced1, inset -5px -5px 5px #fff;
            margin-bottom: 15px;
        }

        .login-box .btn {
            box-shadow: none;
            width: 100%;
            height: 40px;
            background-color: #03A9F4;
            color: #fff;
            border-radius: 25px;
            box-shadow: 3px 3px 3px #b1b1b1, -3px -3px 3px #fff;
            letter-spacing: 1.3px;
        }

        .login-box {
            width: 450px;
            /* Adjusted width */
            border: solid 1px;
            padding: 40px;
            /* Adjusted padding */
            background-color: rgba(236, 240, 243, 0.8);
            /* Use rgba to set opacity */
            border-radius: 15px;
            box-shadow: 10px 10px 18px #808080, -10px -10px 18px #808080;
            margin: 10px;
        }


        .login-box .btn:hover {
            background-color: #039BE5;
        }

        .login-box a {
            text-decoration: none;
            font-size: 0.8rem;
            color: #03A9F4;
        }

        .login-box a:hover {
            color: #039BE5;
        }

        .login-box {
            width: 450px;
            /* Adjusted width */
            border: none;
            /* Remove border */
            padding: 40px;
            /* Adjusted padding */
            background-color: rgba(236, 240, 243, 0.8);
            /* Use rgba to set opacity */
            border-radius: 15px;
            box-shadow: 10px 10px 18px #808080, -10px -10px 18px #808080;
            margin: 10px;
        }
    </style>
</head>
<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>

<body>
    <div class="main d-flex flex-column justify-content-center align-items-center">
        <div class="login-box">
            <div class="logo">
                <img src="{{ asset('dist/img/logoH.png') }}" alt="">
            </div>
            <div class="text-center mt-4 name">
                PesanAja <span>Hotel</span>
            </div>
            <br>
            @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
            @endif
            <!-- Display login error -->
            @if($errors->has('loginError'))
            <div class="alert alert-danger">
                {{ $errors->first('loginError') }}
            </div>
            @endif

            <form action="{{ route('login') }}" method="post" id="loginForm">
    @csrf
    <div>
        <label for="username">Username</label>
        <input type="text" name="username" id="username" class="form-control" value="{{ old('username') }}" required>
    </div>
    <div>
        <label for="password">Password</label>
        <input type="password" name="password" id="password" class="form-control" required>
    </div>

    <div>
        <button type="submit" class="btn" id="loginBtn">Login</button>
    </div>
</form>
<input type="hidden" id="loginStatus" value="{{ session('success') ? 'success' : 'failure' }}">

        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4"
        crossorigin="anonymous"></script>

  <script>
        $(document).ready(function () {
            var loginStatus = $('#loginStatus').val();

            if (loginStatus === 'success') {
                $('#loginBtn').hide();
                $('#successMessage').show();
            }

            $('#loginForm').submit(function () {
                $('#loginBtn').html('Loading...').attr('disabled', true);
            });
        });

        function redirectToDashboard() {
            // Replace the URL with the actual dashboard URL
            window.location.href = "/dashboard";
        }
    </script>

</body>

</html>