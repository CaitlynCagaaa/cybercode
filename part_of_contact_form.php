//or well part of the contact form the rest of it is on the vm i no longer have access too 
<?php
if(isset($_POST["submit"])){
// Checking For Blank Fields..
if($_POST["vname"]==""||$_POST["vemail"]==""||$_POST["sub"]==""||$_POST["msg"]==""){
echo "Fill All Fields..";
}else{
// Check if the "Sender's Email" input field is filled out
$email=$_POST['vemail'];
// Sanitize E-mail Address
$email =filter_var($email, FILTER_SANITIZE_EMAIL);
// Validate E-mail Address
$email= filter_var($email, FILTER_VALIDATE_EMAIL);
if (!$email){
echo "Invalid Sender's Email";
}
else{
$subject = $wordpress_email;
$message = $message_from_wordpress;
$headers = 'From:'. $email2 . "rn"; // Sender's Email
$headers .= 'Cc:'. $email2 . "rn"; // Carbon copy to Sender
// Message lines should not exceed 70 characters (PHP rule), so wrap it
$message = wordwrap($message, 70);
// Send Mail By PHP Mail Function
mail("wordpress@sunpartners.local", $subject, $message, $headers);
echo "Your mail has been sent successfuly ! Thank you for your feedback";
}
}
}


if (isset($_POST['upload']))
{
    // ftp settings
    $ftp_hostname = '10.0.158.73'; // change this
    $ftp_username = 'wordpress_upload'; // change this
    $ftp_password = 'wordpress'; // change this
    $remote_dir = 'c:/program files (x86)/wing ftp server/data/sunpartners/users/'; // change this
    $src_file = $_FILES['srcfile']['name'];

    //upload file
    if ($src_file!='')
    {
        // remote file path
        $dst_file = $remote_dir . $src_file;

        // connect ftp
        $ftpcon = ftp_connect($ftp_hostname) or die('Error connecting to ftp server...');

        // ftp login
        $ftplogin = ftp_login($ftpcon, $ftp_username, $ftp_password);

        // ftp upload
        if (ftp_put($ftpcon, $dst_file, $src_file, FTP_ASCII))
            echo 'File uploaded successfully to FTP server!';
        else
            echo 'Error uploading file! Please try again later.';

        // close ftp stream
        ftp_close($ftpcon);
    }
    else
        header('Location: contact_form.php');
}
?>
