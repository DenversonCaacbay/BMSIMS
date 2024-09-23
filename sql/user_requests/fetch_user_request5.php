<style>
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
    <!-- DELETE POP UP FORM (Bootstrap MODAL) -->
    <div class="modal fade" id="deletemodal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">

                <form action="../sql/user_requests/request_cancel.php" method="POST">

                    <div class="modal-body">

                        <input type="hidden" name="delete" id="delete_id">

                        <h4 style="text-align:left;">Do you want to Cancel Request?</h4>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-custom" data-dismiss="modal"> NO </button>
                        <button type="submit" name="deletedata" class="btn btn-custom"> YES</button>
                    </div>
                </form>

            </div>
        </div>
    </div>

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

$query = "
SELECT * FROM tbl_request WHERE email='$_SESSION[email]'
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

';
if($total_data > 0)
{
  foreach($result as $row)
  {
    $output .='
    <div class="card">
          <div class="card-header">
            <div class="row">
              <div class="col-12">
              <h5 class="text-center" style="color:#27329b" hidden>'.$row["req_id"].'</h5>
              <h5 class="" style="color:#27329b">'.$row["req_date"].'</h5>
    ';
      if($row["request_status"] == "Pending"){

        $output .= '
                <button type="button" style="float:right;width:100px" class="btn btn-status btn-custom deletebtn">Cancel</button>
              </div>
            </div>
        ';
      }
    $output.='
      </div>
      <div class="card-body">
        <h5 style="color:#27329b">'.$row["request_type"].'</h5>
        <h5 style="color:#27329b">'.$row["get_date"].'</h5>
        <h5 style="color:#27329b">'.$row["payment_method"].'</h5>
        <h5 style="color:#27329b">'.$row["payment_status"].'</h5>
     ';
    if($row["request_status"] == "Pending"){

      $output .= '
        <h5 class="bg-danger">'.$row["request_status"].'</h5>';
    }
    else {
      $output .= '
      <h5 style="background:#2bd598;">'.$row["request_status"].'</h5>
      ';
    };

    $output.= '    
      </div>
    </div>';

   
  }
} 
else
{
  $output .= '
  <tr>
    <td colspan="7" align="center">No Data Found</td>
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
