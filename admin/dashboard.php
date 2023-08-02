<?php
include_once('./includes/config.php');
include_once('./includes/header.php');
if(isset($_SESSION['uname']))
{


  if( isset($_POST['edit_submit']) )
{
    $h_id = $_POST['h_id'];
    $username = $_POST['user_name'];
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $email = $_POST['email'];
    $gender = $_POST['gender'];
    $colours_final = implode(",",$_POST['favourite_colours']);
    $edit_password = $_POST['edit_password'];
    $b64_log_pass = base64_encode($edit_password);
    
    
    $user_name = strtolower(str_replace(' ', '_', $username));
    
    $update = "UPDATE `users` SET `user_name` = '$user_name', `first_name` = '$first_name', `last_name` = '$last_name', `email` = '$email', `gender` = '$gender', `favourite_colours` = '$colours_final', `password` = '$b64_log_pass' WHERE `users`.`id` = $h_id";

   mysqli_query($conDB,$update);
              
}

?>
<section>
    <!-- Row Section Start -->
    <div class="dashboard-row-mc">
        <!-- Col 1 mc -->
        <?php
      include_once('./includes/admin-menu.php');
      ?>
        <!-- Col 1 mc -->
        <!-- Col 2 mc -->
        <div class="dashboard-col">
            <!-- Page nation Start -->
            <br />
            <div class="container">
                <br />
                <div class="card">
                    <div class="card-header">Users List</div>
                    <div class="card-body">
                        <div class="form-group">
                            <input type="text" name="search_box" id="search_box" class="form-control"
                                placeholder="Type your search query here" />
                        </div>
                        <div class="table-responsive" id="dynamic_content">

                        </div>
                    </div>
                </div>
            </div>
            <!-- Page nation End -->

        </div>
        <!-- Col 2 mc -->
    </div>
    <!-- Row Section End -->

</section>
<?php
include_once('./includes/footer.php'); 
} 
else {
 echo "<script>";
 echo "window.location.href ='./'";
 echo "</script>";
}
?>

<script>
  $(document).ready(function(){

    load_data(1);

    function load_data(page, query = '')
    {
      $.ajax({
        url:"fetch.php",
        method:"POST",
        data:{page:page, query:query},
        success:function(data)
        {
          $('#dynamic_content').html(data);
        }
      });
    }

    $(document).on('click', '.page-link', function(){
      var page = $(this).data('page_number');
      var query = $('#search_box').val();
      load_data(page, query);
    });

    $('#search_box').keyup(function(){
      var query = $('#search_box').val();
      load_data(1, query);
    });

  });
</script>