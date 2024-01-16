
<?php
$title = 'Login';$style = '
<style>
/* Custom Pink Theme */
:root {
--bs-pink: #ff69b4;
--bs-dark-pink: #ff85c2;
}

body {
background-color: #fff3f8;
color: #333;
}

/* Customizing the Bootstrap Buttons */
.btn-primary, .btn-success {
background-color: var(--bs-pink);
border-color: var(--bs-pink);
}

.btn-primary:hover, .btn-success:hover {
background-color: var(--bs-dark-pink);
border-color: var(--bs-dark-pink);
}

/* Table and Form Styling */
.table thead th {
background-color: var(--bs-pink);
color: #fff;
}

.form-label {
color: var(--bs-pink);
}

/* Modal Customization */
.modal-content {
border-color: var(--bs-pink);
}

.modal-header {
background-color: var(--bs-pink);
color: #fff;
}

/* Button Close in Modal */
.btn-close {
filter: invert(1) grayscale(100%) brightness(200%);
}
.btn-custom-pink {
background-color: #ff69b4 !important; /* Pink color */
border-color: #ff69b4 !important; /* Pink border */
border-radius: 1rem !important; /* Larger border-radius */
}

.btn-custom-pink:hover {
background-color: #ff85c2 !important; /* Lighter pink on hover */
border-color: #ff85c2 !important;
}
</style>';
$content = '
<div class="col-md-9 col-lg-6 col-xl-5">
<img src="assets/images/perfume.webp"  class="img-fluid" alt="Sample image">
</div>
<div class="col-md-8 col-lg-6 col-xl-4 offset-xl-1"><h1 class="mb-3 text-center mb-12">Login</h1>

<form method="post" action="/login">

  <!-- Email input -->
  <div class="form-outline mb-4">
    <input type="email" id="email" name="email" class="form-control form-control-lg" placeholder="Enter a valid email address" required />
  </div>

  <!-- Password input -->
  <div class="form-outline mb-3">
    <input type="password" id="password" name="password" class="form-control form-control-lg" placeholder="Enter password" required />
  </div>

  <div class="text-center d-flex justify-content-between align-items-center text-lg-start mt-4 pt-2">
  <button type="submit" class="btn text-white font-weight-bold btn-custom-pink btn-lg" style="padding-left: 2.5rem; padding-right: 2.5rem;">Login</button>
  <p class="small fw-bold mt-2 pt-1 mb-0">Don\'t have an account? <a href="/signup" class="link-danger">Sign Up</a></p>
</div>
</form>
</div>
';
include 'layout.php';
?>
