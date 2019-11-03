<?php 
    session_start();
    require_once "config/db.php";
    require_once "config/settings.php";

    $sql = "SELECT 
                `id`,
                `currency_name`    
            FROM `".TABLE_CURRENCY."` 
    ";
    $currencies = [];
    if($result = mysqli_query($conn,$sql)){
        while($row = mysqli_fetch_assoc($result)){
            $currencies[] = $row;
        }
    }

    $sql = "SELECT
            `id`,
            `position_name`
        FROM `".TABLE_POSITIONS."`
    ";
    $positions = [];
    if($result = mysqli_query($conn,$sql)){
        while($row=mysqli_fetch_assoc($result)){
            $positions[] = $row;
        }
    }

    if(isset($_POST['submit'])) {

        $firstName = '';
        if(isset($_POST['first_name'])){
            $firstName = trim($_POST['first_name']);
        }

        $lastName = '';
        if(isset($_POST['last_name'])){
            $lastName = trim($_POST['last_name']);
        }

        $position = $_POST['position'];

        $currency = $_POST['currency'];


        $salary = '';
        if(isset($_POST['salary'])){
            $salary = trim($_POST['salary']);
        }

        $gender = '';
        if(isset($_POST['gender'])){
            $gender = trim($_POST['gender']);
        }

        /* FOR BIRTH DATE */
        $month = $_POST['month'];
        $day = $_POST['day'];
        $year = $_POST['year'];

        $date = $year . '-' . $month . '-' . $day;


        /* END FOR DOB(DATE OF BIRTH) */

        $image = '';
        if(isset($_POST['image'])) {
            $image = trim($_POST['image']);
        }

        $errors = [];

        /* VALIDATIONS */
        if(!mb_strlen($firstName)) {
            $errors['first_name'] = 'Please enter First Name';
        }elseif(mb_strlen($firstName) > 32) {
            $errors['firs_name'] = 'First Name cannot exceed 32 symbols';
        }elseif(preg_match('/[0-9]+/', $firstName)) {
            $errors['first_name'] = 'First Name cannot contain a number';
        }

        if(!mb_strlen($lastName)) {
            $errors['last_name'] = 'Please enter Last Name';
        }elseif(mb_strlen($lastName) > 32) {
            $errors['last_name'] = 'Last Name cannot excceed 32 symbols';
        }elseif(preg_match('/[0-9]+/', $lastName)) {
            $errors['last_name'] = 'Last Name cannot contain a number';
        }

        if($position < 1) {
            $errors['position'] = 'Please choose staff position';
        }

        if($currency < 1) {
            $errors['currency'] = 'Please choose a currency';
        }

        if(!mb_strlen($salary)) {
            $errors['salary'] = 'Please enter salary amount';
        }elseif(!is_numeric($salary)) {
            $errors['salary'] = 'Salary field should be a number';
        }

        if(!$gender) {
            $errors['gender'] = 'Please choose a gender';
        }

        /* Validation for DOB */
        if ($_POST['day']==0 or $_POST['month']==0 or $_POST['year']==0){
			$errors['dob'] = 'Please complete date of birth fields';
        }
        
        /* Validation for image */
        if(count($_FILES)) {
            $dir = 'uploads/staff_photos/';
            $fileName = basename($_FILES['image']['name']);
            $size = getimagesize($_FILES['image']['tmp_name']);
            $errorsImage = [];
            $filePath = $dir . $fileName;

            if(!$size) {
                $errorsImage['image'] = 'Please upload an image!';
            }
    
            for(;;) {
                if(!file_exists($dir . $fileName)){
                    break;
                }
                $fileName = mt_rand() . $fileName;
            }
    
            $type = strtolower(pathinfo($dir . $fileName, PATHINFO_EXTENSION));

            if($type !== 'jpeg' && $type !== 'jpg' && $type !== 'png') {
                $errorsImage['image'] = "Please choose an image with extension 'jpeg', 'jpg' or 'png' ! ";
            }
    
            if(!count($errorsImage)){
                if(move_uploaded_file($_FILES['image']['tmp_name'] , $dir . $fileName)) {
                    $image = $dir . $fileName;
                }
            }
            $errors = array_merge($errors, $errorsImage);
        }

        /* FOR SUCCESSFULL REGISTRARTION OF USER */
        if(!count($errors)) {
            $sql = " INSERT INTO `".TABLE_STAFF."` (
                    `currency_id`,
                    `position_id`,
                    `first_name`,
                    `last_name`,
                    `salary`,
                    `birth_date`,
                    `gender`,
                    `image`,
                    `created_at`,
                    `updated_at`
                ) VALUES (
                    '".mysqli_real_escape_string($conn, $currency)."',
                    '".mysqli_real_escape_string($conn, $position)."',
                    '".mysqli_real_escape_string($conn, $firstName)."',
                    '".mysqli_real_escape_string($conn, $lastName)."',
                    '".mysqli_real_escape_string($conn, $salary)."',
                    '".mysqli_real_escape_string($conn, $date)."',
                    '".mysqli_real_escape_string($conn, $gender)."',
                    '".mysqli_real_escape_string($conn, $image)."',
                    NOW(),
                    NOW()
                )
            ";
            if(mysqli_query($conn, $sql)) {
                $success = "Successfully added staff member";
            }

        }

        function showArray($data){
            echo "<pre>";
            print_r($data);
            echo "</pre>";
        }
        /* showArray($errors); */
    }

