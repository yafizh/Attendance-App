<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <!-- Bootstrap core CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link href='https://unpkg.com/boxicons@2.0.9/css/boxicons.min.css' rel='stylesheet'>
    <style>
        body {
            padding-top: 2rem;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            width: 100vw;
        }


        @media (max-width:767px) {

            body::before,
            body::after {
                content: "";
                position: absolute;
                height: 150px;
                width: 300px;
            }
        }

        .center {
            text-align: center;
        }

        .icenter {
            display: block;
            margin-left: auto;
            margin-right: auto;
        }

        .card {
            border-radius: 5%;
        }

        .right-inner-addon {
            position: relative;
        }

        .right-inner-addon input {
            padding-right: 35px !important;
        }

        .right-inner-addon i {
            position: absolute;
            right: 0px;
            padding: 12px 12px;
            pointer-events: none;
        }

        .cir {
            border-radius: 20px;
        }
    </style>
</head>

<body>



    <div class="container">
        <div class="row">
            <div class="col-sm-6 offset-sm-3">

                <h3 class="center">Login</h3>
                <div class="card-body">

                    <form action="login/login_user" method="post">

                        <div class="right-inner-addon input-container form-group">
                            <i class='bx bx-user'></i>
                            <input type="text" class="cir form-control" placeholder="Username" id="username" name="username" autocomplete="on">
                        </div>

                        <div class="input-group input-container mb-3">
                            <input type="password" id="password" name="password" placeholder="Password" class="cir form-control" placeholder="">
                            <div class="input-group-append">
                                <button class="cir btn input-group-text" type="button" onclick="myFunction()" id="button-addon2"><i class='bx bx-show-alt bx-flip-horizontal'></i></button>
                            </div>
                        </div>
                        <br>
                        <button type="submit" class="cir btn btn-primary btn-block">Login</button>
                    </form>

                    <hr>

                    <p><a href="register">Register</a></p>

                </div>
            </div>


        </div>
    </div>
    <script>
        function myFunction() {
            var x = document.getElementById("password");
            if (x.type === "password") {
                x.type = "text";
            } else {
                x.type = "password";
            }

        }
    </script>
    <script src="https://unpkg.com/boxicons@2.0.9/dist/boxicons.js"></script>
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>

</body>

</html>