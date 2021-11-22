<?php
/** @var array $movie */

?>

<div class="movie-info">
	<div class="movie-info__head">
		<div class="movie-info__head__name">
			<div class="movie-info__head__name__title"><?= formatMovieTitle($movie['title'],
					$movie['release-date']) ?></div>
			<div class="movie-info__head__name__bottom">
				<div class="movie-info__head__name__bottom__subtitle"><?= $movie['original-title'] ?></div>
				<div class="movie-info__head__name__bottom__age-restriction"><?= $movie['age-restriction']
					. '+' ?></div>
			</div>
		</div>
		<div class="movie-info__head__favourite-button"></div>
	</div>
	<div class="movie-info__body">
		<div class="movie-info__body__image"
			 style="background-image: url(<?= formatMovieImageUrl('./data/img/', $movie['id'], '.jpg') ?>)"></div>
		<div class="movie-info__body__details">
			<div class="movie-info__body__details__rating">
				<ul class="movie-info__body__details__rating__list">
					<?php
					for ($i = 0; $i < floor($movie['rating']); $i++): ?>
						<li class="movie-info__body__details__rating__list__item"></li>
					<?php
					endfor; ?>
					<?php
					for ($i = 0; $i < 10 - floor($movie['rating']); $i++): ?>
						<li class="movie-info__body__details__rating__list__item
										movie-info__body__details__rating__list__item_empty"></li>
					<?php
					endfor; ?>
				</ul>
				<div class="movie-info__body__details__rating__num"><?= number_format($movie['rating'], 1) ?></div>
			</div>
			<div class="movie-info__body__details__heading">О фильме</div>
			<ul class="movie-info__body__details__about-list">
				<li class="movie-info__body__details__about-list__item">
					<div class="movie-info__body__details__about-list__item__key">Год производства:</div>
					<div class="movie-info__body__details__about-list__item__value"><?= $movie['release-date'] ?></div>
				</li>
				<li class="movie-info__body__details__about-list__item">
					<div class="movie-info__body__details__about-list__item__key">Режиссер:</div>
					<div class="movie-info__body__details__about-list__item__value"><?= $movie['director'] ?></div>
				</li>
				<li class="movie-info__body__details__about-list__item">
					<div class="movie-info__body__details__about-list__item__key">В главных ролях:</div>
					<div
						class="movie-info__body__details__about-list__item__value"><?= formatArray($movie['cast']) ?> </div>
				</li>
			</ul>
			<div class="movie-info__body__details__heading">Описание</div>
			<div class="movie-info__body__details__description"><?= $movie['description'] ?></div>
		</div>
	</div>
</div>