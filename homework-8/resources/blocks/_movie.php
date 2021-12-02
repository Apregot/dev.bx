<?php
/** @var array $movie */
/** @var array $config */
?>

<div class="movie-list__item">
	<div class="movie-list__item__overlay">
		<div class="movie-list__item__overlay__button">
			<a href=<?= formatHRef('./details.php', 'id=' . $movie['movieID']) ?>><?= $config['menu']['details'] ?></a>
		</div>
	</div>
	<div class="movie-list__item__image"
		 style="background-image: url(
		 <?= formatMovieImageUrl('./data/img/', $movie['movieID'], '.jpg') ?> )">
	</div>
	<div class="movie-list__item__content">
		<div class="movie-list__item__head">
			<div class="movie-list__item__head__title">
				<?= formatMovieTitle($movie['TITLE'], $movie['RELEASE_DATE']) ?>
			</div>
			<div class="movie-list__item__head__subtitle"><?= $movie['ORIGINAL_TITLE'] ?></div>
		</div>
		<div class="movie-list__item__description">
			<?= formatMovieDescription($movie['TITLE'], $movie['DESCRIPTION']) ?>
		</div>
	</div>
	<div class="movie-list__item__bottom">
		<div class="movie-list__item__bottom__time">
			<div class="movie-list__item__bottom__time__icon"></div>
			<?= formatMovieTime($movie['DURATION']) ?>
		</div>
		<div class="movie-list__item__bottom__info">
			<?= formatArray($movie['GENRES']) ?>
		</div>
	</div>
</div>