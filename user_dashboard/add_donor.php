<?php
	include('../connection.php');
	session_start();

	$name = $_POST['name'] ;

	$blood_group = $_POST['blood_group'];
	$gender = $_POST['gender'];
	$datepicker = $_POST['datepicker'];
	$weight = $_POST['weight'];
	$email = $_POST['email'];
	$state = $_POST['state'];
	$city = $_POST['city'];
	$pincode = $_POST['pincode'];
	$phone = $_POST['phone'];
	$address = $_POST['address'];


	$fileInfo = PATHINFO($_FILES["photo"]["name"]);
	
	if (empty($_FILES["photo"]["name"])){
		$location="./Errorss.php";
	}
	else{
		if ($fileInfo['extension'] == "jpg" OR $fileInfo['extension'] == "png") {
			$newFilename = $fileInfo['filename'] . "_" . time() . "." . $fileInfo['extension'];
			move_uploaded_file($_FILES["photo"]["tmp_name"], "../upload/" . $newFilename);
			$location = "upload/" . $newFilename;
		}
		else{
			$location="";
			?>
				<script>
					window.alert('Photo not added. Please upload JPG or PNG photo only!');
				</script>
			<?php
		}
	}

// echo "<pre>";
// 	print_r($_POST);
// 	exit();

	$insert = $connection->query("INSERT INTO donor(name, blood_group, gender, dob, body_weight, email, state, city, address, pincode, phone, image, username_fk, status) VALUES ('$name', '$blood_group', '$gender', '$datepicker', '$weight', '$email', '$state', '$city', '$pincode', '$phone', '$address', '$location', '".$_SESSION['membername']."', '0')");
	// $r = "INSERT INTO donor(name, father_name, gender, dob, body_weight, email, state, city, address, pincode, phone, image, username_fk) VALUES ('$name', '$fathername', '$gender', '$datepicker', '$weight', '$email', '$state', '$city', '$pincode', '$phone', '$address', '$location',)";
	// echo $r;
	// exit();
	
	if($insert){
		header('location:donor.php');
	}else {
		header('location:donor.php');
	}
?>