<?php
/** @var array $movies */
/** @var array $config */
?>


<div class="movie-list">
	<?php
	foreach ($movies as $movie): ?>
		<?= renderTemplate("./resources/blocks/_movie.php", [
			'movie' => $movie,
			'config' => $config,
		]) ?>
	<?php
	endforeach; ?>
</div>