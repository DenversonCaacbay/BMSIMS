
<html>
  <!-- EDIT POP UP FORM (Bootstrap MODAL) -->

    <!-- DELETE POP UP FORM (Bootstrap MODAL) -->
    <div class="modal fade" id="deletemodal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel"> Removing... </h5>
                </div>

                <form action="sql/fetch/info/program_delete.php" method="POST">

                    <div class="modal-body">

                        <input type="hidden" name="delete" id="delete_id">

                        <h4> Do you want to remove this Program?</h4>
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
                $('#program_id').val(data[0]);
                $('#event_title').val(data[1]);
                //$('#payment_status').val(data[6]);
                // $('#payment_status').val(data[3]);    
                // $('#payment_status').val(data[4]);
                // $('#payment_status').val(data[5]);
                // $('#payment_status').val(data[6]);
                // $('#payment_status').val(data[7]);
                // $('#payment_status').val(data[8]);
            });
        });
    </script>  
</html>



<?php


$connect = new PDO("mysql:host=localhost; dbname=bmsims", "root", "");

$page_array=array(); 
$limit = '10000000';
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
SELECT * FROM tbl_programs
";

if($_POST['query'] != '')
{
  $query .= '
  WHERE event_title LIKE "%'.str_replace(' ', '%', $_POST['query']).'%" 
  ';
}

$query .= 'ORDER BY program_id DESC ';

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
<table class="table tblCustomers">
  <tr>
    <th hidden>ID</th>
    <th>Event Title</th>
    <th>Date&Time</th>
    <th>Place</th>
    <th>Description</th>
    <th>Remove</th>
  </tr>
';
if($total_data > 0) 
{
  foreach($result as $row)
  {
      $output .= '
      <tr> 
        <td hidden>'.$row["program_id"].'</td>
        <td>'.$row["event_title"].'</td>
        <td>'.$row["event_datetime"].'</td>
        <td>'.$row["place"].'</td>
        <td>'.$row["description"].'</td>
  
        <td hidden>'.'<button type="button" style="width:100%;" class="btn editbtn"><i class="fas fa-user-edit"></i></button>'.'</td>
        <td>'.'<button type="button" style="width:100%;" class="btn editbtn"><i class="fas fa-trash"></i></button>'.'</td>
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
