<h1>Lists des annonces</h1>

<?php foreach($annonces as $annonce):?>
  <article>
    <h3><a href="<?= URL ?>/annonces/lire/<?= $annonce->id ?>"><?= $annonce->titre ?></a></h3>
    <p><?= $annonce->description ?></p>
  </article>
<?php endforeach;?>