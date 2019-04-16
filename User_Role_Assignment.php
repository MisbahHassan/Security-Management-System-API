<?php require('conn.php');
			session_start();	?>
<html>
<head>
    <title> User Role Assignment</title>
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
	<script>
	jQuery(document).ready(function(){
			var obj={"act": "getUserRoleTable"};
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
				
				var obj={"act": "getUsers"};
			var userSettings = {
                    type: "POST",
                    datatype: "json",
                    url: "API.php",
                    data: obj,
                    success: function (r) {
                        $("#user_cmb").append(r);
                    },
                    error: function () {
                        alert("some problem occured")
                    }
                };
                $.ajax(userSettings);
				
				var obj={"act": "getRoles"};
				var roleSettings = {
                    type: "POST",
                    datatype: "json",
                    url: "API.php",
                    data: obj,
                    success: function (r) {
                        $("#roles_cmb").append(r);
                    },
                    error: function () {
                        alert("some problem occured")
                    }
                };
                $.ajax(roleSettings);
				
				$("#save").click(function(){
					var user=$("#user_cmb").val();
					var role=$("#roles_cmb").val();
					obj={"user":user,"role":role,"act":"userRoleSave"};
					var userRoleSettings={
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
					$.ajax(userRoleSettings);
				
				})
				$("#clr").click(function () {
                ClearFields();            
                return false;

            });  
                
	});     
	function ClearFields() {
            
            $("#user_cmb").val('0');
            $("#roles_cmb").val('0');
        }
		
		function deleteUserRole(id)
		{
			var res=confirm("Do you want to delete data?");
			if(res==true){
			obj={"act":"deleteUserRole","id":id};
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
			location.reload();
			}
		}
		function editUserRole(id)
		{
			
			obj={"act":"editUserRole","id":id};
			var editSettings=
			{
				type:"POST",
				datatype:"json",
				url:"API.php",
				data:obj,
				success:function(res){
				res = $.parseJSON(res);
				$("#user_cmb").val(res["user"]);
				$("#roles_cmb").val(res["role"]);
				$("#save").click(function(){
					var user=$("#user_cmb").val();
					var role=$("#roles_cmb").val();
			obj2={"act":"editUserRoleSave","id":id,"user":user,"role":role};
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
    
</head>

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
        <h2>User Role Assignment</h2>
        <tr><b> User: </b><select id="user_cmb">
		
        <br>
        <br>
	</select></tr>
	<br>
    <br>
		 <tr><b> Roles: </b><select id="roles_cmb">
		
	</select></tr>
	<br>
    <br>
        <tr>
            <td><input type="submit" class="button" id='save' name='save' value='Save'></td>
            <td><input type="submit" class="button" id='clr' name='clr' value='Clear'></td>
        </tr>

    </form>
    </form>
	<table cellpadding="5" id="Table">
	<tr>
    <th>ID</th>
    <th>User</th> 
	<th>Role</th>
	</tr>
	</table>
</body>
</html>
