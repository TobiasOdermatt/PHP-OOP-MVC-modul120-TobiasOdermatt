<?php
class searchmanagement
{


    public function loadCategory($db, $id)
    {
        $Category = new Category();
        $Categoryname = $Category->get_single_data($db, $id);
        return $Categoryname;
    }

    public function loadCategories($db)
    {
        $Categorsy = new Category();
        $Categorys = $Categorsy->get_all_data($db);
        return $Categorys;
    }

    public function generateAdvancedSearchButton()
    {
?><div>
            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#advancedSearchModal">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-search" viewBox="0 0 16 16">
                    <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z"></path>
                </svg>
                Erweiterte Suche
            </button>
        </div><br><?php
                }

                public function advancedSearchModal()
                {
                    ?>
        <!-- Modal -->
        <div class="modal fade" id="advancedSearchModal" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h3 class="modal-title">Erweiterte Sucheinstellungen</h3>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <h5 class="modal-title">Filteroptionen:</h5><br>
                        <div class="input-group">
                            <input type="search" name="search" class="form-control rounded" placeholder="Suchen nach.." />
                            <select class="form-select form-select-lg " name="topic">
                                <option selected value="0">Buchtitel</option>
                                <option value="1">Autor</option>
                                <option value="2">Kategorie</option>
                                <option value="3">Nummer</option>
                                <option value="4">Katalog</option>
                            </select>
                            <select class="form-select form-select-lg" name="zustand">
                                <option selected>Zustand...</option>
                                <option value="G">Gut</option>
                                <option value="M">Mittel</option>
                                <option value="S">Schlecht</option>
                            </select><br>
                        </div><br>
                        <h5 class="modal-title">Sortieren nach:</h5>
                        <div class="input-group">
                            <select class="form-select form-select-lg" name="sortas">
                                <option selected value="0">Buchtitel...</option>
                                <option value="1">Autor</option>
                                <option value="2">Kategorie</option>
                                <option value="3">Nummer</option>
                                <option value="4">Katalog</option>
                            </select>
                            <select class="form-select form-select-lg" name="sortingmethod">
                                <option selected value="ASC">Aufsteigend...</option>
                                <option value="DESC">Absteigend</option>
                            </select>
                        </div>

                        <br>

                        <div>
                            <button type="submit" class="btn btn-primary">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-search" viewBox="0 0 16 16">
                                    <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z"></path>
                                </svg>
                                Suche starten
                            </button>
                        </div><br>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Schliessen</button>
                    </div>
                </div>
            </div>
        </div><?php
                }



