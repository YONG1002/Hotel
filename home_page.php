<!DOCTYPE HTML>
<html>
<head>
    <title>Home Page</title>
    <style>
        body {
            margin: 0;
            padding: 0;
            font-family: Arial, sans-serif;
            background-color: #f5f5f5;
        }
        
        header {
            background-color: #FFA500;
            padding: 20px;
            box-shadow: 0px 3px 6px rgba(0, 0, 0, 0.16);
            display: flex;
            justify-content: space-between;
            align-items: center;
            position: fixed;
            top: 0;
            width: 97.5%;
            z-index: 999;
        }
        
        h1 {
            margin: 0;
            font-size: 32px;
            color: #fff;
        }
        
        nav {
            display: flex;
            align-items: center;
        }
        
        nav a {
            text-decoration: none;
            color: #fff;
            font-size: 18px;
            margin-left: 20px;
            transition: all 0.3s ease-in-out;
        }
        
        nav a:hover {
            color: #f5f5f5;
            transform: scale(1.1);
        }
        
        .home-content {
    text-align: center;
    margin: 100px auto;
    border: 2px solid #ccc;
    height: 250px;
    width: 600px;
    font-size: 20px;
    padding: 20px;
    border-radius: 5px;
}
        
        .home-content h2 {
            font-size: 24px;
            margin-bottom: 10px;
        }
        
        .about-us {
            text-align: center;
            margin: 120px auto 40px;
        }
        
        .about-us h2 {
            font-size: 24px;
            margin-bottom: 10px;
        }
        
        .team-container {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            grid-gap: 20px;
            justify-items: center;
            margin: 0 20px;
        }
        
        .team-member {
            width: 550px;
            height: 450px;
            background-color: #fff;
            padding: 20px;
            text-align: center;
            box-shadow: 0px 3px 6px rgba(0, 0, 0, 0.16);
            border-radius: 5px;
        }
        
        .team-member img {
            width: 150px;
            height: 150px;
            border-radius: 50%;
            object-fit: cover;
            margin-bottom: 20px;
        }
        
        .team-member h3 {
            margin: 0;
            font-size: 20px;
            color: #333;
        }
        
        .team-member p {
            font-size: 14px;
            color: #666;
            margin: 10px 0;
        }
        
        .contact-us {
            margin: 50px auto 40px;
        }
        
        .contact-us h2 {
            font-size: 24px;
            margin-bottom: 10px;
        }
		
		.contact-info {
            display: flex;
            align-items: center;
            margin-bottom: 20px;
            margin-left: 20px;
        }

        .contact-info img {
            width: 30px;
            height: 30px;
            margin-right: 10px;
        }

        .social-media a {
            margin-right: 10px;
        }

        .social-media img {
            width: 30px;
            margin-left: 20px;
        }
    </style>
    
    
</head>

<body>
    <header>
        <h1>Booking Homestay</h1>
        <nav>
			<a href="#about-us">About Us</a>
            <a href="#contact-us">Contact Us</a>
            <a href="login_page.php">Login</a>
			<a href="signup_page.php">Sign Up</a>
            
        </nav>
    </header>
    
    <div class="home-content">
    <h2>Welcome to Booking Homestay!</h2>
    <p>Experience the ultimate comfort and personalized hospitality of homestays with our website. Sign up today to unlock exclusive deals and create your account, taking the first step towards discovering and booking your dream homestay.</p>
    <div style="padding: 25px;" >
        <a href="signup_page.php" style="padding: 10px 20px; background-color: #FFA500; color: #fff; text-decoration: none; border-radius: 5px; font-weight: bold;">Sign Up Now</a>
    </div>
