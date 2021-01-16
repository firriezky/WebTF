<!DOCTYPE html>
<html>

<head>
    <!-- Karakter encoding -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>Login Page Ep. 3</title>
    <!-- Load bootstrap stylesheet -->
    <link rel="stylesheet" href="./auth_asset/bootstrap/css/bootstrap.min.css">
    <!-- Load login stylesheet -->
    <link rel="stylesheet" href="./auth_asset/css/login.css">
</head>

<body>
    <div class="container-fluid">
        <div class="card card-login">
            <div class="card-body">
                <div class="row justify-content-center">
                    <div class="col-lg-6 col-md-12">
                        <div class="padding bg-primary text-center align-items-center d-flex">
                            <div id="particles-js"></div>
                            <div class="w-100">
                                <div class="logo mb-4">
                                    <img src="./auth_asset/img-login/logo.png" alt="" class="img-fluid">
                                </div>
                                <h4 class="text-light mb-2">Aplikasi Tahfidz SDIT Wahdah Islamiyah Bantaeng</h4>
                                <p class="lead text-light">Aplikasi Setoran Hafalan dan Muroja'ah Al-Quran Al-Karim</p>
                            </div>

                            <div class="help-links">
                                <ul>
                                    <li><a href="http://henryaugusta.feylabs.my.id">Developed By Feylaboratory</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-12">
                        <div class="padding">
                            <h2>Login</h2>
                            <p class="lead">Silakan login untuk melanjutkan</p>
                            <a href="{{url('login/student')}}">
                                <button class="btn btn-block btn-icon btn-icon-google mb-3">
                                    Login Sebagai Santri/Siswa
                                </button>
                            </a>
                            <a href="{{url('login/mentor')}}">
                                <button class="btn btn-block btn-icon btn-icon-google mb-3">
                                    Login Sebagai Ustadz/Ustadzah
                                </button>
                            </a>
                            <a href="{{url('login/')}}">
                                <button class="btn btn-block btn-icon btn-icon-google mb-3">
                                    Login Sebagai Admin
                                </button>
                            </a>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="js/particles.js"></script>
    <script>
        particlesJS.load('particles-js', 'particlesjs-config.json', function () {
			console.log('callback - particles.js config loaded');
		});
    </script>
</body>

</html>