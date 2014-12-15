<?php 
require_once "assets/functions.php";
 if(!isset($requested_page)) $requested_page = (isset($_GET['page'])) ? strtolower($_GET['page']) : "home";

switch ($requested_page) {
	case 'home': ?>
	<script type="text/javascript"> set_active('.nav-home'); </script>
	<article class="main-article hoverable">
		<h1>Test Article</h1>
		<p><a href="#">Just some body</a> text lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim adminim veniam, quis nostrud exercitation <a href="#">ullamco laboris nisi ut aliquip ex ea commodo</a> consequat. Duis aute irure dolor in reprehenderit in voluptate velit essecillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
		<hr>
	</article>
	<?php
	break;

	case 'about': ?>
	<script type="text/javascript"> set_active('.nav-about'); </script>
	<article class="main-article">
		<h1>Who are we ?</h1>
		<p><a href="#">Just some body</a> text lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim adminim veniam, quis nostrud exercitation <a href="#">ullamco laboris nisi ut aliquip ex ea commodo</a> consequat. Duis aute irure dolor in reprehenderit in voluptate velit essecillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
		<hr>
	</article>
	<article class="main-article">
		<h1>What do we do ?</h1>
		<p><a href="#">Just some body</a> text lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim adminim veniam, quis nostrud exercitation <a href="#">ullamco laboris nisi ut aliquip ex ea commodo</a> consequat. Duis aute irure dolor in reprehenderit in voluptate velit essecillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
		<hr>
	</article>
	<article class="main-article">
		<h1>Who is this for ?</h1>
		<p><a href="#">Just some body</a> text lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim adminim veniam, quis nostrud exercitation <a href="#">ullamco laboris nisi ut aliquip ex ea commodo</a> consequat. Duis aute irure dolor in reprehenderit in voluptate velit essecillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
		<hr>
	</article>
	<article class="main-article">
		<h1>Why me made it ?</h1>
		<p><a href="#">Just some body</a> text lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim adminim veniam, quis nostrud exercitation <a href="#">ullamco laboris nisi ut aliquip ex ea commodo</a> consequat. Duis aute irure dolor in reprehenderit in voluptate velit essecillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
		<hr>
	</article>
		<?php
		break;

	case 'contact': ?>
		<script type="text/javascript"> set_active('.nav-contact'); </script>
		<article class="main-article">
			<h1>Contact Page</h1>
		</article>
		<?php
		break;

	case 'categories': ?>
		<script type="text/javascript"> set_active('.nav-categories'); </script>
		<article class="main-article">
			<h1>Category Page</h1>
		</article>
		<?php
		break;
	
	default:
		echo "page does not exits";
		break;
}

?>