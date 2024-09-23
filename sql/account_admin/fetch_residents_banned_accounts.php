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

  .password-container{
  position: relative;
}
.password-container input[type="password"],
.password-container input[type="text"]{
  width: 100%;
  padding: 12px 36px 12px 12px;
  box-sizing: border-box;
}
.fa-eye{
  position: absolute;
  top: 53%;
  right: 5%;
  cursor: pointer;
  color: #27329b;
}
#myImg {
  border-radius: 5px;
  cursor: pointer;
  transition: 0.3s;
}

#myImg:hover {opacity: 0.7;}

/* The Modal (background) */
.modal1 {
  display: none; /* Hidden by default */
  position: fixed; /* Stay in place */
  z-index: 1; /* Sit on top */
  padding-top: 100px; /* Location of the box */
  left: 0;
  top: 0;
  width: 100%; /* Full width */
  height: 100%; /* Full height */
  overflow: auto; /* Enable scroll if needed */
  background-color: rgb(0,0,0); /* Fallback color */
  background-color: rgba(0,0,0,0.9); /* Black w/ opacity */
}

/* Modal Content (image) */
.modal-content1 {
  margin: auto;
  display: block;
  width: 80%;
  max-width: 700px;
}

/* Caption of Modal Image */
#caption {
  margin: auto;
  display: block;
  width: 80%;
  max-width: 700px;
  text-align: center;
  color: #ccc;
  padding: 10px 0;
  height: 150px;
}

/* Add Animation */
/* .modal-content, #caption {  
  -webkit-animation-name: zoom;
  -webkit-animation-duration: 0.6s;
  animation-name: zoom;
  animation-duration: 0.6s;
}

@-webkit-keyframes zoom {
  from {-webkit-transform:scale(0)} 
  to {-webkit-transform:scale(1)}
}

@keyframes zoom {
  from {transform:scale(0)} 
  to {transform:scale(1)}
} */

/* The Close Button */
.close {
  position: absolute;
  top: 15px;
  right: 35px;
  color: #f1f1f1;
  font-size: 40px;
  font-weight: bold;
  transition: 0.3s;
}

