
<html>



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
                $('#tracking_id').val(data[1]);
                $('#req_date').val(data[2]);
                $('#fullname').val(data[3]);    
                $('#request_type').val(data[4]);
                $('#purpose').val(data[5]);
                $('#date_open').val(data[6]);
                $('#date_close').val(data[7]);
                $('#get_date').val(data[8]);
                $('#payment_method').val(data[9]);
                $('#reference_no').val(data[10]);
                $('#amount').val(data[11]);
                $('#date_paid').val(data[12]);
                $('#payment_status').val(data[13]);
                $('#request_status').val(data[14]);
                $('#username').val(data[15]);
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

                $('#delete_id1').val(data[0]);
                $('#req_id1').val(data[0]);
                $('#tracking_id1').val(data[1]);
                $('#req_date1').val(data[2]);
                $('#fullname1').val(data[3]);    
                $('#request_type1').val(data[4]);
                $('#purpose1').val(data[5]);
                $('#date_open1').val(data[6]);
                $('#date_close1').val(data[7]);
                $('#get_date1').val(data[8]);
                $('#payment_method1').val(data[9]);
                $('#reference_no1').val(data[10]);
                $('#amount1').val(data[11]);
                $('#date_paid1').val(data[12]);
                $('#payment_status1').val(data[13]);
                $('#request_status1').val(data[14]);
                $('#username1').val(data[15]);

            });
        });
  </script>
    <script>
        $(document).ready(function(){
        $("#myInput").on("keyup", function() {
            var value = $(this).val().toLowerCase();
            $("#myTable tr").filter(function() {
            $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
            });
        });
        });
    </script>
    <script>
        $(document).ready(function(){
        $("#myInput1").on("keyup", function() {
            var value = $(this).val().toLowerCase();
            $("#myTable tr").filter(function() {
            $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
            });
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
SELECT * FROM tbl_request WHERE request_type='Business Permit' AND payment_method='Gcash' AND request_status='Get Record'
";
 
if($_POST['query'] != '')
{
  $query .= '
  AND fullname LIKE "%'.str_replace(' ', '%', $_POST['query']).'%" 
  ';
}

$query .= 'ORDER BY req_id ASC ';

$filter_query = $query . 'LIMIT '.$start.', '.$limit.'';

$statement = $connect->prepare($query);
$statement->execute();
$total_data = $statement->rowCount();

$statement = $connect->prepare($filter_query);
$statement->execute();
$result = $statement->fetchAll();
$total_filter_data = $statement->rowCount();

$output = '
<label hidden>Total Records : '.$total_data.'</label>
<table class="table sticky">
  <thead>
    <tr>
      <th hidden>Request ID</th>
      <th hidden>Tracking Id</th>
      <th hidden>Request Date</th>
      <th>Full name</th>
      <th hidden>request type</th>
      <th hidden>Purpose</th>
      <th hidden>close</th>
      <th hidden>open</th>
      <th>Get Day</th>
      <th hidden>Payment Method</th>
      <th hidden>Reference No</th>
      <th hidden>Amount</th>
      <th hidden>Date Paid</th>
      <th>Payment Status</th>
      <th>Request Status</th>
      <th hidden>username</th>
      <th>Update</th>
    </tr>
  </thead>
  
';
if($total_data > 0)
{
  foreach($result as $row)
  {
    $output .= '
    <tbody id="myTable">
      <tr>
        <td hidden>'.$row["req_id"].'</td>
        <td hidden>'.$row["tracking_id"].'</td>
        <td hidden>'.$row["req_date"].'</td>
        <td>'.$row["fullname"].'</td>
        <td hidden>'.$row["request_type"].'</td>
        <td hidden>'.$row["purpose"].'</td>
        <td hidden>'.$row["date_open"].'</td>
        <td hidden>'.$row["date_close"].'</td>
        <td>'.$row["get_date"].'</td>
        <td hidden>'.$row["payment_method"].'</td>
        <td hidden>'.$row["reference_no"].'</td>
        <td hidden>'.$row["amount"].'</td>
        <td hidden>'.$row["date_paid"].'</td>
        <td>'.$row["payment_status"].'</td>
        <td>'.$row["request_status"].'</td>
        <td hidden>'.$row["username"].'</td>
        <td>'.'<button type="button" style="width:100%;" class="btn btn-custom editbtn">Mark as Done</button>'.'</td>
      </tr>
    </tbody>
    
    ';
  }
}
else
{
  $output .= '
  <tr>
    <td colspan="9" align="center">No Data Found</td>
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

if(!$total_data == 0) {
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
    if($next_id > $total_links)
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
}

$output .= $previous_link .'<li class="page-item">
<p class="page-link" style="pointer-events: none; cursor: default;">'.$page.'</p>
</li>' . $next_link;
$output .= '
  </ul>

</div>
';

echo $output;

?>
