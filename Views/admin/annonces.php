<table class="table table-striped">
  <thead>
    <th>ID</th>
    <th>Titre</th>
    <th>Contenu</th>
    <th>Actif</th>
    <th>Actions</th>
  </thead>
  <tbody>
    <?php foreach ($annonces as $annonce) : ?>
      <tr>
        <td><?= $annonce->id?></td>
        <td><?= $annonce->titre?></td>
        <td><?= $annonce->description?></td>
        <!-- active annonces -->
        <td>
          <div class="form-check form-switch">
            <input class= "form-check-input" 
                  type= "checkbox" 
                  role= "switch" 
                  id= "switch<?=$annonce->id?>"
                  data-id= "<?=$annonce->id?>"
                  <?= $annonce->actif?'checked':'';?>
                  >
            <label class="form-check-label" for="switch<?=$annonce->id?>"></label>
          </div>
        </td>
        <td>
          <div class="btn-group" role="group" aria-label="Basic mixed styles example">
            <!-- Read -->
            <a href="" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#exampleModal<?= $annonce->id?>">Lire</a>
              <!-- Modal -->
              <div class="modal fade" id="exampleModal<?= $annonce->id?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title" id="exampleModalLabel"><?=$annonce->titre;?></h5>
                      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                      <?=$annonce->description ;?>
                    </div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                      <!-- modify button -->
                      <a href="<?=URL?>./annonces/modifier/<?= $annonce->id?>" class="btn btn-warning">Modifier</a>
                      <!-- delete button -->
                      <a href="<?=URL?>./admin/supprimeAnnonce/<?= $annonce->id?>" class="btn btn-danger">Supprimer</a>
                    </div>
                  </div>
                </div>
              </div>
            <!-- Update -->
            <a href="<?=URL?>./annonces/modifier/<?= $annonce->id?>" class="btn btn-warning">Modifier</a>
            <!-- Delete -->
            <a href="<?=URL?>./admin/supprimeAnnonce/<?= $annonce->id?>" class="btn btn-danger">Supprimer</a>
          </div>
        </td>
      </tr>
    <?php endforeach ?>
  </tbody>
</table>