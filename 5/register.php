<?php

    session_start();

    $link = mysqli_connect("localhost","apoorv","Ubuntu@123456","wtlphp5") or die($link);

    if(isset($_POST['register_button'])){

        $firstname = mysqli_real_escape_string($link,$_POST['firstname']);
        $middlename = mysqli_real_escape_string($link,$_POST['middlename']);
        $lastname = mysqli_real_escape_string($link,$_POST['lastname']);

        $address = mysqli_real_escape_string($link,$_POST['address']);
        $emailid = mysqli_real_escape_string($link,$_POST['emailid']);
        $phonenumber = mysqli_real_escape_string($link,$_POST['phonenumber']);

        $designation = mysqli_real_escape_string($link,$_POST['designation']);

        $registrationid = mysqli_real_escape_string($link,$_POST['registrationid']);
        $password = mysqli_real_escape_string($link,$_POST['password']);

        $securityquestion = mysqli_real_escape_string($link,$_POST['securityquestion']);
        $securityanswer = mysqli_real_escape_string($link,$_POST['securityanswer']);

        $sql = "INSERT INTO userdetails(firstname,middlename,lastname,address,phonenumber,emailid,designation,registrationid,password,securityquestion,securityanswer) VALUES ('$firstname','$middlename','$lastname','$address','$phonenumber','$emailid','$designation','$registrationid','$password','$securityquestion','$securityanswer')";

        mysqli_query($link,$sql);

       	//header("location: confirm.php");

   	}

    function test(string $regid){
        $link = mysqli_connect("localhost","apoorv","Ubuntu@123456","wtlphp5") or die($link);

        $registrationid = $_POST["registrationid"];

        $query = "SELECT * FROM userdetails WHERE registrationid='$registrationid'";
        $result  = mysqli_query($link, $query);
        $rowcount = mysqli_num_rows($result);

        if($rowcount>0) {
            echo "Already Exists";
            console.log("Mayahehe");
        }

        return $rowcount;
    }

?>


