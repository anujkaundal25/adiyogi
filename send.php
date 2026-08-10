<?php
if(!isset($_POST['submit']))
{
	//This page should not be accessed directly. Need to submit the form.
	echo "error; you need to submit the form!";
}
$name = $_POST['name'];

$message = $_POST['message'];
$phone = $_POST['phone'];
$subject = $_POST['subject'];



if(IsInjected($visitor_email))
{
    echo "Bad email value!";
    exit;
}

$email_from = 'adiyogiholidays932@gmail.com';//<== update the email address
$email_subject = "DM/Website Enquiry"; 
$email_body = "You have received a new message from \n  "."Name: $name \n"."Phone Number: $phone \n"."subject: $subject \n"."message: $message \n".
    
$to = "adiyogiholidays932@gmail.com";//<== update the email address
$headers = "From: $email_from \r\n";
//$headers .= "Reply-To: $visitor_email \r\n";
//Send the email!
mail($to,$email_subject,$email_body,$headers);
//done. redirect to thank-you page.
//header('Location: thank-you.html');

echo '<script>
    alert("Thank you for contacting us!");
    window.location.href = "index.html"; 
</script>';

// Function to validate against any email injection attempts
function IsInjected($str)
{
  $injections = array('(\n+)',
              '(\r+)',
              '(\t+)',
              '(%0A+)',
              '(%0D+)',
              '(%08+)',
              '(%09+)'
              );
  $inject = join('|', $injections);
  $inject = "/$inject/i";
  if(preg_match($inject,$str))
    {
    return true;
  }
  else
    {
    return false;
  }
}
   
?> 