</div>
    
    <div class="about-us" id="about-us">
        
		<br><br><br><br><h2>About Us</h2>
    </div>
    
    <div class="team-container">
        <div class="team-member">
            <img src="http://localhost/Homestay_Reservation_System/Image/002.jpg" alt="Person 1">
            <h3>LIM FANG YONG</h3>
            <p>Web Developer</p>
            <p>FANG YONG has a strong passion for coding and creating innovative digital solutions. His extensive knowledge and expertise in various programming languages and frameworks enables them to build robust and efficient websites and web applications. They are proficient in both front-end and back-end development, ensuring seamless functionality and the best user experience. He is always eager to take on new challenges and keep abreast of the latest industry trends. You will be impressed by his technical prowess and ability to bring ideas to life.</p>
        </div>
        <div class="team-member">
            <img src="http://localhost/Homestay_Reservation_System/Image/003.jpg" alt="Person 2">
            <h3>SOH HAN YUAN</h3>
            <p>Web Developer</p>
            <p>HAN YUAN is a skilled web developer. They have an uncanny ability to turn complex ideas into functional and visually appealing websites. He is proficient in multiple programming languages and frameworks, including HTML, CSS, JavaScript, and more. Their expertise extends to front-end and back-end development, enabling them to create seamless user interfaces and powerful server-side functionality. He is passionate about staying up-to-date on emerging technologies and best practices, ensuring they deliver cutting-edge solutions.</p>
        </div>
        <div class="team-member">
            <img src="http://localhost/Homestay_Reservation_System/Image/004.jpg" alt="Person 3">
            <h3>LIM PING LIANG</h3>
            <p>Web Designer</p>
            <p>PING LIANG has a strong passion for creating beautiful and functional websites, a keen eye for design and a wealth of knowledge in web development. They excel at turning ideas into engaging digital experiences. You will be impressed by his work and expertise in the field of web design.</p>
        </div>
        <div class="team-member">
            <img src="http://localhost/Homestay_Reservation_System/Image/005.jpg" alt="Person 4">
            <h3>CHEN HOE MUM</h3>
            <p>Web Designer</p>
            <p>HOE MUM has an extraordinary ability to blend creativity and technical skills to create visually stunning and user-friendly websites. He has a proven track record of delivering successful web projects, ensuring seamless functionality and captivating aesthetics. He keeps up with the latest design trends and specializes in implementing responsive design for the best user experience across devices.</p>
        </div>
    </div>
    
    <div class="contact-us" id="contact-us" style="border: 2px solid black; width: 800px; height: 550px;">
    <h2 style="text-align:center;">Contact Us</h2>
	<div style="display: grid; grid-template-columns: 1fr 1fr; grid-template-rows: 1fr 1fr;">
		<div class="contact-info" style="grid-column: 1; grid-row: 1;">
			<img src="http://localhost/Homestay_Reservation_System/Image/006.jpg" alt="Contact Icon">
			<div>
				<p><strong>Address</strong></p>
				<p>No 123 Jalan Homestay 4/5</p>
				<p>Tamam Homestay</p>
				<p>67890 Johor Bahru</p>
				<p>Johor</p>
			</div>
		</div>
		<div class="contact-info" style="grid-column: 2; grid-row: 1;">
			<img src="http://localhost/Homestay_Reservation_System/Image/007.jpg" alt="Email Icon">
			<div>
				<p><strong>Email</strong></p>
				<p>bookinghomestay@gmail.com</p>
			</div>
		</div>
		<div class="contact-info" style="grid-column: 1; grid-row: 2;">
			<img src="http://localhost/Homestay_Reservation_System/Image/008.jpg" alt="Phone Icon">
			<div>
				<p><strong>Contact Number</strong></p>
				<p>012 34567890</p>
			</div>
		</div>
	</div>
    <div class="social-media" style="text-align:center;">
        <a href="https://www.facebook.com"><img src="http://localhost/Homestay_Reservation_System/Image/009.jpg" alt="Facebook"></a>
        <a href="https://www.instagram.com"><img src="http://localhost/Homestay_Reservation_System/Image/010.jpg"></a>
        <a href="https://twitter.com"><img src="http://localhost/Homestay_Reservation_System/Image/011.jpg" alt="Twitter"></a>
    </div>
</div>



</body>
</html>
