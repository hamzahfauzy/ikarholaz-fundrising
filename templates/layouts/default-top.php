<!DOCTYPE html>
<html lang="en">
<head>
	<meta http-equiv="X-UA-Compatible" content="IE=edge" />
	<title><?=app('name')?></title>
	<meta content='width=device-width, initial-scale=1.0, shrink-to-fit=no' name='viewport' />
	<link rel="icon" href="<?=base_url()?>/assets/img/main-logo.png" type="image/x-icon"/>

	<!-- Fonts and icons -->
	<script src="<?=base_url()?>/assets/js/plugin/webfont/webfont.min.js"></script>
	<script>
		WebFont.load({
			google: {"families":["Lato:300,400,700,900"]},
			custom: {"families":["Flaticon", "Font Awesome 5 Solid", "Font Awesome 5 Regular", "Font Awesome 5 Brands", "simple-line-icons"], urls: ['<?=base_url()?>/assets/css/fonts.min.css']},
			active: function() {
				sessionStorage.fonts = true;
			}
		});
	</script>

	<!-- CSS Files -->
	<link rel="stylesheet" href="<?=base_url()?>/assets/css/bootstrap.min.css">
	<link rel="stylesheet" href="<?=base_url()?>/assets/css/atlantis.min.css">
	<link rel="stylesheet" href="<?=base_url()?>/assets/css/landing.css">
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-light">
        <div class="container">
            <a class="navbar-brand" href="#">
                <img src="<?=base_url()?>/assets/img/main-logo.png" width="30" height="30" class="d-inline-block align-top" alt="">
                Ikarholaz Fundrising
            </a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNavDropdown">
                <ul class="navbar-nav ml-auto ikf-navbar">
                    <li class="nav-item <?= is_route('default/index') ? 'active' : '' ?>">
                        <a class="nav-link" href="<?=base_url()?>">Beranda <span class="sr-only">(current)</span></a>
                    </li>
                    <li class="nav-item <?= is_route('default/campaigns') ? 'active' : '' ?>">
                        <a class="nav-link" href="<?=routeTo('default/campaigns',[],true)?>">Kampanye</a>
                    </li>
                    <li class="nav-item <?= is_route('default/donations') ? 'active' : '' ?>">
                        <a class="nav-link" href="<?=routeTo('default/donations',[],true)?>">Donasi</a>
                    </li>
                    <li class="nav-item <?= is_route('default/about-us') ? 'active' : '' ?>">
                        <a class="nav-link" href="<?=routeTo('default/about-us',[],true)?>">Tentang Kami</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link btn btn-primary" href="<?=routeTo('auth/login')?>"><i class="fas fa-fw fa-sign-in-alt"></i> Log In</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container mb-4 pb-4" style="min-height:calc(100vh - 180px)">
    
	