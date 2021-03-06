<?php
$social_links = get_option( 'social_links');
$contact_info = get_option('contact_info');
$brand_info = get_option('brand_info');
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<!--[if IE]><meta http-equiv='X-UA-Compatible' content='IE=edge,chrome=1'><![endif]-->
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
	<meta name="description" content="">
    <?php wp_head() ?>

</head>
<body>
    <!-- Preloader -->
	<div class="loader-mask">
		<div class="loader">
			"Loading..."
		</div>
	</div>
    <main class="main-wrapper">
    <!-- Navigation -->
		<header class="nav">
			<div class="nav__holder nav--sticky">
				<div class="container-fluid nav__container nav__container--side-padding">
					<div class="flex-parent">

						<div class="nav__header">
							<!-- Logo -->
							<?php if(!isset($brand_info)): ?>
								<a href="<?php echo get_home_url() ?>" class="logo-container flex-child">
									<img class="logo" src="<?php bloginfo('template_directory') ?>/assets/img/logo.png" srcset="<?php bloginfo('template_directory') ?>/assets/img/logo.png 1x, <?php bloginfo('template_directory') ?>/assets/img/logo@2x.png 2x" alt="logo">
								</a>
							<?php else: ?>
								<a href="<?php echo get_home_url() ?>" class="logo-container flex-child">
									<img class="logo" src="<?php echo $brand_info['brand_logo'] ?>" srcset="<?php echo $brand_info['brand_logo'] ?> 1x, <?php echo $brand_info['brand_logo'] ?> 2x" alt="logo">
								</a>
							<?php endif; ?>

							<!-- Mobile toggle -->
							<button type="button" class="nav__icon-toggle" id="nav__icon-toggle" data-toggle="collapse" data-target="#navbar-collapse">
								<span class="sr-only">Toggle navigation</span>
								<span class="nav__icon-toggle-bar"></span>
								<span class="nav__icon-toggle-bar"></span>
								<span class="nav__icon-toggle-bar"></span>
							</button>
						</div>

						<!-- Navbar -->
						<?php
							wp_nav_menu(
								array(
									'theme-location' => 'top-menu',
									'container' => 'nav',
									'container_class' => 'nav__wrap collapse navbar-collapse',
									'container_id' => 'navbar-collapse',
									'walker' => new Custom_Menu_Walker(),
									'items_wrap' => '<ul class="nav__menu">%3$s</ul>',
								)
							);
						?>

						<div class="nav__phone nav--align-right d-none d-lg-block">
							<span class="nav__phone-text"><?php echo $contact_info['phone_text'] ?></span>
							<a href="tel:1-800-995-3959" class="nav__phone-number"><?php echo $contact_info['phone_number'] ?></a>
						</div>

						<div class="nav__socials d-none d-lg-block">
							<div class="socials">
								<?php foreach($social_links as $social_link): ?>
									<?php echo $social_link ?>
								<?php endforeach; ?>
							</div>
						</div>

					</div> <!-- end flex-parent -->
				</div> <!-- end container -->

			</div>
		</header> <!-- end navigation -->