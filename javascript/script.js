$(document).ready(function () {
  // on submit...
  $("#register-form").submit(function (e) {
    e.preventDefault();
    $(".registration_success_message_mc").addClass("dn");

    $("#register-error").hide();

    //user name required
    let username = $("input#username").val();
    if (username == "") {
      $("#register-error").fadeIn().text("User Name Required.");

      $("input#username").focus();
      return false;
    }

   

    //First name required
    let first_name = $("input#first_name").val();
    if (first_name == "") {
      $("#register-error").fadeIn().text("First Name Required.");

      $("input#first_name").focus();
      return false;
    }

    //First name required
    let last_name = $("input#last_name").val();
    if (last_name == "") {
      $("#register-error").fadeIn().text("Last Name Required.");

      $("input#last_name").focus();
      return false;
    }

    //email required
    let email_address = $("input#email_address").val();
    if (email_address == "") {
      $("#register-error").fadeIn().text("Email Required.");

      $("input#email_address").focus();
      return false;
    }

    //Gender required
    let male = $("input#male").is(":checked");
    let female = $("input#female").is(":checked");

    if (!male && !female) {
      $("#register-error").fadeIn().text("Gender Required.");
      $("input#male").focus();
      return false;
    }

    //Favourite colours required
    let yellow = $("input#yellow").is(":checked");
    let orange = $("input#orange").is(":checked");
    let brown = $("input#brown").is(":checked");

    if (!yellow && !orange && !brown) {
      $("#register-error").fadeIn().text("Favourite Colours Required.");
      $("input#yellow").focus();
      return false;
    }

    //password required
    var password = $("input#password").val();
    if (password == "") {
      $("#register-error").fadeIn().text("Password Required.");
      $("input#password").focus();
      return false;
    }
    //confirm-password required
    let confirm_password = $("input#confirm_password").val();
    if (confirm_password == "") {
      $("#register-error").fadeIn().text("Confirm Password Required.");
      $("input#confirm_password").focus();
      return false;
    }

    //confirm-password same required
    if (password !== confirm_password) {
      $("#register-error")
        .fadeIn()
        .text("Password and confirm password should be same.");
      $("input#password").val("");
      $("input#confirm_password").val("");
      $("input#password").focus();
      return false;
    }



    // ajax
    $.ajax({
      type: "POST",
      url: "ajaxcall/register-form-db.php",
      data: $(this).serialize(), // get all form field value in serialize form
      success: function (data) {
        if (data) {
          document.getElementById("register-form").reset();
          $(".registration_success_message_mc").removeClass("dn");
        }
      },
    });


  });

  
$(".reg_user_name").focusout(function(){
     // ajax
     $.ajax({
      type: "POST",
      url: "ajaxcall/username-check-db.php",
      data: $(this).serialize(), // get all form field value in serialize form
      success: function (data) {
        if (data == 1) {
          $("input#username").val('');
          $("#register-error").fadeIn().text("This username is already taken, Please enter some other user name.");
          $("input#username").focus();
          return false;
        }
      },
    });
});


  // on submit...
  $("#login-form").submit(function (e) {

    e.preventDefault();

    //user name required
    let username = $("input#username").val();
    if (username == "") {
      $("#login-error").fadeIn().text("User Name Required.");

      $("input#username").focus();
      return false;
    }

    //Password required
    let password = $("input#password").val();
    if (password == "") {
      $("#login-error").fadeIn().text("Password Required.");

      $("input#password").focus();
      return false;
    }

      // ajax
    $.ajax({
      type: "POST",
      url: "../ajaxcall/login-form-db.php",
      data: $(this).serialize(), // get all form field value in serialize form
      success: function (data) {
        if (data == 0) {
          document.getElementById("login-form").reset();
          $("#login-error").fadeIn().text("User Name or Password is Incorrect.");
        } else {
           window.location.href ='dashboard.php';
        }
      },
    });
  });




     $('.eye_password').on('click',function(){

        let type = $(".eye_input").attr('type');

         if(type === 'password')
         {
          $(this).removeClass('icon-eye-look-icon');
          $(this).addClass('icon-hide-private-hidden-icon');
          $(".eye_input").attr('type','text');
         }
         if(type === 'text') 
         {
          $(this).removeClass('icon-hide-private-hidden-icon');
          $(this).addClass('icon-eye-look-icon');
          $(".eye_input").attr('type','password');
         }
        

     });

     

});

// fa-solid fa-eye-slash
function recordDelete(id)
{
  $.ajax({
    type: "POST",
    url: "../ajaxcall/delete.php",
    data: {remove_id:id},
    success: function(data)
    {
      $( document ).ready(function() {
        $('#users_list_row_' + data).remove();
      });
    }
  });
}

let myFlage = 0;

function flag()
{
  myFlage = 1;
}

function usernameCheck()
{
  if(myFlage == 1)
  {
        $( document ).ready(function() {
        let value = $(this).val();
        // ajax
        $.ajax({
          type: "POST",
          url: "../ajaxcall/edit-username-check-db.php",
          data: $("#edit-form").serialize(), // get all form field value in serialize form
          success: function (data) {
            if (data == 1) {
            
              $("input#user_name").val('');
              alert("This username is already taken, Please enter some other user name.");
              $("input#user_name").focus();
            
              return false;
            }
          },
        });
      });
      myFlage = 0;
  }
  
}