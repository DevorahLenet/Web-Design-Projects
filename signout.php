<?php
session_start();

if (isset($_GET['exit_account'])){
    $_SESSION = array();
    session_destroy();

    ?>
    <!DOCTYPE html>
        <html lang="en">
        <head>
            <meta charset="UTF-8">
            <meta http-equiv="X-UA-Compatible" content="IE=edge">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>GiveGet Signed Out</title>
        </head>
        <body>
            <?php
                require 'header.php';
                require 'navigation.php';
            ?>

            <div class="process_account_container">
                <br/><br/>
                <p class="regular_text">Sign out successful</p>
            </div>
            
                
        </body>
        </html>
<?php
}
else{
    header("location:useraccount.php");
}
?>

