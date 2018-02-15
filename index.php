<!DOCTYPE html>
<script src="js/jquery-3.2.1.min.js"></script>
<?php
include 'connection.php';
require_once 'Mobile_Detect.php';
require_once 'detect.php';

?>

<?php
if(isset($_POST["submit"]))
{

$id=0;
$name=$_POST["name"];
$email=$_POST["email"];
$phone=$_POST["phone"];
$location=$_POST["location"];
$message=$_POST["message"];
$browser_info = browser_data();
date_default_timezone_set('Asia/Kolkata');

$created_date= date("Y-m-d h:i:s");

$query="INSERT INTO `contact`(`id`, `name`, `email`, `phone`, `location`, `message`,`date`,`browser_info`) VALUES ('$id','$name','$email','$phone','$location','$message','$created_date','$browser_info')";
mysql_query($query);

$_SESSION["status"] = "contact";
// print_r($_SESSION["status"]);
          if($_SESSION["status"]=="contact")
          {
            echo "<script>
                     $(document).ready(function()
                     {
                       $('#mynewModal').modal('show');
                       setTimeout(function(){
                   $('#mynewModal').modal('hide');
                 }, 5000);
                     });
              </script>";
          }

require_once 'phpmailer.php';
$subject = "Enquiry from AKB Group contact";

$msg = "Hello,
              You have a enquiry from contact page.
              Name : ".$name."
              Email : ".$email."
              Phone : ".$phone."
              Location : ".$location."
              Message : ".$message."

              Thank You.
            ";
//-----------LIVE Credentials---------------------------//
}





if(isset($_POST["subscribe"]))
{
  $id=0;
  $email=$_POST["subscribe_email"];
  $browser_info = browser_data();
  date_default_timezone_set('Asia/Kolkata');
  $created_date= date("Y-m-d h:i:s");

  $query="INSERT INTO `subscribe`(`id`,`email`,`date`,`browser_info`) VALUES ('$id','$email','$created_date','$browser_info')";
  $a = mysql_query($query);

  if($a)
  {
    $_SESSION["status"] = "subscribe";
    // print_r($_SESSION["status"]);
    if($_SESSION["status"]=="subscribe")
    {
      echo "<script>
               $(document).ready(function()
               {
                 $('#mysubModal').modal('show');
                 setTimeout(function(){
             $('#mysubModal').modal('hide');
           }, 5000);
               });
        </script>";
    }
  }
}



function browser_data(){
  if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
          $ip=$_SERVER['HTTP_CLIENT_IP'];}
          elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
          $ip=$_SERVER['HTTP_X_FORWARDED_FOR'];} else {
          $ip=$_SERVER['REMOTE_ADDR'];}

  /*Find User Agent*/
          $userAgent = $_SERVER['HTTP_USER_AGENT'];

  /* Load Library*/

  /*Find Device Type*/
          $device_type=Detect::deviceType($userAgent);
          if($device_type=='Computer')
          {
              $device='Desktop';
          }
          else if($device_type=='Phone')
            $device='Mobile';
          else if($device_type=='Tablet')
            $device='Tablet';
            // echo $ip.$userAgent.$device;exit;
  /*Find OS of the device*/
          $os=Detect::os();
  /*Find Location from where file is accessed*/
// 		        $json = file_get_contents("http://ipinfo.io/{$ip}/geo");
//
// 		        $loc_details = json_decode($json, true);
// 						print_r($loc_details
//
// );
// 					$location=array('city'=>$loc_details['city'],'state'=>$loc_details['region'],'country'=>$loc_details['country']);
          return $ip."<br>".$userAgent."<br>".$device."<br>".$os."<br>";
          // print_r($location);exit;
}



