/*JS for the user account page (includes profile, jobs list, create request, sign out)*/


function displayProfile(){
    document.getElementById("request_page").style.display = "none";
    document.getElementById("sign_out_page").style.display = "none";
    document.getElementById("jobs_container").style.display = "none";
    document.getElementById("profile_container").style.display = "block";
}

function displayRequestPage(){
    document.getElementById("profile_container").style.display = "none";
    document.getElementById("sign_out_page").style.display = "none";
    document.getElementById("jobs_container").style.display = "none";
    document.getElementById("request_page").style.display = "block";
}

function displayJobsList(){
    document.getElementById("request_page").style.display = "none";
    document.getElementById("sign_out_page").style.display = "none";
    document.getElementById("profile_container").style.display = "none";
    document.getElementById("jobs_container").style.display = "block";
}

function displaySignOut(){
    document.getElementById("request_page").style.display = "none";
    document.getElementById("profile_container").style.display = "none";
    document.getElementById("jobs_container").style.display = "none";
    document.getElementById("sign_out_page").style.display = "block";

    // window.location.href = "https://cdlwebsysdev.esc-atsystems.net/devorah_sachs948/Final%20Project/home.php";
}