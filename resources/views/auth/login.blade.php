<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <title>Sign in - Voler Admin Dashboard</title>
  <link rel="stylesheet" href="assets/css/bootstrap.css">
  <link rel="shortcut icon" href="assets/images/favicon.svg" type="image/x-icon">
  <link rel="stylesheet" href="assets/css/app.css">
</head>

<body>
  <div id="auth">
    <div class="container">
      <div class="row">
        <div class="col-md-5 col-sm-12 mx-auto">
          <div class="card pt-4">
            <div class="card-body">
              <div class="text-center mb-5">
                <img src="assets/images/logo.png" height="48" class='mb-4'>
                <h3>Sign In</h3>
              </div>
              <form id="signIn">
                <div class="form-group position-relative has-icon-left">
                  <label for="username">Email</label>
                  <div class="position-relative">
                    <input type="text" class="form-control" name="email" placeholder="Email address" required />
                    <div class="form-control-icon">
                      <i data-feather="user"></i>
                    </div>
                  </div>
                </div>
                <div class="form-group position-relative has-icon-left">
                  <div class="clearfix">
                    <label for="password">Password</label>
                  </div>
                  <div class="position-relative">
                    <input type="password" class="form-control" name="password" placeholder="Password" required />
                    <div class="form-control-icon">
                      <i data-feather="lock"></i>
                    </div>
                  </div>
                </div>
                <div class="clearfix">
                  <button class="btn btn-primary float-right">Submit</button>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script src="assets/js/feather-icons/feather.min.js"></script>
  <script src="assets/js/app.js"></script>
  <script src="assets/js/main.js"></script>
  <script>
    $.ajaxSetup({
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
    });

    $("#signIn").submit(function(e) {
      e.preventDefault();
      let formData = new FormData(this);
      $.ajax({
        type: "POST",
        url: "{{ route('login') }}",
        data: formData,
        contentType: false,
        processData: false,
        success: (res) => {
          window.location.href = "/dashboard";
        },
        error: function(err) {
          alert("Email or Password is incorrect. Try again.")
          console.log("Error", err);
        },
      });
    })
  </script>
</body>

</html>
