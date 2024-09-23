<?php
include "dbcon.php";
 
$userid = $_POST['userid'];
 
$sql = "select * from resident_accounts where res_id=".$userid;
$result = mysqli_query($conn,$sql);
while( $row = mysqli_fetch_array($result) ){
?>
<table border='0' width='100%'>
<tr>
 
    <td width="300"><img src="data:image/jpg;charset=utf8;base64,<?php echo base64_encode($row['validation']); ?>" width=100%/> 
    </td>
</tr>
</table>
 
<?php } ?>