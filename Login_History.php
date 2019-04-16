<?php require('conn.php');
			session_start();	?>
<html>
<head>
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
<script>
jQuery(document).ready(function(){
			var obj={"act": "loginHistoryTable"};
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
});
</script>
</head>

<body>
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
<table cellpadding="8" id="table">
  <tr>
    <th>ID</th>
    <th>User ID</th> 
	<th>Login</th>
	<th>Login Time</th>
	<th>Machine IP</th>
	</tr>
</table>
</form>
<br><br>

</body>
</html>