<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>Sign Up</title>
        <link rel="stylesheet" href="style00.css">

    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>

	<script>

        function checkAvailability(){
            jQuery.ajax({
                url: "check_availability.php",
                data:'registrationid='+$("#regid").val(),
                type: "POST",
                success:function(data){},
                error:function (){}
            });
        }

		function regIDRegex(){

			var regid = document.getElementById("regid").value;
			var pattern = /^[CEI][2][K][\d]{8}$/;
			var isPatternPresent = regid.match(pattern);

			if( isPatternPresent!=null){		
				document.getElementById("regidregex").innerHTML = "";

	            jQuery.ajax({
	                //url: "check_availability.php",
	                //data:'registrationid='+regid,

                    url: "register.php",
                    data:{action:test(regid)},
	                type: "POST",
	                success:function(data){},
	                error:function (){}
	            });

			}
			else {
				document.getElementById("regidregex").innerHTML = "RegexID Not Correct";
				document.getElementById("regid").value = "";
			}



		}


		function passwordValidation(){

			var pass1 = document.getElementById("pass").value;
			var pass2 = document.getElementById("pass2").value;

			if( pass1==pass2 && pass1.length!=0 )
				document.getElementById("passval2").innerHTML = "";
			else {
				document.getElementById("passval2").innerHTML = "Passwords do not Match";
			}
			
		}
		
		function phoneValidation(){
		
			var phonenumber = document.getElementById("phonenumber").value;
			var pattern = /^\d{10,10}$/ ;
			var isPatternPresent = phonenumber.match(pattern);

			if( isPatternPresent!=null){		
				document.getElementById("phoneregex").innerHTML = "";
				
			}
			else {
				document.getElementById("phoneregex").innerHTML = "Phone Number should be a 10 digit number";
				//document.getElementById("phonenumber").value = null ;
			}

		}
		
		function emailValidation(){
		
			var emailid = document.getElementById("emailid").value;
			var pattern = /^[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,4}$/ ;
			var isPatternPresent = emailid.match(pattern);

			if( isPatternPresent!=null){		
				document.getElementById("emailidregex").innerHTML = "";
			}
			else {
				document.getElementById("emailidregex").innerHTML = "Email Address Not Valid";
				document.getElementById("emailidregex").value = "";
			}

		}

		function passwordStrength(){
	
			var pass = document.getElementById("pass").value;
			document.getElementById("passval").innerHTML = "";

			var pattern,isPatternPresent;
			
			document.getElementById("strength").value = 0.0;
			
			//Atleast One Digit
			pattern = /\d/;
			isPatternPresent = pass.match(pattern);
			if(isPatternPresent==null){
				document.getElementById("passval").innerHTML += "Password must contain atleast one digit.<br>"	
			}
			else{
				document.getElementById("strength").value = 0.2;
			}
			
			//Atleast One Special Character
			pattern = /[ !@#$%^&*()_+\-=\[\]{};':"\\|,.<>\/?]/;
			isPatternPresent = pass.match(pattern);
			if(isPatternPresent==null){
				document.getElementById("passval").innerHTML += "Password must contain atleast one special character.<br>";
			}
			else{
				document.getElementById("strength").value = 0.2;
			}
			
			//Atleast One Uppercase Alphabet
			pattern = /[A-Z]/;
			isPatternPresent = pass.match(pattern);
			if(isPatternPresent==null){
				document.getElementById("passval").innerHTML += "Password must contain atleast one uppercase alphabet.<br>";
			}
			else{
				document.getElementById("strength").value = 0.2;
			}

			//Atleast Eight Characters
			var passlen = pass.length;
			if (passlen == 0){
				document.getElementById("strength").value = 0.0;
				document.getElementById("passval").innerHTML += "Password must contain atleast 8 characters.<br>";
			}
			else if (passlen < 8){
				document.getElementById("strength").value = 0.2;
				document.getElementById("passval").innerHTML += "Password must contain atleast 8 characters.<br>";
			}
			else if(passlen < 12){
				document.getElementById("strength").value = 0.7;
			}
			else{
				document.getElementById("strength").value = 1;
			}
			
		}

	</script>
	
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
	<script>
	$(document).ready(function() {
	
		$("#passstrength").hide();
	
		$("select[name='designation']").change(function() {
			if($(this).val()=="student"){
				$("#regid").attr("placeholder","Enter the Registration ID");
				$("#regidtitle").html("Registration ID:");
			}
			else{
				$("#regid").attr("placeholder","Enter the Employee ID");
				$("#regidtitle").html("Employee ID:");
			}
		});
		
		$("input,textarea").focus(function(){
			$(this).css("background-color","yellow");
		});
		
		$("input,textarea").blur(function(){
			$(this).css("background-color","#F0F0F0");
		});
		
		$("#pass").focus(function(){
			$("#passstrength").show();
		});
		
	});
	
	
	</script>
	
	
    </head>
    <body>

        <header>
            <h1>PICT LEAVE MANAGEMENT SYSTEM</h1>
            <h2>Sign Up & Get Started!</h2>
        </header>
        <br>

        <main>
            <h3 style="color:black;">Fill in the details and then click 'Sign Up!'</h3>

            <form method="post" action="register.php">
                <table border="0px" align="center" class="form1">
                    <tr>
                        <td>First Name: </td>
                        <td><input type="text" id="firstname" name="firstname" placeholder="Enter the First Name" size="25" required></td>
                    </tr>
                    <tr>
                        <td>Middle Name: </td>
                        <td><input type="text" id="middlename" name="middlename" placeholder="Enter the Middle Name (Optional)" size="25" ></td>
                    </tr>
                    <tr>
                        <td>Last Name: </td>
                        <td><input type="text" id="lastname" name="lastname" placeholder="Enter the Last Name" size="25"  required></td>
                    </tr>

                    <tr>
                        <td><br><td>
                    </tr>
                    <tr>
                        <td>Email Address: </td>
                        <td><input type="email" id="emailid" name="emailid" placeholder="Enter the Email ID" size="25" onfocusout="emailValidation()"  required></td>
                    </tr>
                    <tr>
                    	<td></td>
                    	<td style="color:red;" id="emailidregex" text-align="left"></td>
                    </tr>
                    <tr>
                        <td>Phone Number: </td>
                        <td>
                            <input type="text" id="countrycode" value="+91" size="3" readonly>
                            <input type="number" id="phonenumber"  name="phonenumber" placeholder="Enter the Phone Number"
                                size="19" onfocusout="phoneValidation()"   required maxlength="10">
                        </td>
                    </tr>
                    <tr>
                    	<td></td>
                    	<td style="color:red;" id="phoneregex" text-align="left"></td>
                    </tr>
                    <tr>
                        <td><br><td>
                    </tr>
                    <tr>
                        <td valign='top' >Address: </td>
                        <td>
                            <textarea id="address"  name="address" rows="4" cols="28" placeholder="Enter the Address"></textarea>
                        </td>
                    </tr>

                    <tr>
                        <td><br></td>
                    </tr>

                </table>
                
                <table  border="0px" align="center">
                    <tr>
                        <td><br></td>
                    </tr>
                    <tr>
                        <td>Designation: </td>
                        <td>
				<select name="designation">
		                        <optgroup label="Designation">
		                            <option value="student">Student</option>
		                            <option value="faculty">Faculty</option>
		                            <option value="hod">HOD</option>
		                            <option value="admin">Admin</option>
		                        </optgroup>
                            	</select>
                        </td>
                    </tr>

                    <tr>
                        <td><br></td>
                    </tr>
                </table>
                    
               
            	<table  border="0px" align="center">
                    <tr>
                        <td id="regidtitle">Registration ID: </td>
                        <td><input type="text" name="registrationid" id="regid" placeholder="Enter the Registration ID" size="25" onfocusout="regIDRegex();"  required></td>
                    </tr>
                    <tr>
                    	<td></td>
                    	<td style="color:red;" id="regidregex" text-align="left"></td>
                    </tr>

                    <tr>
                        <td><br></td>
                    </tr>
                    
                    <tr>
                        <td>Password: </td>
                        <td><input type="password" id="pass"  name="password" placeholder="Enter the Password" size="25" onfocusout="passwordStrength()"  required></td>
                    </tr>
                    <tr>
                    	<td></td>
                    	<td><p id="passstrength">Password Strength: <meter id="strength" value="0.0" low="0.4" high="0.8" optimum="0.9" /></p></td>
                    
                    <tr>
                    	<td></td>
                    	<td style="color:red;" id="passval" text-align="left"></td>
                    </tr>
                    <tr>
                        <td>Password (again): </td>
                        <td><input type="password" id="pass2" placeholder="Enter the Password Again" size="25" onfocusout="passwordValidation()"    required></td>
                    </tr>
                    <tr>
                    	<td></td>
                    	<td style="color:red;" id="passval2" text-align="left"></td>
                    </tr>
                </table>
                

                
                
                <br>
                
                
                 <table  border="0px" align="center">
                    <tr>
                        <td>Security Question: </td>
                        <td>
                            <select class="securityquestions"  name="securityquestion">
                                <optgroup label="questions">
                                    <option name="q1" value="q1">What was your childhood nickname?</option>
                                    <option name="q2" value="q2">What is the name of your favorite childhood friend?</option>
                                    <option name="q3" value="q3">Who is your childhood sports hero?</option>
                                    <option name="q4" value="q4">What school did you attend for tenth grade?</option>
                                    <option name="q5" value="q5">What is the name of your childhood pet?</option>
                                </optgroup>
                            </select>
                        </td>
                    </tr>
                </table>
                


                <table  border="0px" align="center">
                    <tr>
                        <td>Your Answer: </td>
                        <td><input type="text" id="hintanswer" name="securityanswer" placeholder="Enter your Answer" size="25" required></td>
                    </tr>

                    <tr>
                        <td><br></td>
                    </tr>
                    
                </table>
                
               

                <section class="btn">
                    <input type="submit" class="button" name="register_button" value="Sign Up!">

                    <p>By Clicking this button, you agree to our <a href="https://www.pict.edu">Terms and Conditions</a>.</p>
                    <p>Already have an account? <a href="https://www.pict.edu">Login</a> instead.</p>
                </section>

                <br>

            </form>
            
        </main>

        <footer>
            <div>


                <table border="0px" align="center" class="form3" width="100%">
                    <tr>
                        <th>Sitemap</th>
                        <th></th>
                        <th>Contact Us</th>
                    </tr>
                    <tr>
                        <td>
                            <div><a href="https://www.pict.edu">Home</a></div>
                            <div><a href="https://www.pict.edu">About Us</a></div>
                            <div><a href="https://www.pict.edu">Contact Us</a></div>
                            <div><a href="https://www.pict.edu">Sign In</a></div>
                            <div><a href="signup.html">Sign Up</a></div>
                            <div><a href="https://www.pict.edu">Terms and Conditions</a></div>
                            <br>
                        </td>
                        <td>
                            <div><a href="https://www.pict.edu">Student</a></div>
                            <div><a href="teacher.html">Teacher</a></div>
                            <div><a href="https://www.pict.edu">HOD</a></div>
                            <div><a href="https://www.pict.edu">Admin</a></div>
							<div><a href="developers.xml">Developers</a></div>
                            <div><a href="leave_teacher.html">Leave Request (Teacher)</a></div>
                            <div><a href="https://www.pict.edu">Check Application</a></div>
                        </td>
                        <td>
                            <div>Phone: +91 9028610141</div>
                            <div>Email: apoorvdixit619@gmail.com</div>
                            <div>Address:</div>
                            <div>&emsp;&emsp;Pune Institute of Computer Technology</div>
                            <div>&emsp;&emsp;Near Trimurti Chowk, Bharti Vidyapeeth Campus</div>
                            <div>&emsp;&emsp;Dhankawadi, Pune.</div>
                            <div>&emsp;&emsp;Pincode - 411043.</div>
                        </td>
                    </tr>
                    
                </table>

                <hr>
                <p>&copy; 2019-2020 <a href="https://www.pict.edu">PICT</a>, All rights reserved.</p>
                <p><a href="developers.xml">Developers</a></p>
            <div>
        </footer>

    </body>
</html>
