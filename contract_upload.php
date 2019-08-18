<?php
require('config.php');
if(isset($_POST['file_submit'])) {

  // Get the file
  $id = $_GET['id'];
  $file = $_FILES["file"]["tmp_name"];
  // Get contents of the file
  $file_contents = file_get_contents($file);
  // Get the file extension
  $ext = pathinfo($_FILES['file']['name'], PATHINFO_EXTENSION);
  if($ext === 'csv') {
    if ($_FILES["file"]["size"] > 0) {
      $handle = fopen($file,"r");
      $flag = true;
        //loop through the csv file and insert into database
      while (($data = fgetcsv($handle,10000,",")) !== FALSE) {
         if($flag) { $flag = false; continue; }

          $query = "INSERT INTO contract (vendor, ship_within, carriers, address, city, state, postal)
                    VALUES ('$data[0]', '$data[1]', '$data[2]', '$data[3]', '$data[4]', '$data[5]', '$data[6]')";

          $res = mysqli_query($connection, $query);
        }
    fclose($handle);
    echo '<script>';
    echo 'window.location.href="shipment.php"';  //not showing an alert box.
    echo '</script>';
     }
  }


}


 ?>
 <form action="contract_upload.php" class="form-horizontal" method="post" name="upload_excel" enctype="multipart/form-data">
     <fieldset>

         <div class="form-group">
             <label class="col-md-4 control-label" for="filebutton">Select File</label>
             <div class="col-md-4">
                 <input type="file" name="file" id="contract-file" class="input-large" accept=".csv">
             </div>
         </div>

         <div class="form-group">
             <div class="col-md-4 col-md-offset-5">
                 <button type="submit" id="file-submit" name="file_submit" data-loading-text="Loading...">Submit</button>
             </div>
         </div>

     </fieldset>
 </form>
