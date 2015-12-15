<!DOCTYPE HTML>
<html>
	<head>
		<title>Customer info</title>
	</head>
	<body>

		<style>
			.error {color: #FF0000;}
			#header {
				background-color:#395870;
				color:white;
				text-align:center;
				padding:5px;
			}

			#section {
				background: #cbe2c1;
				background: -webkit-linear-gradient(to right, #a1d3b0, #f6f1d3);
				background: -webkit-linear-gradient(left, #a1d3b0, #f6f1d3);
				background: linear-gradient(to right, #a1d3b0, #f6f1d3);
				padding: 44px 0 22px 0;
				padding:10px;
			}

			#footer {
				background-color: #395870;
				color: white;
				clear:both;
				text-align:center;
				padding:5px;
			}

			form {
				margin: 0 auto;
				border: 3px solid #648880;
				background : white;
				border-radius: 10px;
				font: 14px/1.4 "Helvetica Neue", Helvetica, Arial, sans-serif;
				overflow: hidden;
				width: 800px;
			}
			fieldset {
				border: 3px solid #648880;
				background : white;
				margin: 10px;
				padding: 10px;
				border-radius: 10px;
				color: #395870;
			}

			legend{
				font-weight: bold;
			}

			label {
				color: #395865;
				display: block;
				font-weight: bold;
				margin-bottom: 0px;
			}

		</style>

		<?php

		$err1= $err2=$err3=$err4=$err5=$err6=$err7=$err8=$err9=$err10="";
		$err11=$err12=$err13=$err14=$err15=$err16=$err17=$err18=$err19=$err20="";
		$allset = 0;

		$age= $job= $marital = $education = $default_credit = $housing_loan = $personal_loan = $contact= $month = $day = $duration = $campaign = $prev_days = $prev_num_contact = $prev_outcome = $decision = "";
		// sending parameters
		if ($_SERVER["REQUEST_METHOD"] == "POST") {

			if(empty($_POST["age"])) {
				$err1="required";
				$allset=1;
			}else {
				if($_POST["age"] <= 0) {
					$err1="Invalid age";
					$allset=1;
				}
				$age = test_input($_POST["age"]);
			}

			if(empty($_POST["job"])) {
				$err2="required";
				$allset=1;
			}else {
				$job = test_input($_POST["job"]);
			}

			if(empty($_POST["marital"])) {
				$err3="required";
				$allset=1;
			}else{
				$marital = test_input($_POST["marital"]);
			}

			if(empty($_POST["education"])) {
				$err4="required";
				$allset=1;
			} else {
				$education = test_input($_POST["education"]);
			}

			if(empty($_POST["default_credit"])) {
				$err5="required";
				$allset=1;
			} else {
				$default_credit = test_input($_POST["default_credit"]);
			}

			if(empty($_POST["housing_loan"])) {
				$err6="required";
				$allset=1;
			} else {
				$housing_loan = test_input($_POST["housing_loan"]);
			}

			if(empty($_POST["personal_loan"])) {
				$err7="required";
				$allset=1;
			} else {
				$personal_loan = test_input($_POST["personal_loan"]);
			}

			if(empty($_POST["contact"])) {
				$err8="required";
				$allset=1;
			} else {

				$contact = test_input($_POST["contact"]);
			}

			if(empty($_POST["day"])) {
				$err9="required";
				$allset=1;
			} else {
				$day = test_input($_POST["day"]);
			}


			if(empty($_POST["month"])) {
				$err10="required";
				$allset=1;
			} else {
				$month = test_input($_POST["month"]);
			}

			if(empty($_POST["duration"])) {
				$err11="required";
				$allset=1;
			} else {
				if($_POST["duration"] < 0) {
					$err11="invalid value";
					$allset=1;
				}
				$duration = test_input($_POST["duration"]);
			}

			if(empty($_POST["campaign"])) {
				$err12="required";
				$allset=1;
			} else {
				if($_POST["campaign"] < 0) {
					$err12="invalid value";
					$allset=1;
				}
				$campaign = test_input($_POST["campaign"]);
			}

			if(empty($_POST["prev_days"])) {
				$err13="required";
				$allset=1;
			} else {
				if($_POST["prev_days"] < 0 || $_POST["prev_days"] > 999) {
					$err13="invalid value";
					$allset=1;
				}
				$prev_days = test_input($_POST["prev_days"]);
			}

			if(empty($_POST["prev_num_contact"])) {
				$err14="required";
				$allset=1;
			} else {
				if($_POST["prev_num_contact"] < 0 ) {
					$err14="invalid value";
					$allset=1;
				}
				$prev_num_contact = test_input($_POST["prev_num_contact"]);
			}

			if(empty($_POST["prev_outcome"])) {
				$err15="required";
				$allset=1;
			} else {
				$prev_outcome = test_input($_POST["prev_outcome"]);
			}

			if($allset == 0) {
				if(decision_tree($duration, $month, $prev_num_contact, $job)){
					$decision = "yes";
				}
				else{
					$decision="no";
				}

				echo "<script language='javascript'>";
				echo "alert('decision for this customer is : $decision')";
				echo "</script>";
				$conn = mysqli_connect("localhost","root","","bank_marketing");

				if(!$conn) {
					die("connection Error " . mysqli_connect_error());
				}

				$query = "INSERT INTO customer (age, job, marital, education, default_credit,
				housing_loan, personal_loan, contact, month, day, duration, campaign, prev_days, prev_num_contact, prev_outcome, decision)
				VALUES ($age, '$job', '$marital', '$education', '$default_credit',
				'$housing_loan', '$personal_loan', '$contact', '$month', '$day', $duration, $campaign, $prev_days, $prev_num_contact, '$prev_outcome', '$decision')";

				if(mysqli_query($conn, $query)) {
					echo "new record created successfully";
				} else {
					echo "Error in inserting" .$sql . "<br>" .mysqli_error($conn);
				}

				mysqli_close($conn);

				$_POST = array();
			}
		}

		function test_input($data) {
			$data = trim($data);
			$data = stripslashes($data);
			$data = htmlspecialchars($data);
			return $data;
		}

		function decision_tree($duration, $month, $prev_num_contact, $job) {
			if($duration<474.5){
				return false;
			}
			else if($duration<680) {
				return false;
			}
			else if(strcmp($month,"mar")==0||strcmp($month,"may")==0||strcmp($month,"apr")==0||
			strcmp($month,"dec")==0||strcmp($month,"oct")==0||strcmp($month,"sep")==0){
				return false;
			}
			else if($prev_num_contact>=3){
				return false;
			}
			else if($duration<828){
				return false;
			}
			else if(strcmp ($job,"entrepreneur")==0||strcmp ($job,"housemaid")==0||strcmp ($job,"retired")==0||
			strcmp ($job,"student")==0||strcmp ($job,"technician")==0||strcmp ($job,"unemployed")==0){
				return false;
			}
			else{
				return true;
			}

		}
		?>

		<div id="header">
			<h1> CUSTOMER INFORMATION </h1>
		</div>

		<div id="section">
			<center>
				<p><span class="error">* required field.</span></p>
			</center>
			<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">

				<fieldset class="personal_info">
					<legend>Personal Information</legend>
					<label>
						age   <span class="error">* </span> &nbsp &nbsp
						<input type="number" name="age" value=" <?php echo $age; ?> ">
						<span class="error"><?php echo $err1 ?></span><br><br>
					</label>

					<label>
						job   <span class="error">* </span> &nbsp &nbsp
						<select name="job">
							<option disabled selected> -- select current occupation -- </option>
							<option value="admin" <?php if (isset($_POST['job']) && $_POST['job'] == 'admin')  echo 'selected="selected"'; ?> >Admin</option>
							<option value="blue collar" <?php if (isset($_POST['job']) && $_POST['job'] == 'blue collar')  echo 'selected="selected"'; ?> >Blue Collar</option>
							<option value="entrepreneur" <?php if (isset($_POST['job']) && $_POST['job'] == 'entrepeneur')  echo 'selected="selected"'; ?> >Entrepeneur</option>
							<option value="housemaid" <?php if (isset($_POST['job']) && $_POST['job'] == 'housemaid')  echo 'selected="selected"'; ?> >Housemaid</option>
							<option value="management" <?php if (isset($_POST['job']) && $_POST['job'] == 'management')  echo 'selected="selected"'; ?> >Management</option>
							<option value="retired" <?php if (isset($_POST['job']) && $_POST['job'] == 'retired')  echo 'selected="selected"'; ?> >Retired</option>
							<option value="self employed" <?php if (isset($_POST['job']) && $_POST['job'] == 'self employed')  echo 'selected="selected"'; ?> >Self Employed</option>
							<option value="services" <?php if (isset($_POST['job']) && $_POST['job'] == 'services')  echo 'selected="selected"'; ?> >Services</option>
							<option value="student" <?php if (isset($_POST['job']) && $_POST['job'] == 'student')  echo 'selected="selected"'; ?> >Student</option>
							<option value="technician" <?php if (isset($_POST['job']) && $_POST['job'] == 'technician')  echo 'selected="selected"'; ?> >Technician</option>
							<option value="unemployed" <?php if (isset($_POST['job']) && $_POST['job'] == 'unemployed')  echo 'selected="selected"'; ?> >Unemployed</option>
						</select>
						<span class="error">&nbsp<?php echo $err2 ?></span> <br><br>
					</label>

					<label>
						marital status    <span class="error">* </span> &nbsp &nbsp
						<select name="marital">
							<option disabled selected> -- select status -- </option>
							<option value="single" <?php if (isset($_POST['marital']) && $_POST['marital'] == 'single')  echo 'selected="selected"'; ?> >Single</option>
							<option value="married" <?php if (isset($_POST['marital']) && $_POST['marital'] == 'married')  echo 'selected="selected"'; ?> >Married</option>
							<option value="divorced" <?php if (isset($_POST['marital']) && $_POST['marital'] == 'divorced')  echo 'selected="selected"'; ?> >Divorced</option>
						</select>
						<span class="error">&nbsp<?php echo $err3 ?></span><br><br>
					</label>

					<label>
						education    <span class="error">* </span> &nbsp &nbsp
						<select name="education">
							<option disabled selected> -- select highest education-- </option>
							<option value="illiterate" <?php if (isset($_POST['education']) && $_POST['education'] == 'illiterate')  echo 'selected="selected"'; ?> >Illiterate</option>
							<option value="high school" <?php if (isset($_POST['education']) && $_POST['education'] == 'high school')  echo 'selected="selected"'; ?> >High School</option>
							<option value="university degree" <?php if (isset($_POST['education']) && $_POST['education'] == 'university degree')  echo 'selected="selected"'; ?> >University Degree</option>
							<option value="Professional degree" <?php if (isset($_POST['education']) && $_POST['education'] == 'Professional degree')  echo 'selected="selected"'; ?> >Professional degree</option>
						</select>
						<span class="error">&nbsp<?php echo $err4 ?></span><br><br>
					</label>

					<label>
						Contact Method  <span class="error">* </span> &nbsp &nbsp
						<input type="radio" name="contact" value="telephone" <?php if (isset($_POST['contact']) && $_POST['contact'] == 'telephone') echo ' checked="checked"';?> />Telephone
						<input type="radio" name="contact" value="cellular" <?php if (isset($_POST['contact']) && $_POST['contact'] == 'cellular') echo ' checked="checked"';?> />Cellular
						<span class="error">&nbsp<?php echo $err8 ?></span>
						<br><br>
					</label>
				</fieldset>

				<fieldset class="bank_info">
					<legend>Bank Information</legend>
					<label>
						has credit in default ?
						<input type="radio" name="default_credit" value="yes" <?php if (isset($_POST['default_credit']) && $_POST['default_credit'] == 'yes') echo ' checked="checked"';?> />Yes
						<input type="radio" name="default_credit" value="no" <?php if (isset($_POST['default_credit']) && $_POST['default_credit'] == 'no') echo ' checked="checked"';?> />No
						<span class="error">* &nbsp<?php echo $err5 ?></span><br><br>
					</label>

					<label>
						has house loan ?
						<input type="radio" name="housing_loan" value="yes" <?php if (isset($_POST['housing_loan']) && $_POST['housing_loan'] == 'yes') echo ' checked="checked"';?> />Yes
						<input type="radio" name="housing_loan" value="no" <?php if (isset($_POST['housing_loan']) && $_POST['housing_loan'] == 'no') echo ' checked="checked"';?> />No
						<span class="error">* &nbsp<?php echo $err6 ?></span><br><br>
					</label>

					<label>
						has other loan ?
						<input type="radio" name="personal_loan" value="yes" <?php if (isset($_POST['personal_loan']) && $_POST['personal_loan'] == 'yes') echo ' checked="checked"';?> />Yes
						<input type="radio" name="personal_loan" value="no" <?php if (isset($_POST['personal_loan']) && $_POST['personal_loan'] == 'no') echo ' checked="checked"';?> />No
						<span class="error">* &nbsp<?php echo $err7 ?></span><br><br>
					</label>

				</fieldset>

				<fieldset class="campaign_info">
					<legend>Campaign Information</legend>
					<label>
						Month         <span class="error">* </span> &nbsp &nbsp
						<select name="month">
							<option disabled selected> -- select a month -- </option>
							<option value = "jan" <?php if (isset($_POST['month']) && $_POST['month'] == 'jan')  echo 'selected="selected"'; ?> >January</option>
							<option value = "feb" <?php if (isset($_POST['month']) && $_POST['month'] == 'feb')  echo 'selected="selected"'; ?> >February</option>
							<option value = "mar" <?php if (isset($_POST['month']) && $_POST['month'] == 'mar')  echo 'selected="selected"'; ?> >March</option>
							<option value = "apr" <?php if (isset($_POST['month']) && $_POST['month'] == 'apr')  echo 'selected="selected"'; ?> >April</option>
							<option value = "may" <?php if (isset($_POST['month']) && $_POST['month'] == 'may')  echo 'selected="selected"'; ?> >May</option>
							<option value = "jun" <?php if (isset($_POST['month']) && $_POST['month'] == 'jun')  echo 'selected="selected"'; ?> >June</option>
							<option value = "jul" <?php if (isset($_POST['month']) && $_POST['month'] == 'jul')  echo 'selected="selected"'; ?> >July</option>
							<option value = "aug" <?php if (isset($_POST['month']) && $_POST['month'] == 'aug')  echo 'selected="selected"'; ?> >August</option>
							<option value = "sep" <?php if (isset($_POST['month']) && $_POST['month'] == 'sep')  echo 'selected="selected"'; ?> >September</option>
							<option value = "oct" <?php if (isset($_POST['month']) && $_POST['month'] == 'oct')  echo 'selected="selected"'; ?> >October</option>
							<option value = "nov" <?php if (isset($_POST['month']) && $_POST['month'] == 'nov')  echo 'selected="selected"'; ?> >November</option>
							<option value = "dec" <?php if (isset($_POST['month']) && $_POST['month'] == 'dec')  echo 'selected="selected"'; ?> >December</option>
						</select>
						<span class="error">&nbsp<?php echo $err10 ?></span><br><br>

						Day             <span class="error">* </span> &nbsp  &nbsp
						<select name="day">
							<option disabled selected> -- select a day -- </option>
							<option value = "mon" <?php if (isset($_POST['day']) && $_POST['day'] == 'mon')  echo 'selected="selected"'; ?> >Monday</option>
							<option value = "tue" <?php if (isset($_POST['day']) && $_POST['day'] == 'tue')  echo 'selected="selected"'; ?> >Tuesday</option>
							<option value = "wed" <?php if (isset($_POST['day']) && $_POST['day'] == 'wed')  echo 'selected="selected"'; ?> >Wednesday</option>
							<option value = "thu" <?php if (isset($_POST['day']) && $_POST['day'] == 'thu')  echo 'selected="selected"'; ?> >Thursday</option>
							<option value = "fri" <?php if (isset($_POST['day']) && $_POST['day'] == 'fri')  echo 'selected="selected"'; ?> >Friday</option>
							<option value = "sat" <?php if (isset($_POST['day']) && $_POST['day'] == 'sat')  echo 'selected="selected"'; ?> >Saturday</option>
							<option value = "sun" <?php if (isset($_POST['day']) && $_POST['day'] == 'sun')  echo 'selected="selected"'; ?> >Sunday</option>
						</select>
						<span class="error">&nbsp<?php echo $err9 ?></span><br><br>

						Last contact Duration  <span class="error">* </span> &nbsp &nbsp
						<input type="number" name="duration" placeholder="in seconds" value=" <?php echo $duration; ?> " >
						<span class="error">&nbsp<?php echo $err11 ?></span><br><br>

						Number of contacts done in campaign <span class="error">* </span> &nbsp &nbsp
						<input type="number" name="campaign" value=" <?php echo $campaign; ?> " >
						<span class="error">&nbsp<?php echo $err12 ?></span><br><br>

						Number of days passed after last contacted <span class="error">* </span> &nbsp &nbsp
						<input type="number" name="prev_days" placeholder="999 if not contacted" value=" <?php echo $prev_days; ?> " >
						<span class="error">&nbsp<?php echo $err13 ?></span><br><br>

						Number of contacts done before this campaign <span class="error">* </span> &nbsp &nbsp
						<input type="number" name="prev_num_contact" value=" <?php echo $prev_num_contact; ?> " >
						<span class="error">&nbsp<?php echo $err14 ?></span><br><br>

						Previous Marketing Outcome <span class="error">* </span> &nbsp &nbsp
						<select name="prev_outcome">
							<option disabled selected> -- select outcome -- </option>
							<option value = "failure" <?php if (isset($_POST['prev_outcome']) && $_POST['prev_outcome'] == 'failure')  echo 'selected="selected"'; ?> >Failure</option>
							<option value = "success" <?php if (isset($_POST['prev_outcome']) && $_POST['prev_outcome'] == 'success')  echo 'selected="selected"'; ?> >Success</option>
							<option value = "nonexistent" <?php if (isset($_POST['prev_outcome']) && $_POST['prev_outcome'] == 'nonexistent')  echo 'selected="selected"'; ?>>Non existent</option>
						</select>
						<span class="error">&nbsp<?php echo $err15 ?></span><br><br>
					</label>
				</fieldset>

				<center>
					<input type="submit" name="submit" >
				</center>
			</form>

		</div>

		<div id="footer">
			Copyright &copy RIT
		</div>

	</body>
</html>