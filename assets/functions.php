<?php

	global $conn_host, $conn_user, $conn_pass, $conn_db, $conn_charset;
	$conn_host = "localhost";
	$conn_user = "executionist";
	$conn_pass = "password";
	$conn_db = "ratehat";
	$conn_charset = "utf8";

	class UserAccount {

		private $user_logged, $user_name, $user_email, $user_type;
		
		public function __construct($command = null) {

			global $conn_host, $conn_user, $conn_pass, $conn_db, $conn_charset;
			$conn = new mysqli($conn_host, $conn_user, $conn_pass, $conn_db);
			$conn->set_charset($conn_charset);

			if(
				isset($_SESSION["user_name"], $_SESSION["user_email"], $_SESSION["user_type"]) &&
				(!empty($_SESSION["user_name"]) && !empty($_SESSION["user_email"]) && !empty($_SESSION["user_type"]))
			) {
				$this->user_logged = true;
				$this->user_name = $_SESSION["user_name"];
				$this->user_email = $_SESSION["user_email"];
				$this->user_type = $_SESSION["user_type"];
			}
			else {
				$this->user_logged = false;
			}

			switch ($command) {
				case 'user-controls':
					$this->showUserControls($this->user_logged);
					break;

				case 'rating-controls':
					$this->showRatingControls($this->user_logged);
					break;

				default:
					echo "Error: Undefined Command";
					break;
			} // End of Swtich

			$conn->close();
			unset($conn);

		} // End of __construct

		private function showUserControls($user_log_status) {
			
			echo "<section class=\"user-controls-container f-right\">\n\t\t\t\t\t";
			if($user_log_status) {
				// Display user credentials
				echo "User credentials\n";
			}
			else {
				// Display Login / Create account Buttons
				echo "<a class=\"button f-right popup\" href=\"#create-account-form\"><i class=\"fa fa-plus-square\"></i>Create Account<paper-ripple fit></paper-ripple></a>\n\t\t\t\t\t<a class=\"button f-right popup\" href=\"#login-form\"><i class=\"fa fa-sign-in\"></i>Login<paper-ripple fit></paper-ripple></a>\n\n\t\t\t\t\t<div id=\"create-account-form\" style=\"display:none;\">";

				$this->showCreateAccount();

				echo "\t\t\t</div>\n\t\t\t\t\t<div id=\"login-form\" style=\"display:none;\">";
				
				$this->showLogin();

				echo "\t\t\t</div>\n";
			}
			echo "\t\t\t\t</section>\n";

		} // End of showUserControls

		private function showRatingControls($user_log_status) {
			
			if($user_log_status) {
				// Display rating controls
				echo "User credentials\n";
			}
			else {
				echo "You must be logged in to rate\n";
			}

		} // End of showRatingControls

		private function showLogin() {
			
			// Display login form
			$request_from = "login";
			require 'forms.php';
			unset($request_from);

		} // End of showLogin

		private function showCreateAccount() {
			
			// Display account creation form
			$request_from = "create-account";
			require 'forms.php';
			unset($request_from);

		} // End of showCreateAccount

	} // END of UserAccount

	class Categories {

		protected $category_id, $category_name, $category_description, $category_icon, $category_count;
		private $query_categories, $fetch_categories;

		public function __construct() {

			global $conn_host, $conn_user, $conn_pass, $conn_db, $conn_charset;
			$conn = new mysqli($conn_host, $conn_user, $conn_pass, $conn_db);
			$conn->set_charset($conn_charset);

			$this->query_categories = $conn->query("CALL getCategories()");
			$this->category_count = 0;
			while($this->fetch_categories = $this->query_categories->fetch_assoc()){
				$this->category_id[] = $this->fetch_categories['id'];
				$this->category_name[] = $this->fetch_categories['name'];
				$this->category_description[] = $this->fetch_categories['description'];
				$this->category_icon[] = $this->fetch_categories['icon_class'];
				$this->category_count ++;
			}

			$conn->close();
			unset($conn);

		} // End of __construct

	} // END of Categories

	class Items extends Categories {

		protected $item_id, $item_name, $item_summary, $item_description, $item_location, $item_category_id, $item_count;
		private $query_preset, $query_preset_annex, $query_items, $fetch_items;
		
		public function __construct($display_category = "all") {

			parent::__construct();

			global $conn_host, $conn_user, $conn_pass, $conn_db, $conn_charset;
			$conn = new mysqli($conn_host, $conn_user, $conn_pass, $conn_db);
			$conn->set_charset($conn_charset);

			switch ($display_category) {
				case 'all':
					$this->query_items = $conn->query("CALL getItems('')");
					break;
				
				default:
					$this->query_items = $conn->query("CALL getItems('{$display_category}')");
					break;
			} // End of Switch

			$this->item_count = 0;
			while($this->fetch_items = $this->query_items->fetch_assoc()){
				$this->item_id[] = $this->fetch_items['id'];
				$this->item_name[] = $this->fetch_items['name'];
				$this->item_summary[] = $this->fetch_items['summary'];
				$this->item_description[] = $this->fetch_items['description'];
				$this->item_location[] = $this->fetch_items['location'];
				$this->item_category_name[] = $this->fetch_items['category_name'];
				$this->item_count ++;
			}

			$conn->close();
			unset($conn);

		} // End of __construct

		private function output() {

			for ($i=0; $i < $this->item_count; $i++) {
					echo "<a class=\"item-block\" href=\"categories/".strtolower(str_replace(' ','-',$this->item_category_name[$i]))."/{$this->item_id[$i]}\"><h5 class=\"item-name\">{$this->item_name[$i]}</h5><p class=\"item-summary\">{$this->item_summary[$i]}</p></a>\n\t";
				}

		} // End of output

	} // END of Items

	class Navigation extends Items {

		protected $nav_item_id, $nav_item_title, $nav_item_class, $nav_item_link, $nav_item_count;
		private $query_nav_items, $fetch_nav_items;

		public function __construct() {
			
			parent::__construct();

			global $conn_host, $conn_user, $conn_pass, $conn_db, $conn_charset;
			$conn = new mysqli($conn_host, $conn_user, $conn_pass, $conn_db);
			$conn->set_charset($conn_charset);

			$this->query_nav_items = $conn->query("CALL getNavigation('en')");
			$this->nav_item_count = 0;
			while($this->fetch_nav_items = $this->query_nav_items->fetch_assoc()){
				$this->nav_item_id[] = $this->fetch_nav_items['id'];
				$this->nav_item_title[] = $this->fetch_nav_items['title'];
				$this->nav_item_class[] = $this->fetch_nav_items['class'];
				$this->nav_item_link[] = $this->fetch_nav_items['link'];
				$this->nav_item_count++;
			}

			$conn->close();
			unset($conn);
			
		} // End of __construct

		public function output($navigation_type = "primary") {

			if($navigation_type != "primary" && $navigation_type != "secondary" && $navigation_type != "footer") {
				echo "Undefined Navigation Type";
				exit;
			}

			if($navigation_type == "primary") {
				echo "<ul class=\"navigation-container\">\n";
				for ($i=0; $i < $this->nav_item_count; $i++) { 
					echo "\t\t\t<a class=\"navigation-item {$this->nav_item_class[$i]}\" onClick=\"load_page('{$this->nav_item_link[$i]}');\">{$this->nav_item_title[$i]}<paper-ripple fit></paper-ripple></a>\n";
				}
				echo "\t\t</ul>\n";
			}
			else if($navigation_type == "footer") {
				echo "<div class=\"footer-navigation footer-row\">\n";
				for ($i=0; $i < $this->nav_item_count; $i++) { 
					echo "\t\t\t<a class=\"footer-navigation-item\" onClick=\"load_page('{$this->nav_item_title[$i]}');\">{$this->nav_item_title[$i]}</a>\n";
				}
				echo "\t\t</div>\n";
			}

		}

	} // END of Navigation

?>