
<?php
//include 'header.php';

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
        <form action="qs.php" class="register" method="POST">
            <h1>TEST INFORMATIONS</h1>
			<fieldset class="row1">
               
				<p>
                    <label>TEST Name * 
                    </label>
                    <input name="test" type="text" required="required"/>
               </P>   
               <P>  				
					<label>No Of Students * 
                    </label>
                    <input name="num" required="required" type="text"/>
                    
					
                </p>
                <P>  				
					<label>Maximum Marks * 
                    </label>
                    <input name="tot" required="required" type="text"/>
                    
					
                </p>
                
               
				<div class="clear"></div>
            </fieldset>
            <fieldset class="row2">
				<legend>Question Details</legend>
				<p> 
					<input type="button" value="Add Question" onClick="addRow('dataTable')" /> 
					<input type="button" value="Remove Question" onClick="deleteRow('dataTable')"  /> 
					
               <table id="dataTable" class="form" border="1">
                  <tbody>
                    <tr>
                      <p>
						<td><input type="checkbox" required="required" name="chk[]" checked="checked" /></td>
						<td>
							<label>qs no</label>
							<input type="text" required="required" name="BX_QNO[]">
						 </td>
						 <td>
							<label for="BX_MARK">max mark</label>
							<input type="text" required="required" class="small"  name="BX_MARK[]">
					     </td>
						 <td>
							<label for="BX_CO">co</label>
							<select id="BX_CO" name="BX_CO[]" required="required">
								<option>....</option>
								<option>A</option>
								<option>B</option>
                                <option>C</option>
                                <option>D</option>
                                <option>E</option>
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
			<a class="submit" href="index.php"/>cancel</a>
			<div class="clear"></div>
        </form>
		
    </body>
	<!-- Start of StatCounter Code for Default Guide 
<script type="text/javascript">
var sc_project=9046834; 
var sc_invisible=1; 
var sc_security="ec55ba17"; 
var scJsHost = (("https:" == document.location.protocol) ?
"https://secure." : "http://www.");
document.write("<sc"+"ript type='text/javascript' src='" +
scJsHost+
"statcounter.com/counter/counter.js'></"+"script>");
</script>
<noscript><div class="statcounter"><a title="free hit
counter" href="http://statcounter.com/" target="_blank"><img
class="statcounter"
src="http://c.statcounter.com/9046834/0/ec55ba17/1/"
alt="free hit counter"></a></div></noscript>
 End of StatCounter Code for Default Guide -->
</html>
