<div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Confirmation</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fermer"></button>
            </div>
            <div class="modal-body">
                <?php
                // Utilisez les informations récupérées depuis la requête
                foreach ($informationModal as $uneLigne) {
                    echo "<p>" . $uneLigne["NumeroDeSerie"] . " - " . $uneLigne["LibelleTypeMateriel"] . "</p>";
                }
                ?>
            </div>
        </div>
    </div>