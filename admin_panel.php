<?php
  include 'header.php';
  require 'config.php';
  ?>
<nav>
<div class="navbar">
  	<div class="subnav">
    	<button class="navbtn">Home</button>
    		<div class="subnav-content">
      			<a href="it_news.php">IT News</a>
      			<a href="it_devices.php">IT Devices</a>
      			<a href="it_jobs.php">IT Jobs</a>
			</div>
		</div>
			<a href="about.php">About Us</a>
			<a href="contact.php">Contact</a>
			<a href="addpost.php">Add post</a>
			<a href="delete_post.php">Delete post</a>

			<div class="right">
				<a href="register.php">Log in</a>
				<a href="logout.php">Log out</a>
			</div>
		</div>
	</nav>