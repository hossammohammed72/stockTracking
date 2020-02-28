<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta http-equiv="x-ua-compatible" content="ie=edge">

  <title>AdminLTE 3 | Dashboard 3</title>

  <!-- Font Awesome Icons -->
  <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
  <!-- IonIcons -->
  <link rel="stylesheet" href="http://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="dist/css/adminlte.min.css">
  <!-- Select2 -->
  <link rel="stylesheet" href="/plugins/select2/css/select2.min.css">
  <link rel="stylesheet" href="plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css">

  <!-- Google Font: Source Sans Pro -->
  <style>
    .my_table tbody tr:hover {
      background-color: #7fccee;
      /*--- this is a blue color when hover ---*/
    }

    .my_table tbody tr:focus {
      background-color: #f3f3f3;
      /*--- this is a gray color when clicked---*/
    }

    #radioBtn .notActive {
      color: #3276b1;
      background-color: #fff;
    }

    .fa-heart:before {
      content: "\f004";

    }

    .heart-checkBox-input,
    .shopping-cart-input {
      position: absolute;
      left: -1000vw;
    }

    .heart-checkBox-label:hover {
      color: #da1e26a6;
    }

    .heart-checkBox-label,
    .shop-cart-label {
      color: #d2d2d2;
      cursor: pointer;
      font-size: 1.3rem;
      align-self: center;
      transition: color 0.2s ease-in-out;
      position: relative;
    }

    .autocomplete-suggestions {
      border: 1px solid #999;
      background: #FFF;
      overflow: auto;
    }

    .autocomplete-suggestion {
      padding: 2px 5px;
      white-space: nowrap;
      overflow: hidden;
    }

    .autocomplete-selected {
      background: #F0F0F0;
    }

    .autocomplete-suggestions strong {
      font-weight: normal;
      color: #3399FF;
    }

    .autocomplete-group {
      padding: 2px 5px;
    }

    .autocomplete-group strong {
      display: block;
      border-bottom: 1px solid #000;
    }
  </style>
  <style>
    body {
      padding-top: 60px;
    }
  </style>

  <link href="assets/css/bootstrap.css" rel="stylesheet" />

  <link href="assets/css/login-register.css" rel="stylesheet" />
  <link rel="stylesheet" href="http://netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.css">

  <script src="assets/js/jquery-1.10.2.js" type="text/javascript"></script>
  <script src="assets/js/bootstrap.js" type="text/javascript"></script>
  <script src="assets/js/login-register.js" type="text/javascript"></script>
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
</head>
<!--
BODY TAG OPTIONS:
=================
Apply one or more of the following classes to to the body tag
to get the desired effect
|---------------------------------------------------------|
|LAYOUT OPTIONS | sidebar-collapse                        |
|               | sidebar-mini                            |
|---------------------------------------------------------|
-->

