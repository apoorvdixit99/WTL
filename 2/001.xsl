<?xml version="1.0" encoding="UTF-8"?>
<xsl:stylesheet version="1.0" 
xmlns:xsl="http://www.w3.org/1999/XSL/Transform">
	<xsl:template match="/">
		<html>
			<body>
				
				<header>
				    <h1>PICT LEAVE MANAGEMENT SYSTEM</h1>
				    <h2>Meet our developers!</h2>
				</header>
				<br/>

				
				<xsl:for-each select="developers/mentor">
					<p><xsl:value-of select="name"/></p>
				</xsl:for-each>
			
				<table border="1">


					<tr bgcolor="green">
						<th>Name</th>
						<th>Class</th>
					</tr>

					<xsl:for-each select="developers/student">
						<tr>
							<td><xsl:value-of select="name"/></td>
							<td><xsl:value-of select="class"/></td>
						</tr>
					</xsl:for-each>

				</table>
				
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
						    <br/>
						</td>
						<td>
						    <div><a href="https://www.pict.edu">Student</a></div>
						    <div><a href="teacher.html">Teacher</a></div>
						    <div><a href="https://www.pict.edu">HOD</a></div>
						    <div><a href="https://www.pict.edu">Admin</a></div>
						    <div><a href="developers.html">Developers</a></div>
						    <div><a href="leave_teacher.html">Leave Request (Teacher)</a></div>
						    <div><a href="https://www.pict.edu">Check Application</a></div>
						</td>
						<td>
						    <div>Phone: +91 9028610141</div>
						    <div>Email: apoorvdixit619@gmail.com</div>
						    <div>Address:</div>
							<!--TAB ENTITY-->
						    <div>Pune Institute of Computer Technology</div>
						    <div>Near Trimurti Chowk, Bharti Vidyapeeth Campus</div>
						    <div>Dhankawadi, Pune.</div>
						    <div>Pincode - 411043.</div>
						</td>
					    </tr>
					    
					</table>

					<hr/>
					<!--COPYRIGHT ENTITY-->
					<p>2019-2020 <a href="https://www.pict.edu">PICT</a>, All rights reserved.</p>
					<p><a href="developers.html">Developers</a></p>
				    </div>
				</footer>
				
				
			</body>
		</html>
	</xsl:template>
</xsl:stylesheet>
