<?php
 include_once('./include/header.php');
?>
<div class="mc">
    <div id="container">
        <header>Register Here</header>
        <br />
        <p class="text-danger text-center r_error_mc">
            <b>
                <span id="register-error"></span>
            </b>
        </p>
        <p class="text-success text-center registration_success_message_mc dn">
            <b>
                Your Registration is Successful
            </b>
        </p>

        <form method="post" id="register-form">
            <fieldset>
                <br />

                <!-- Row 1 Section Start -->
                <div class="row">
                    <!-- Col 1 Section Start -->
                    <div class="col-md-6">
                        <input type="text" class="reg_user_name" name="username" id="username" placeholder="Username" autofocus minlength="3"
                            maxlength="30" />
                        <br /><br />
                    </div>
                    <!-- Col 1 Section End -->
                    <!-- Col 2 Section Start -->
                    <div class="col-md-6">
                        <input type="text" name="first_name" id="first_name" placeholder="First Name" minlength="3"
                            maxlength="30" />
                        <br /><br />
                    </div>
                    <!-- Col 2 Section End -->
                </div>
                <!-- Row 1 Section End -->

                <!-- Row 2 Section Start -->
                <div class="row">
                    <!-- Col 1 Section Start -->
                    <div class="col-md-6">
                        <input type="text" name="last_name" id="last_name" placeholder="Last Name" minlength="3"
                            maxlength="30" />
                        <br /><br />
                    </div>
                    <!-- Col 1 Section End -->
                    <!-- Col 2 Section Start -->
                    <div class="col-md-6">
                        <input type="email" name="email_address" id="email_address" placeholder="Email Address"
                            minlength="3" maxlength="30" />
                        <br /><br />
                    </div>
                    <!-- Col 2 Section End -->
                </div>
                <!-- Row 2 Section End -->


                <p class="text-white">Gender</p>

                <!-- Row 3 Section Start -->
                <div class="row">
                    <!-- Col 1 Section Start -->
                    <div class="col-md-6">
                        <label for="male" class="text-white">Male</label>
                        <input type="radio" name="gender" id="male" value="male" />
                        <br /><br />
                    </div>
                    <!-- Col 1 Section End -->
                    <!-- Col 2 Section Start -->
                    <div class="col-md-6">
                        <label for="female" class="text-white">Female</label>
                        <input type="radio" name="gender" id="female" value="female" />
                        <br /><br />
                    </div>
                    <!-- Col 2 Section End -->
                </div>
                <!-- Row 3 Section End -->

                <p class="text-white">Favourite colours</p>
                <!-- Row 4 Section Start -->
                <div class="row">
                    <!-- Col 1 Section Start -->
                    <div class="col-md-4">
                        <label for="yellow" class="text-white">Yellow</label>
                        <input type="checkbox" name="colours[]" id="yellow" value="Yellow" />
                        <br /><br />
                    </div>
                    <!-- Col 1 Section End -->
                    <!-- Col 2 Section Start -->
                    <div class="col-md-4">
                        <label for="orange" class="text-white">Orange</label>
                        <input type="checkbox" name="colours[]" id="orange" value="Orange" />
                        <br /><br />
                    </div>
                    <!-- Col 2 Section End -->
                    <!-- Col 3 Section Start -->
                    <div class="col-md-4">
                        <label for="brown" class="text-white">Brown</label>
                        <input type="checkbox" name="colours[]" id="brown" value="Brown" />
                        <br /><br />
                    </div>
                    <!-- Col 3 Section End -->
                </div>
                <!-- Row 4 Section End -->


                <!-- Row 5 Section Start -->
                <div class="row">
                    <!-- Col 1 Section Start -->
                    <div class="col-md-6">
                        <input type="password" name="password" id="password" placeholder="Password" minlength="3"
                            maxlength="30" />
                        <br /><br />
                    </div>
                    <!-- Col 1 Section End -->
                    <!-- Col 2 Section Start -->
                    <div class="col-md-6">
                        <input type="password" name="confirm_password" id="confirm_password"
                            placeholder="Re-type password" minlength="3" maxlength="30" />
                        <br /> <br />
                    </div>
                    <!-- Col 2 Section End -->
                </div>
                <!-- Row 5 Section End -->

                <label for="submit"></label>
                <input type="submit" name="submit" id="submit" value="REGISTER">
            </fieldset>
        </form>
    </div>
</div>
<?php
 include_once('./include/footer.php');
?>