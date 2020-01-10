

<div class="htlfndr-top-header">
					<div class="navbar navbar-default htlfndr-blue-hover-nav">
						<div class="container">
							<!-- Brand and toggle get grouped for better mobile display -->
							<div class="navbar-header">
								<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#htlfndr-first-nav">
									<span class="sr-only">Toggle navigation</span>
									<span class="icon-bar"></span>
									<span class="icon-bar"></span>
									<span class="icon-bar"></span>
								</button>
								<a class="htlfndr-logo navbar-brand" href="index.php">
									<img src="images/home.png" alt="Logo" style="height: 30px;margin-top: -5px;" />
									<p class="htlfndr-logo-text">Ba<span>sera</span></p>
								</a>
							</div><!-- .navbar-header -->
							<!-- Collect the nav links, forms, and other content for toggling -->
							<div class="collapse navbar-collapse navbar-right" id="htlfndr-first-nav">
								<!-- List with sing up/sing in links -->
								<ul class="nav navbar-nav htlfndr-singup-block">
							<?php 
							if(isset($_SESSION['CustId']))
							{
							?>
		
								<li  class="dropdown">
							<a href="#" onclick="return false;">Hey! <?php echo $_SESSION['CustName']; ?></a>
						<ul class="dropdown-menu">	
											<li><a href="user-page.php">User Profile</a></li>
											<li><a href="logout.php">Log Out</a></li>
																						
						
										</ul>
									</li>
								
							<?php
							}
							else
							{
							?>
								<li id="htlfndr-singup-link">
									<a href="#" data-toggle="modal" data-target="#htlfndr-sing-up"><span>sign up</span></a>
								</li>
								<li id="htlfndr-singin-link">
									<a href="#" data-toggle="modal" data-target="#htlfndr-sing-in"><span>sign in</span></a>
								</li></ul>
							<?php
							}
							?>

								<!-- .htlfndr-singup-block -->
								<!-- List with currency and language dropdons -->
								
								<!-- .htlfndr-top-menu-dropdowns -->
							</div><!-- .collapse.navbar-collapse -->
						</div><!-- .container -->
					</div><!-- .navbar.navbar-default.htlfndr-blue-hover-nav-->
				</div>