                public function generateDropdownbar($db)
                { ?>
        <div class="dropdown">
            <button class="btn btn-secondary dropdown-toggle" type="button" id="category-dropdown" data-bs-toggle="dropdown" aria-expanded="false">
                <?php
                    if (isset($_GET['category'])) {
                        if (is_numeric($_GET['category'])) {
                            $CurrentCategorynumber = (int)$_GET['category'];
                            if ($CurrentCategorynumber == 0) {
                                echo "Alle Bücher";
                            } else {
                                echo ($this->loadCategory($db, $CurrentCategorynumber)[1]);
                            }
                        }
                    } else {
                        echo "Kategorie wählen";
                    }
                ?>
            </button>
            <ul class="dropdown-menu">
                <li><a class="dropdown-item" href="./index.php?view=viewBook&category=0">Alle</a></li>
                <?php
                    $Categorylist = $this->loadCategories($db);
                    foreach ($Categorylist as $category) {
                ?><li><a class="dropdown-item" href="./index.php?view=viewBook&category=<?php echo $category->id; ?>"><?php echo ($category->kategorie) ?></a></li><?php
                                                                                                                                                        }
                                                                                                                                                            ?>
            </ul>
        </div>
        <input type="hidden" id="view" name="view" value="viewBook">
        <?php if (!empty($CurrentCategorynumber)) { ?>
            <input type="hidden" id="category" name="category" value="<?php echo $CurrentCategorynumber ?>"><?php } ?>
        <button type="submit" class="btn btn-primary">Suchen</button>
        </div><br>
    <?php
                }
            }

            function loadCategoryID()
            {
                if ($_SERVER['REQUEST_METHOD'] == 'GET') {
                    if (isset($_GET['category']) && is_numeric($_GET['category'])) {
                        $categoryid = (int)$_GET['category'];
                        return $categoryid;
                    } else {
                        return null;
                    }
                }
                return null;
            }

            function loadSearchKeyword()
            {
                if ($_SERVER['REQUEST_METHOD'] == 'GET') {
                    if (isset($_GET['searchbar']) && $_GET['searchbar'] != '') {
                        return htmlspecialchars($_GET['searchbar']);
                    }

                    if (isset($_GET['search']) && $_GET['search'] != '') {
                        return htmlspecialchars($_GET['search']);
                    } else {
                        return '';
                    }
                }
            }
            function loadTopicofBook()
            {
                $arrayOfTopic = [
                    "0" => "kurztitle",
                    "1" => "autor",
                    "2" => "kategorie",
                    "3" => "nummer",
                    "4" => "katalog",
                ];
                if ($_SERVER['REQUEST_METHOD'] == 'GET') {
                    if (isset($_GET['topic']) && is_numeric($_GET['topic'])) {
                        $categoryid = (int)$_GET['topic'];
                        return $arrayOfTopic[$categoryid];
                    } else {
                        return "kurztitle";
                    }
                } else {
                    return "kurztitle";
                }
            }

            function loadZustandofBook()
            {
                if ($_SERVER['REQUEST_METHOD'] == 'GET') {
                    if (isset($_GET['zustand'])) {
                        if ($_GET['zustand'] == "G" || $_GET['zustand'] == "M" || $_GET['zustand'] == "S") {
                            return htmlspecialchars($_GET['zustand']);
                        }
                    } else {
                        return "";
                    }
                }
            }

            function loadSortasofBooks()
            {
                $arrayOfTopic = [
                    "0" => "kurztitle",
                    "1" => "autor",
                    "2" => "kategorie",
                    "3" => "nummer",
                    "4" => "katalog",
                ];
                if ($_SERVER['REQUEST_METHOD'] == 'GET') {
                    if (isset($_GET['sortas']) && is_numeric($_GET['sortas'])) {
                        $topicid = (int)$_GET['sortas'];
                        return $arrayOfTopic[$topicid];
                    } else {
                        return "kurztitle";
                    }
                } else {
                    return "kurztitle";
                }
            }

            function loadSortMethodofBook()
            {
                if ($_SERVER['REQUEST_METHOD'] == 'GET') {
                    if (isset($_GET['sortingmethod'])) {
                        if ($_GET['sortingmethod'] == "ASC" || $_GET['sortingmethod'] == "DESC") {
                            return htmlspecialchars($_GET['sortingmethod']);
                        } else {
                            return "asc";
                        }
                    }
                }
            }


            function loadSearchvalues($db, $start, $limit)
            {
                $categoryid = loadCategoryID();
                $searchkeyword = loadSearchKeyword();
                $topic = loadTopicofBook();
                $zustand = loadZustandofBook();
                $sortingmethod = loadSortMethodofBook();
                $sortas = loadSortasofBooks();
                $books  = new BookController($db);


                if ($categoryid != null && $searchkeyword != '') {
                    $books = $books->loadBookwithCategoryandKeyword($start, $limit, $db, $categoryid, $searchkeyword);
                    if ($books == null) {
                        DisplayError("Keine Ergebnise");
                    }
                } elseif ($categoryid == null && $searchkeyword != '') {
                    $books = $books->get_data_with_keywordAdvanced($start, $limit, $db, $searchkeyword, $sortingmethod, $sortas, $topic, $zustand);
                    if ($books == null) {
                        DisplayError("Keine Ergebnise");
                    }
                } elseif ($categoryid != null && $searchkeyword == '') {
                    $books = $books->loadBookwithCategory($start, $limit, $db, $categoryid);
                    if ($books == null) {
                        DisplayError("Keine Ergebnise");
                    }
                } else {
                    return null;
                }
                return $books;
            }

            function generateSearchBar()
            {
    ?>
    <input type="search" name="searchbar" class="form-control rounded" placeholder="Datenbank nach Büchern durchsuchen.." />
<?php
            }
?>