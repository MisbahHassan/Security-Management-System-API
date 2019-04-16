<?php require('conn.php');
			session_start();	?>
<html>  
    <head>
<title>Permission Assignment</title>
<script src="jquery-1.9.1.min.js" type="text/javascript"></script>

    <style>
 table, th, td {
    border: 2px groove black;
    border-collapse: collapse;
	align:center;
	
}
    body {
        margin: 0;
        font-family: Arial, Helvetica, sans-serif;
    }

    .topnav {
        overflow: hidden;
        background-color: #333;
    }

        .topnav a {
            float: left;
            color: #f2f2f2;
            text-align: center;
            padding: 14px 16px;
            text-decoration: none;
            font-size: 17px;
        }

            .topnav a:hover {
                background-color: #ddd;
                color: black;
            }

            .topnav a.active {
                background-color: #4CAF50;
                color: white;
            }

    .button {
        background-color: #4CAF50; /* Green */
        border: none;
        color: white;
        padding: 15px 32px;
        text-align: center;
        text-decoration: none;
        display: inline-block;
        font-size: 16px;
        margin: 4px 2px;
        cursor: pointer;
        background-color: #008CBA;
    }
</style>
        
    </head>
	<script>
	jQuery(document).ready(function(){
			var obj={"act": "getRolePermissionTable"};
			var tableSettings = {
                    type: "POST",
                    datatype: "json",
                    url: "API.php",
                    data: obj,
                    success: function (r) {
                        $("table").append(r);
                    },
                    error: function () {
                        alert("Some Problem Occured")
                    }
                };
                $.ajax(tableSettings);    
	
				var obj={"act": "getRoles"};
				var roleSettings = {
                    type: "POST",
                    datatype: "json",
                    url: "API.php",
                    data: obj,
                    success: function (r) {
                        $("#cmbRoles").append(r);
                    },
                    error: function () {
                        alert("some problem occured")
                    }
                };
                $.ajax(roleSettings);
            var obj={"act": "getPermissions"};
			var userSettings = {
                    type: "POST",
                    datatype: "json",
                    url: "API.php",
                    data: obj,
                    success: function (r) {
                        $("#cmbPermissions").append(r);
                    },
                    error: function () {
                        alert("Some problem occured")
                    }
                };
                $.ajax(userSettings);  

				$("#save").click(function(){
					var perm=$("#cmbPermissions").val();
					var role=$("#cmbRoles").val();
					obj={"perm":perm,"role":role,"act":"rolePErmissionSave"};
					var rolePermissionSettings={
						type:"POST",
						datatype:"json",
						url:"API.php",
						data:obj,
						success:function(response)
						{
							alert(response);
						},
						error:function()
						{
							alert("Some Problem has been Occured");
						}
					};
					$.ajax(rolePermissionSettings);
				
				})
				$("#clr").click(function () {
                ClearFields();             
                return false;

            });  
                				
	});     
	function ClearFields() {
            
            $("#cmbRoles").val('0');
            $("#cmbPermissions").val('0');
        
        }
			function deleteRolePermission(id)
		{
			var res=confirm("Do you want to delete data?");
			if(res==true){
			obj={"act":"deleteRolePermission","id":id};
			var deleteSettings=
			{
				type:"POST",
				datatype:"json",
				url:"API.php",
				data:obj,
				success:function(res){
				alert(res);
				},
				error:function(){
				alert("some Problem has Occured");
				}
			}
			$.ajax(deleteSettings);
			location.reload();}
			}
function editRolePermission(id)
		{
			
			obj={"act":"editRolePermission","id":id};
			var editSettings=
			{
				type:"POST",
				datatype:"json",
				url:"API.php",
				data:obj,
				success:function(res){
				res = $.parseJSON(res);
				$("#cmbPermissions").val(res["per"]);
				$("#cmbRoles").val(res["role"]);
				$("#save").click(function(){
					var per=$("#cmbPermissions").val();
					var role=$("#cmbRoles").val();
			obj2={"act":"editRolePermissionSave","id":id,"per":per,"role":role};
			var editSaveSettings=
			{
				type:"POST",
				datatype:"json",
				url:"API.php",
				data:obj2,
				success:function(res){
				alert(res);
				},
				error:function(){
				alert("some Problem has Occured");
				}
			}
			$.ajax(editSaveSettings);
					
				})
				},
				error:function(){
				alert("some Problem has Occured");
				}
			}
			$.ajax(editSettings);
			

		}					
		
				
</script>
<body bgcolor="lightblue">
<form>
    <div class="topnav">
        <a href="Home.php"> Home </a> </td>
        <a href="User_Management.php">User Management</a>
        <a href="Role_Management.php">Role Managment</a>
        <a href="Permission_Management.php">Permission Management</a>
        <a href="Role_Permission_Assignment.php">Role Permission Assingment</a>
        <a href="User_Role_Assignment.php">User Role Assignment</a>
		 <a href="Login_History.php">LoginHistory</a>
		 <a href="Login.php">LogOut</a>
    </div>

<form>
<h2>Permission Assignment</h2>

<tr><b>Role:</b> <select id="cmbRoles">
	
</select></tr><br><br>
<tr> <b>Permission:</b><select id="cmbPermissions">

</select>
</tr>
<br>
<br>
<tr>
            <td><input type="submit" class="button" id='save' name='save' value='Save'></td>
            <td><input type="submit" class="button" id='clr' name='clr' value='Clear'></td>
        </tr>

</form>
</form>
<table cellpadding="5" id="table">
<tr>
    <th>ID</th>
    <th>Role</th> 
    <th>Description</th>
	<th>Permission</th>
	<th>Description</th>
	</tr>
</table>
</body>
</html>