.close:hover,
.close:focus {
  color: #bbb;
  text-decoration: none;
  cursor: pointer;
}
</style>
<html>
<div class="modal fade" id="viewmodal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                <h3 style="color: #27329b; font-weight:600; margin: 10px;"id="exampleModalLabel">View Details</h3>
                    <button type="button" style="background: #27329b; color:white;" class="btn" data-dismiss="modal" aria-label="Close">
                        X
                    </button>
                </div>

                <form action="#" method="POST">
                <div class="modal-body">
                  <input type="hidden" name="id" id="id" required>
                  <div class="row">
                            <div class="col-sm-4 form-group">
                            <label>First Name</label>
                                <input type="text" name="firstname" id="firstname5" class="form-control" placeholder="First Name" disabled>
                            </div>
                            <div class="col-sm-4 form-group">
                            <label>Middle Name</label>
                                <input type="text" name="middlename" id="middlename5" class="form-control" placeholder="Middle Initial" disabled>
                            </div>
                            
                            <div class="col-sm-4 form-group">
                            <label>Last Name</label>
                                <input type="text" name="lastname" id="lastname5" class="form-control" placeholder="Last Name" disabled>
                            </div>
                        </div>
                        
                        <div class="row">
                            <div class="col-sm-3 form-group" style="margin-top: 10px">
                            <label>Gender</label>
                                <input type="text" name="gender" id="gender5" class="form-control" placeholder="Gender" disabled>
                            </div>
                            <div class="col-sm-3 form-group" style="margin-top: 10px">
                            <label>Place of Birth</label>
                              <input type="text" name="place_of_birth" id="place_of_birth5" class="form-control" placeholder="Place of Birth" disabled>
                            </div>
                            <div class="col-sm-3 form-group" style="margin-top: 10px">
                            <label>Birthdate</label>
                              <input type="text" name="bdate" id="bdate5" class="form-control" placeholder="" disabled>
                            </div>
                            <div class="col-sm-3 form-group" style="margin-top:10px;">
                            <label>Civil Status</label>
                             <input type="text" name="civil_status" id="civil_status5" class="form-control" placeholder="" disabled>
                            </div>

                        </div>


                        <div class="row">
                            
                        <div class="col-sm-6 form-group" style="margin-top: 10px">
                            <label>Address</label>
                                <input type="text" name="address" id="address5" class="form-control" placeholder="address" disabled>
                            </div>
                            <div class="col-sm-6 form-group" style="margin-top:10px;">
                            <label>Purok</label>
                              <input type="text" name="purok" id="purok5" class="form-control" placeholder="" disabled>
                            </div>
                            <div class="col-sm-12 form-group" style="margin-top: 10px">
                            <label>Phone Number</label>
                                <input type="text" name="email" id="phone5" class="form-control" placeholder="Email Address" disabled>
                            </div>
                        

                        </div>
 
  
                        
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
                $('#acc_id').val(data[0]);
                $('#admin_power').val(data[1]);
                $('#username').val(data[2]);
                $('#firstname').val(data[3]);
                $('#middlename').val(data[4]);    
                $('#lastname').val(data[5]);
                $('#gender').val(data[6]);
                $('#place_of_birth').val(data[7]);
                $('#bdate').val(data[8]);
                $('#civil_status').val(data[9]);
                $('#address').val(data[10]);
                $('#purok').val(data[11]);
                $('#email').val(data[12]);
                $('#phone').val(data[13]);
                $('#image').val(data[14]);
                
            });
        });
    </script>  


  <!-- <script>
        $(document).ready(function () {

            $('.deletebtn').on('click', function () {

                $('#deletemodal').modal('show');

                $tr = $(this).closest('tr');

                var data = $tr.children("td").map(function () {
                    return $(this).text();
                }).get();

                console.log(data);

                $('#delete_id').val(data[0]);
                $('#username1').val(data[1]);
                $('#firstname1').val(data[2]);
                $('#middlename1').val(data[3]);    
                $('#lastname1').val(data[4]);
                $('#gender1').val(data[5]);
                $('#place_of_birth1').val(data[6]);
                $('#bdate1').val(data[7]);
                $('#civil_status1').val(data[8]);
                $('#address1').val(data[9]);
                $('#purok1').val(data[10]);
                $('#email1').val(data[11]);
                $('#phone1').val(data[12]);
                $('#enterpassword1').val(data[13]);

            });
        });
  </script> -->

<script>
        $(document).ready(function () {

            $('.deletebtn').on('click', function () {

                $('#deletemodal').modal('show');

                $tr = $(this).closest('tr');

                var data = $tr.children("td").map(function () {
                    return $(this).text();
                }).get();

                console.log(data);
                $('#acc_id9').val(data[0]);
                $('#admin_power9').val(data[1]);
                $('#username9').val(data[2]);
                $('#firstname9').val(data[3]);
                $('#lastname9').val(data[5]);    
                
            });
        });
    </script>  

<!-- Grant Access -->
<script>
        $(document).ready(function () {

            $('.grantbtn').on('click', function () {

                $('#grantmodal').modal('show');

                $tr = $(this).closest('tr');

                var data = $tr.children("td").map(function () {
                    return $(this).text();
                }).get();

                console.log(data);
                $('#acc_id6').val(data[0]);
                $('#access6').val(data[1]);
                $('#username6').val(data[2]);
                $('#fname6').val(data[3]);
                $('#middlename6').val(data[4]);    
                $('#lastname6').val(data[5]);
                $('#gender6').val(data[6]);
                $('#place_of_birth6').val(data[7]);
                $('#bdate6').val(data[8]);
                $('#civil_status6').val(data[9]);
                $('#address6').val(data[10]);
                $('#purok6').val(data[11]);
                $('#email6').val(data[12]);
                $('#phone6').val(data[13]);
                $('#password6').val(data[13]);
                $('#image6').val(data[14]);
                
            });
        });
    </script>  

    <!-- View Full Details -->
