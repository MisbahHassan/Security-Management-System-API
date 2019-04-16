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
			var obj={"act": "getUserTable"};
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
                
			var obj={"act": "getCountries"};
			var settings = {
                    type: "POST",
                    datatype: "json",
                    url: "API.php",
                    data: obj,
                    success: function (r) {
                        $("#cmbCountries").append(r);
                    },
                    error: function () {
                        alert("some problem occured")
                    }
                };
                $.ajax(settings);
                
                $("#cmbCountries").change(function(){
                    $("cmbCities").html("");
                    var sel= $("<option>");
                    sel.val(0);
                    sel.text("--Select--");
                    $("#cmbCities").append(sel);
                    
                    var countryid=$("#cmbCountries").val();
                    //console.log(countryid);
                    var citySettings ={
                        type:"POST",
                        datatype:"json",
                        url:"API.php",
                        data:{"countryid": countryid, "act":"getCities"},
                        success:function(r){
                            $("#cmbCities").append(r);
                        },
                        error:function(){
                            alert("some error occured");
                        }
                    };
                    $.ajax(citySettings);
                });
				$("#save").click(function(){
			 if(document.getElementById("login_txt").value=="" ||document.getElementById("pass_txt").value=="" ||document.getElementById("name_txt").value=="" ||document.getElementById("email_txt").value=="")
			 {
				 alert("Please Fill All Fields !! ");
			 }
			 else{
	
					var login = $("#login_txt").val();
					var password =$("#pass_txt").val();
					var name =$("#name_txt").val();
					var email =$("#email_txt").val();
					var country=$("#cmbCountries").val();
					var city=$("#cmbCities").val();
					if ($("#is_admin").is(":checked"))
					{
						var isadmin=1;
					}
					else
					{
						var isadmin=0;
					}
					var obj={"login":login,"password":password,"name":name,"email":email,"country":country,
					"city":city,"is_admin":isadmin,"act":"saveUser"};
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
				})
				
				
				$("#clr").click(function () {
                ClearFields();          
                return false;

            });   //End of Clear button event handler


		});
			function ClearFields() {
            $("#login_txt").val('');
            $("#pass_txt").val('');
			$("#name_txt").val('');
            $("#cmbCountries").val('0');
            $("#cmbCities").val('0');
            $("#email_txt").val('');
            $("#is_admin").attr("checked", false);
            
        
        }
        function ValidateEmail() {
            var mailformat = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/;
            if (!document.getElementById('email_txt').value.match(mailformat)) {
                alert("Email Pattern is not Valid!!");
            }
        }

		function deleteUser(id)
		{
			var res=confirm("Do you want to delete data?");
			if(res==true){
			obj={"act":"deleteUser","id":id};
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
		function editUser(id)
		{
			
			obj={"act":"editUser","id":id};
			var editSettings=
			{
				type:"POST",
				datatype:"json",
				url:"API.php",
				data:obj,
				success:function(res){
				res = $.parseJSON(res);
				 $("#login_txt").val(res["log"]);
                 $("#pass_txt").val(res["password"]);
				 $("#name_txt").val(res["name"]);
                 $("#email_txt").val(res["email"]);
				 $("#cmbCountries").val(res["ctry"]);
                 $("#cmbCities").val(res["city"]);
				 $("#save").click(function(){
						
					var login = $("#login_txt").val();
					var password =$("#pass_txt").val();
					var name =$("#name_txt").val();
					var email =$("#email_txt").val();
					var country=$("#cmbCountries").val();
					var city=$("#cmbCities").val();
					if ($("#is_admin").is(":checked"))
					{
						var isadmin=1;
					}
					else
					{
						var isadmin=0;
					}
				 var obj2={"act":"editUserSave","id":id,"login":login,"pass":password,"name":name,"email":email,"country":country,"city":city,"is_admin":isadmin};			 
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
    </script>
</head>
<body bgcolor="lightblue">

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
    </table>


    <form>
        <h2>User Management</h2>
        <tr><b>Login:</b><br><input type='text' id='login_txt' required></tr>
        <br>
        <tr><b> Password: </b><br><input type='password' id='pass_txt' required></tr>
        <br>
        <tr><b> Name: </b><br><input type='text' id='name_txt' required></tr>
        <br>
        <tr><b> Email:</b> <br><input type='email' id='email_txt' onblur="ValidateEmail()" required></tr>
        <span></span>
        <br>
        <br>
        <tr> <b>Countries:</b> <select name="" id="cmbCountries">
		<option value="0">--select--</option>
	</select></tr>
        <br>
        <br>
        <tr> <b>City:</b><select name="" id="cmbCities"></tr>
		<tr>
		<br>
		<input type="checkbox" id="is_admin"><b>Is Admin?</b><br>
		</tr>
        <tr>
            <td><input type="submit" class="button" id='save' value='Save'></td>
            <td><input type="submit" class="button" id='clr' value='Clear'></td>
        </tr>

    </form>

    <table cellpadding="5" id="Table">
	<tr>
    <th>ID</th>
    <th>Name</th> 
    <th>Email</th>
	<th>Country</th>
	<th>City</th>
	<th>Created On</th>
	<th>Created By</th>
	<th>Is Admin</th>
	</tr>
	</table>

</body>
</html>
