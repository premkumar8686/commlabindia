<?php
include_once('./includes/config.php');



$limit = '8';
$page = 1;
if($_POST['page'] > 1)
{
  $start = (($_POST['page'] - 1) * $limit);
  $page = $_POST['page'];
}
else
{
  $start = 0;
}

$query = "
SELECT * FROM `users` WHERE `users`.`isactive` = 1
";

if($_POST['query'] != '')
{
  $query .= '
  WHERE user_name LIKE "%'.str_replace(' ', '%', $_POST['query']).'%" AND `users`.`isactive` = 1  
  ';
} 

$query .= 'ORDER BY `users`.`id` DESC ';

$filter_query = $query . 'LIMIT '.$start.', '.$limit.'';

$statement = $connect->prepare($query);
$statement->execute();
$total_data = $statement->rowCount();

$statement = $connect->prepare($filter_query);
$statement->execute();
$result = $statement->fetchAll();
$total_filter_data = $statement->rowCount();

$output = '
<label class="my-3"><b>  </b> </label>
<table class="table table-striped table-bordered">
  <tr>
    <th>User Name</th>
    <th>First Name</th>
    <th>Last Name</th>
    <th>Email</th>
    <th>Gender</th>
    <th>Favourite Colours</th>
    <th>Registered Date</th>
    <th>Actions</th>
  </tr>
';
if($total_data > 0)
{
  foreach($result as $row)
  {

    // Gender Check
    if($row['gender'] == 'male')
    {
        $isCheckedMale = 'checked';
        $isCheckedFemale = '';
    } else {
        $isCheckedFemale = 'checked';
        $isCheckedMale = '';
    } 
    // Gender Check

    // favourite_colours check
     
    $string = $row['favourite_colours'];
    $array = explode(",", $string);

    if (in_array('Yellow', $array)) {
        $fcy = 'checked';
    } else {
        $fcy = "";
    }
    if (in_array('Orange', $array)) {
        $fco = 'checked';
    } else {
        $fco = "";
    }
    if (in_array('Brown', $array)) {
        $fcb = 'checked';
    } else {
        $fcb = "";
    }
    // favourite_colours check

    $output .= '
    <tr id="users_list_row_'.$row["id"].'">
      <td>'.$row["user_name"].'</td>
      <td>'.$row["first_name"].'</td>
      <td>'.$row["last_name"].'</td>
      <td>'.$row["email"].'</td>
      <td>'.$row["gender"].'</td>
      <td>'.$row["favourite_colours"].'</td>
      <td>'.$row["date"].'</td>
      <td class="d-flex justify-content-between">
        <span class="icon prem icon-edit-square-line-icon text-warning" data-bs-toggle="modal" data-bs-target="#editModal'.$row["id"].'"></span>

        <span class="icon prem icon-close-square-line-icon text-danger" data-bs-toggle="modal" data-bs-target="#deleteModal'.$row["id"].'"></span>

        <!-- The delete Modal Start-->
<div class="modal" id="deleteModal'.$row['id'].'">
  <div class="modal-dialog">
    <div class="modal-content">

      <!-- Modal Header -->
      <div class="modal-header">
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>

      <!-- Modal body -->
      <div class="modal-body text-center">
        <p class="text-danger"> <b>Do you want to delete this record permanently<b/> </p>
      </div>

      <!-- Modal footer -->
      <div class="modal-footer justify-content-between">

        <button type="button" class="btn btn-success"  onclick="recordDelete('.$row['id'].')" data-bs-dismiss="modal">Yes</button>

        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>

      </div>

    </div>
  </div>
</div>
<!-- The delete Modal End -->


<div class="modal" id="editModal'.$row['id'].'" >
  <div class="modal-dialog">
    <div class="modal-content">

      <!-- Modal Header -->
      <div class="modal-header">
        
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>

      <!-- Modal body -->
      <div class="modal-body">
      <form method="post" id="edit-form">
      <div class="mb-3 mt-3">
        <label for="user_name" class="form-label">User Name:</label>

        <input value="'.$row["id"].'" type="hidden" name="h_id" />

        <input value="'.$row["user_name"].'" type="text" class="form-control" id="user_name" placeholder="User Name" name="user_name" required minlength="3" maxlength="30" onfocusout="usernameCheck()" onkeydown="flag()" />
      </div>
      <div class="mb-3">
        <label for="first_name" class="form-label">First Name:</label>
        <input value="'.$row["first_name"].'" type="text" class="form-control" id="first_name" placeholder="First Name" name="first_name" required minlength="3" maxlength="30" />
      </div>
      <div class="mb-3">
        <label for="last_name" class="form-label">Last Name:</label>
        <input value="'.$row["last_name"].'" type="text" class="form-control" id="last_name" placeholder="Last Name" name="last_name" required minlength="3" maxlength="30" />
      </div>
      <div class="mb-3">
        <label for="email" class="form-label">Email:</label>
        <input value="'.$row["email"].'" type="email" class="form-control" id="email" placeholder="Email" name="email" required minlength="3" maxlength="30" />
      </div>
      <p>Gender</p>
      <div class="mb-3">
        <label for="male" class="form-label">Male:</label>
        <input '.$isCheckedMale.'  value="Male" type="radio" class="male" id="male" name="gender" />
        
        <label for="female" class="form-label">Female:</label>
        <input '.$isCheckedFemale.' value="Female" type="radio" class="female" id="female" name="gender" />
      </div>
      <p>Favourite Colours</p>
      <div class="form-check mb-3">
        <label class="form-check-label">
          <input '.$fcy.' class="form-check-input" type="checkbox" name="favourite_colours[]" value="Yellow" required /> Yellow
        </label><br/>
        <label class="form-check-label">
          <input '.$fco.' class="form-check-input" type="checkbox" name="favourite_colours[]" value="Orange" /> Orange
        </label><br/>
        <label class="form-check-label">
          <input '.$fcb.' class="form-check-input" type="checkbox" name="favourite_colours[]" value="Brown" /> Brown
        </label>
      </div>

      <div class="mb-3">
        <label for="password" class="form-label">Password:</label>
        <input value="'.base64_decode($row["password"]).'" type="text" class="form-control" id="password" placeholder="password" name="edit_password" required minlength="3" maxlength="30" />
      </div>


      <center>
      <input type="submit" name="edit_submit" class="btn btn-primary" value="Submit" />
      </center>
      </form>
      </div>
    </div>
  </div>
</div>
<!-- The edit Modal End -->


      </td>
    </tr>
    ';
  }
}
else
{
  $output .= '
  <tr>
    <td colspan="2" align="center">No Data Found</td>
  </tr>
  ';
}

