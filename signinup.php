
    <div id="id01" class="modal">

        
        <form id="signin_1" class="modal-content animate" action="useraccount.php" method="post">
            <span onclick="document.getElementById('id01').style.display='none'" class="close" title="Close Modal">&times;</span>


            <div class="container">
                <h1 class="modal_title">Sign In</h1>
            <label for="eml1"><b>Email</b></label><br/>
            <input id="eml1" type="text" class="modal_input" placeholder="Enter Email Address" name="email"><br/>

            <label for="pw1"><b>Password</b></label><br/>
            <input id="pw1" type="password" class="modal_input" placeholder="Enter Password" name="password">
                
            <button class="modal_btn" type="submit" name="login">Login</button>
            </div>

            <div class="container" style="background-color:#f1f1f1">
            <button type="button" class="modal_btn" onclick="document.getElementById('id01').style.display='none'" id="cancel_btn">Cancel</button>
            <span class="psw">Not registered? 
                <a href="https://cdlwebsysdev.esc-atsystems.net/devorah_sachs948/Final%20Project/createaccount.php">
                <u>Create Account</u></a>
            </span>
            </div>

        </form>
    </div>         


