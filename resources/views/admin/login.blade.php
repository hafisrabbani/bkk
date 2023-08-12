@php
$configs = App\Http\Controllers\adminController::getConfigWeb();
@endphp
<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="{{ asset('/assets/css/bootstrap.min.css') }}">

    <title>Admin BKK Login</title>

    <style>
        .center {
            position: absolute;
            left: 50%;
            top: 50%;
            -webkit-transform: translate(-50%, -50%);
            transform: translate(-50%, -50%);
            border: 2.5px solid #eaeaea;
            border-radius: 15px;
            box-shadow: 9px 22px 35px 0px rgba(0, 0, 0, 0.34);
            -webkit-box-shadow: 9px 22px 35px 0px rgba(0, 0, 0, 0.34);
            -moz-box-shadow: 9px 22px 35px 0px rgba(0, 0, 0, 0.34);
        }

        .b-50 {
            border-radius: 70px;
            border: 0.5px solid #eaeaea;
        }
    </style>
</head>

<body>

    <div class="container">
        <div class="center">
            <div class="row p-5">
                <div class="col-md-6">
                    <img src="{{ asset('/storage/config/logo/'.$data->logo) }}" class="img-fluid" style="max-height: 350px;">
                </div>
                <div class="col-md-6">
                    <h4 class="text-center mb-4">Admin Login</h4>
                    <form action="{{ route('login') }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label for="username"><strong>Username</strong></label>
                            <input type="text" name="username" class="b-50 form-control" id="username" required>
                        </div>
                        <div class="form-group">
                            <label for="password"><strong>Password</strong></label>
                            <input type="password" name="password" class="b-50 form-control" id="password" required>
                        </div>
                        <div class="text-center">
                            <button class="btn btn-success px-5 py-1" type="submit" style="border-radius: 50px">Login</button>
                        </div>
                    </form>
                    <div class="text-center pt-4">
                        <small class="text-secondary">Copyright &copy; 2022 BKK SMKN 1 CERME <br>Developed By Hafis
                            Rabbani</small>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Option 1: jQuery and Bootstrap Bundle (includes Popper) -->
    @include('sweetalert::alert')
    <script src="{{ asset('/assets/jquery.min.js') }}"></script>
    <script src="{{ asset('/assets/bootstrap.min.js') }}"></script>
</body>

</html>