<?php
if($_POST['button'] && isset($_FILES['attachment'])) 
{ 
  
    $from_email         = 'sukil1990@gmail.com'; //from mail, sender email addrress 
    $recipient_email    = 'ganancia360online@gmail.com'; //recipient email addrress 
      
    //Load POST data from HTML form 
    $sender_name    = $_POST["sender_name"] //sender name 
    $reply_to_email = $_POST["sender_email"] //sender email, it will be used in "reply-to" header 
    $subject        = $_POST["subject"] //subject for the email 
    $message        = ="<html>
<head>
<meta http-equiv="content-type" content="text/html; charset=utf-8" />
<title>company name</title>
</head>

<body>
<table width=\\"560\\" border=\\"0\\" align=\\"center\\" cellspacing=\\"0\\" cellpadding=\\"2\\" bgcolor=\\"#CEACFF\\">
    <tr>
            <td colspan=\\"4\\" height=\\"10\\" align=\\"center\\" bgcolor=\\"#ffffff\\">    <font size=\\"2\\" style=\\"COLOR: #d8325d; MARGIN-LEFT:10px\\"><strong>$name has sent Query for using our services</td>
        </tr>    
    <tr  cellpadding=\\"8\\" cellspacing=\\"5\\">
        <td colspan=\\"4\\">
    <font size=\\"1\\" face=\\"Verdana\\" style=\\"COLOR: #d8325d; MARGIN-LEFT:0px\\"><strong>1. Contact Informations</td>        
    </tr>
    <tr>
        <td width=\\"130\\"><font size=\\"1\\"><strong>First Name</td>
        <td><font size=\\"1\\" face=\\"Verdana\\">$name</td>
        <td><font size=\\"1\\"><strong>Last Name </td>
        <td><font size=\\"1\\" face=\\"Verdana\\">$lname</td>        
    </tr>
    <tr>
        <td><font size=\\"1\\"><strong>Designation </td>
        <td><font size=\\"1\\" face=\\"Verdana\\">$desi </td>
        <td><font size=\\"1\\"><strong>Company </td>
        <td><font size=\\"1\\" face=\\"Verdana\\">$company </td>        
    </tr>
    <tr>
        <td><font size=\\"1\\"><strong>Phone/Mob No. </td>
        <td><font size=\\"1\\" face=\\"Verdana\\">$phone </td>
        <td><font size=\\"1\\"><strong>E-mail </td>
        <td><font size=\\"1\\" face=\\"Verdana\\">$email </td>        
    </tr>
    <tr>
        <td><font size=\\"1\\"><strong>Address </td>
        <td colspan=\\"3\\"><font size=\\"1\\" face=\\"Verdana\\">$address </td>    
    </tr>
    <tr>
        <td colspan=\\"4\\">    <font size=\\"1\\" face=\\"Verdana\\" style=\\"COLOR: #d8325d; MARGIN-LEFT:0px\\"><strong>2. From Where ? </td>
        </tr>
    <tr>
        <td><font size=\\"1\\"><strong>City </td>
        <td><font size=\\"1\\" face=\\"Verdana\\">$fromcity </td>
        <td><font size=\\"1\\"><strong>State </td>
        <td><font size=\\"1\\" face=\\"Verdana\\">$fromstate </td>        
    </tr>
    <tr>
        <td colspan=\\"4\\">    <font size=\\"1\\" face=\\"Verdana\\" style=\\"COLOR: #d8325d; MARGIN-LEFT:0px\\"><strong>3. To Where ? </td>
    </tr>
    <tr>
        <td><font size=\\"1\\"><strong>City </td>
        <td><font size=\\"1\\" face=\\"Verdana\\">$tocity </td>
        <td><font size=\\"1\\"><strong>State </td>
        <td><font size=\\"1\\" face=\\"Verdana\\">$tostate </td>        
    </tr>
    <tr>
        <td>    <font size=\\"1\\" face=\\"Verdana\\" style=\\"COLOR: #d8325d; MARGIN-LEFT:0px\\"><strong>4. Date of Moving </td>
        <td colspan=\\"3\\"><font size=\\"1\\" face=\\"Verdana\\"><strong>$movingdate</td>
    </tr>
    <tr>
        <td>    <font size=\\"1\\" face=\\"Verdana\\" style=\\"COLOR: #d8325d; MARGIN-LEFT:0px\\"><strong>5. Paid By : </td>
        <td colspan=\\"3\\"><font size=\\"1\\" face=\\"Verdana\\">$paidby </td>
    </tr>
    <tr>
        <td>    <font size=\\"1\\" face=\\"Verdana\\" style=\\"COLOR: #d8325d; MARGIN-LEFT:0px\\"><strong>6. Additional Services : </td>
        <td><font size=\\"1\\" face=\\"Verdana\\">$field1 </td>
        <td><font size=\\"1\\" face=\\"Verdana\\">$field2 </td>
        <td><font size=\\"1\\" face=\\"Verdana\\">$field3 </td>        
    </tr>
    <tr>
        <td colspan=\\"4\\">    <font size=\\"1\\" face=\\"Verdana\\" style=\\"COLOR: #d8325d; MARGIN-LEFT:0px\\"><strong>7. Any other informations </td>
    </tr>
    <tr>
        <td colspan=\\"4\\"><font size=\\"1\\" face=\\"Verdana\\">message </td>
    </tr>
    <tr>
        <td colspan=\\"4\\"> </td>
    </tr>    
</table>        
        <tr>
            <td colspan=\\"2\\" height=\\"25\\" align=\\"center\\" bgcolor=\\"#CEACFF\\">
                <span style=\\"font-size: 10px; font-weight: bold; color: #874272; font-family:Arial, Helvetica, sans-serif;\\">some footer text</span><br /><span style=\\"float: left; font-size: 10px; font-weight: bold; color: #444888; font-family:Arial, Helvetica, sans-serif; MARGIN-LEFT:10px\\">Copyright 2013 All Rights Reserved.</span><span style=\\"float: right; font-size: 10px; font-weight: bold; color: #444888; font-family:Arial, Helvetica, sans-serif; MARGIN-RIGHT:10px\\">company name</span>
            </td>
        </tr>
    </table>
    </td>
   </tr>
</table>
</body>
</html>"; 
     
    if(strlen($sender_name)<1) 
    { 
        die('Name is too short or empty!'); 
    }  
    */
      
    //Get uploaded file data using $_FILES array 
    $tmp_name    = $_FILES['my_file']['tmp_name']; // get the temporary file name of the file on the server 
    $name        = $_FILES['my_file']['name'];  // get the name of the file 
    $size        = $_FILES['my_file']['size'];  // get size of the file for size validation 
    $type        = $_FILES['my_file']['type'];  // get type of the file 
    $error       = $_FILES['my_file']['error']; // get the error (if any) 
  
    //validate form field for attaching the file 
    if($file_error > 0) 
    { 
        die('Upload error or No files uploaded'); 
    } 
  
    //read from the uploaded file & base64_encode content 
    $handle = fopen($tmp_name, "r");  // set the file handle only for reading the file 
    $content = fread($handle, $size); // reading the file 
    fclose($handle);                  // close upon completion 
  
    $encoded_content = chunk_split(base64_encode($content)); 
  
    $boundary = md5("random"); // define boundary with a md5 hashed value 
  
    //header 
    $headers = "MIME-Version: 1.0\r\n"; // Defining the MIME version 
    $headers .= "From:".$from_email."\r\n"; // Sender Email 
    $headers .= "Reply-To: ".$reply_to_email."\r\n"; // Email addrress to reach back 
    $headers .= "Content-Type: multipart/mixed;\r\n"; // Defining Content-Type 
    $headers .= "boundary = $boundary\r\n"; //Defining the Boundary 
          
    //plain text  
    $body = "--$boundary\r\n"; 
    $body .= "Content-type: text/html; charset=iso-8859-1' . "\r\n"; 
    $body .= "Content-Transfer-Encoding: base64\r\n\r\n";  
    $body .= chunk_split(base64_encode($message));  
          
    //attachment 
    $body .= "--$boundary\r\n"; 
    $body .="Content-Type: $file_type; name=".$file_name."\r\n"; 
    $body .="Content-Disposition: attachment; filename=".$file_name."\r\n"; 
    $body .="Content-Transfer-Encoding: base64\r\n"; 
    $body .="X-Attachment-Id: ".rand(1000, 99999)."\r\n\r\n";  
    $body .= $encoded_content; // Attaching the encoded file with email 
      
    $sentMailResult = mail($recipient_email, $subject, $body, $headers); 
  
    if($sentMailResult )  
    { 
       echo "File Sent Successfully."; 
       unlink($name); // delete the file after attachment sent. 
    } 
    else
    { 
       die("Sorry but the email could not be sent. 
                    Please go back and try again!"); 
    } 
} 

?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html lang="en">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Free Bootstrap Contact Form With PHP - Send Email With Attachent</title>
<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" >
<!-- Optional theme -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" >
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<link rel="stylesheet" href="form.css" >
<script src="form.js"></script>
</head>
<body >
<div class="container">
<div class="row">
<div class="col-md-6 col-md-offset-3" id="form_container">
<h2>Contact Us</h2> 
<form enctype="multipart/form-data" method="POST" action=""> 
    <label>Your Name <input type="text" name="sender_name" /> </label>  
    <label>Your Email <input type="email" name="sender_email" /> </label>  
    <label>Subject <input type="text" name="subject" /> </label>  
    <label>Message <textarea name="message"></textarea> </label>  
    <label>Attachment <input type="file" name="attachment" /></label> 
    <label><input type="submit" name="button" value="Submit" /></label> 
</form> 
</body>
</html>