function contactmail()
{

//   require_once 'phpmailer.php';
//   $subject = "This is sample subject";
//
//   $msg = "This is message from website contact page.";
// //my change here..
//   $destino="subrat@active.agency";
//
//   $mail = new phpmailer();  //PHPMailer
//   $mail->IsSMTP(); // we are going to use SMTP
//   $mail->Mailer = 'smtp';
//   $mail->Host = "smtp.mailgun.org";
//   $mail->SMTPAuth = true;
//   $mail->Username = "arun@sandbox268e9d7709114d6db616e62ce42f2ada.mailgun.org";
//   $mail->Password = "arun123";
//   $mail->SMTPAutoTLS = false;
//   $mail->SMTPSecure = 'SSL';
//   $mail->Port = 25;   // Tried with 465 but didnt work.
//   $mail->setFrom('arun@active.agency');
//
//   $destino = "subrat@active.agency";
//
//   $mail->AddAddress($destino);
//   $mail->Subject = "checking..";//$subject;
//   $mail->Body = "checking";//$msg;
//   $mail->SMTPDebug = 0;  // can use 1 or 2 or 3 or 4 for viewing more details..
//   // print_r($mail->Username);exit;
//   if($mail->Send())
//   {
//     //echo "success";
//   }
//   else
//   {
//     //echo "not sent";
//   }




require_once 'phpmailer.php';
$subject = "This is sample subject";

$msg = "This is message from website contact page.";

$destino = "subrat@active.agency";//"me.arunchandran.here@gmail.com";

$mail = new phpmailer();  //PHPMailer
$mail->IsSMTP(); // we are going to use SMTP
$mail->Mailer = 'smtp';
$mail->Host = "smtp.mailgun.org";
$mail->SMTPAuth = true;
$mail->Username = "arun@sandbox268e9d7709114d6db616e62ce42f2ada.mailgun.org";
$mail->Password = "arun123";
$mail->SMTPAutoTLS = false;
$mail->SMTPSecure = 'SSL';
$mail->Port = 25;   // Tried with 465 but didnt work.
$mail->setFrom('arun@active.agency');
$mail->AddAddress($destino);
$mail->Subject = $subject;
$mail->Body = $msg;
$mail->SMTPDebug = 0;  // can use 1 or 2 or 3 or 4 for viewing more details..
// print_r($mail->Username);exit;
if($mail->Send())
{

  ///echo "success";
}
else
{
  //echo "not sent";
}

}


?>


