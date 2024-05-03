document.getElementById("signupLink").addEventListener("click", function(event) {
    event.preventDefault();
    document.getElementById("loginSection").style.display = "none";
    document.getElementById("signupSection").style.display = "block";
});

document.getElementById("backToLogin").addEventListener("click", function(event) {
    event.preventDefault();
    document.getElementById("loginSection").style.display = "block";
    document.getElementById("signupSection").style.display = "none";
});

