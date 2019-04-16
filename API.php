<?php require('conn.php');
			session_start();	?>
			
<?php
if($_REQUEST["act"]=="editRolePermission")
{
	$arr=array();
		$id=$_REQUEST['id'];
		$sql = "SELECT * FROM role_permission where id='$id'";
		$result = mysqli_query($conn, $sql);
		$row = mysqli_fetch_assoc($result);
		$arr["per"]=$row["permissionid"];
		$arr["role"]=$row["roleId"];
		echo json_encode($arr);
}
if($_REQUEST["act"]=="editRolePermissionSave")
{
			$id=$_REQUEST['id'];	
			$role_id=$_REQUEST['role'];		
			$perm_id=$_REQUEST['per'];
			$sql="update role_permission set roleid='$role_id',permissionid= '$perm_id' where id='$id'";
			$result = mysqli_query($conn, $sql);
			echo "Succesfully Edited";
}
if($_REQUEST["act"]=="editUserRoleSave")
{
	$id=$_REQUEST['id'];
	$user_id=$_REQUEST['user'];		
	$role_id=$_REQUEST['role'];
	$sql="update user_role set userid='$user_id',roleid= '$role_id' where id='$id'";
	$result = mysqli_query($conn, $sql);
	echo "Succesfully Edited";
}
if($_REQUEST["act"]=="editUserSave")
{
	$id=$_REQUEST['id'];
		$login=$_REQUEST['login'];
			$password=$_REQUEST['pass'];
			$email=$_REQUEST['email'];
			$name=$_REQUEST['name'];
			$country=$_REQUEST['country'];
			$city=$_REQUEST['city'];
			$adminChk=$_REQUEST['is_admin'];
			
			$sql2 = "update users set login = '$login', password = '$password', email = '$email', name = '$name',
			isadmin = '$adminChk', countryid = '$country',cityid='$city' where userid = '$id'";
			$result1 = mysqli_query($conn, $sql2);
			echo "Successfully Edited";
}
if($_REQUEST["act"]=="editRoleSave")
{
			$id=$_REQUEST['id'];
			$role=$_REQUEST['role'];	
			$descrp=$_REQUEST['des'];			
			$sql = "update roles set name = '$role', description = '$descrp' where roleid = '".$id."'";
			$result = mysqli_query($conn, $sql);
			echo "Successfully Edited";
}
if($_REQUEST["act"]=="editPermissionSave")
{
			$id=$_REQUEST['id'];
			$p=$_REQUEST['per'];	
			$des=$_REQUEST['des'];
			$sql = "update permissions set name = '$p', description = '$des' where permissionid = '".$id."'";
			$result = mysqli_query($conn, $sql);
			echo "Successfully Edited";
			
}
if($_REQUEST["act"]=="editUser")
{
	$arr=array();
	$id=$_REQUEST['id'];
		$sql = "SELECT * FROM users where userid='$id'";
		$result = mysqli_query($conn, $sql);
		$row = mysqli_fetch_assoc($result);
		$arr['name']=$row["name"];
		$arr['email']=$row["email"];
		$arr['password']=$row["password"];
		$arr['log']=$row["login"];
		//$adm=$row['isadmin'];
		$arr['ctry']=$row['countryid'];
		$arr['city']=$row['cityid'];
		echo json_encode($arr);

}
if($_REQUEST["act"]=="editUserSave")
{
			$login=$_REQUEST['id'];
			$login=$_REQUEST['login'];
			$password=$_REQUEST['pass'];
			$email=$_REQUEST['email'];
			$name=$_REQUEST['name'];
			$country=$_REQUEST['country'];
			$city=$_REQUEST['city'];

			$adminChk=isset($_REQUEST['is_admin']);	
			
			$sql2 = "update users set login = '$login', password = '$password', email = '$email', name = '$name',
			isadmin = '$adminChk', countryid = '$country',cityid = '$city' where userid = '$id'";
			$result1 = mysqli_query($conn, $sql2);
			echo "Succesfully Edited";
			
}
if($_REQUEST["act"]=="editUserRole")
{
	$id=$_REQUEST['id'];
	$arr=array();
		$sql = "SELECT * FROM user_role where id='$id'";
		$result = mysqli_query($conn, $sql);
		$row = mysqli_fetch_assoc($result);
		$arr["user"]=$row['userid'];
		$arr["role"]=$row['roleid'];
		echo json_encode($arr);
}
if($_REQUEST["act"]=="editRole")
{
	$id=$_REQUEST["id"];
	$query="Select * from roles where roleid=$id";
	$result = mysqli_query($conn, $query);
	$noOfRecords = mysqli_num_rows($result);
	$arr=array();
	if($noOfRecords>0)
	{
		while($data = mysqli_fetch_assoc($result)) {
		$role_id=$data['roleid'];
		$arr["id"]=$role_id;
		$arr["role"]=$data['name'];
		$arr["des"]=$data['description'];
		}
	}
	echo json_encode($arr);
}
if($_REQUEST["act"]=="editPermission")
{
	$id=$_REQUEST["id"];
	$query="Select * from permissions where permissionid=$id";
	$result = mysqli_query($conn, $query);
	$noOfRecords = mysqli_num_rows($result);
	$arr=array();
	if($noOfRecords>0)
	{
		while($data = mysqli_fetch_assoc($result)) {
		$per_id=$data['permissionid'];
		$arr["id"]=$per_id;
		$arr["per"]=$data['name'];
		$arr["des"]=$data['description'];
		}
	}
	echo json_encode($arr);
}
if($_REQUEST["act"]=="loginHistoryTable")
{
$query="Select * from login_history";
	$result = mysqli_query($conn, $query);
	$noOfRecords = mysqli_num_rows($result);
	if($noOfRecords>0)
	{
		while($data = mysqli_fetch_assoc($result)) {
		echo "<tr>";
		echo "<td>".$data['id']."</td>";
		$user_id=$data['userid'];
		echo "<td>".$user_id."</td>";		
		echo "<td>".$data['login']."</td>";
		echo "<td>".$data['logintime']."</td>";
		echo "<td>".$data['machineip']."</td>";
		echo "</tr>";
		}
	}
}
if($_REQUEST["act"]=="getUserTable"){
    
	$query="Select * from users";
	$result = mysqli_query($conn, $query);
	$noOfRecords = mysqli_num_rows($result);
	if($noOfRecords>0)
	{
		while($data = mysqli_fetch_assoc($result)) {
		echo "<tr>";
		$user_id=$data['userid'];
		echo "<td>".$user_id."</td>";
		echo "<td>".$data['name']."</td>";
		echo "<td>".$data['email']."</td>";
		$ctry=$data['countryid'];
		$q="Select * from country where countryid='$ctry'";
		$country = mysqli_query($conn, $q);
		$d = mysqli_fetch_assoc($country);
		echo "<td>".$d['Name']."</td>";
		$cty=$data['cityid'];
		$q="Select * from city where id='$cty'";
		$country = mysqli_query($conn, $q);
		$d2 = mysqli_fetch_assoc($country);
		echo "<td>".$d2['name']."</td>";

		echo "<td>".$data['createdon']."</td>";
		echo "<td>".$data['createdby']."</td>";	
		if($data['isadmin']==1)
		{
			echo "<td>Yes</td>";	
		}
		else
		{
			echo "<td>No</td>";	
		}
		echo "<td><button type='submit' id='edit' value='$user_id' onclick='editUser($user_id)'> Edit </button></td>";
		echo "<td><button type='submit' id='delete' value='$user_id' onclick='deleteUser($user_id)'> DELETE </button></td>";
		echo "</tr>";
		}
	}
}
if($_REQUEST["act"]=="getRoleTable")
{
	$query="Select * from roles";
	$result = mysqli_query($conn, $query);
	$noOfRecords = mysqli_num_rows($result);
	if($noOfRecords>0)
	{
		while($data = mysqli_fetch_assoc($result)) {
		echo "<tr>";
		$role_id=$data['roleid'];
		echo "<td>".$role_id."</td>";
		echo "<td>".$data['name']."</td>";
		echo "<td>".$data['description']."</td>";
		echo "<td>".$data['createdon']."</td>";
		echo "<td>".$data['createdby']."</td>";	
		echo "<td><button type='submit' id='edit' value='$role_id' onclick='editRole($role_id)'> Edit </button></td>";
		echo "<td><button type='submit' id='delete' value='$role_id' onclick='deleteRole($role_id)'> DELETE </button></td>";
		echo "</tr>";
		}
	}
}
if($_REQUEST["act"]=="getPermissionTable")
{
	$query="Select * from permissions";
	$result = mysqli_query($conn, $query);
	$noOfRecords = mysqli_num_rows($result);
	if($noOfRecords>0)
	{
		while($data = mysqli_fetch_assoc($result)) {
		echo "<tr>";
		$permission_id=$data['permissionid'];
		echo "<td>".$permission_id."</td>";
		echo "<td>".$data['name']."</td>";
		echo "<td>".$data['description']."</td>";
		echo "<td>".$data['createdon']."</td>";
		echo "<td>".$data['createdby']."</td>";	
		echo "<td><button type='submit' id='edit' value='$permission_id' onclick='editPermission($permission_id)'> Edit </button></td>";
		echo "<td><button type='submit' id='delete' value='$permission_id' onclick='deletePermission($permission_id)'> DELETE </button></td>";
		echo "</tr>";
		}
	}
}
if($_REQUEST["act"]=="getUserRoleTable"){
$query="Select * from user_role";
	$result = mysqli_query($conn, $query);
	$noOfRecords = mysqli_num_rows($result);
	if($noOfRecords>0)
	{
		while($data = mysqli_fetch_assoc($result)) {
		echo "<tr>";
		$id=$data['id'];
		echo "<td>".$id."</td>";
		
		$user_id=$data['userid'];
		$q="Select * from users where userid='$user_id'";
		$user = mysqli_query($conn, $q);
		$d1= mysqli_fetch_assoc($user);		
		echo "<td>".$d1['name']."</td>";
		
		$role_id=$data['roleid'];
		$q="Select * from roles where roleid='$role_id'";
		$role = mysqli_query($conn, $q);
		$d2 = mysqli_fetch_assoc($role);		
		echo "<td>".$d2['name']."</td>";
		
		echo "<td><button type='submit' name='edit' value='$id' onclick='editUserRole($id)'> Edit </button></td>";
		echo "<td><button type='submit' name='delete' value='$id' onclick='deleteUserRole($id)'> DELETE </button></td>";
		echo "</tr>";
		}
	}
}
if($_REQUEST["act"]=="getRolePermissionTable"){
	$query="Select * from role_permission";
	$result = mysqli_query($conn, $query);
	$noOfRecords = mysqli_num_rows($result);
	if($noOfRecords>0)
	{
		while($data = mysqli_fetch_assoc($result)) {
		echo "<tr>";
		$id=$data['id'];
		echo "<td>".$id."</td>";
		
		$role_id=$data['roleId'];
		$q1="Select * from roles where roleId='$role_id'";
		$role = mysqli_query($conn, $q1);
		$d1= mysqli_fetch_assoc($role);		
		echo "<td>".$d1['name']."</td>";
		echo "<td>".$d1['description']."</td>";

		$prem_id=$data['permissionid'];
		$q2="Select * from permissions where permissionid='$prem_id'";
		$prem = mysqli_query($conn, $q2);
		$d2 = mysqli_fetch_assoc($prem);		
		echo "<td>".$d2['name']."</td>";
		echo "<td>".$d2['description']."</td>";

		echo "<td><button type='submit' name='edit' value='$id' onclick='editRolePermission($id)'> Edit </button></td>";
		echo "<td><button type='submit' name='delete' value='$id'  onclick='deleteRolePermission($id)'> DELETE </button></td>";
		echo "</tr>";
		}
	}
}
if($_REQUEST["act"]=="saveRole")
{
	if($_REQUEST['id']==-1){
			$role=$_REQUEST['role'];
			$descrp=$_REQUEST['description'];
			$createBy=$_SESSION['login_id'];
			$createOn=date("Y-m-d h:i:s");
			$sql="insert into roles (name,description,createdon,createdby) values ('$role','$descrp','$createOn','$createBy')";
			$result = mysqli_query($conn, $sql);
			echo "Sccessfully Role Added !!";
	}

}
if($_REQUEST["act"]=="savePermission")
{
	if($_REQUEST['id']==-1){
			$per=$_REQUEST['perm'];
			$descrp=$_REQUEST['description'];
			$createBy=$_SESSION['login_id'];
			$createOn=date("Y-m-d h:i:s");
			$sql="insert into permissions (name,description,createdon,createdby) values ('$per','$descrp','$createOn','$createBy')";
			$result = mysqli_query($conn, $sql);
			echo "Sccessfully Permission Added !!";
	}
}
if($_REQUEST["act"]=="getCountries"){
    $sql = "SELECT countryid,name FROM country";

    $result = mysqli_query($conn, $sql);
    $recordsFound = mysqli_num_rows($result);

    if ($recordsFound > 0) {
        //echo $recordsFound;
        while ($row = mysqli_fetch_assoc($result)) {

            $id = $row["countryid"];
            $name = $row["name"];
            if ($id == 0) {
                echo "<option selected value='$id'>$name</option>";
            } else {
                echo "<option value='$id'>$name</option>";
            }
        }
    }
}
if($_REQUEST["act"]=="getUsers"){
$q1 = "SELECT * FROM users";
		$result = mysqli_query($conn, $q1);
		$recordsFound = mysqli_num_rows($result);			
		if ($recordsFound > 0) {
		while($row = mysqli_fetch_assoc($result)) {		
			$id_r = $row["userid"];
			$name_r = $row["name"];
			/*if($u_id==$id_r)
			{
				echo "<option value='$id_r' selected>$name_r</option>";
			}
			else{*/
			if($row['isadmin']==0)
			{
				echo "<option value='$id_r'>$name_r</option>";
			}
			//}
		}	
	}			
}
if($_REQUEST["act"]=="getRoles"){
$q2 = "SELECT * FROM roles";
		$res = mysqli_query($conn, $q2);
		$recordsFound = mysqli_num_rows($res);			
		if ($recordsFound > 0) {
		while($row = mysqli_fetch_assoc($res)) {
			$id = $row["roleid"];
			$name = $row["name"];
			/*if($r_id==$id)
			{
				echo "<option value='$id' selected>$name</option>";
			}
			else*/
			{
				echo "<option value='$id'>$name</option>";
			}
			
		}	
	}			
}
if($_REQUEST["act"]=="getPermissions"){
$q1 = "SELECT * FROM permissions";
		$result = mysqli_query($conn, $q1);
		$recordsFound = mysqli_num_rows($result);			
		if ($recordsFound > 0) {
		while($row = mysqli_fetch_assoc($result)) {		
			$id = $row["permissionid"];
			$name = $row["name"];
			/*if($p_id==$id)
			{
			echo "<option value='$id' selected>$name</option>";
			}
			else*/
			{
				echo "<option value='$id'>$name</option>";
			}
		}	
	}			
}
if($_REQUEST["act"]=="getCities"){
    $cid=$_REQUEST["countryid"];
    $sql1 = "SELECT id,name FROM city where countryid='".$cid."'";

    $result1 = mysqli_query($conn, $sql1);
    $recordsFound1 = mysqli_num_rows($result1);

    if ($recordsFound1 > 0) {
        //echo $recordsFound;
        while ($row1 = mysqli_fetch_assoc($result1)) {

            $id = $row1["id"];
            $name = $row1["name"];
            if ($id == 0) {
                echo "<option selected value='$id'>$name</option>";
            } else {
                echo "<option value='$id'>$name</option>";
            }
        }
    }
}
if($_REQUEST["act"]=="saveUser")
{
			$flag=true;
			$login=$_REQUEST['login'];
			$password=$_REQUEST['password'];
			$email=$_REQUEST['email'];
			$name=$_REQUEST['name'];
			$country=$_REQUEST['country'];
			$cityid=$_REQUEST['city'];
			$adminChk=$_REQUEST['is_admin'];
			$createBy=$_SESSION['login_id'];
			$createOn=date("Y-m-d h:i:s");
			$q="Select * from users";
			$res = mysqli_query($conn, $q);
			$noOfRecords = mysqli_num_rows($res);
			if($noOfRecords>0)
			{
			while($data = mysqli_fetch_assoc($res)) {
				if($data['login']==$login || $data['email']==$email)
				{
					$flag=false;
				}
			}
			}
			if($flag==false)
			{
				echo "Login or Email already exists";
				return;
			}
			$sql="insert into users (login,password,email,name,countryid,isadmin,createdon,createdby,cityid) 
			values ('$login','$password','$email','$name','$country','$adminChk','$createOn','$createBy','$cityid')";
			$result = mysqli_query($conn, $sql);
			echo "Succesfully Added User !!"; 
}
if($_REQUEST["act"]=="userRoleSave")
{
	$user_id=$_REQUEST['user'];		
	$role_id=$_REQUEST['role'];
	$sql="insert into user_role (userid,roleid) values ('$user_id','$role_id')";
	$result = mysqli_query($conn, $sql);
	echo "Succesfully Assign Role !!"; 

}
if($_REQUEST["act"]=="rolePErmissionSave")
{
			$role_id=$_REQUEST['role'];		
			$perm_id=$_REQUEST['perm'];
			$sql="insert into role_permission (roleId,permissionid) values ('$role_id','$perm_id')";
			$result = mysqli_query($conn, $sql);
			echo "Succesfully Assign Permission !!"; 

}
if($_REQUEST["act"]=="deleteUser"){
$id=$_REQUEST['id'];
		$q="delete from users where userid='$id'";
		$res=mysqli_query($conn, $q);
		echo "Successfully Deleted";
}
if($_REQUEST["act"]=="deleteRole"){
		$id=$_REQUEST['id'];
		$q="delete from roles where roleid='$id'";
		$res=mysqli_query($conn, $q);
		echo "Successfully Deleted";
}
if($_REQUEST["act"]=="deletePermission"){
	
		$id=$_REQUEST['id'];
		$q="delete from permissions where permissionid='$id'";
		$res=mysqli_query($conn, $q);
		echo "Successfully Deleted";
}
if($_REQUEST["act"]=="deleteUserRole"){
		
		$id=$_REQUEST['id'];
		$q="delete from user_role where id='$id'";
		$res=mysqli_query($conn, $q);
		echo "Successfully Deleted";
}
if($_REQUEST["act"]=="deleteRolePermission"){
		$id=$_REQUEST['id'];
		$q="delete from role_permission where id='$id'";
		$res=mysqli_query($conn, $q);
		echo "Successfully Deleted";
}
?>