<style>
.table{
  overflow: hidden;
  border: 1px solid black;
  border-radius: 10px;
  box-shadow: 0 8px 22px rgba(0,0,0,0.1);;
  }
.table th td{
    text-align:center;
    font-size: 15px;
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

  
</html>



<?php


$connect = new PDO("mysql:host=localhost; dbname=u622464203_bmsims", "u622464203_bmsims", "Bmsims2023");

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
SELECT *
FROM tbl_invoice
ORDER BY date_paid DESC
LIMIT 10;
";

if($_POST['query'] != '')
{
  $query .= '
  AND fullname LIKE "%'.str_replace(' ', '%', $_POST['query']).'%" 
  OR request_type LIKE "%'.str_replace(' ', '%', $_POST['query']).'%" 
  ';
}

$query .= 'ORDER BY invoice_id DESC ';

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

    <th class="text-center" hidden>ID</th>
    <th class="text-center" hidden>Staff</th>
    <th class="text-center">Tracking id</th>
    <th class="text-center">Fullname</th>
    <th class="text-center">Request Type</th>
    <th class="text-center">Payment Method</th>
    <th class="text-center">Amount</th>
    <th class="text-center">Date Paid</th>
    <th class="text-center" hidden>Reqeuest Status</th>
  </tr>
';
if($total_data > 0)
{
  foreach($result as $row)
  {
    $output .= '
    <tr>
      <td hidden>'.$row["invoice_id"].'</td>
      
      <td class="text-center" hidden>'.$row["staff"].'</td>
      <td class="text-center">'.$row["tracking_id"].'</td>
      <td class="text-center">'.$row["fullname"].'</td>
      <td class="text-center">'.$row["request_type"].'</td>
      <td class="text-center">'.$row["payment_method"].'</td>
      <td class="text-center">'.$row["amount"].'</td>
      <td class="text-center">'.date("F d, Y- l [g:i:s A]", strtotime($row["date_paid"])).'</td> 
      <td class="text-center" hidden>'.$row["request_status"].'</td> 
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
<div align="center" style="float:right">
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

// $output .= $previous_link .'<li class="page-item"> 
// <p class="page-link" style="pointer-events: none; cursor: default;color:#27329b;"><b>Page '.$page.'</b></p>
// </li>'
// . $next_link;
$output .= '
  </ul>

</div>
';

echo $output;

?>
