<?php
session_start();
$session_id='1'; //$session id

$username=$_SESSION['username'];
$conn=new MongoClient();
$db=$conn->$username;
	$valid_formats = array("jpg", "png", "gif", "bmp");
	if(isset($_POST) and $_SERVER['REQUEST_METHOD'] == "POST")
		{
			$name = $_FILES['photoimg']['name'];
			$size = $_FILES['photoimg']['size'];
			
			if(strlen($name))
				{
					list($txt, $ext) = explode(".", $name);
					if(in_array($ext,$valid_formats))
					{
					
							$actual_image_name =$username.".".$ext;
							$tmp = $_FILES['photoimg']['tmp_name'];
							$path='uploads/'.$actual_image_name;
							if(move_uploaded_file($tmp, $path))
								{
									$pic=$db->profilepic->findOne();
									$db->profilepic->update(array('pic'=>$pic['pic']),array('pic'=>$actual_image_name));	
									echo "<img src='imageupload/uploads/".$actual_image_name."'  class='dp' style='position:relative; top:0px; left:0px'>";
									
									}
							else
								echo "failed";
											
						}
						else
						echo "Invalid file format..";	
				}
				
			else
				echo "Please select image..!";
				
			exit;
		}
?>
