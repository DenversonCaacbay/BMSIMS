
<html>

<!-- EDIT POP UP FORM (Bootstrap MODAL) -->
<div class="modal fade" id="editmodal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                <h3 style="color: #27329b; font-weight:600; margin: 10px;"id="exampleModalLabel">View Details</h3>
                    <button type="button" style="background: #27329b; color:white;" class="btn" data-dismiss="modal" aria-label="Close">
                        X
                    </button>
                </div>

                <form action="sql/resident_update.php" method="POST">
                <div class="modal-body">
                  <input type="hidden" name="id" id="id" required>
                  <div class="row">
                            <div class="col-sm-4 form-group">
                            <label>First Name</label>
                                <input type="text" name="firstname" id="firstname" class="form-control" placeholder="First Name" disabled>
                            </div>
                            <div class="col-sm-4 form-group">
                            <label>Middle Name</label>
                                <input type="text" name="middlename" id="middlename" class="form-control" placeholder="Middle Initial" disabled>
                            </div>
                            
                            <div class="col-sm-4 form-group">
                            <label>Last Name</label>
                                <input type="text" name="lastname" id="lastname" class="form-control" placeholder="Last Name" disabled>
                            </div>
                        </div>
                        
                        <div class="row">
                            <div class="col-sm-3 form-group" style="margin-top: 10px">
                            <label>Gender</label>
                                <input type="text" name="gender" id="gender" class="form-control" placeholder="Gender" disabled>
                            </div>
                            <div class="col-sm-3 form-group" style="margin-top: 10px">
                            <label>Place of Birth</label>
                              <input type="text" name="place_of_birth" id="place_of_birth" class="form-control" placeholder="Place of Birth" disabled>
                            </div>
                            <div class="col-sm-3 form-group" style="margin-top: 10px">
                            <label>Birthdate</label>
                              <input type="text" name="bdate" id="bdate" class="form-control" placeholder="" disabled>
                            </div>
                            <div class="col-sm-3 form-group" style="margin-top:10px;">
                            <label>Civil Status</label>
                             <input type="text" name="civil_status" id="civil_status" class="form-control" placeholder="" disabled>
                            </div>

                        </div>


                        <div class="row">
                            
                        <div class="col-sm-6 form-group" style="margin-top: 10px">
                            <label>Address</label>
                                <input type="text" name="address" id="address" class="form-control" placeholder="address" disabled>
                            </div>
                            <div class="col-sm-6 form-group" style="margin-top:10px;">
                            <label>Purok</label>
                              <input type="text" name="purok" id="purok" class="form-control" placeholder="" disabled>
                            </div>
                            <div class="col-sm-6 form-group" style="margin-top: 10px">
                            <label>Email</label>
                                <input type="text" name="email" id="email" class="form-control" placeholder="Email Address" disabled>
                            </div>
                            <div class="col-sm-6 form-group" style="margin-top: 10px">
                            <label>Phone Number</label>
                                <input type="number" name="phone" id="phone" class="form-control" placeholder="Phone Number" disabled>
                            </div>
                        

                        </div>
 
  
                        
                    </div>
                </form>

            </div>
        </div>
    </div>
    <!--End of Edit Modal-->
    <!-- DELETE POP UP FORM (Bootstrap MODAL) -->
    <div class="modal fade" id="deletemodal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel"> Deleting... </h5>
                </div>

                <form action="sql/resident_delete.php" method="POST">

                    <div class="modal-body">

                        <input type="hidden" name="delete" id="delete_id">

                        <h4> Do you want to Delete this Resident?</h4>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal"> NO </button>
                        <button type="submit" name="deletedata" class="btn btn-custom"> YES</button>
                    </div>
                </form>

            </div>
        </div>
    </div>

    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
    <script>
        $(document).ready(function () {

            $('.editbtn').on('click', function () {

                $('#editmodal').modal('show');

                $tr = $(this).closest('tr');

                var data = $tr.children("td").map(function () {
                    return $(this).text();
                }).get();

                console.log(data);
                $('#id').val(data[0]);
                $('#username').val(data[1]);
                $('#firstname').val(data[2]);
                $('#middlename').val(data[3]);    
                $('#lastname').val(data[4]);
                $('#gender').val(data[5]);
                $('#place_of_birth').val(data[6]);
                $('#bdate').val(data[7]);
                $('#civil_status').val(data[8]);
                $('#address').val(data[9]);
                $('#purok').val(data[10]);
                $('#email').val(data[11]);
                $('#phone').val(data[12]);
                
            });
        });
    </script>  
  <script>
        $(document).ready(function () {

            $('.deletebtn').on('click', function () {

                $('#deletemodal').modal('show');

                $tr = $(this).closest('tr');

                var data = $tr.children("td").map(function () {
                    return $(this).text();
                }).get();

                console.log(data);

                $('#delete_id').val(data[0]);

            });
        });
  </script>
</html>



<?php


$connect = new PDO("mysql:host=localhost; dbname=bmsims", "root", "");

$page_array=array(); 
$limit = '1000000';
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
SELECT * FROM tbl_resident
";

if($_POST['query'] != '')
{
  $query .= '
  WHERE firstname LIKE "%'.str_replace(' ', '%', $_POST['query']).'%" 
  ';
}

$query .= 'ORDER BY acc_id ASC ';

$filter_query = $query . 'LIMIT '.$start.', '.$limit.'';

$statement = $connect->prepare($query);
$statement->execute();
$total_data = $statement->rowCount();

$statement = $connect->prepare($filter_query);
$statement->execute();
$result = $statement->fetchAll();
$total_filter_data = $statement->rowCount();

$output = '
<label>Total Records : '.$total_data.'</label>
<p></p>
<table class="table">
  <tr>
    <th hidden>ID</th>
    <th hidden>Username</th>
    <th>First Name</th>
    <th>Middle Initial</th>
    <th>Last Name</th>
    <th>Gender</th>
    <th>Place of Birth</th>
    <th>BirthDate</th>
    <th>Civil Status</th>
    <th hidden>Address</th>
    <th hidden>Purok</th>
    <th hidden>Email</th>
    <th hidden>Phone</th>

    <th>View Details</th>
  </tr>
';
if($total_data > 0)
{
  foreach($result as $row)
  {
    $output .= '
    <tr>
      <td hidden>'.$row["acc_id"].'</td>
      <td hidden>'.$row["username"].'</td>
      <td>'.$row["firstname"].'</td>
      <td>'.$row["middlename"].'</td>
      <td>'.$row["lastname"].'</td>
      <td>'.$row["gender"].'</td>
      <td>'.$row["place_of_birth"].'</td>
      <td>'.$row["bdate"].'</td>
      <td>'.$row["civil_status"].'</td>

      <td hidden>'.$row["address"].'</td>
      <td hidden>'.$row["purok"].'</td>
      <td hidden>'.$row["email"].'</td>
      <td hidden>'.$row["phone"].'</td>
     
      <td>'.'<button type="button" style="width:100%;" class="btn editbtn"><i class="fas fa-eye"></i></button>'.'</td>
    </tr>
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
  <ul class="pagination">
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
    <li class="page-item">
      <a class="page-link" style="color:#fff;background: #27329b;" href="#">'.$page_array[$count].' <span class="sr-only">(current)</span></a>
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

// $output .= $previous_link . $page_link . $next_link;
$output .= '
  </ul>

</div>
';

echo $output;

?>
