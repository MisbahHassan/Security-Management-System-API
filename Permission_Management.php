<?php require('conn.php');
			session_start();?>

			
			
<html>  
    <head>
<title> Permission Management</title>
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
    background-color:#008CBA;
}
        </style>
        </head>
<script>
jQuery(document).ready(function(){
			var obj={"act": "getPermissionTable"};
			var tableSettings = {
                    type: "POST",
                    datatype: "json",
                    url: "API.php",
                    data: obj,
                    success: function (r) {
                        $("table").append(r);
                    },
                    error: function () {
                        alert("some problem occured")
                    }
                };
                $.ajax(tableSettings);
	
				$("#save").click(function(){
			 if(document.getElementById("per_txt").value=="" ||document.getElementById("des_txt").value=="")
				 {
				 alert("Please Fill All Fields !! ");
			 }
			 else{
	
					var perm = $("#per_txt").val();
					var descrip =$("#des_txt").val();	
					var obj={"perm":perm,"description":descrip,"act":"savePermission","id":-1};
				
					var saveSettings ={
                        type:"POST",
                        datatype:"json",
                        url:"API.php",
                        data:obj,
                        success:function(r){
                            alert(r);		
                        },
                        error:function(){
                            alert("Some Error has been Occured");
                        }
                    };
                    $.ajax(saveSettings);
			 }
				});
				$("#clr").click(function () {
                ClearFields();            
                return false;

            });  
});
function editPermission(id)
		{
			
			obj={"act":"editPermission","id":id};
			var editSettings=
			{
				type:"POST",
				datatype:"json",
				url:"API.php",
				data:obj,
				success:function(res){
				res = $.parseJSON(res);
				 $("#per_txt").val(res["per"]);
                 $("#des_txt").val(res["des"]);
				$("#save").click(function(){
				var per = $("#per_txt").val();
				var descrip =$("#des_txt").val();	
				 var obj2={"act":"editPermissionSave","id":id,"per":per,"des":descrip};			 
				 var EDsettings={
				
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
				 $.ajax(EDsettings);
				 });
				},
				error:function(){
				alert("some Problem has Occured");
				}
			}
			$.ajax(editSettings);
			

		}		
function ClearFields() {
            $("#per_txt").val('');
            $("#des_txt").val('');
        }
function deletePermission(id)
		{
			var res=confirm("Do you want to delete data?");
			if(res==true){
			obj={"act":"deletePermission","id":id};
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
<h2>Permission Management</h2>
<tr><b>Permission Name: </b><br><input type='text' id='per_txt'  required></tr><br>
<tr><b> Description:</b> <br><input type='text' id='des_txt'  required></tr><br>

<tr>
            <td><input type="submit" class="button" name='save' id='save' value='Save'></td>
            <td><input type="submit" class="button" name='clr' id='clr' value='Clear'></td>
        </tr>

</form>
<table cellpadding="5" id="table">
<tr>
    <th>ID</th>
    <th>Permission</th> 
    <th>Description</th>
	<th>Created On</th>
	<th>Created By</th>
	</tr>
</table>
</form>
</body>
</html>
