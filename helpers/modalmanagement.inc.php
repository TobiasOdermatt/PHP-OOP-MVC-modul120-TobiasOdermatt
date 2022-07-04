<?php
function generateBooksModal($db, $book, $searchmanagement)
{ ?>
    <!-- Modal -->
    <div class="modal fade" id="id<?php echo $book->id ?>" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h3 class="modal-title">Einzelheiten des Buchs</h3>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <h2>Buchtitel: <?php echo ($book->kurztitle) ?></h2>
                    <h3 class="modal-title">Beschreibung:</h3>
                    <p><?php echo ($book->title) ?></p>
                    <h4 class="modal-title">Autor: </h4>
                    <?php if (($book->autor) == " ") { ?><p class="text-danger"><?php
                                                                                echo "Unbekannt"; ?></p><?php } else { ?><p class="text-dark"><?php echo ($book->autor); ?></p><?php } ?>
                    <h4 class="modal-title">Zustand: </h4>
                    <?php
                    if ($book->zustand == "G") { ?>
                        <p class="text-success">
                            <?php echo "Gut"; ?></p><?php }
                    if ($book->zustand == "M") { ?>
                        <p class="text-dark"><?php echo "Mittel"; ?></p><?php }
                    if ($book->zustand == "S") { ?>
                        <p class="text-danger"><?php echo "Schlecht"; ?></p><?php } ?>

                    <h4 class="modal-title">Kategorie: </h4>
                    <?php if (empty($searchmanagement->loadCategory($db, $book->kategorie))) { ?>
                        <p class="text-danger"><?php echo "Keine Kategorie zugewiesen"; ?></p>
                    <?php } else { ?> <p class="text-dark">
                            <?php echo ($searchmanagement->loadCategory($db, $book->kategorie))[1]; ?></p><?php } ?>



                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Schliessen</button>
                </div>
            </div>
        </div>
    </div><?php
        }
            ?>