<?php
	session_start();
	include('../connectDB.php');
	if($_POST) {
		$slide_id = $_POST['slide_id'];
		$slide_topic = $_POST["slide-topic"];
		$slide_name_button = $_POST["slide-name-button"];
		$slide_decription = $_POST["slide-decription"];
	    $picture_tmp = $_FILES['img']['tmp_name'];
	    $picture_name = $_FILES['img']['name'];
	    $picture_type = $_FILES['img']['type'];

    $allowed_type = array('image/png', 'image/gif', 'image/jpg', 'image/jpeg');

    if(in_array($picture_type, $allowed_type)) {
        $path = '../../image/'.$picture_name;
        $images= 'image/'.$picture_name;//change this to your liking
    } else {
        $error[] = 'File type not allowed';
    }

    if(!empty($error)) {
        echo '<font color="red">'.output_errors($error).'</font>';

    } else if(empty($error)) {
        $req = "UPDATE `slide_img` SET slide_topic='$slide_topic',slide_decription='$slide_decription', slide_name_button='$slide_name_button', slide_img='$images' WHERE slide_id='$slide_id'";
        move_uploaded_file($picture_tmp, $path);

        if (mysqli_query($conDB,$req)) {
            echo 'ok';
            header("location:../../slide-the-cover.php");
        } else {
        	echo $req;
            echo 'เออรู้แล้วว่าเขียนคำสั่ง sql ผิด';
        }
        
    }
}
?>