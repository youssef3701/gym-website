// Function to show the Login & Sign Up Section when 'Get Started' is clicked
function showLoginSignUp() {
    document.getElementById("login-signup-section").style.display = "block"; 
    document.querySelector(".hero").style.display = "none";  // Hide hero section
  }
  
  // Show Login Form
  function showLogin() {
    document.getElementById("login-form").style.display = "block";
    document.getElementById("signup-form").style.display = "none";
  }
  
  // Show Sign Up Form
  function showSignUp() {
    document.getElementById("login-form").style.display = "none";
    document.getElementById("signup-form").style.display = "block";
  }
  