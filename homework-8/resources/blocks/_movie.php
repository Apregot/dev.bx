<?php
/** @var array $movie */
/** @var array $config */
?>

<div class="movie-list__item">
	<div class="movie-list__item__overlay">
		<div class="movie-list__item__overlay__button">
			<a href=<?= formatHRef('./details.php', 'id=' . htmlspecialchars($movie['movieID'])) ?>><?= $config['menu']['details'] ?></a>
		</div>
	</div>
	<div class="movie-list__item__image"
		 style="background-image: url(
		 <?= formatMovieImageUrl('./data/img/', $movie['movieID'], '.jpg') ?> )">
	</div>
	<div class="movie-list__item__content">
		<div class="movie-list__item__head">
			<div class="movie-list__item__head__title">
				<?= htmlspecialchars(formatMovieTitle($movie['TITLE'], $movie['RELEASE_DATE'])) ?>
			</div>
			<div class="movie-list__item__head__subtitle"><?= $movie['ORIGINAL_TITLE'] ?></div>
		</div>
		<div class="movie-list__item__description">
			<?= htmlspecialchars(formatMovieDescription($movie['TITLE'], $movie['DESCRIPTION'])) ?>
		</div>
	</div>
	<div class="movie-list__item__bottom">
		<div class="movie-list__item__bottom__time">
			<div class="movie-list__item__bottom__time__icon"></div>
			<?= htmlspecialchars(formatMovieTime($movie['DURATION'])) ?>
		</div>
		<div class="movie-list__item__bottom__info">
			<?= htmlspecialchars(formatActorsArray($movie['GENRES'])) ?>
		</div>
	</div>
</div>