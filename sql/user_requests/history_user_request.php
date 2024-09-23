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

$connect = new PDO("mysql:host=localhost; dbname=u622464203_bmsims", "u622464203_bmsims", "Bmsims2023");

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
SELECT * FROM tbl_request WHERE email='{$_SESSION['email']}' AND request_status IN ('Done', 'Disapproved')
";

if($_POST['query'] != '')
{
  $query .= '
  WHERE request_type LIKE "%'.str_replace(' ', '%', $_POST['query']).'%" 
  ';
}

$query .= 'ORDER BY req_id DESC ';

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
    <th class="text-center" style="font-size:12px;color:white" hidden>Request Id</th>
    <th class="text-center" style="font-size:12px;color:white">Date Requested</th>
    <th class="text-center" style="font-size:12px;color:white">Request Type</th>
    <th class="text-center" style="font-size:12px;color:white">Get Day</th>
    <th class="text-center" style="font-size:12px;color:white">Payment Method</th>
    <th class="text-center" style="font-size:12px;color:white">Payment Status</th>
    <th class="text-center" style="font-size:12px;color:white">Request Status</th>
  </tr>
';
if($total_data > 0)
{
  foreach($result as $row)
  {
    $output .= '
    <tr>
      <td class="text-center" style="font-size:12px;color:#27329b" hidden>'.$row["req_id"].'</td>
      <td class="text-center" style="font-size:12px;color:#27329b">'.date("F d, Y", strtotime($row["req_date"])).'</td>
      <td class="text-center" style="font-size:12px;color:#27329b">'.$row["request_type"].'</td>
      <td class="text-center" style="font-size:12px;color:#27329b">'.date("F d, Y", strtotime($row["get_date"])).'</td>
      <td class="text-center" style="font-size:12px;color:#27329b">'.$row["payment_method"].'</td>
      <td class="text-center" style="font-size:12px;color:#27329b">'.$row["payment_status"].'</td>
    ';
    if($row["request_status"] == "Pending"){

      $output .= '
      <td><h5 class="bg-danger">'.$row["request_status"].'</h5></td>';
    }else {
      $output .= '
      <td class="text-center" style="font-size:12px;color:#27329b">'.$row["request_status"].'</td>
      </tr>';
    };
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

echo $output;

?>