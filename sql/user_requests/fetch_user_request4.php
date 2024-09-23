<style>
.table {
  overflow: hidden;
  border-radius: 10px;
  box-shadow: -4px -4px 15px rgba(255,255,255,0.3),
        4px 4px 15px rgba(0,0,0,0.1);
}
.table th td{
    text-align:center;
  }  
.table h5{
    font-size: 15px;
    color:#fff;
    text-align:center;
    padding:5px;
    border-radius: 50px;
  }

</style>

<html>


    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>

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
session_start();

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


// $query = "SELECT 
//     tbl_request.req_id, tbl_request.req_date, tbl_request.request_type, tbl_request.get_date, 
//     tbl_request.payment_method, tbl_request.payment_status, tbl_request.request_status,
//     tbl_id.req_id AS id_req_id, tbl_id.req_date AS id_req_date, tbl_id.request_type AS id_request_type, tbl_id.get_date AS id_get_date,
//     tbl_id.payment_method AS id_payment_method, tbl_id.payment_status AS id_payment_status, tbl_id.request_status AS id_request_status
//   FROM tbl_request 
//   LEFT JOIN tbl_id ON tbl_id.req_id = tbl_request.req_id
//   WHERE tbl_request.email='{$_SESSION['email']}'";
$query = "SELECT 
    tbl_request.req_id, tbl_request.req_date, tbl_request.request_type, tbl_request.get_date, 
    tbl_request.payment_method, tbl_request.payment_status, tbl_request.request_status,
    tbl_id.bar_id AS id_bar_id, tbl_id.request_date AS id_request_date, tbl_id.type AS id_type, tbl_id.getting_date AS id_getting_date,
    tbl_id.method AS id_method, tbl_id.payment AS id_payment, tbl_id.request AS id_request
  FROM tbl_request 
  LEFT JOIN tbl_id ON tbl_id.bar_id = tbl_request.req_id
  WHERE tbl_request.email='{$_SESSION['email']}' AND tbl_id.email='{$_SESSION['email']}'";

if($_POST['query'] != '')
{
  $query .= '
  AND  tbl_request.req_id LIKE "%'.str_replace(' ', '%', $_POST['query']).'%" 
  AND  tbl_id.bar_id LIKE "%'.str_replace(' ', '%', $_POST['query']).'%" 
  ';
}

$query .= 'ORDER BY tbl_request.req_date DESC ';

$filter_query = $query . 'LIMIT '.$start.', '.$limit.'';

$statement = $connect->prepare($query);
$statement->execute();
$total_data = $statement->rowCount();

$statement = $connect->prepare($filter_query);
$statement->execute();
$result = $statement->fetchAll();
$total_filter_data = $statement->rowCount();

$output = '

<table class="table sticky">
  <tr>
    <th class="text-center" style="color:white" hidden>Request Id</th>
    <th class="text-center" style="color:white">Date Requested</th>
    <th class="text-center" style="color:white">Request Type</th>
    <th class="text-center" style="color:white">Get Day</th>
    <th class="text-center" style="color:white">Payment Method</th>
    <th class="text-center" style="color:white">Payment Status</th>
    <th class="text-center" style="color:white">Request Status</th>
    <th class="text-center" style="color:white">Cancel</th>
  </tr>
';
if($total_data > 0)
{
  foreach($result as $row)
  {
    $output .= '
    <tr>
    <td class="text-center" style="color:#27329b" hidden>'.$row["req_id"].'</td>
    <td class="text-center" style="color:#27329b">'.date("F d, Y - l", strtotime($row["req_date"])).'</td>
    <td class="text-center" style="color:#27329b">'.$row["request_type"].'</td>
    <td class="text-center" style="color:#27329b">'.date("F d, Y - l", strtotime($row["get_date"])).'</td>
    <td class="text-center" style="color:#27329b">'.$row["payment_method"].'</td>
    <td class="text-center" style="color:#27329b">'.$row["payment_status"].'</td> 
    ';
    if($row["request_status"] == "Pending"){
      $output .= '
      <td><h5 class="bg-danger">'.$row["request_status"].'</h5></td>
      <td class="text-center">'.'<button type="button" class="btn btn-status deletebtn"><i class="fas text-danger fa-trash"></i></button>'.'</td></tr>';
    }else {
      $output .= '
      <td><h5 style="background:#2bd598;">'.$row["request_status"].'</h5></td>
      </tr>';
    };
    // Output columns from tbl_id
    $reqDate = DateTime::createFromFormat('Y-m-d', $row["id_request_date"]);
    $reqDateString = ($reqDate !== false) ? $reqDate->format("F d, Y - l") : '';
    
    $getDate = DateTime::createFromFormat('Y-m-d', $row["id_getting_date"]);
    $getDateString = ($getDate !== false) ? $getDate->format("F d, Y - l") : '';
    $output .= '
    <tr>
    <td class="text-center" style="color:#27329b">'.$row["id_bar_id"].'</td>
    <td class="text-center" style="color:#27329b">'.$reqDateString.'</td>
    <td class="text-center" style="color:#27329b">'.$row["id_type"].'</td>
    <td class="text-center" style="color:#27329b">'.$getDateString.'</td>
    <td class="text-center" style="color:#27329b">'.$row["id_method"].'</td>
    <td class="text-center" style="color:#27329b">'.$row["id_payment"].'</td>
    <td class="text-center" style="color:#27329b">'.$row["id_request"].'</td>
      <td class="text-center"></td>
    </tr>
    ';
    $result;
  }
} 
else
{
  $output .= '
  <tr>
    <td colspan="7" align="center">No Request Found</td>
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

$output .= '
  </ul>

</div>
';

// Display the HTML table or message
echo $output;
var_dump($result);


$query = "SELECT 
    tbl_request.req_id, tbl_request.req_date, tbl_request.request_type, tbl_request.get_date, 
    tbl_request.payment_method, tbl_request.payment_status, tbl_request.request_status,
    tbl_id.req_id AS id_req_id, tbl_id.req_date AS id_req_date, tbl_id.request_type AS id_request_type, tbl_id.get_date AS id_get_date,
    tbl_id.payment_method AS id_payment_method, tbl_id.payment_status AS id_payment_status, tbl_id.request_status AS id_request_status,
    tbl_id.column1 AS id_column1, tbl_id.column2 AS id_column2
  FROM tbl_request 
  LEFT JOIN tbl_id ON tbl_id.req_id = tbl_request.req_id
  WHERE tbl_request.email='{$_SESSION['email']}'";

$result = mysqli_query($connection, $query);

if ($result) {
  if (mysqli_num_rows($result) > 0) {
    // Display the joined rows
    while ($row = mysqli_fetch_assoc($result)) {
      var_dump($row);
    }
  } else {
    echo "No matching records found.";
  }
} else {
  echo "Query failed: " . mysqli_error($connection);
}



?>
