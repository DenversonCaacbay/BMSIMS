<style>
  .table {
  overflow: hidden;
  border: 1px solid black;
  border-radius: 10px;
  box-shadow: 0 8px 22px rgba(0,0,0,0.1);;
}
</style>
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
SELECT * FROM tbl_request WHERE request_type='Indigency' AND request_status='Get Record'
";
 
if($_POST['query'] != '')
{
  $query .= '
  AND fullname LIKE "%'.str_replace(' ', '%', $_POST['query']).'%" 
  OR purpose LIKE "%'.str_replace(' ', '%', $_POST['query']).'%" 
 
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

<table class="table sticky">
  <thead>
    <tr>
    <th class="text-center" hidden>Request ID</th>
    <th class="text-center" hidden>Tracking Id</th>
    <th class="text-center" hidden>Request Date</th>
    <th class="text-center">Full name</th>
    <th class="text-center" hidden>request type</th>
    <th class="text-center">Purpose</th>
    <th class="text-center" hidden>close</th>
    <th class="text-center" hidden>open</th>
    <th class="text-center" hidden>Get Day</th>
    <th class="text-center" hidden>Payment Method</th>
    <th class="text-center" hidden>Reference No</th>
    <th class="text-center" hidden>Amount</th>
    <th class="text-center" hidden>Date Paid</th>
    <th class="text-center" hidden>Payment Status</th>
    <th class="text-center" hidden>Request Status</th>
    <th class="text-center" hidden>username</th>
    <th class="text-center">Print</th>
    <th class="text-center">Update</th>
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
        <td class="text-center" hidden>'.$row["req_id"].'</td>
        <td class="text-center" hidden>'.$row["tracking_id"].'</td>
        <td class="text-center" hidden>'.$row["req_date"].'</td>
        <td class="text-center">'.$row["fullname"].'</td>
        <td class="text-center" hidden>'.$row["request_type"].'</td>
        <td class="text-center">'.$row["purpose"].'</td>
        <td class="text-center" hidden>'.$row["date_open"].'</td>
        <td class="text-center" hidden>'.$row["date_close"].'</td>
        <td class="text-center" hidden>'.$row["get_date"].'</td>
        <td class="text-center" hidden>'.$row["payment_method"].'</td>
        <td class="text-center" hidden>'.$row["reference_no"].'</td>
        <td class="text-center" hidden>'.$row["amount"].'</td>
        <td class="text-center" hidden>'.$row["date_paid"].'</td>
        <td class="text-center" hidden>'.$row["payment_status"].'</td>
        <td class="text-center" hidden>'.$row["request_status"].'</td>
        <td class="text-center" hidden>'.$row["email"].'</td>
        <td class="text-center">'."<a href='../../generate_indigency.php?pdf=1&id=".$row['req_id']."' target='_blank'><i class='fas fa-print'></i></a>".'</td>
        <td class="text-center">'.'<button type="button" style="width:auto;" class="btn btn-custom editbtn">Mark as Done</button>'.'</td>
      </tr>
    </tbody>
    ';
  }
}
else
{
  $output .= '
  <tr>
    <td colspan="5" align="center">No Data Found</td>
  </tr>
  ';
}

$output .= '
</table>
<br />
<div align="center" style="float:right;">
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

$output .= $previous_link  .'<li class="page-item">
<p class="page-link" style="pointer-events: none; cursor: default;color:#27329b;"><b>Page '.$page.'</b></p>
</li>'
. $next_link;
$output .= '
  </ul>

</div>
';

echo $output;

?>
