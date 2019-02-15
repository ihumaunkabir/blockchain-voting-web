<?php

ob_start();

/*
session_start();
$nid = $_SESSION['nid'];

if($_SESSION['nid'] != $nid)
{
  header('location: /hk_project/index.php');
}

    if(isset($_POST['att'])){

    }
*/
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

    <h3><?php echo date('Y-m-d'); ?> <br> Voting Page</h3>
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

      curl_setopt($ch, CURLOPT_URL,'http://10.10.1.98:3000/voters/nominations?type=0');

      curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
      curl_setopt($ch, CURLOPT_HEADER, 0);
    
      curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

      // Timeout in seconds
      curl_setopt($ch, CURLOPT_TIMEOUT, 60);

      $authToken = curl_exec($ch);

     $jsondata = json_decode($authToken,true);
     curl_close ($ch);


   // reading all voters in the list under the designation
        ?>


    <!-- President Starts-->
       <tr>
           <td>  <label>President</label>
            <select name="whichp" id="input1">

    <?php 


    foreach ($jsondata['data']['PM'] as $data) {


//matching with data and query
      $ph = curl_init();
      $headers = array(
        'Content-Type: application/x-www-form-urlencoded'
      );

      curl_setopt($ph, CURLOPT_URL,'http://10.10.1.98:3000/voters/query?nid='.$data);

      curl_setopt($ph, CURLOPT_HTTPHEADER, $headers);
      curl_setopt($ph, CURLOPT_HEADER, 0);
    
      curl_setopt($ph, CURLOPT_RETURNTRANSFER, true);

      // Timeout in seconds
      curl_setopt($ph, CURLOPT_TIMEOUT, 60);

      $pm = curl_exec($ph);

     $jsondataPM = json_decode($pm,true);
     curl_close ($ph);


       ?>
              
    <option  value=<?php echo $jsondataPM['id']; ?> > <?php echo $jsondataPM['username']; ?> </option>

     <?php


      } 
           
      ?>
         </select>

    </td>
    </tr>
<!-- President ends -->



    <!-- Vice President Starts-->
       <tr>
           <td>  <label>Vice President</label>
            <select name="whichvp" id="input1">

    <?php 


    foreach ($jsondata['data']['AM'] as $dataAM) {


//matching with data and query
      $ah = curl_init();
      $headers = array(
        'Content-Type: application/x-www-form-urlencoded'
      );

      curl_setopt($ah, CURLOPT_URL,'http://10.10.1.98:3000/voters/query?nid='.$dataAM);

      curl_setopt($ah, CURLOPT_HTTPHEADER, $headers);
      curl_setopt($ah, CURLOPT_HEADER, 0);
    
      curl_setopt($ah, CURLOPT_RETURNTRANSFER, true);

      // Timeout in seconds
      curl_setopt($ah, CURLOPT_TIMEOUT, 60);

      $am = curl_exec($ah);

     $jsondataAM = json_decode($am,true);
     curl_close ($ah); 


       ?>
              
    <option  value=<?php echo $jsondataAM['id']; ?> > <?php echo $jsondataAM['username']; ?> </option>

     <?php

      }

      

      ?>
         </select>

    </td>
    </tr>
<!-- Vice President ends -->





    <!-- GS Starts-->
       <tr>
           <td>  <label>Vice President</label>
            <select name="whichvp" id="input1">

    <?php 


    foreach ($jsondata['data']['GS'] as $dataGS) {


//matching with data and query
      $gh = curl_init();
      $headers = array(
        'Content-Type: application/x-www-form-urlencoded'
      );

      curl_setopt($gh, CURLOPT_URL,'http://10.10.1.98:3000/voters/query?nid='.$dataGS);

      curl_setopt($gh, CURLOPT_HTTPHEADER, $headers);
      curl_setopt($gh, CURLOPT_HEADER, 0);
    
      curl_setopt($gh, CURLOPT_RETURNTRANSFER, true);

      // Timeout in seconds
      curl_setopt($gh, CURLOPT_TIMEOUT, 60);

      $gs = curl_exec($gh);

     $jsondataGS = json_decode($gs,true);
     curl_close ($gh);

       ?>
              
    <option  value=<?php echo $jsondataGS['id']; ?> > <?php echo $jsondataGS['username']; ?> </option>

     <?php

      } 

      ?>
         </select>

    </td>
    </tr>
<!-- GS ends -->



</div>

          
     <input type="submit" class="btn btn-primary col-md-2 col-md-offset-5" value="Vote Now" name="vote" />

    </form>
</div>

</div>


</center>

</body>
</html>