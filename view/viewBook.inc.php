        <!-- Seiteninhalt-->
        <br>
        <h1>Bücherliste</h1>
        <?php
        require_once('model/connection.php');
        require_once('controller/BookController.php');
        require_once('helpers/paginationmanagement.php');
        include 'model/book.php';
        include 'helpers/searchmanagement.inc.php';
        include 'helpers/modalmanagement.inc.php';
        include 'model/category.php';

        $db = Database::getInstance();
        $countOfResults = 20; //Anzahl Bücher pro Seite
        $paginationsystem = new paginationmanagement($countOfResults);
        $start = $paginationsystem->get_start();
        $limit = $paginationsystem->get_limit();
        $books  = new BookController($db);
        $totalcounts = 0;

        $result = $books->loadBooks($start, $limit, $db);
        $totalcounts = $result[0];
        $books = $result[1];
        $searchmanagement = new searchmanagement();
        $searchresult = loadSearchvalues($db, $start, $limit);
        if ($searchresult[1] != null) {
            $books = $searchresult[1];
            $totalcounts = $searchresult[0];
            if($searchresult[1] == "No Result")
            {
                $books = array();
            }
        }
        $currentCategoryID = loadCategoryID();
        $currentsearch = loadSearchKeyword();


        ?>
        <br>
        <form method="get" action="#">
            <div class="input-group">
                <?php generateSearchBar() ?>

                <?php $searchmanagement->generateDropdownbar($db);
                $searchmanagement->generateAdvancedSearchButton();
                $searchmanagement->advancedSearchModal(); ?>

                <p class="text-secondary py-2" style="font-style: italic"><?php echo $totalcounts?> Bücher gefunden.</p>

                <div class="row gx-4 gx-lg-4">


                    <?php foreach ($books as $book) : ?>
                        <!-- Vorschaukarte -->
                        <div class="col-md-3 mb-4">
                            <div class="card h-100">
                                <div class="card-body">
                                    <h5 class="card-title"><?php echo ($book->kurztitle); ?></h5>
                                    <p class="card-text"><?php echo ($book->title) ?></p>
                                    <!-- Details Button -->
                                </div>
                                <div class="card-footer"><a class="btn btn-primary btn-sm" href="#!" data-bs-toggle="modal" data-bs-target="#id<?php echo $book->id ?>">Details</a></div>
                            </div>
                        </div>

                        <?php generateBooksModal($db, $book, $searchmanagement); ?>
                    <?php endforeach; ?>
                </div>

                <?php //Hier wird der searchString zusammengesetzt
                $currentCategoryID = $currentCategoryID == 0 ? '' : '&category=' . $currentCategoryID;
                $currentsearch = $currentsearch == null ? '' : '&search=' . $currentsearch;
                $searchparam = $currentCategoryID . $currentsearch ?>
        </form>
        <?php 
        $paginationsystem->set_total_records($totalcounts);
        $paginationsystem->generatePagination("viewBook", $searchparam) ?>