<?php
function prx($data){
	echo '<pre>';
	print_r($data);
	die();
}

function get_safe_value($data){
	global $con;
	if($data){
		return mysqli_real_escape_string($con,$data);
	}
}

function redirect($link){
	?>
	<script>
	window.location.href="<?php echo $link?>";
	</script>
	<?php
}

function checkUser(){
	if(isset($_SESSION['UID']) && $_SESSION['UID']!=''){
	
		
	}else{
		redirect('index.php');
	}
}

function getCategory($category_id='',$page=''){
	global $con;
	$res=mysqli_query($con,"select * from category order by name asc");
	$fun="required";
	if($page=='reports'){
		//$fun="onchange=change_cat()";
		$fun="";
	}
	$html='<select $fun name="category_id" id="category_id"  class="form-control">';
		$html.='<option value="">Select Category</option>';
		
		while($row=mysqli_fetch_assoc($res)){
			if($category_id>0 && $category_id==$row['id']){
				$html.='<option value="'.$row['id'].'" selected>'.$row['name'].'</option>';
			}else{
				$html.='<option value="'.$row['id'].'">'.$row['name'].'</option>';	
			}
			
		}
		
	$html.='</select>';
	return $html;
	
}

function getDashboardExpense($type){
	global $con;
	$today=date('Y-m-d');
	if($type=='today'){
		$sub_sql=" and expense_date='$today'";
		$from=$today;
		$to=$today;
	}
	elseif($type=='yesterday'){
		$yesterday=date('Y-m-d',strtotime('yesterday'));
		$sub_sql=" and expense_date='$yesterday'";
		$from=$yesterday;
		$to=$yesterday;
	}elseif($type=='week' || $type=='month' || $type=='year'){
		$from=date('Y-m-d',strtotime("-1 $type"));
		$sub_sql=" and expense_date between '$from' and '$today'";
		$to=$today;
	}else{
		$sub_sql=" ";
		$from='';
		$to='';
	}
	
	$res=mysqli_query($con,"select sum(price) as price from expense where added_by='".$_SESSION['UID']."' $sub_sql");
	
	$row=mysqli_fetch_assoc($res);
	$p=0;
	$link="";
	if($row['price']>0){
		$p=$row['price'];
		$link="&nbsp;<a href='dashboard_report.php?from=".$from."&to=".$to."' target='_blank' class='detail_link'>Details</a>";
	}
	
	return $p.$link;	
}

function adminArea(){
	if($_SESSION['UROLE']!='Admin'){
		redirect('dashboard.php');
	}
}

function userArea(){
	if($_SESSION['UROLE']!='User'){
		redirect('category.php');
	}
}



include_once('config.php');

/**
 * Function to get the user's name by ID
 *
 * @param int $id User ID
 * @return string|false User's name or false if not found
 */
function getUserNameById($id) {
    $conn = getDbConnection();
    $id = intval($id);
    $stmt = $conn->prepare("SELECT name FROM users WHERE id = ?");
    if ($stmt === false) {
        die("Prepare failed: " . $conn->error);
    }
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $stmt->bind_result($name);
    $result = $stmt->fetch() ? $name : false;
    $stmt->close();
    $conn->close();
    return $result;
}

/**
 * Function to safely get a value from GET request
 *
 * @param string $key The key to look for in the GET request
 * @return string|null The sanitized value or null if not set
  */
// function get_safe_value($key) {
//     return isset($_GET[$key]) ? htmlspecialchars($_GET[$key], ENT_QUOTES, 'UTF-8') : null;
// }

/**
 * Function to get the user's name from session
 *
 * @return string|null The user's name or null if not logged in
 */
function getUserNameBySession() {
    if (isset($_SESSION['user_id'])) {
        return getUserNameById($_SESSION['user_id']);
    }
    return null;
}

?>