?>


<html>
	<head>
		<title>Staff</title>
		<link rel="stylesheet" type="text/css" href="assets/css/app.css">
	</head>
	<body>
        <div id="staff">
            <div class="progress">
                <div class="loader">Loading...</div>
            </div>
            <!-- <div class="staff-card">

            </div> -->
        </div>
        
        <div class="form-holder">
                <form action="" method="POST" enctype="multipart/form-data">
                    <label for="fname">First Name:</label>
                    <input  id="fname" type="text" name="first_name">
                    <label for="lname">Last Name:</label>
                    <input  id="lname" type="text" name="last_name">
                    <label for="position">Position:</label>
                    <select name="position" id="position">
                        <option value="0">Position:</option>
                        <?php foreach($positions as $position) : ?>
                        <option value="<?=$position['id']?>"><?=$position['position_name']?></option>
                        <?php endforeach ?>
                    </select>
                    <label for="currency">Currency:</label>
                    <select name="currency" id="currency">
                        <option value="0">Currency</option>
                        <?php foreach($currencies as $currency) : ?>
                            <option value="<?=$currency['id']?>"><?=$currency['currency_name']?></option>
                        <?php endforeach ?>
                    </select>
                    <label for="salary">Salary:</label>
                    <input  id="salary" type="text" name="salary">
                    <label for="gender">Gender:</label>
                    <input  id="gender" type="radio" name="gender" value="Male">Male
                    <input  id="gender" type="radio" name="gender" value="Female">Female
                    <input  id="gender" type="radio" name="gender" value="Other">Other
                    <label class="b_date">Date of birth:</label>
                    <select name="month" id="month">
                        <option value="0">Month</option>
                        <?php
                        for( $m = 1; $m <= 12; $m++ ) {
                            $num = str_pad( $m, 2, 0, STR_PAD_LEFT );
                            $month =  date("F", mktime(0, 0, 0, $m, 1));
                            ?>
                                <option value="<?php echo $num; ?>"><?php echo $month; ?></option>
                            <?php
                        }
                        ?>
                    </select>
                    <select name="day" id="day">
                    <option value="0">Day</option>
                        <?php
                            for( $a = 1; $a <= 31; $a++ ) {
                                ?>
                                    <option value="<?php echo $a; ?>"><?php echo $a; ?></option>
                                <?php
                            }
                        ?>
                    </select>
                    <select name="year" id="year">
                        <option value="0">Year</option>
                    <?php
                        for( $y = 2019; $y >= 1905; $y-- ) {
                            ?>
                                <option value="<?php echo $y; ?>"><?php echo $y; ?></option>
                            <?php
                        }
                        ?>
                    </select>                       
                    <label class="photo">Photo:</label>
                    <input type="file" name="image">
                    <input class="sbm_btn" type="submit" name="submit" value="Add Staff">
                </form>
            </div>


        

		<script type="text/javascript" src="assets/js/jquery-3.4.1.js"></script>
		<script type="text/javascript" src="assets/js/ajax.js"></script>
	</body>
</html>