$output .= '
</table>
<br />
<div align="center">
  <ul class="pagination justify-content-end" >
';

$total_links = ceil($total_data/$limit);
$previous_link = '';
$next_link = '';
$page_link = '';

//echo $total_links;

if($total_links > 4)
{
  if($page < 5)
  {
    for($count = 1; $count <= 5; $count++)
    {
      $page_array[] = $count;
    }
    $page_array[] = '...';
    $page_array[] = $total_links;
  }
  else
  {
    $end_limit = $total_links - 5;
    if($page > $end_limit)
    {
      $page_array[] = 1;
      $page_array[] = '...';
      for($count = $end_limit; $count <= $total_links; $count++)
      {
        $page_array[] = $count;
      }
    }
    else
    {
      $page_array[] = 1;
      $page_array[] = '...';
      for($count = $page - 1; $count <= $page + 1; $count++)
      {
        $page_array[] = $count;
      }
      $page_array[] = '...';
      $page_array[] = $total_links;
    }
  }
}
else
{
  for($count = 1; $count <= $total_links; $count++)
  {
    $page_array[] = $count;
  }
}

for($count = 0; $count < count($page_array); $count++)
{
  if($page == $page_array[$count])
  {
    $page_link .= '
    <li class="page-item active">
      <a class="page-link" href="#">'.$page_array[$count].' <span class="sr-only">(current)</span></a>
    </li>
    ';

    $previous_id = $page_array[$count] - 1;
    if($previous_id > 0)
    {
      $previous_link = '<li class="page-item"><a class="page-link" href="javascript:void(0)" data-page_number="'.$previous_id.'">Previous</a></li>';
    }
    else
    {
      $previous_link = '
      <li class="page-item disabled">
        <a class="page-link" href="#">Previous</a>
      </li>
      ';
    }
    $next_id = $page_array[$count] + 1;
    if($next_id >= $total_links)
    {
      $next_link = '
      <li class="page-item disabled">
        <a class="page-link" href="#">Next</a>
      </li>
        ';
    }
    else
    {
      $next_link = '<li class="page-item"><a class="page-link" href="javascript:void(0)" data-page_number="'.$next_id.'">Next</a></li>';
    }
  }
  else
  {
    if($page_array[$count] == '...')
    {
      $page_link .= '
      <li class="page-item disabled">
          <a class="page-link" href="#">...</a>
      </li>
      ';
    }
    else
    {
      $page_link .= '
      <li class="page-item"><a class="page-link" href="javascript:void(0)" data-page_number="'.$page_array[$count].'">'.$page_array[$count].'</a></li>
      ';
    }
  }
}

$output .= $previous_link . $page_link . $next_link;
$output .= '
  </ul>

</div>
';

echo $output;

?>