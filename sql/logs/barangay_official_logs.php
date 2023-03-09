
<html>

<!-- EDIT POP UP FORM (Bootstrap MODAL) -->
<div class="modal fade" id="editmodal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h3 style="font-weight:600; margin: 10px;"id="exampleModalLabel">Updating Status...</h3>
                <button type="button" style="background: #27329b; color:white;" class="btn" data-dismiss="modal" aria-label="Close">
                    X
                </button>
            </div>

            <form action="../sql/request_clearance_update.php" method="POST">
                <div class="modal-body">
                    <input type="hidden" name="req_id" id="req_id" required>
                    <div class="col-12">
                        <label>Amount</label>
                        <input type="text" name="amount" id="amount" class="form-control">
                    </div>
                    <div class="col-sm-12 form-group" style="margin-top: 10px">
                            <label>Payment Status</label>
                            <select style="padding:13px;" class="form-control form-select" name="payment_status" id="inputGroupSelect01" required>
                                    <option selected id="payment_status" value=""></option>
                                    <option value="Not Paid">Not Paid</option>
                                    <option value="Paid">Paid</option>
                                </select>
                            </div>
                            <div class="col-sm-12 form-group" style="margin-top: 10px">
                              <label>Request Status</label>
                              <select style="padding:13px;" class="form-control form-select" name="request_status" id="request_status inputGroupSelect01" required>
                                    <option selected value=""></option>
                                    <option value="Not Approved">Not Approved</option>
                                    <option value="Approved">Approved</option>
                                    <option value="Processing">Processing</option>
                                    <option value="Get Record">Get Record</option>
                                </select>
                            </div>
                            <div class="col-md-12 form-group mb-3" hidden>
                                <label>Date Paid</label>
                                <input style="padding:13px;" class="form-control form-select" type="date" name="date_paid" value="<?php echo date("Y-m-d"); ?>">
                            </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" name="updatedata" style="background: #27329b; color:white;width: 100%" class="btn successbtn">Update</button>
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

                <form action="../sql/request_remove/request_clearance_remove.php" method="POST">

                    <div class="modal-body">

                        <input type="hidden" name="delete" id="delete_id">

                        <h4> Do you want to remove this request?</h4>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal"> NO </button>
                        <button type="submit" name="deletedata" class="btn btn-primary"> YES</button>
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
                $('#req_id').val(data[0]);
                $('#amount').val(data[5]);
                //$('#payment_status').val(data[5]);
                // $('#payment_status').val(data[3]);    
                // $('#payment_status').val(data[4]);
                // $('#payment_status').val(data[5]);
                // $('#payment_status').val(data[6]);
                // $('#payment_status').val(data[7]);
                // $('#payment_status').val(data[8]);
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
$limit = '5';
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
SELECT * FROM tbl_logs_official
";
 
if($_POST['query'] != '')
{
  $query .= '
  WHERE log_id LIKE "%'.str_replace(' ', '%', $_POST['query']).'%" 
  ';
}

$query .= 'ORDER BY log_id ASC ';

$filter_query = $query . 'LIMIT '.$start.', '.$limit.'';

$statement = $connect->prepare($query);
$statement->execute();
$total_data = $statement->rowCount();

$statement = $connect->prepare($filter_query);
$statement->execute();
$result = $statement->fetchAll();
$total_filter_data = $statement->rowCount();




$output = '
<p></p>
<table class="table">
  <tr>
    <th hidden>Request ID</th>
    
    <th>Log Id</th>
    <th hidden>Account Id</th>
    <th>Staff</th>
    <th>Position</th>
    <th>Firstname</th>
    <th>Middlename</th>
    <th>Lastname</th>
    <th>Date Config</th>
    <th>Status</th>
  </tr>
';



if($total_data > 0)
{
  foreach($result as $row)
  {
    

    $output .= '
    
    <tr>
      <td hidden>'.$row["log_id"].'</td>
      
      <td>'.$row["log_id"].'</td>
      <td hidden>'.$row["acc_id"].'</td>
      <td>'.$row["staff"].'</td>
      <td>'.$row["position"].'</td>
      <td>'.$row["firstname"].'</td>
      <td>'.$row["middlename"].'</td>
      <td>'.$row["lastname"].'</td>
      <td>'.$row["date_config"].'</td>
      <td>'.$row["status"].'</td>
      
    ';
    if($row["status"] == "Deleted"){
      $output .= '<td>'.'<button type="button" style="margin-left:5px;" class="btn btn-success deletebtn">Retrieve Record</button>'.'</td></tr>';
    }else {
      $output .= '</tr>';
    };
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

$output .= $previous_link . $page_link . $next_link;
$output .= '
  </ul>

</div>
';

echo $output;

?>
