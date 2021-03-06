
<!-- DEFAULT LAYOUT -->

<!DOCTYPE html>
<html>
	<head>
		<title>
			<?php /* if a $page_title variable is set, include it it the title tag */ ?>
			<?php if ( isset($page_title) ): ?>
				<?php echo $page_title . ' | '; ?>
			<?php endif; ?>
			EnviroMon
		</title>
		<meta name="viewport" 
			content="width=device-width, minimum-scale=1.0, maximum-scale=1.0">
		<link rel="stylesheet" type="text/css" 
			href="css/bootstrap.min.css">
		<style type="text/css">
		img {
			max-width: 100%;
		}

		.col-sm-4 {
			text-align: center;
		}

		.col-sm-4 img {
			height: 300px;
		}
		</style>
	</head>
	<body>
		<!-- Bootstrap navigation header -->
		<nav class="navbar navbar-default">
			<div class="container">
				<div class="navbar-header">
					<a class="navbar-brand" href="index.php">EnviroMon</a>
				</div>
				<div class="navbar-collapse">
					<ul class="nav navbar-nav navbar-left">
						<li><a href="Index.php">Today</a>
						<li><a href="Yesterday.php">Yesterday</a>
						<li><a href="nDays.php?n=1">1-day</a>
						<li><a href="nDays.php?n=7">7-day</a>
						<li><a href="nDays.php?n=30">30-day</a>
						<li><a href="Monthly.php">This Month</a>
						<li><a href="Other.php">Other</a>
					</ul>
					<ul class="nav navbar-nav navbar-right">
						<li><a href="about.php">About</a>
						<li><a href="contact.php">Contact</a></li>
						<!-- li><a href="admin.php">Admin</a></li -->
					</ul>
				</div>
			</div>
		</nav>
		
		<div class="container">
			<!-- div class="page-header">
				<h2 class="page-title">
					<?php /* If a $page_title is available, use that in the header */ ?>
					<?php if ( isset($page_title) ): ?>
						<?php echo $page_title; ?>
					<?php /* Otherwise, print the default title */ ?>
					<?php else: ?>
						EnviroMon- Environment Monitor
					<?php endif; ?>
				</h2>
			</div -->

			<?= $page_content ?>

		</div> <!-- /container -->
	</body>
</html>