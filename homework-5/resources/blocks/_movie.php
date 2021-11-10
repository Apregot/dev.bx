<?php
/** @var array $movie */
/** @var array $config */
?>

<div class="movie-list__item">
	<div class="movie-list__item__overlay">
		<div class="movie-list__item__overlay__button">
			<a href=<?= formatHRef('./details.php', 'id=' . $movie['id']) ?>><?= $config['menu']['details'] ?></a>
		</div>
	</div>
	<div class="movie-list__item__image"
		 style="background-image: url(
		 <?= formatMovieImageUrl('./data/img/', $movie['id'], '.jpg') ?> )">
	</div>
	<div class="movie-list__item__content">
		<div class="movie-list__item__head">
			<div class="movie-list__item__head__title">
				<?= formatMovieTitle($movie['title'], $movie['release-date']) ?>
			</div>
			<div class="movie-list__item__head__subtitle"><?= $movie['original-title'] ?></div>
		</div>
		<div class="movie-list__item__description">
			<?= formatMovieDescription($movie['title'], $movie['description']) ?>
		</div>
	</div>
	<div class="movie-list__item__bottom">
		<div class="movie-list__item__bottom__time">
			<div class="movie-list__item__bottom__time__icon"></div>
			<?= formatMovieTime($movie['duration']) ?>
		</div>
		<div class="movie-list__item__bottom__info">
			<?= formatArray($movie['genres']) ?>
		</div>
	</div>
</div>