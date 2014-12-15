<?php 

	session_start();
	require_once "assets/functions.php";

	$navigation_object = new Navigation();

 ?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<base href="/ratehat-v3/">
	<!-- <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no"> -->
	<title>RateHat</title>
	<link rel="shortcut icon" href="assets/images/favicon.ico">

	<link href='http://fonts.googleapis.com/css?family=Roboto:400,500|Roboto+Condensed:400,500' rel='stylesheet' type='text/css'>
	<link rel="stylesheet" type="text/css" href="assets/styles/main-style.css">

	<script type="text/javascript" src="assets/scripts/jquery-2.1.0.min.js"></script>
	<script type="text/javascript" src="assets/scripts/jquery-ui.js"></script>
	<script type="text/javascript" src="assets/scripts/script.js"></script>

	<link rel="import" href="http://www.polymer-project.org/components/paper-ripple/paper-ripple.html">
	<!-- PUT <paper-ripple fit></paper-ripple> at the end of clickable position: relative|absolute elements -->

	<script type="text/javascript">

		function set_active(item) { 
			$('.navigation-item').removeClass('active');
			$(item).addClass('active');
		}

		function load_page(page) {
			$('#loading-spinner').animate({'top':'15px'}, 300, 'easeOutBack');
			$.ajax({

				url:"pages.php?page="+page,
				success:function(result) {
					$(".main-page").html(result);
					$('#loading-spinner').stop().clearQueue().delay(1000).animate({'top':'-100px'}, 300, 'easeInCirc');
				}

			});
			var new_url = (page == "Home") ? "" : "page/"+page.toLowerCase();
			window.history.pushState(page, page+" | RateHat", new_url);
		}

	</script>

</head>
<body>
	<div id="loading-spinner">Loading...</div>

	<header class="primary-header">
		<img class="logo" src="assets/images/logo.png">
		<section class="user-account condensed">
			<div class="user-name">desmond1303@gmail.com</div>
			<img class="user-image" src="assets/images/user.jpg">
		</section>
	</header>
	<nav class="primary-navigation">
		<?php $navigation_object->output(); ?>
	</nav>

	<section class="main-page">
	<?php 

	$requested_page = (isset($_GET['page'])) ? strtolower($_GET['page']) : "home";
	require_once 'pages.php';

	?>
	</section>

	<footer class="primary-footer">
		<section class="footer-container">
			<div class="footer-row">
				<h4>About</h4>
				<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
			</div>
			<?php $navigation_object->output('footer'); ?>
		</section>
	</footer>

</body>
</html>