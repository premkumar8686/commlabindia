<?php
include_once('./includes/config.php');
include_once('./includes/header.php');
if( isset( $_SESSION['uname'] ) )
{
    echo "<script>";
    echo "window.location.href ='dashboard.php'";
    echo "</script>";
} else {
?>
<div class="mc">

<div id="container">
    <header>Login Here</header>
    <br />
    <p class="text-danger text-center l_error_mc">
        <b>
            <span id="login-error"></span>
        </b>
    </p>
    

    <form method="post" id="login-form">
        <fieldset>
            <br />

            <input type="text" name="username" id="username" placeholder="Username" autofocus minlength="3"
                maxlength="30" />
            <br /><br />
            <div class="password-mc">
                
               <input type="password" name="password" id="password" class="login_password eye_input" placeholder="Password" minlength="3"
                maxlength="30" />

                <span class="icon-eye-look-icon eye_password"></span>
            </div>
            <br /><br />

            <label for="submit"></label>
            <input type="submit" name="submit" id="submit" value="LOGIN" />
        </fieldset>
    </form>
</div>
</div>



<?php
 include_once('./includes/footer.php');
}
?>