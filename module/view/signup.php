
<?php
$title = 'Signup';
$style = '
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
<img src="assets/images/perfume.webp" 
  class="img-fluid" alt="Sample image">
</div>
<div class="col-md-8 col-lg-6 col-xl-4 offset-xl-1">
<h1 class="mb-3 text-center mb-12">Signup</h1>
<form method="post" action="/signup">
 

<div class="form-outline mb-4">
<input type="text" id="name" name="name" class="form-control form-control-lg" placeholder="John Doe" required />
   
  </div>

  <!-- Email input -->
  <div class="form-outline mb-4">
    <input type="email" id="email" name="email" required class="form-control form-control-lg"
      placeholder="Enter a valid email address" />
  </div>

  <!-- Password input -->
  <div class="form-outline mb-3">
    <input type="password" id="password" name="password" required class="form-control form-control-lg"
      placeholder="Enter password" />
  </div>

  <div class="d-flex justify-content-between align-items-center">
    <!-- Checkbox -->
    <div class="form-check mb-0">
    <input class="form-check-input me-2" type="checkbox" value="" id="termsCheckbox" />
    <label class="form-check-label" for="form2Example3">
       I agree all statement in Terms & Conditions
      </label>
    </div>
  </div>

  <div class="d-flex justify-content-between align-items-center text-center text-lg-start mt-4 pt-2">
  <button type="submit" class="text-white font-weight-bold btn btn-custom-pink btn-lg" style="padding-left: 2.5rem; padding-right: 2.5rem;">Sign Up</button>

    <p class="small fw-bold mt-2 pt-1 mb-0">Already have account? <a href="/login"
        class="link-danger">Login</a></p>
  </div>

</form>
</div>

';
$content .= '
<script>
document.addEventListener(\'DOMContentLoaded\', function () {
  var signupForm = document.querySelector(\'form\');
  signupForm.addEventListener(\'submit\', function (event) {
    var termsCheckbox = document.getElementById(\'termsCheckbox\');
    if (!termsCheckbox.checked) {
      event.preventDefault(); 
      alert(\'Maaf, silakan centang checkbox dahulu.\');
    }
  });
});
</script>
';
include 'layout.php';
?>