<body>
  <div class="wrapper">
    <!-- Navbar -->
    <nav class="navbar navbar-expand navbar-white navbar-light">
      <!-- Left navbar links -->
      <ul class="navbar-nav">

        <li class="nav-item d-none d-sm-inline-block">
          <h1 class="m-0 text-dark">SockAPI SPA</h1>
        </li>


  </div>

  </ul>
  </nav>
  <!-- /.navbar -->

  <!-- Content Header (Page header) -->
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h4 class="m-0 text-dark">Keep an eye on your most interesting stocks</h1>
        </div><!-- /.col -->
      </div><!-- /.row -->
    </div><!-- /.container-fluid -->
  </div>
  <!-- /.content-header -->

  <!-- Main content -->
  <div class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-lg-6">
          <div class="card">
            <div class="card-header border-0">
              <div class="d-flex justify-content-between">
                <div class="card-title">
                  <div class="input-group">
                    <div id="radioBtn" class="btn-group">
                      <a class="btn btn-default btn-sm notActive" data-toggle="period" data-id='1y' data-value="1" data-unit="years">1 Year</a>
                      <a class="btn btn-default btn-sm active" data-toggle="period" data-id='6mo' data-value="6" data-unit="months">6 Months</a>
                      <a class="btn btn-default btn-sm notActive" data-toggle="period" data-id='2mo' data-value="2" data-unit="months">2 Month</a>
                      <a class="btn btn-default btn-sm notActive" data-toggle="period" data-id='2w' data-value="14" data-unit="days">2 weeks</a>
                      <a class="btn btn-default btn-sm notActive" data-toggle="period" data-id='1w' data-value="7" data-unit="days">1 week</a>

                    </div>
                    <input type="hidden" name="period" id="period">
                  </div>
                </div>
                <a href="javascript:void(0);">Historical Data</a>
              </div>
            </div>
            <div class="card-body">
              <div class="d-flex">
                <p class="d-flex flex-column">
                  <span class="text-bold text-lg" id='curentSymbol'></span>
                  <span id='curentPrice'></span>
                </p>
                <!-- <p class="ml-auto d-flex flex-column text-right" id='changePercentae'>
                    <span class="text-success">
                      <i class="fas fa-arrow-up"></i> 12.5%
                    </span>
                    <span class="text-muted"></span>
                  </p> -->
              </div>
              <!-- /.d-flex -->

              <div class="position-relative mb-4">
                <canvas id="indexes-chart" height="200"></canvas>
              </div>

              <div class="d-flex flex-row justify-content-end">
                <span class="mr-2">
                  <i class="fas fa-square text-primary"></i> High
                </span>
                <span class="mr-2">
                  <i class="fas fa-square text-gray"></i> Low
                </span>
                <span class="mr-2">
                  <i class="fas fa-square text-success"></i> Open
                </span>
                <span class="mr-2">
                  <i class="fas fa-square text-danger"></i> Close
                </span>
              </div>
            </div>
          </div>
        </div>
        <!-- /.card -->
        <div class="col-lg-6">
          <!--Make sure the form has the autocomplete function switched off:-->
          <input class="form-control form-control-navbar" type="search" placeholder="Search" aria-label="Search" id="autocomplete" />
          <div class="autocomplete-suggestions">
          </div>
          <div class="card">
            <div class="card-body table-responsive p-0">
              <table class="table table-valign-middle my_table">
                <thead>
                  <tr>
                    <th>Symbol</th>
                    <th>Name</th>
                    <th>LastPrice</th>
                    <th>Change</th>
                    <th>Wishlist</th>
                  </tr>
                </thead>
                <tbody id='StockPricingTable'>
                </tbody>
              </table>
            </div>
          </div>
          <!-- /.card -->
        </div>
        <!-- /.col-md-6 -->

        <!-- /.card -->
      </div>
      <!-- /.col-md-6 -->
    </div>
    <!-- /.row -->
  </div>
  <!-- /.container-fluid -->
  </div>
  <!-- /.content -->


  <!-- /.control-sidebar -->

  <!-- Main Footer -->

  <footer class="main-footer">
    <strong>Copyright &copy; 2014-2019 <a href="http://adminlte.io">AdminLTE.io</a>.</strong>
    All rights reserved.
    <div class="float-right d-none d-sm-inline-block">
      <b>Version</b> 3.0.2
    </div>
  </footer>
  </div>
  <!-- ./wrapper -->

  <!-- REQUIRED SCRIPTS -->

  <!-- jQuery -->

  <script src="plugins/jquery/jquery.min.js"></script>

  <!-- Bootstrap -->
  <script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
  <!-- AdminLTE -->
  <script src="dist/js/adminlte.js"></script>

  <!-- OPTIONAL SCRIPTS -->
  <script src="plugins/chart.js/Chart.min.js"></script>
  <script src="plugins/jquery.autocomplete.js"></script>
  <script src="plugins/moment/moment.min.js"></script>
  <script src="dist/js/demo.js"></script>
  <script defer src="app/js/app.js"></script>
  <script defer src="dist/js/pages/dashboard3.js"></script>
</body>
</html>