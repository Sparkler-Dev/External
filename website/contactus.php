
<?php
$recipient_email    = "info@sparklerpro.com"; //recepient
$from_email = $_POST['sender_email'];


if($_POST){
	
    //php validation, exit outputting json string
/* if ($_SERVER["REQUEST_METHOD"] == "POST") {
     if (empty($_POST["sender_name"])) {
        $nameErr = "Name is required";
     } else {
         $name = test_input($_POST["name"]);
     }

     if (empty($_POST["sender_email"])) {
       $emailErr = "Email is required";
    } else {
      $sender_email = test_input($_POST["sender_email"]);
     }

     if (empty($_POST["website"])) {
       $website = "";
     } else {
       $website = test_input($_POST["website"]);
     }

     if (empty($_POST["comment"])) {
       $comment = "";
     } else {
       $comment = test_input($_POST["comment"]);
     }

 */
    $sender_name    = filter_var($_POST["sender_name"], FILTER_SANITIZE_STRING); //capture sender name
    $sender_email   = filter_var($_POST["sender_email"], FILTER_SANITIZE_STRING); //capture sender email
	$cname   = filter_var($_POST["cname"], FILTER_SANITIZE_STRING);
	$website   = filter_var($_POST["website"], FILTER_SANITIZE_STRING);
    $mobilenumber   = filter_var($_POST["mobilenumber"], FILTER_SANITIZE_NUMBER_INT);
    $budget   = filter_var($_POST["budget"], FILTER_SANITIZE_NUMBER_INT);
    $services        = filter_var($_POST["services"], FILTER_SANITIZE_STRING);
    $description        = filter_var($_POST["description"], FILTER_SANITIZE_STRING); //capture message

    $attachments = $_FILES['my_files'];
    
    $file_count = count($attachments['name']); //count total files attached
    $boundary = md5("sparklerpro.com"); 
    
    //construct a message body to be sent to recipien
	 $message_body =  " Name : $sender_name\n";
    $message_body .=  "------------------------------\n";
    $message_body .=  " EMail : $sender_email\n";
    $message_body .=  "------------------------------\n";
	$message_body .=  " Mobile Number : $mobilenumber\n";
    $message_body .=  "------------------------------\n";
	$message_body .=  " Company Name : $cname\n";
    $message_body .=  "------------------------------\n";
	$message_body .=  " Website : $website\n";
    $message_body .=  "------------------------------\n";
	$message_body .=  " Services : $services\n";
    $message_body .=  "------------------------------\n";
	$message_body .=  " Budget : $budget\n";
    $message_body .=  "------------------------------\n";
	$message_body .=  " Description : $description\n";
    $message_body .=  "------------------------------\n";
 
    if($file_count > 0){ //if attachment exists
        //header
        $headers = "MIME-Version: 1.0\r\n"; 
        $headers .= "From:".$from_email."\r\n"; 
        $headers .= "Reply-To: ".$sender_email."" . "\r\n";
        $headers .= "Content-Type: multipart/mixed; boundary = $boundary\r\n\r\n"; 
        
        //message text
        $body = "--$boundary\r\n";
        $body .= "Content-Type: text/plain; charset=ISO-8859-1\r\n";
        $body .= "Content-Transfer-Encoding: base64\r\n\r\n"; 
        $body .= chunk_split(base64_encode($message_body)); 

        //attachments
        for ($x = 0; $x < $file_count; $x++){       
            if(!empty($attachments['name'][$x])){
                
                if($attachments['error'][$x]>0) //exit script and output error if we encounter any
                {
                    $mymsg = array( 
                    1=>"The uploaded file exceeds the upload_max_filesize directive in php.ini", 
                    2=>"The uploaded file exceeds the MAX_FILE_SIZE directive that was specified in the HTML form", 
                    3=>"The uploaded file was only partially uploaded", 
                    4=>"No file was uploaded", 
                    6=>"Missing a temporary folder" ); 
                    print  $mymsg[$attachments['error'][$x]]; 
                    exit;
                }
                
                //get file info
                $file_name = $attachments['name'][$x];
                $file_size = $attachments['size'][$x];
                $file_type = $attachments['type'][$x];
                
                //read file 
                $handle = fopen($attachments['tmp_name'][$x], "r");
                $content = fread($handle, $file_size);
                fclose($handle);
                $encoded_content = chunk_split(base64_encode($content)); //split into smaller chunks (RFC 2045)
                
                $body .= "--$boundary\r\n";
                $body .="Content-Type: $file_type; name=".$file_name."\r\n";
                $body .="Content-Disposition: attachment; filename=".$file_name."\r\n";
                $body .="Content-Transfer-Encoding: base64\r\n";
                $body .="X-Attachment-Id: ".rand(1000,99999)."\r\n\r\n"; 
                $body .= $encoded_content; 
            }
        }

    }else{ //send plain email otherwise
       $headers = "From:".$from_email."\r\n".
        "Reply-To: ".$sender_email. "\n" .
        "X-Mailer: PHP/" . phpversion();
        $body = $message_body;
    }
        
    $sentMail = mail($recipient_email, $subject, $body, $headers);
    if($sentMail) //output success or failure messages
    {       
       echo '<script>alert("Thank you for reaching SparklerPro. We will respond to your query as soon as possible.");</script>';
	echo '<script>window.location.href="contactus.php";</script>';
	}
	else
	{
	echo '<script>alert("Please resend it.);</script>';
	echo '<script>window.location.href="contactus.php";</script>';
	}
 
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
   <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
  <link rel="canonical" href="https://sparklerpro.com/contactus.php" />
  <title>Contact us | SparklerPro</title>
  <meta content="At SparklerPro, we are specialised on providing the complete IT needs for the new and existing business entrepreneurs, starting with affordable Web development, Mobile App development, Social Media Marketing, Digital Marketing, SEO and Social Media Marketing, Logo Designs, Software development and Promotional videos." name="description">
  <meta content="website designers in chennai,web development company in chennai,web designing company in chennai,web developer in chennai,website development company in chennai,website developers in chennai,ecommerce development company in chennai,php web development company chennai,best website designers in chennai,ecommerce website developer in chennai,ui developer chennai,php website development chennai,laravel development company in chennai,webdesigning company in chennai,cinematographers in chennai,cinematography chennai,digital marketing professionals,professional search engine optimization,seo professional services,professional seo marketing,seo services for photographers,professional search engine optimization services,professional search engine optimization company,professional seo services agency,professional search engine optimisation,best seo professional,professional search engine marketing services,professional digital marketing services,professional search engine marketing,professional seo consultancy,search engine marketing professionals,seo professional overview,professional seo services near me,search engine professionals,search engine optimization for photographers,seo professionals near me,seo professional consultant" name="keywords">
  <meta property="og:type" content="article" />
  <meta property="og:title" content="Contact us | SparklerPro" />
  <meta property="og:url" content="https://sparklerpro.com/contactus.php" />
  <meta property="og:site_name" content="SparklerPro | Your One stop solution for all your Business tech needs" />
  <meta property="article:publisher" content="https://www.facebook.com/sparklerpro/" />
  <meta property="og:description"
    content="At SparklerPro, we are specialised on providing the complete IT needs for the new and existing business entrepreneurs, starting with affordable Web development, Mobile App development, Social Media Marketing, Digital Marketing, SEO and Social Media Marketing, Logo Designs, Software development and Promotional videos." />
  <meta property="og:image" content="https://res.cloudinary.com/dv5jjlsd7/image/upload/v1631206488/poster3_nkd7d9.png" />
  <meta name="twitter:card" content="summary_large_image" />
  <meta name="twitter:site" content="Sparkler Pro" />
  <meta name="twitter:title" content="Your One stop solution for all your Business tech needs | SparklerPro" />
  <meta name="twitter:description"
    content="At SparklerPro, we are specialised on providing the complete IT needs for the new and existing business entrepreneurs, starting with affordable Web development, Mobile App development, Social Media Marketing, Digital Marketing, SEO and Social Media Marketing, Logo Designs, Software development and Promotional videos." />
  <meta name="twitter:image" content="https://res.cloudinary.com/dv5jjlsd7/image/upload/v1631206488/poster3_nkd7d9.png" />
  <meta name="twitter:url" content="https://twitter.com/SparklerPro" />
  <meta name=”robots” content=”index, follow”>
   <meta name="author" content="Sparklerpro"/>
  <!-- Favicons -->
  <link href="assets/favicon.png" rel="icon">
  <link href="assets/apple-touch-icon.png" rel="apple-touch-icon">

  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Raleway:300,300i,400,400i,500,500i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="assets/vendor/icofont/icofont.min.css" rel="stylesheet">
  <link href="assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
  <link href="assets/vendor/venobox/venobox.css" rel="stylesheet">
  <link href="assets/vendor/owl.carousel/assets/owl.carousel.min.css" rel="stylesheet">
  <link href="assets/vendor/aos/aos.css" rel="stylesheet">
  <link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet'>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  
  <!-- reference your copy Font Awesome here (from our CDN or by hosting yourself) -->
  <link href="/your-path-to-fontawesome/css/fontawesome.css" rel="stylesheet">
  <link href="/your-path-to-fontawesome/css/brands.css" rel="stylesheet">
  <link href="/your-path-to-fontawesome/css/solid.css" rel="stylesheet">
  <link href="assets/css/style.css" rel="stylesheet">
  <script type="application/ld+json">
{
  "@context": "https://schema.org",
  "@type": "LocalBusiness",
  "name": "Sparklerpro",
  "image": "https://res.cloudinary.com/dv5jjlsd7/image/upload/v1631206488/poster3_nkd7d9.png",
  "@id": "",
  "url": "https://res.cloudinary.com/dv5jjlsd7/image/upload/v1631206488/poster3_nkd7d9.png",
  "telephone": "+ 988 430 1084",
  "address": {
    "@type": "PostalAddress",
    "streetAddress": "West Tambaram, Chennai",
    "addressLocality": "Chennai",
    "postalCode": "600045",
    "addressCountry": "IN"
  },
  "openingHoursSpecification": {
    "@type": "OpeningHoursSpecification",
    "dayOfWeek": [
      "Monday",
      "Tuesday",
      "Wednesday",
      "Thursday",
      "Friday",
      "Saturday",
      "Sunday"
    ],
    "opens": "00:00",
    "closes": "23:59"
  },
  "sameAs": [
    "https://www.facebook.com/sparklerpro",
    "https://twitter.com/SparklerPro",
    "https://www.instagram.com/sparklerpro/",
    "https://sparklerpro.com/"
  ] 
}
</script>
  
</head>

<body>

  <!-- ======= Top Bar ======= -->
  <section id="topbar" class="d-none d-lg-block">
    <div class="container d-flex">
      <div class="contact-info mr-auto">
        <ul>
          <li><i class="icofont-envelope"></i><a href="mailto:info@sparklerpro.com">info@sparklerpro.com</a></li>
          <li><i class="icofont-phone"></i><a href="tel:9884301084">098843 01084</a></li>
          <li><i class="icofont-clock-time icofont-flip-horizontal"></i> Mon-Fri 8am - 6pm</li>
        </ul>

      </div>
      <!--<div class="cta">
        <a href="#about" class="scrollto">Get a Quote</a>
      </div>-->
    </div>
  </section>

  <!-- ======= Header ======= -->
  <header id="header">
    <div class="container d-flex">

      <div class="logo mr-auto">
        <!-- <h1 class="text-light"><a href="index.html"><span>SparklerPro</span></a></h1> -->
        <!-- image logo -->
         <a href="./index.php"><img src="assets/img/logo.png" alt="" class="img-fluid"></a>
      </div>

      <nav class="nav-menu d-none d-lg-block">
        <ul>
          <li><a href="https://sparklerpro.com/">Home</a></li>
          <!-- <li><a href="./about.html">About</a></li>
          <li><a href="./services.html">Services</a></li>
          <li><a href="./samples.html">Samples</a></li> -->
          <li class="active"><a href="contactus.php">Contact</a></li>

        </ul>
      </nav><!-- .nav-menu -->

    </div>
  </header><!-- End Header -->

  <!-- ======= Hero Section ======= -->
  <section id="hero1" class="d-flex flex-column justify-content-center align-items-center">
    <div class="container" data-aos="fade-in">
      <h1 style="text-align:center;color:#000;text-transform:uppercase;">contact us</h1>
	   <p style="text-align:center;color:#000;">
At sparklerpro we know that even the best product is only as good as the people behind it. </p>
	  
     
    </div>
  </section><!-- End Hero -->

  <main id="main">

   
   <section id="contact" class="contact">
      <div class="container">

        <!--<div class="section-title">
          <h2 data-aos="fade-up">Contact</h2>
          <p data-aos="fade-up">
At sparklerpro we know that even the best product is only as good as the people behind it. </p> --
        </div>-->

        <div class="row">
<div class="col-xl-4 col-lg-4 mt-4" data-aos="fade-up">
            <div class="info-box">
              <i class="bx bx-map"></i>
              <h3>Our Address</h3>
              <p>West Tambaram,<br>Chennai</p>
            </div>
          </div>

          <div class="col-xl-4 col-lg-4 mt-4" data-aos="fade-up" data-aos-delay="100">
            <div class="info-box">
              <i class="bx bx-envelope"></i>
              <h3>Email Us</h3>
              <p>info@sparklerpro.com</p>
			  <p>support@sparklerpro.com</p>
            </div>
          </div>
          <div class="col-xl-4 col-lg-4 mt-4" data-aos="fade-up" data-aos-delay="200">
            <div class="info-box">
              <i class="bx bx-phone-call"></i>
              <h3>Call Us</h3>
              <p>+ 988 430 1084<br>+ 63 945 402 1171</p>
            </div>
          </div>
          
        </div>

        <div class="row">
		<div class="col-xl-6 col-lg-12 mt-4">
		</br>
           <h2 >We’re here to help
</h2>
          <p class="font">At Sparklerpro we ease the process for you and make things seamless. We listen to your requirements with utmost attention so that we not only understand your requirements but also analyze and suggest the best approach possible for your development.</p>
          <ul>
		  <li>Share your Requirement
		  <p class="font">We keenly analyze the requirements that you provide. This makes things transparent from the beginning between us and further eases the overall development process.</p>
<!--  <li>Share your Requirement 
		<!-- <p class="font">We keenly analyze the requirements that you provide. This makes things transparent from the beginning between us and further eases the overall development process</p>
		<li>Share your Requirement
		  <p class="font">We keenly analyze the requirements that you provide. This makes things transparent from the beginning between us and further eases the overall development process</p>
	<li>Share your Requirement
		  <p class="font">We keenly analyze the requirements that you provide. This makes things transparent from the beginning between us and further eases the overall development process</p>
	  		 --->
		 </ul>
		  </div>
          <div class="col-xl-6 col-lg-12 mt-4"></br>
		   <h2 >GET A QUOTE
</h2>
            <form action="" method="post" enctype="multipart/form-data">
                <div class="form-group">
                  <input type="text" name="sender_name" class="form-control" id="name" placeholder="Your Name" required/>
				 
                  <div class="validate"></div>
                </div>
                <div class="form-group">
                  <input type="email" class="form-control" name="sender_email" id="email" placeholder="Your Email"  required/>
                  <div class="validate"></div>
                </div>
              
			  <div class="form-group">
			  <input type="number" id="phone" name="mobilenumber" class="form-control" placeholder="123-456-7890"  pattern="[0-9]{3}-[0-9]{3}-[0-9]{4}"
       required>
                <div class="validate"></div>
              </div>
			  <div class="form-group">
                <input type="text" class="form-control" name="cname" id="subject" placeholder="Please Enter company Name"  required/>
                <div class="validate"></div>
              </div>
			  <div class="form-group">
			  <input type="url" name="website" id="url" class="form-control" placeholder="https://example.com"   size="30"  required>
              </div>
              <div class="form-group">
			   <select name="services" id="services" class="form-control">
                     <option value="" disabled selected>Choose Services</option>
                     <option value="Logo Design">Logo Design</option>
                     <option value="Web Development">Web Development</option>
                     <option value="Social Media Marketing">Social Media Marketing</option>
                     <option value="Media Marketing">Media Marketing</option>
                     <option value="Mobile App Development">Mobile App Development</option>
					 <option value="Mobile App Development">Software Development</option>
					 <option value="Mobile App Development">2D & 3D Animation</option>
					 <option value="Mobile App Development">Media Related Products</option>
               </select>
              <!--   <input type="text" class="form-control" name="services" id="subject" placeholder="Please Enter Services" required/>
                <div class="validate"></div>-->
              </div>
			   <div class="form-group">
                <input type="number" class="form-control" name="budget" id="subject" placeholder="Please Enter Budget" required/>
                <div class="validate"></div>
              </div>
              <div class="form-group">
                <textarea class="form-control" class="form-control" name="description" rows="5"  placeholder="Message"></textarea>
                <div class="validate"></div>
              </div>
			   <div class="form-group">
                <input type="file" name="my_files[]" class="form-control" multiple/>
                <div class="validate"></div>
              </div>
              <div class="mb-3">
                
              </div>
              <div class="form-group"><input type="submit" name="submit" class="btn btn-info" value="Submit" style="padding:10px;width:100%;"/></div>
            </form>
          </div>

        </div>
       </div>
      </div>
    </section>


   <!-- About social -->
   <section class="team section-bg">
<div class="text-center about">
  <div class="section-title">
    <h2 data-aos="fade-up">
      Want To Get Updated Regularly?
      </h2>
    <p data-aos="fade-up">Follow us on social media to get our regular updates</p>
  </div>

  <div class="social-menu">
    <ul>
      <li><a href="https://instagram.com/sparklerpro"><i class="fa fa-instagram"></i></a></li>
      <li><a href="https://twitter.com/SparklerPro"><i class="fa fa-twitter"></i></a></li>
      <li><a href="https://www.facebook.com/sparklerpro"><i class="fa fa-facebook"></i></a></li>
      <li><a href="https://www.linkedin.com/company/sparklerpro/mycompany/"><i class="fa fa-linkedin"></i></a></li>
      
    </ul>


  </div>
</div></section>
    
  </main><!-- End #main -->

  <!-- ======= Footer ======= -->
  <footer id="footer">

    <div style="background-color: rgb(14, 14, 14);color:white" class="footer-top">
      <div class="container">
        <div class="row">

          <div class="col-lg-3 col-md-6 footer-contact">
            <h3>SparklerPro</h3>
            <p style="color:rgb(197, 194, 194)">
              We are solution finders for all <br>your business needs. We are specialized on providing the<br>complete IT needs for the new <br>and existing business entrepreneurs. 
              </p>
          </div>

          <div class="col-lg-2 col-md-6 footer-links">
            <h4  style="color:white">Useful Links</h4>
            <ul >
              <li><i class="bx bx-chevron-right"></i> <a href="#">Home</a></li>
              <li><i class="bx bx-chevron-right"></i> <a href="#">About us</a></li>
              <li><i class="bx bx-chevron-right"></i> <a href="#">Services</a></li>
              <li><i class="bx bx-chevron-right"></i> <a href="#">Samples</a></li>
              <li><i class="bx bx-chevron-right"></i> <a href="#">Contact</a></li>
              <li><i class="bx bx-chevron-right"></i> <a href="#">Terms of service</a></li>
              <li><i class="bx bx-chevron-right"></i> <a href="#">Privacy policy</a></li>
            </ul>
          </div>

          <div class="col-lg-3 col-md-6 footer-links">
            <h4  style="color:white">Our Services</h4>
            <ul>
              <li><i class="bx bx-chevron-right"></i> <a href="#">Logo Design</a></li>
              <li><i class="bx bx-chevron-right"></i> <a href="#">Web Development</a></li>
              <li><i class="bx bx-chevron-right"></i> <a href="#">App Development</a></li>
              <li><i class="bx bx-chevron-right"></i> <a href="#">Software Development</a></li>
              <li><i class="bx bx-chevron-right"></i> <a href="#">Product Photography</a></li>
              <li><i class="bx bx-chevron-right"></i> <a href="#">Video Editing</a></li>
              <li><i class="bx bx-chevron-right"></i> <a href="#">2 D/3 D Animation</a></li>
              <li><i class="bx bx-chevron-right"></i> <a href="#">Digital Marketing</a></li>
              <li><i class="bx bx-chevron-right"></i> <a href="#">Graphic Design</a></li>
              <li><i class="bx bx-chevron-right"></i> <a href="#">Music Production</a></li>
            </ul>
          </div>

          <div class="col-lg-4 col-md-6 footer-newsletter">
            <h4  style="color:white">Join Our Newsletter</h4>
            <p style="color:rgb(197, 194, 194)">Don’t miss out! Join our newsletter for exclusive updates on services delivered straight to your inbox.</p>
            <form action="" method="post">
              <input type="email" name="email"><input type="submit" value="Subscribe">
            </form>
          </div>

        </div>
      </div>
    </div>

    <div style="background-color: rgb(41, 41, 41);color:white" class="container-fluid d-lg-flex py-4">

      <div class="mr-lg-auto text-center text-lg-left">
        <div class="copyright">
          &copy; Copyright <strong><span>SparklerPro</span></strong>. All Rights Reserved 2020
        </div>
       
      </div>
     
    </div>
  </footer><!-- End Footer -->

  <a href="#" class="back-to-top"><i class="icofont-simple-up"></i></a>

  <!-- Vendor JS Files -->
  <script src="assets/vendor/jquery/jquery.min.js"></script>
  <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="assets/vendor/jquery.easing/jquery.easing.min.js"></script>
  <script src="assets/vendor/jquery-sticky/jquery.sticky.js"></script>
  <script src="assets/vendor/venobox/venobox.min.js"></script>
  <script src="assets/vendor/owl.carousel/owl.carousel.min.js"></script>
  <script src="assets/vendor/isotope-layout/isotope.pkgd.min.js"></script>
  <script src="assets/vendor/aos/aos.js"></script>
  <script src="assets/vendor/waypoints/jquery.waypoints.min.js"></script>
  <script src="assets/vendor/counterup/counterup.min.js"></script>
  <script src="assets/vendor/typed.js/typed.min.js"></script>
  <script src="https://unpkg.com/boxicons@latest/dist/boxicons.js"></script>
  <!-- Template Main JS File -->
  <script src="assets/js/main.js"></script>




</body>

</html>