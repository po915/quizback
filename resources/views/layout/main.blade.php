<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <title>Admin Dashboard</title>
  <link rel="stylesheet" href="assets/css/bootstrap.css">
  <link rel="stylesheet" href="assets/vendors/chartjs/Chart.min.css">
  <link rel="stylesheet" href="assets/vendors/perfect-scrollbar/perfect-scrollbar.css">
  <link rel="stylesheet" href="assets/css/app.css">
  <link rel="shortcut icon" href="assets/images/favicon.svg" type="image/x-icon">
  <link rel="stylesheet" href="assets/vendors/simple-datatables/style.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.7.0/animate.min.css">
  <link rel="stylesheet" href="assets/vendors/choices.js/choices.min.css" />
  <link rel="stylesheet" href="assets/css/style.css">

  @yield('style')
</head>

<body>
  <div id="app">
    <div id="sidebar" class='active'>
      <div class="sidebar-wrapper active">
        <div class="sidebar-header">
          <img src="assets/images/logo.png" alt="" srcset="" />
        </div>
        <div class="sidebar-menu">
          <ul class="menu">
            <li class='sidebar-title'>Main Menu</li>
            <li class="sidebar-item">
              <a href="/quiz" class='sidebar-link'>
                <i data-feather="award" width="20"></i>
                <span>Quizzes</span>
              </a>
            </li>
            <li class="sidebar-item">
              <a href="/category" class='sidebar-link'>
                <i data-feather="list" width="20"></i>
                <span>Categories</span>
              </a>
            </li>
            <li class="sidebar-item">
              <a href="/question" class='sidebar-link'>
                <i data-feather="help-circle" width="20"></i>
                <span>Questions</span>
              </a>
            </li>
            <li class="sidebar-item">
              <a href="/content" class='sidebar-link'>
                <i data-feather="book" width="20"></i>
                <span>Contents</span>
              </a>
            </li>
            <li class="sidebar-item">
              <a href="/user" class='sidebar-link'>
                <i data-feather="user" width="20"></i>
                <span>Users</span>
              </a>
            </li>
            <li class="sidebar-item">
              <a href="/author" class='sidebar-link'>
                <i data-feather="user-check" width="20"></i>
                <span>Authors</span>
              </a>
            </li>
        </div>
        <button class="sidebar-toggler btn x"><i data-feather="x"></i></button>
      </div>
    </div>

    <div id="main">
      <nav class="navbar navbar-header navbar-expand navbar-light">
        <a class="sidebar-toggler" href="#">
          <span class="navbar-toggler-icon"></span>
        </a>
        <button class="btn navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
          aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
      </nav>
      @yield('content')
    </div>
  </div>

  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js">
  </script>
  <script src="assets/js/bootstrap.js"></script>
  <script src="assets/js/feather-icons/feather.min.js"></script>
  <script src="assets/vendors/perfect-scrollbar/perfect-scrollbar.min.js"></script>
  <script src="assets/js/app.js"></script>
  <script src="assets/vendors/chartjs/Chart.min.js"></script>
  <script src="assets/vendors/apexcharts/apexcharts.min.js"></script>
  <script src="assets/js/pages/dashboard.js"></script>
  <script src="assets/js/main.js"></script>
  <script src="assets/vendors/simple-datatables/simple-datatables.js"></script>
  <script src="assets/js/vendors.js"></script>
  <script src="assets/vendors/choices.js/choices.min.js"></script>
  <script>
    $.ajaxSetup({
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
    });

    $(document).ready(function() {
      $("[href='/" + $(".is-active").attr('val') + "']").addClass('active-link');
      $("a.active-link").parent().addClass("active");
    });
  </script>
  @yield('script')
</body>

</html>
