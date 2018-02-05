
<?php

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
    <head>
        <title>aspare</title>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
        <link rel="stylesheet" type="text/css" href="css/default.css"/>
		<script type="text/javascript" src="js/script.js"></script> 
    </head>




    <body>    
        <form action="enrol.php" class="register" method="POST">
            <h1>subject allocation</h1>
			<fieldset class="row1">
               
				<p>
                    <label>Teacher Name * 
                    </label>
                    <select class="form-dropdown validate[required]" style="width:150px" id="input_43" name="user">
                 <option value=""> -----------ALL----------- </option> 
               <?php
                   include 'connection.php';
                   $user=" ";
              
                   $sql="SELECT * FROM users WHERE role= 'teacher' "; //selection query
                   $rs = mysqli_query($conn, $sql);//odbc_exec($conn,$sql);
                   if (mysqli_num_rows($rs) > 0) {
    // output data of each row
                   while($row = mysqli_fetch_assoc($rs)) {
                   $user .=  "<option value=".$row['id'].">" . $row['username']. "</option>";
                   
    }
}
  echo $user;
                  
?> 
</select>

               </P>   
               <P>  				
					<label>department * 
                    </label><select class="form-dropdown validate[required]" style="width:150px" id="input_43"  required="required" name="dep">
                 <option value=""> -----------ALL----------- </option> 
               <?php
                   include 'connection.php';
                  // $dep=" "; 
                   $sql="SELECT * FROM course "; //selection query
                   $rs = mysqli_query($conn, $sql);//odbc_exec($conn,$sql);
                   if (mysqli_num_rows($rs) > 0) {
    // output data of each row
                   while($row = mysqli_fetch_assoc($rs)) {
                   $dep .= "<option value=".$row['cid'].">" . $row['course']. "</option>";
    }
}
  echo $dep;
                  
?> 
</select>
                    
                    
					
               
               
				<div class="clear"></div>
            </fieldset>
            <fieldset class="row2">
				<legend>subject allocation</legend>
				<p> 
					<input type="button" value="Add Subject" onClick="addRow('dataTable')" /> 
					<input type="button" value="Remove subject" onClick="deleteRow('dataTable')"  /> 
					
               <table id="dataTable" class="form" border="1">
                  <tbody>
                    <tr>
                      <p>
						<td><input type="checkbox" required="required" name="chk[]" checked="checked" /></td>
						<td>
							<label>subject</label>
							 </label><select class="form-dropdown validate[required]" style="width:150px" id="input_43" name="sub[]">
                 <option value=""> -----------ALL----------- </option> 
               <?php
                   include 'connection.php';
                   $sub[]=" "; 
                   $sql="SELECT * FROM subject "; //selection query
                   $rs = mysqli_query($conn, $sql);//odbc_exec($conn,$sql);
                   if (mysqli_num_rows($rs) > 0) {
    // output data of each row
                   while($row = mysqli_fetch_assoc($rs)) {
                   $sub[] .= "<option value=".$row['subid'].">" . $row['subject']. "</option>";
             }
             }
             $arrlength = count($sub);
             for($x = 0; $x < $arrlength; $x++) {
             echo $sub[$x];
             echo "<br>";
             }
            // echo $sub;
                  
              ?> 
              </select>
							
						 </td>
						 <td>
							<label for="BX_MARK">batch</label>
							</label><select class="form-dropdown validate[required]" style="width:150px" id="input_43" name="batch[]">
                 <option value=""> -----------ALL----------- </option> 
               <?php
                   include 'connection.php';
                   $batch[]=" "; 
                   $sql="SELECT * FROM batch "; //selection query
                   $rs = mysqli_query($conn, $sql);//odbc_exec($conn,$sql);
                   if (mysqli_num_rows($rs) > 0) {
    // output data of each row
                   while($row = mysqli_fetch_assoc($rs)) {
                   $batch[] .= "<option value=".$row['bid'].">" . $row['batch']. "</option>";
             }
             }
             $arrlength = count($batch);
             for($x = 0; $x < $arrlength; $x++) {
             echo $batch[$x];
             echo "<br>";
             }
            // echo $sub;
                  
              ?> 
              </select>
							
					     </td>
						 
						 
						</p>
                    </tr>
                    </tbody>
                </table>
				<div class="clear"></div>
            </fieldset>
           
            
				<div class="clear"></div>
            </fieldset>
			<input class="submit" type="submit" value="Confirm &raquo;" />
			<a class="submit" href="indexm.php"/>cancel</a>
			<div class="clear"></div>
        </form>
		
    </body>
</html>