<?php
//Anleitung die ich für ein OOP Paginationsystem gebraucht habe
// https://steemit.com/utopian-io/@alfarisi94/pagination-with-php-oop-system-1-basic-oop-class-fetch-data-with-pdo-database-use-function-in-a-class


class paginationmanagement
{
    private $total_records, $limit;


    public function __construct($limit)
    {
        $this->limit = $limit;
    }

    public function set_total_records($recordscount){
        $this->total_records = $recordscount;
    }

    public function get_current_page()
    {
        return isset($_GET['page']) ? (int)$_GET['page'] : 1;
    }

    public function get_start()
    {
        $start = 0;
        if ($this->get_current_page() > 1) {
            $start = ($this->get_current_page() * $this->limit) - $this->limit;
        }
        return $start;
    }

    public function get_limit()
    {
        return $this->limit;
    }

    public function get_pagination_number()
    {
        return ceil($this->total_records / $this->limit);
    }

    function generatePagination($view, $optionalparam)
    {

        //Falls es keine Vorhige Seite gibt, wird der Button deaktiviert
        $currentpage = $this->get_current_page();
        $pages  = $this->get_pagination_number();
        $previousdisabled = '';
        if ($currentpage <= 1) {
            $previousdisabled = 'disabled';
        }

        //Falls es nicht mehr Seiten gibt, wird der Button deaktiviert
        $nextdisabled = '';
        if ($currentpage >= $pages) {
            $nextdisabled = 'disabled';
        }


?>
        <?php
        if($pages != 0)
        {
            ?>
        <!--Pagination -->
        <br><br>
        <nav aria-label="...">
            <ul class="pagination justify-content-center">
                <li class="page-item <?php echo $previousdisabled ?>">
                    <a class="page-link" href="?view=<?php echo $view ?>&page=<?php echo $currentpage - 1 ?><?php echo $optionalparam ?>" tabindex="-1">Vorhige</a>
                </li>
                <?php
                if ($currentpage != 1) {
                ?> <li class="page-item"><a class="page-link" href="?view=<?php echo $view ?>&page=1<?php echo $optionalparam ?>">1..</a></li><?php }
                                                                                                                                            ?>
                <li class="page-item active"><a class="page-link" href="?view=<?php echo $view ?>&page=<?php echo $currentpage ?><?php echo $optionalparam ?>"><?php echo $currentpage ?> </a></li>
                <?php
                $nextcountofpages = 3;
                for ($i = 1; $i < $nextcountofpages; $i++) {
                    if ($currentpage == $pages) {
                        break;
                    }
                    if ($currentpage + $i < $pages) { ?>
                        <li class="page-item">

                            <a class="page-link" href="?view=<?php echo $view ?>&page=<?php echo $currentpage + $i ?><?php echo $optionalparam ?>"><?php echo $currentpage + $i;
                                                                                                                                                if ($i == $nextcountofpages - 1) {
                                                                                                                                                    echo "...";
                                                                                                                                                } ?> <span class="sr-only"></span></a>
                        </li>
                    <?php
                    }
                }

                //Ist die Maximale Seitenanzahl, ermöglicht es dem Benutzer auf die letzte Seite zu springen

                //Wird nur ausgeführt wenn der Benutzer nicht auf der grössten Seite ist.
                if ($currentpage != $pages) {
                    ?><li class="page-item"><a class="page-link" href="?view=<?php echo $view ?>&page=<?php echo $pages; ?><?php echo $optionalparam ?>"><?php echo $pages ?></a></li><?php
                                                                                                                                                                            }
                                                                                                                                                                                ?>
                <li class="page-item <?php echo $nextdisabled ?>">
                    <a class="page-link" href="?view=<?php echo $view ?>&page=<?php echo $currentpage + 1; ?><?php echo $optionalparam ?>">Nächste</a>
                </li>
            </ul>
        </nav><?php
            }
            else { ?>
            <br> <br> <br> <br> <br> <br> <br> <br>
            <br> <br> <br> <br> <br> <br> <br> <br>
            <?php }
        }
    }
?>