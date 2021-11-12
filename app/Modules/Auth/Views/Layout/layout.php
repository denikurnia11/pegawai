<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">

  <title>Data Pegawai</title>
</head>

<body>
  <?php
  if (session()->role == "admin") {
    echo $this->include('Layout/navbar');
  } else if (session()->role == "user") {
    echo $this->include('Layout/navbarUser');
  }
  ?>
  <?= $this->renderSection('content') ?>

  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-Piv4xVNRyMGpqkS2by6br4gNJ7DXjqk09RmUpJ8jgGtD7zP9yug3goQfGII0yAns" crossorigin="anonymous"></script>
  <!-- JQuery -->
  <script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>
  <!-- jQuery Validation -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.3/jquery.validate.js"></script>
  <script>
    $(document).ready(function() {
      $(".formAuth").validate({
        rules: {
          nama: 'required',
          email: {
            required: true,
            email: true
          },
          password: 'required',
          cpassword: {
            required: true,
            equalTo: '#password'
          }
        },
        messages: {
          nama: 'Nama harus diisi.',
          email: {
            required: 'Email harus diisi.',
            email: 'Email tidak valid.'
          },
          password: 'Password harus diisi.',
          cpassword: {
            required: 'Password harus diisi.',
            equalTo: 'Confirm Password tidak sama.'
          },
        }
      });
    });
  </script>
</body>

</html>