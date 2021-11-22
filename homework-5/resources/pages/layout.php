<?php
/** @var array $config */
/** @var array $genres */
/** @var array $movies */
/** @var string $content */
/** @var string $currentPage */
?>

<!DOCTYPE html>
<html lang="ru">
<head>
	<meta charset="UTF-8">
	<meta name="viewport"
		  content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<title><?= $config['title'] ?></title>
	<link rel="stylesheet" href="./resources/css/reset.css">
	<link rel="stylesheet" href="./resources/css/layout.css">
	<link rel="stylesheet" href="./resources/css/main-content.css">
	<link rel="stylesheet" href="./resources/css/details-content.css">
	<link rel="stylesheet" href="./resources/css/add-content.css">
	<link rel="stylesheet" href="./resources/css/favourites-content.css">
	<link rel="stylesheet" href="./resources/css/film-not-found.css">
</head>
<body>
<div class="wrapper">
	<div class="sidebar">
		<div class="logo"></div>
		<ul class="menu">
			<li class="menu__item <?= $currentPage === 'index' ? "menu__item_active" : "" ?>">
				<a href=<?= formatHRef("./index.php") ?>><?= $config['menu']['index'] ?></a>
			</li>
			<?php
			foreach ($genres as $key => $value): ?>
				<li class="menu__item <?= $currentPage === $key ? "menu__item_active" : "" ?>">
					<a href=<?= formatHRef("./index.php", "genre=" . $key) ?>><?= $value ?></a>
				</li>
			<?php
			endforeach; ?>
			<li class="menu__item <?= $currentPage === 'favourites' ? "menu__item_active" : "" ?>">
				<a href=<?= formatHRef("./favourites.php") ?>><?= $config['menu']['favourites'] ?></a>
			</li>
		</ul>
	</div>
	<div class="container">
		<div class="header">
			<form action="index.php" method="get" class="header__search-form">
				<div class="header__search-form__search-bar">
					<div class="header__search-form__search-bar__icon"></div>
					<input name="search" placeholder="Поиск по каталогу...">
				</div>
				<button type="submit">Поиск</button>
			</form>
			<div class="header__add-button">
				<a href=<?= formatHRef("./add.php") ?>><?= $config['menu']['add'] ?></a>
			</div>
		</div>
		<div class="content">
			<?= $content ?>
		</div>
	</div>
</div>
</body>
</html>