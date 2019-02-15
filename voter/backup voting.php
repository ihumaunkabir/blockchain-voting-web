<?php

ob_start();


session_start();
$nid = $_SESSION['nid'];

if($_SESSION['nid'] != $nid)
{
  header('location: /hk_project/index.php');
}

    if(isset($_POST['att'])){

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

      curl_setopt($ch, CURLOPT_URL,'http://10.10.1.98:3000/voters/nominations');  //nominated user list

      curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
      curl_setopt($ch, CURLOPT_HEADER, 0);
    
      curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

      // Timeout in seconds
      curl_setopt($ch, CURLOPT_TIMEOUT, 60);

      $authToken = curl_exec($ch);

    $jsondata = json_decode($authToken,true);
    $i = 0;
    foreach ($jsondata['data'] as $data) {

      $nomineePM = $data['PM'][i];
      $nomineeAM = $data['AM'][i];
      $nomineeGS = $data['GS'][i];
      $i++;

      //nominee list showed

      $dh = curl_init();
      $headers = array(
    'Content-Type: application/x-www-form-urlencoded'
      );

      curl_setopt($dh, CURLOPT_URL,'http://10.10.1.98:3000/voters/query?nid='.$nomineeAM);  //nominated user list AM
      curl_setopt($dh, CURLOPT_HTTPHEADER, $headers);
      curl_setopt($dh, CURLOPT_HEADER, 0);
    
      curl_setopt($dh, CURLOPT_RETURNTRANSFER, true);

      // Timeout in seconds
      curl_setopt($dh, CURLOPT_TIMEOUT, 60);

      $am = curl_exec($dh);

    $jsondataAM = json_decode($am,true);  //json of AM

      $eh = curl_init();
      $headers = array(
    'Content-Type: application/x-www-form-urlencoded'
      );

      curl_setopt($eh, CURLOPT_URL,'http://10.10.1.98:3000/voters/query?nid='.$nomineePM);  //nominated user list AM
      curl_setopt($eh, CURLOPT_HTTPHEADER, $headers);
      curl_setopt($eh, CURLOPT_HEADER, 0);
    
      curl_setopt($eh, CURLOPT_RETURNTRANSFER, true);

      // Timeout in seconds
      curl_setopt($eh, CURLOPT_TIMEOUT, 60);

      $pm = curl_exec($eh);

    $jsondataPM = json_decode($pm,true); //json of PM

    $fh = curl_init();
      $headers = array(
    'Content-Type: application/x-www-form-urlencoded'
      );

      curl_setopt($fh, CURLOPT_URL,'http://10.10.1.98:3000/voters/query?nid='.$nomineeGS);  //nominated user list AM
      curl_setopt($fh, CURLOPT_HTTPHEADER, $headers);
      curl_setopt($fh, CURLOPT_HEADER, 0);
    
      curl_setopt($fh, CURLOPT_RETURNTRANSFER, true);

      // Timeout in seconds
      curl_setopt($fh, CURLOPT_TIMEOUT, 60);

      $gs = curl_exec($fh); //general secretary
      $jsondataGS = json_decode($gs,true); //json of GS

//AM PM insertion over loop $jsondataPM, $jsondataAM print them to the dropdown menu

   // reading all voters in the list under the designation
 
    $radio =0;
    ?>
    <!-- President -->
       <tr>
           <td>  <label>President</label>
            <select name="whichp" id="input1">

    <?php 
    foreach ($jsondataAM as $data) {

       $i++;
       ?>
              
    <option  value=<?php echo $data['id']; ?> > <?php echo $data['name']; ?></option>

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
    foreach ($jsondataAM as $data) {

       $i++;
       ?>
              
    <option  value=<?php echo $data['id']; ?> > <?php echo $data['name']; ?></option>

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
    foreach ($jsondataGS as $data) {

       $i++;
       ?>
              
    <option  value=<?php echo $data['id']; ?> > <?php echo $data['name']; ?></option>

     <?php
        $radio++; //on for new one
      } 
}
      ?>
         </select>

    </td>
    </tr>
<!-- GS ends -->



     </div>
               
     <input type="submit" class="btn btn-primary col-md-2 col-md-offset-5" value="Nominate" name="nominate" />

    </form>
</div>

</div>


</center>

</body>
</html>