<?php
/** @var array $movie */

?>

<div class="movie-info">
	<div class="movie-info__head">
		<div class="movie-info__head__name">
			<div class="movie-info__head__name__title"><?= formatMovieTitle($movie['TITLE'],
					$movie['RELEASE_DATE']) ?></div>
			<div class="movie-info__head__name__bottom">
				<div class="movie-info__head__name__bottom__subtitle"><?= $movie['ORIGINAL_TITLE'] ?></div>
				<div class="movie-info__head__name__bottom__age-restriction"><?= $movie['AGE_RESTRICTION']
					. '+' ?></div>
			</div>
		</div>
		<div class="movie-info__head__favourite-button"></div>
	</div>
	<div class="movie-info__body">
		<div class="movie-info__body__image"
			 style="background-image: url(<?= formatMovieImageUrl('./data/img/', $movie['movieID'], '.jpg') ?>)"></div>
		<div class="movie-info__body__details">
			<div class="movie-info__body__details__rating">
				<ul class="movie-info__body__details__rating__list">
					<?php
					for ($i = 0; $i < floor((int)$movie['RATING']); $i++): ?>
						<li class="movie-info__body__details__rating__list__item"></li>
					<?php
					endfor; ?>
					<?php
					for ($i = 0; $i < 10 - floor((int)$movie['RATING']); $i++): ?>
						<li class="movie-info__body__details__rating__list__item
										movie-info__body__details__rating__list__item_empty"></li>
					<?php
					endfor; ?>
				</ul>
				<div class="movie-info__body__details__rating__num"><?= number_format($movie['RATING'], 1) ?></div>
			</div>
			<div class="movie-info__body__details__heading">О фильме</div>
			<ul class="movie-info__body__details__about-list">
				<li class="movie-info__body__details__about-list__item">
					<div class="movie-info__body__details__about-list__item__key">Год производства:</div>
					<div class="movie-info__body__details__about-list__item__value"><?= $movie['RELEASE_DATE'] ?></div>
				</li>
				<li class="movie-info__body__details__about-list__item">
					<div class="movie-info__body__details__about-list__item__key">Режиссер:</div>
					<div class="movie-info__body__details__about-list__item__value"><?= $movie['DIRECTOR'] ?></div>
				</li>
				<li class="movie-info__body__details__about-list__item">
					<div class="movie-info__body__details__about-list__item__key">В главных ролях:</div>
					<div
						class="movie-info__body__details__about-list__item__value"><?= formatArray($movie['ACTORS']) ?> </div>
				</li>
			</ul>
			<div class="movie-info__body__details__heading">Описание</div>
			<div class="movie-info__body__details__description"><?= $movie['DESCRIPTION'] ?></div>
		</div>
	</div>
</div>