<?php

ob_start();


session_start();
$nid = $_SESSION['nid'];
//passing session data

if($_SESSION['nid'] != $nid)
{
  header('location: /hk_project/index.php');
}
	//all member list
		$ch = curl_init();
	    $headers = array(
	 	'Content-Type: application/x-www-form-urlencoded'
	    );

	    curl_setopt($ch, CURLOPT_URL,'http://10.10.1.98:3000/auth/voters/all');

	    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
	    curl_setopt($ch, CURLOPT_HEADER, 0);
	  
	    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

	    // Timeout in seconds
	    curl_setopt($ch, CURLOPT_TIMEOUT, 30);

	    $authToken = curl_exec($ch);

			$jsondata = json_decode($authToken,true);
			

			//nominations are stored via API
    if(isset($_POST['nominate'])){

    }


 ?>


<!DOCTYPE html>
<html lang="en">
<head>
<title>Voting 1.0</title>
<meta charset="UTF-8">

  <link rel="stylesheet" type="text/css" href="/am/css/main.css">
  <!-- Latest compiled and minified CSS -->
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" >
   
  <!-- Optional theme -->
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" >
   
  <link rel="stylesheet" href="styles.css" >
   
  <!-- Latest compiled and minified JavaScript -->
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>


</head>
<body>
<center>

<header>

  <h1>Voting 1.0</h1>

</header>



<div class="row">

  <div class="content">

    <h3><?php echo date('Y-m-d'); ?> <br> Nomination Page</h3>
    <br>

    <!-- <center><p><?php //if(isset($att_msg)) echo $att_msg; if(isset($error_msg)) echo $error_msg; ?></p></center> -->
    
    <form action="" method="post" class="form-horizontal col-md-6 col-md-offset-3">

     <div class="form-group">

     	<?php
     		//all member list
		$ch = curl_init();
	    $headers = array(
	 	'Content-Type: application/x-www-form-urlencoded'
	    );

	    curl_setopt($ch, CURLOPT_URL,'http://10.10.1.98:3000/voters/all');

	    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
	    curl_setopt($ch, CURLOPT_HEADER, 0);
	  
	    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

	    // Timeout in seconds
	    curl_setopt($ch, CURLOPT_TIMEOUT, 60);

	    $authToken = curl_exec($ch);

		$jsondata = json_decode($authToken,true);


   // reading all voters in the list under the designation
   	$i = 0;
   	$radio =0;
   	?>
   	<!-- President -->
   	   <tr>
           <td>  <label>President</label>
           	<select name="whichp" id="input1">

   	<?php 
    foreach ($jsondata['data'] as $data) {

       $i++;
     	 ?>
              
    <option  value=<?php echo $data['Record']['id']; ?> > <?php echo $data['Record']['name']; ?></option>

     <?php
        $radio++; //on for new one
      } 

      ?>
      	 </select>

		</td>
		</tr>
<!-- President ends -->

   	<!-- Vice President -->
   	   <tr>
           <td>  <label> Vice President</label>
           	<select name="whichvp" id="input1">

   	<?php 
    foreach ($jsondata['data'] as $data) {

       $i++;
     	 ?>
              
    <option  value=<?php echo $data['Record']['id']; ?> > <?php echo $data['Record']['name']; ?></option>

     <?php
        $radio++; //on for new one
      } 

      ?>
      	 </select>

		</td>
		</tr>
<!-- Vice President ends -->


   	<!-- GS -->
   	   <tr>
           <td>  <label>General Secretary</label>
           	<select name="whichgs" id="input1">

   	<?php 
    foreach ($jsondata['data'] as $data) {

       $i++;
     	 ?>
              
    <option  value=<?php echo $data['Record']['id']; ?> > <?php echo $data['Record']['name']; ?></option>

     <?php
        $radio++; //on for new one
      } 

      ?>
      	 </select>

		</td>
		</tr>
<!-- GS ends -->



     </div>
               
     <input type="submit" class="btn btn-primary col-md-2 col-md-offset-5" value="Nominate" name="nominate" />

    </form>


    <div class="chainAPI">
      
      <?php

          $ch = curl_init();

          curl_setopt($ch, CURLOPT_URL, 'http://103.84.159.230:6000/chaincodes?peer=peer0.org1.example.com&type=installed');
          curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
          curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'GET');


          $headers = array();
          $headers[] = 'Authorization: Bearer eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJleHAiOjE1NTAyNzU1NjMsInVzZXJuYW1lIjoic2h1aGFuIiwib3JnTmFtZSI6Ik9yZzEiLCJpYXQiOjE1NTAyMzk1NjN9.b_kD8_Y68tl47pswrKitmzRSKoymJ558u1bz0q3Uj18';
          $headers[] = 'Content-Type: application/json';
          curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

          $result = curl_exec($ch);
          if (curl_errno($ch)) {
              echo 'Error:' . curl_error($ch);
          }
          curl_close ($ch);

          $jsonChain = json_decode($result, true);

          foreach ($jsonChain as $key => $value) {
            # code...
            echo $value;
          }



       ?>


    </div>


</div>

</div>

</center>

</body>
</html>