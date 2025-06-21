		<?php
			$this->load->view('layout/header');
		?>
			<title>International Journal of Pharmaceutical Sciences | Open Access</title>
			<meta name="description" content="A monthly Journal, which publishes original research works that contributes significantly to further the scientific knowledge in Pharmaceutical Sciences"/>
			<meta name="keywords" content="International J Pharm Sci, Current issue, Pharmaceutical Sciences, ijps in press, Pharmacology, IJPS journal, Pharmaceutics, Biotechnology"/>
			<meta name="ROBOTS" content="INDEX,FOLLOW">
			<meta name="googlebot" content="INDEX,FOLLOW">
			<link rel="canonical" href="https://www.ijpsjournal.com/">
			<meta name="google-site-verification" content="NWPs0gb3v6ZfzcYZFoAVRsLGjIGgsZTQVzCxpXiankM" />
			<meta property="og:title" content="International Journal of Pharmaceutical Sciences">
			<meta property="og:site_name" content="ijpsjournal" >
			<meta property="og:url" content="https://www.ijpsjournal.com/">
			<meta property="og:description" content="A monthly Journal, which publishes original research works that contributes significantly to further the scientific knowledge in Pharmaceutical Sciences">
			<meta property="og:type" content="article">
			<meta property="og:image" content="https://www.ijpsjournal.com/public/Front/assets/images/logoup.jpg">
			<meta name="twitter:card" content="summary">
			<meta name="twitter:site" content="@int_j_pharm_sci">
			<meta name="twitter:title" content="International Journal of Pharmaceutical Sciences">
			<meta name="twitter:description" content="A monthly Journal, which publishes original research works that contributes significantly to further the scientific knowledge in Pharmaceutical Sciences.">
			<meta name="twitter:image" content="https://www.ijpsjournal.com/public/Front/assets/images/logoup.jpg">
			
<?php
    $this->load->view('layout/menu');
    $this->load->helper('date');
    $this->load->view('layout/headersection');
?>
    <script src="https://www.google.com/recaptcha/api.js" async defer></script> 
<div class="container mt-2 mb-5">
    <div class="register-form">
        <h2>Register</h2>

        <form method="post" enctype="multipart/form-data" id='registerForm' action="<?php echo site_url('register-save'); ?>">
            <input type="hidden" name="_token" value="JKWaLf3KZoODjRlXeMJuFLVpstJS2A4XQjcfwKDm">  
            
            <!-- Name Section -->
            <div class="form-group">
                <label>Name</label>
                <input type="text" name="txtName" class="form-control" placeholder="Name" maxlength="30" 
                    pattern="^[a-zA-Z\s]+$" 
                    title="Name cannot contain links or special characters. Only letters and spaces are allowed.">
                <span class="text-danger"></span>
            </div>

            <!-- Email Section -->
            <div class="form-group">
                <label>Email</label>
                <input type="email" name="txtEmail" class="form-control" placeholder="Email" maxlength="50"
                    pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$" 
                    title="Please enter a valid email address.">
                <span class="text-danger"></span>
            </div>

            <!-- Phone Section -->
            <div class="form-group">
                <label>Phone</label>
                <input type="tel" name="txtPhone" class="form-control" placeholder="Phone" maxlength="15" minlength="10"
                    pattern="[0-9]{10,15}" 
                    title="Please enter a valid phone number (10-15 digits).">
                <span class="text-danger"></span>
            </div>
            
            <div class="clearfix"></div>
            <div class="g-recaptcha mt-3" data-sitekey="6LenUIspAAAAALN-PhdYlCF92Z9RJpNTHXCeriEm"></div>
            <br>
            <button type="submit">Register Now</button>
        </form>
    </div>
</div>
<?php 
    $this->load->view('layout/footer');
    $this->load->view('layout/jsfiles');
?>