<html lang="en">
<head>
  <meta charset="utf-8">
  <title>AKB Group Coming Soon</title>
  <meta http-equiv="X-UA-Compatible" content="IE=Edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- <link rel="stylesheet" href="css/bootstrap.min.css"> -->


  <style type="text/css">
    @font-face{font-family:MuseoSans-300;src:url(../fonts/MuseoSans-300.otf)}@font-face{font-family:MuseoSans-700;src:url(../fonts/MuseoSans-700.otf)}@font-face{font-family:MuseoSans_500;src:url(../fonts/MuseoSans_500.otf)}*{padding:0;margin:0}body{font-family:MuseoSans-300;box-sizing:border-box}.logo{font-family:MuseoSans-300;height:112px;background-color:#f3f2ed;color:#fff;font-size:14px}.top{margin-top:47px}.phone{margin-left:21px;margin-bottom:22px}.col-lg-3.col-md-5.col-sm-5.logoo{margin-top:-12px;margin-bottom:20px}.col-lg-3.col-md-5.col-sm-5.logoo img{display:block;margin:auto}.top-text{margin-top:26px;font-family:MuseoSans-300;font-size:17px}.slider{width:100%;margin-top:20px}.font h3{margin-bottom:28px;font-size:74px;font-family:MuseoSans-700}.font p{font-size:26px;margin-bottom:163px}.section-heading{margin-top:76px;font-size:21px}.col-lg-12.col-md-12.text-center.section-heading p{margin-bottom:0}.sub-heading h2{font-family:MuseoSans_500}.sub-heading p{font-size:16px;color:#9e9e9d;margin-top:20px}span.mobhid{display:none;font-size:28px}.modal-dialog.modal-sm{margin-top:17%;border:0;border-radius:0}.modal-content{border-radius:0;width:421px;height:375px}button.close{margin-right:28px;margin-top:12px;font-weight:100;font-size:26px;color:black}.pop{margin-top:45px}button.close{margin-right:28px;margin-top:12px;font-weight:100;font-size:26px;color:black}.mod h3{font-family:MuseoSans_500;font-size:24px}.mod p{color:#9e9e9d;font-size:16px;margin-top:14px;margin-bottom:-12px}@media (min-width:992px) and (max-width:1205px){.mod p{margin-bottom:4px}}@media (min-width:320px) and (max-width:988px){.modal-content{border-radius:0;width:311px;height:335px;margin:auto}}.pop{margin-top:45px}.pop-email{background-color:#f3f2ec;height:60px;border:0;border-radius:0;font-size:16px}.pop-butn{height:60px;border:0;border-radius:0;font-size:16px;background-color:#6d8ffb;margin-top:15px;color:#fff}@media (min-width:1000px) and (max-width:1300px){.font p{font-size:26px;margin-bottom:38px}}@media (min-width:549px) and (max-width:999px){.font h3{margin-bottom:21px;font-size:52px;font-family:MuseoSans-700}.font p{font-size:18px;margin-bottom:3px}.section-heading{margin-top:76px;font-size:18px}}@media (min-width:480px) and (max-width:548px){.font h3{margin-bottom:6px;font-size:38px;font-family:MuseoSans-700}.font p{font-size:18px;margin-bottom:-15px}.section-heading{margin-top:76px;font-size:18px}}@media (min-width:320px) and (max-width:479px){.top-text{font-size:16px}.font h3{margin-bottom:6px;font-size:28px;font-family:MuseoSans-700}.font p{font-size:16px;margin-bottom:-15px}.section-heading{margin-top:76px;font-size:16px}}@media (min-width:320px) and (max-width:991px){.top{margin-top:0}}@media (min-width:821px) and (max-width:991px){.phone{margin-left:21px;margin-bottom:22px;margin-top:42px}.col-lg-3.col-md-5.col-sm-5.logoo{margin-bottom:20px;margin-top:22px}.col-lg-3.col-md-3.col-sm-3.text-right{margin-top:42px}}@media (min-width:320px) and (max-width:765px){.col-lg-3.col-md-3.col-sm-3.text-right{text-align:left}}@media screen and (min-width:766px){.phone-icon{display:none}.mail-icon{display:none}}@media screen and (max-width:729px){.phone-no{display:none}.mail-add{display:none}span.phone-icon{font-size:36px;color:#fff}span.mail-icon{font-size:36px;position:absolute;margin-top:-107px;margin-left:84px;color:#fff}.col-lg-3.col-md-5.col-sm-5.logoo{margin-top:-27px;margin-bottom:20px}}@media (min-width:733px) and (max-width:765px){.phone-no{display:none}.mail-add{display:none}span.phone-icon{font-size:36px;color:#fff}span.mail-icon{font-size:36px;position:absolute;margin-top:-107px;margin-left:84px;color:#fff}}@media (min-width:320px) and (max-width:360px){.col-lg-3.col-md-5.col-sm-5.logoo{width:66%;margin-top:20px}span.phone-icon{font-size:22px;position:absolute;color:#fff;right:48px;margin-top:19px}span.mail-icon{font-size:22px;position:absolute;right:0;color:#fff;margin-top:-48px}}@media (min-width:362px) and (max-width:374px){.col-lg-3.col-md-5.col-sm-5.logoo{width:56%;margin-top:26px}span.phone-icon{font-size:24px;color:#fff;position:absolute;right:0;margin-right:36px;margin-top:23px}span.mail-icon{font-size:24px;position:absolute;color:#fff;right:0;margin-top:-52px}}@media (min-width:377px) and (max-width:459px){.col-lg-3.col-md-5.col-sm-5.logoo{width:56%;margin-top:26px}span.phone-icon{font-size:24px;color:#fff;position:absolute;right:0;margin-right:36px;margin-top:23px}span.mail-icon{font-size:24px;position:absolute;color:#fff;right:0;margin-top:-52px}}@media (min-width:460px) and (max-width:567px){.col-lg-3.col-md-5.col-sm-5.logoo{width:54%;margin-top:12px}span.phone-icon{font-size:22px;color:#fff;position:absolute;right:0;margin-right:41px;margin-top:26px}span.mail-icon{font-size:22px;position:absolute;color:#fff;right:0;margin-top:-47px}}@media (min-width:570px) and (max-width:599px){.col-lg-3.col-md-5.col-sm-5.logoo{width:54%;margin-top:12px}span.phone-icon{font-size:22px;color:#fff;position:absolute;right:0;margin-right:41px;margin-top:26px}span.mail-icon{font-size:22px;position:absolute;color:#fff;right:0;margin-top:-47px}}@media (min-width:600px) and (max-width:729px){.col-lg-3.col-md-5.col-sm-5.logoo{width:50%;margin-top:12px}span.mail-icon{font-size:36px;position:absolute;margin-top:-63px;right:0;margin-right:52px;color:#fff}span.phone-icon{font-size:36px;color:#fff;position:absolute;right:0;margin-top:22px}}@media (min-width:733px) and (max-width:764px){.col-lg-3.col-md-5.col-sm-5.logoo{width:50%;margin-top:12px}span.mail-icon{font-size:36px;position:absolute;margin-top:-63px;right:0;margin-right:52px;color:#fff}span.phone-icon{font-size:36px;color:#fff;position:absolute;right:0;margin-top:22px}}@media (min-width:766px) and (max-width:769px){.col-lg-3.col-md-5.col-sm-5.logoo{margin-top:25px;margin-bottom:20px}.col-lg-3.col-md-3.col-sm-3.phone{margin-top:36px}.col-lg-3.col-md-3.col-sm-3.text-right{width:29%;margin-top:36px}}@media (min-width:320px) and (max-width:769px){.col-lg-12.col-md-12.text-center.mod{margin-top:46px}.mod p{font-size:14px}}@media (min-width:320px) and (max-width:604px){.carousel-indicators{bottom:-8px}}@media (min-width:358px) and (max-width:360px){span.phone-icon{right:66px;margin-top:26px}span.mail-icon{margin-top:-46px}}@media (min-width:410px) and (max-width:412px){span.phone-icon{margin-right:84px;margin-top:27px}span.mail-icon{right:8px;margin-top:-49px}}@media (min-width:638px) and (max-width:640px){span.phone-icon{margin-right:100px}span.mail-icon{margin-right:12px}}@media (min-width:730px) and (max-width:732px){.phone-no{display:none}.mail-add{display:none}.col-lg-3.col-md-5.col-sm-5.logoo{width:38%;position:absolute;margin:auto;margin-left:231px}span.mail-icon{position:absolute;margin-top:-6px;margin-left:116px;width:0%;font-size:36px;color:#fff}span.phone-icon{position:absolute;margin-left:14px;margin-top:18px;font-size:36px;color:#fff}}@media (min-width:320px) and (max-width:322px){.modal-content{margin-left:-5px}}@media (min-width:568px) and (max-width:569px){.col-lg-3.col-md-5.col-sm-5.logoo{width:54%;margin-top:12px}span.phone-icon{margin-right:100px;margin-top:32px;font-size:22px;color:#fff;position:absolute;right:0}span.mail-icon{margin-top:-49px;margin-right:15px;font-size:22px;position:absolute;color:#fff;right:0}}@media (min-width:375px) and (max-width:376px){.col-lg-3.col-md-5.col-sm-5.logoo{width:56%;margin-top:26px}span.phone-icon{font-size:24px;color:#fff;position:absolute;right:0;margin-right:84px;margin-top:23px}span.mail-icon{font-size:24px;position:absolute;color:#fff;right:0;margin-right:13px;margin-top:-49px}}.sec-heading-sm{display:none;text-align:justify}@media (min-width:320px) and (max-width:400px){.text-sub-heading{text-align:justify}}@media (min-width:320px) and (max-width:768px){.sec-heading{display:none}.sec-heading-sm{display:block}}
  </style>
</head>
<body>


  <!--top logo-->
<div class="fixedHeader">
  <div class="container-fluid topStrip">
      <div class="row">
          <p class="topTextfix">The Definitive Home Of Luxury Furniture</p>
      </div>
  </div>
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-12 col-lg-12 logo">
        <div class="top">
          <div class="col-lg-1 col-md-0 col-sm-0"></div>
          <div class="col-lg-3 col-md-3 col-sm-3 phone">
            <p><a href="tel:+91 (80) 67590504">
              <span class="phone-no">
                <span class="f-size"><i class="fa fa-phone" aria-hidden="true"></i></span>
                <span class="f-size"> +91 (80) 67590504</span>
              </span>
              <span class="phone-icon"><i class="fa fa-phone" aria-hidden="true"></i></span></a></p>
          </div>
          <div class="col-lg-3 col-md-5 col-sm-5 logoo">
            <img src="images/logo.png" alt="logo" class="img-responsive">
          </div>
          <div class="col-lg-3 col-md-3 col-sm-3 emailRght text-right">
            <p><a href="mailto:info@akbgroup.in"><span class="mail-add"><span class="f-size"><i class="fa fa-envelope-o" aria-hidden="true"></i></span><span class="f-size">&nbsp&nbspinfo@akbgroup.in</span></span><span class="mail-icon"><i class="fa fa-envelope-o" aria-hidden="true"></i></span></a></p>
          </div>
        </div>
      </div>
      <div class="col-md-12 col-lg-12 text-center top-text">
        <p>We are currently working on our site.<a href="" data-toggle="modal" data-target="#myModal"> Subscribe</a> to be the first to find out when we launch our brand new website. </p>
      </div>
    </div>
  </div>
  <!--top heading-->
</div>
  <!--slider-->
  <div class="slider">
    <div id="myCarousel" class="carousel slide" data-ride="carousel">

    <!-- Wrapper for slides -->
    <div class="carousel-inner">

      <div class="item active imagee">
        <img src="images/Banner_new.jpg" alt="Slider1" style="width:100%;" class="desktopImg">
        <img src="images/Small-Banner.jpg" alt="" style="width:100%;" class="mobileImg">
        <div class="carousel-caption font">
          <!-- <h3>Launching Soon</h3>
          <p>Beautiful Interior & Luxury Furniture</p> -->
        </div>
      </div>
    </div>
  </div>
</div>
<!--section-->




<div class="container">
  <div class="row">
    <!-- <div class="col-lg-12 col-md-12 text-center section-heading">
      <p class="sec-heading">Native Barn is your new home for luxury interior. Working with some of the top furniture
      </p>
      <p class="sec-heading">brands, we aim to deliver the very best in quality and choice</p>
      <p class="sec-heading-sm">Native Barn is your new home for luxury interior. Working with some of the top furniture brands, we aim to deliver the very best in quality and choice</p>
    </div> -->
    <div class="col-lg-12 col-md-12 text-center sub-heading">
      <h2>Connect with us</h2>
      <p class="text-sub-heading">Please fill in your complete details and we will get back to you.</p>
    </div>
    <!--form-->

      <div class="col-sm-12 form-box">
  <div class="col-sm-10  col-sm-offset-1">
    <form method="post" action="index.php">
    <div class="col-sm-6 form-margin">
          <div class="form-group">
              <input type="text" class="form-control box" id="name" placeholder="Name*" name="name">
             <label style="color:red; display:none;" id="rname" for="name">Please fill the name</label>
           </div>
            </div>
            <div class="col-sm-6 form-margin">
            <div class="form-group">
                 <input type="email" class="form-control box" id="email" placeholder="Email*" name="email">
                <label style="color:red; display:none;" id="remail" for="email">Please fill the email</label>
                <label style="color:red; display:none;" id="vemail" for="email">Please fill Valid email</label>
              </div>
            </div>
              <div class="col-sm-6 form-margin">
           <div class="form-group">
             <input type="text" class="form-control box" id="phone" placeholder="Phone*" name="phone">
             <label style="color:red; display:none;" id="rphone" for="phn">Please fill the phone</label>
           </div>
        </div>

          <div class="col-sm-6 form-margin">
           <div class="form-group">
              <input type="text" class="form-control box" id="loc" placeholder="Location*" name="location">
             <label style="color:red; display:none;" id="rloc" for="loc">Please fill the location</label>
           </div>
         </div>
          <div class="col-sm-12 form-margin">
          <div class="form-group">
          <textarea class="form-control" rows="8" cols="80" id="message" placeholder="Message*"></textarea>
         <label style="color:red; display:none;" id="rmsg" for="comment">Please fill the Message</label>
       </div>
     </div>
           <div class="col-sm-12 form-margin">
          <button type="submit" name="submit" id="submit" class="btn btn-default btn-block sub"><span class="mobshow">SEND MESSAGE</span>
            <span style="display:none;" class="glyphicon glyphicon-ok mobhid"></span>
          </button>
        </div>
        </form>
      </div>
    </div>
  </div>
</div>
<div class="container">
  <div class="contacts">
  	<div class="contact-details">
  	   <div class="c-box">
          <h4>Registered Address</h4>
    		   <p>Level 15, Concorde Towers <br>
    			UB City, 1 Vittal Mallya Road<br>
    			Bangalore 560 - 001
    			</p>
  	   </div>
    </div>
  </div>
</div>
<div class="container-fluid text-center footer">
  <p>All Rights Reserved &copy; AKB Group 2018</p>
</div>
<!--model-->
<div class="container">
  <div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog modal-sm">
      <div class="modal-content">

        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <div class="row">
          <div class="col-lg-12 col-md-12 text-center mod">
            <h3>Notify Me</h3>
            <p>Enter your email address to get notifed</p>
            <p>when site is ready</p>

          </div>
          <div class="col-lg-1 col-md-1 col-sm-1 col-xs-1"></div>
          <div class="col-lg-10 col-md-10 col-sm-10 col-xs-10">
            <form method="post" action="#">
              <div class="form-group pop">
                <input type="email" class="form-control pop-email" id="user_email" placeholder="Enter Email Address" name="subscribe_email">
                <label style="color:red; display:none;" id="rsemail" for="email">Please fill the email</label>
                <label style="color:red; display:none;" id="vsemail" for="email">Please fill valid email</label>
                <button type="submit" name="subscribe" id="subscribe" class="btn btn-default btn-block pop-butn">SUBSCRIBE</button>
              </div>
            </form>
          </div>
          <div class="col-lg-1 col-md-1 col-sm-1 col-xs-1"></div>
        </div>
      </div>
    </div>
  </div>

<!--new model-->
<div class="modal fade" id="mynewModal" role="dialog">
  <div class="modal-dialog modal-sm">
    <div class="modal-content">

      <button type="button" class="close" data-dismiss="modal">&times;</button>
      <div class="row">
        <div class="col-lg-12 col-md-12 text-center mod">
         <div class="col-lg-10 col-md-10 col-lg-offset-1 col-md-offset-1 text-center xyzz">
          <h3>Thank You</h3>
          <p>We will Contact you soon!</p>
           <img src="images/icon.png" alt="tick" class="tick-icon">
        </div>
        </div>
        <div class="col-lg-1 col-md-1 col-sm-1 col-xs-1"></div>
        <div class="col-lg-1 col-md-1 col-sm-1 col-xs-1"></div>
      </div>
    </div>

  </div>
</div>


<div class="modal fade" id="mysubModal" role="dialog">
  <div class="modal-dialog modal-sm">
    <div class="modal-content">

      <button type="button" class="close" data-dismiss="modal">&times;</button>
      <div class="row">
        <div class="col-lg-12 col-md-12 text-center mod">
          <div class="col-lg-10 col-md-10 col-lg-offset-1 col-md-offset-1 text-center xyzz">
          <h3>Thank You</h3>
          <p>Thanks for susbcribing we will notify you once the site is ready</p>
          <img src="images/icon.png" alt="tick" class="tick-icon">
        </div>

        </div>
        <div class="col-lg-1 col-md-1 col-sm-1 col-xs-1"></div>
        <div class="col-lg-1 col-md-1 col-sm-1 col-xs-1"></div>
      </div>
    </div>

  </div>
</div>
<!---new model ends-->


</div>

<!-- <link rel="stylesheet" href="css/font-awesome.min.css"> -->
<script async src="js/bootstrap.min.js"></script>

<script type="text/javascript">
$(document).ready(function() {
  $(".sub").click(function()
  {
    //$(".mobhid").show();
    // $(".mobshow").hide();
    // $(".sub").addClass("grn");
  });

  $(document).on('click','#submit',function()
  {
       var bool=0;
      // return false;
      var contact_name=$('#name').val();
      var contact_email=$('#email').val();
      var entered_phone=$('#phone').val();
      var contact_phone = $.trim(entered_phone);
      var contact_location=$('#loc').val();
      var contact_message=$('#message').val();

      var preg = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;

     if( contact_email !=''){
          if(!contact_email.match(preg)){
             $("#email").css("border-color" , "#ffcdcd");
              $("#vemail").show();
                bool++;
            //  return false;
            }
            else{
                $("#email").css("border-color" , "");
                 $("#vemail").hide();
              }
        }

        if( contact_message =='' && contact_location =='' && contact_email =='' && contact_phone =='' && contact_name ==''){
            $("#rmsg").show();
            $("#rname").show();
            $("#rphone").show();
            $("#remail").show();
            $("#rloc").show();
            bool++;
        }

         if( contact_name ==''){
             $("#name").css("border-color" , "#ffcdcd");
             $("#rname").show();
          //  $(".mobhid").hide();
             bool++;
         }
         else{
             $("#name").css("border-color" , "");
             $("#rname").hide();
           }

         if( contact_phone ==''){
             $("#phone").css("border-color" , "#ffcdcd");
             $("#rphone").show();
             bool++;
         }
         else{
             $("#phone").css("border-color" , "");
             $("#rphone").hide();
           }


         if( contact_email ==''){
              $("#email").css("border-color" , "#ffcdcd");
              $("#remail").show();
              bool++;
         }
         else{
              $("#email").css("border-color" , "");
              $("#remail").hide();
           }

        if( contact_location ==''){
              $("#loc").css("border-color" , "#ffcdcd");
              $("#rloc").show();
              bool++;
        }
        else{
              $("#loc").css("border-color" , "");
              $("#rloc").hide();
          }

       if( contact_message ==''){
              $("#message").css("border-color" , "#ffcdcd");
              $("#rmsg").show();
              bool++;
       }
       else{
             $("#message").css("border-color" , "");
             $("#rmsg").hide();
         }



       if(bool > 0){
        //  $(".mobhid").hide();
         return false;
       }
       else {
         $(".mobhid").show();
         $(".mobshow").hide();
         $(".sub").addClass("grn");
         return true;
       }

  });


  $(document).on('click','#subscribe',function() {
       var bool1=0;
      // return false;

      var contact_email=$('#user_email').val();

      var preg = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;

      if( contact_email !=''){
          if(!contact_email.match(preg)) {
                $("#vsemail").show();
                bool1++;
            //  return false;
            }
            else {
                $("#vsemail").hide();
              }
        }

         if( contact_email =='') {
        //  $("#email").css("border-color" , "#ffcdcd");
           $("#rsemail").show();
            bool1++;
        //  return false;
         }
         else {
            //  $("#email").css("border-color" , "");
               $("#rsemail").hide();
           }

       if(bool1 > 0) {
         return false;
       }
       else {
        //  $('#mynewModal').modal('show');
          return true;
       }

  });




});
</script>
<link rel="stylesheet" href="css/style.css">
</body>
</html>

<script type="text/javascript">
$(function()
{
    $('#name').on('keypress', function(e)
    {
      if (e.which == 32)
      {
        var contact_name=$('#name').val();
        if (contact_name.length <1)
        {
          return false; // not allowing space to  be first.
        }
        else
        {
          return true;
        }
      }
    });
});

$(function() {
    $('#email').on('keypress', function(e) {
        if (e.which == 32)
            return false;
    });
});

$(function() {
  //called when key is pressed in textbox
    $("#phone").keypress(function (e) {
        if (e.which == 32) {
          var contact_phone=$('#phone').val();
          if (contact_phone.length <1) {

            return false; // not allowing space to  be first.
          }
          else {

            return true;
          }
        }

      else {
          if (e.which >=65 && e.which <=122 ) {
              return false; // not allowing alphabets.
          }
          else {
             return true;
          }
        }
      });
});

$(function() {
    $('#loc').on('keypress', function(e) {
      if (e.which == 32) {
        var contact_loc=$('#loc').val();
        if (contact_loc.length <1) {
          return false; // not allowing space to  be first.
        }
        else {
          return true;
        }
      }
    });
});

$(function() {
    $('#message').on('keypress', function(e) {
      if (e.which == 32) {
        var contact_message=$('#message').val();
        if (contact_message.length <1) {
          return false; // not allowing space to  be first.
        }
        else {
          return true;
        }
      }
    });
});

</script>
