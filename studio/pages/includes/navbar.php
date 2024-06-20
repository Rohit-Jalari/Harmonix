<nav class="layout-navbar container-xxl navbar navbar-expand-xl navbar-detached align-items-center  bg-navbar-theme" id="layout-navbar" style="position: sticky;box-shadow: white;box-shadow: 0px 10px 0px 0px #232333,0px -10px 0px 0px #232333;" >
	<div class="layout-menu-toggle navbar-nav align-items-xl-center me-3 me-xl-0 d-xl-none">
		<a class="nav-item nav-link px-0 me-xl-4" href="javascript:void(0)">
			<i class="bx bx-menu bx-sm"></i>
		</a>
	</div>

	<div class="navbar-nav-right d-flex align-items-center" id="navbar-collapse">

		<ul class="navbar-nav flex-row align-items-center ms-auto">
			<!-- Place this tag where you want the button to render. -->
			<li class="nav-item me-3 d-none d-sm-block">
				<div class="btn-group" role="group">
					<?php if(!$loggedIn) { ?>
					<a class="nav-link me-1" href="../pages/login.php"><i class="tf-icons navbar-icon bx bx-user"></i>Login</a>
					<a class="nav-link me-1" href="../pages/register.php"><i class="tf-icons navbar-icon bx bx-user-plus me-1" style="font-size: 1.5rem;"></i>Register</a>
					<?php }
					if($loggedIn) {?>
					<a class="nav-link me-1" href="../pages/logout.php"><i class="tf-icons navbar-icon bx bx-lock-open-alt"></i> Logout</a>
					<?php } ?>
				</div>
			</li>

			<!-- User -->
			<li class="nav-item navbar-dropdown dropdown-user dropdown">
				<a class="nav-link dropdown-toggle hide-arrow" href="javascript:void(0);" data-bs-toggle="dropdown">
					<div class="avatar avatar-online">
						<img src="" alt class="w-px-40 h-auto rounded-circle" />
					</div>
				</a>
				<ul class="dropdown-menu dropdown-menu-end">
					<li>
						<a class="dropdown-item" href="#">
							<div class="d-flex">
								<div class="flex-shrink-0 me-3">
									<div class="avatar avatar-online">
										<img src="" alt class="w-px-40 h-auto rounded-circle" />
									</div>
								</div>
								<div class="flex-grow-1">
									<span class="fw-semibold d-block">John Doe</span>
									<small class="text-muted">Admin</small>
								</div>
							</div>
						</a>
					</li>
					<li>
						<div class="dropdown-divider"></div>
					</li>
					<li>
						<a class="dropdown-item" href="#">
							<i class="bx bx-user me-2"></i>
							<span class="align-middle">My Profile</span>
						</a>
					</li>
					<li>
						<a class="dropdown-item" href="#">
							<i class="bx bx-cog me-2"></i>
							<span class="align-middle">Settings</span>
						</a>
					</li>
				</ul>
			</li>
			<!--/ User -->
		</ul>
	</div>
</nav>
<div id="navShadow"> </div>