<script>
        $(document).ready(function () {

            $('.viewbtn').on('click', function () {

                $('#viewmodal').modal('show');

                $tr = $(this).closest('tr');

                var data = $tr.children("td").map(function () {
                    return $(this).text();
                }).get();

                console.log(data);
                $('#acc_id5').val(data[0]);
                $('#admin_power5').val(data[1]);
                $('#username5').val(data[2]);
                $('#firstname5').val(data[3]);
                $('#middlename5').val(data[4]);    
                $('#lastname5').val(data[5]);
                $('#gender5').val(data[6]);
                $('#place_of_birth5').val(data[7]);
                $('#bdate5').val(data[8]);
                $('#civil_status5').val(data[9]);
                $('#address5').val(data[10]);
                $('#purok5').val(data[11]);
                // $('#email5').val(data[12]);
                $('#phone5').val(data[12]);
                $('#image5').val(data[13]);
                
            });
        });
    </script>  
    <script>
        $(document).ready(function () {

            $('.idbtn').on('click', function () {

                $('#viewidmodal').modal('show');

                $tr = $(this).closest('tr');

                var data = $tr.children("td").map(function () {
                    return $(this).text();
                }).get();

                console.log(data);
                $('#id7').val(data[0]);
                $('#image7').val(data[13]);
                
            });
        });
    </script>  
    <!-- The Modal -->
    <script type='text/javascript'>
            $(document).ready(function(){
                $('.userinfo').click(function(){
                    var userid = $(this).data('id');
                    // alert(userid)
                    $.ajax({
                        url: '../sql/account_admin/fetch_img.php',
                        type: 'post',
                        data: {userid: userid},
                        success: function(response){ 
                            $('.modal-body1').html(response); 
                            $('#empModal1').modal('show'); 
                        }
                    });
                });
            });
            </script>
        </div>
        <div class="modal fade" id="empModal1" role="dialog">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title">Verification ID</h4>
                          <button type="button" class="btn btn-custom" data-dismiss="modal">x</button>
                        </div>
                        <div class="modal-body1">
                        </div>
                        <div class="modal-footer">
                          <button type="button" class="btn btn-custom btn-default" data-dismiss="modal">Close</button>
                        </div>
                    </div>
                </div>
        </div>
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
SELECT * FROM resident_accounts WHERE access='Banned'
";

if($_POST['query'] != '')
{
  $query .= '
  AND fname LIKE "%'.str_replace(' ', '%', $_POST['query']).'%" 
  OR access LIKE "%'.str_replace(' ', '%', $_POST['query']).'%" 
  ';
}

$query .= 'ORDER BY res_id DESC ';

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
    <th class="text-center">Banned At</th>
    <th class="text-center">First Name</th>
    <th class="text-center">Middle Initial</th>
    <th class="text-center">Last Name</th>

    <th hidden>Ban Account</th>
    <th style="text-align:center">Action</th>
  </tr>
';
if($total_data > 0)
{
  foreach($result as $row)
  {
    $output .= '
    <tr>
      <td class="text-center" hidden>'.$row["res_id"].'</td>  
      <td class="text-center" hidden>'.$row["email"].'</td>
      <td class="text-center">'.date("F d, Y - l [g:i:s A]", strtotime($row["created_at"])).'</td>
      <td class="text-center">'.$row["fname"].'</td>
      <td class="text-center">'.$row["mname"].'</td>
      <td class="text-center">'.$row["lname"].'</td>
    ';

    if($row["access"] == "Banned"){
      $output .= '<td style="text-align:center">'.'<button type="button" style="margin-left:5px;" class="btn btn-custom grantbtn">Grant Access</button>'.'</td></tr>';
    };
    
  }
}
else
{
  $output .= '
  <tr>
    <td colspan="5" class="text-center">No Data Found</td>
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

$output .= $previous_link .'<li class="page-item">
<p class="page-link" style="pointer-events: none; cursor: default;color:#27329b;"><b>Page '.$page.'</b></p>
</li>'
. $next_link;
$output .= '
  </ul>

</div>
';

echo $output;

?>
