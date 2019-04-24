<section>
	<article>
		<h1>Gestion de mes sources de données</h1>
		<ul>
		<?php foreach($data as $source): ?>
		<li><?="$data[id] $data[file_name] $data[url] $data[visible]";?></li>
		<?php endforeach; ?>
		</ul>
	</article>
</section>