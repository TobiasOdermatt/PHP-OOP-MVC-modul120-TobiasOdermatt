<?php
class Book{
    public $id;
    public $katalog;
    public $kurztitle;
    public $kategorie;
    public $verkauft;
    public $kaufer;
    public $autor;
    public $title;
    public $sprache;
    public $foto;
    public $verfasser;
    public $zustand;


    public function get_data($start,$limit,$db){
        $countrecords = $db->query("SELECT COUNT(*) FROM buecher");
        $countrecords = $countrecords->fetchColumn();

        $stmt = $db->prepare("SELECT * FROM buecher LIMIT $start, $limit");
        $stmt->execute();
        return array($countrecords,$stmt->fetchAll(PDO::FETCH_CLASS, "Book"));
    }

    public function get_data_with_category($start,$limit,$db,$categoryid){
        $countrecords = $db->query("SELECT COUNT(*) FROM buecher WHERE kategorie = $categoryid");
        $countrecords = $countrecords->fetchColumn();

        $stmt = $db->prepare("SELECT * FROM buecher WHERE kategorie = '$categoryid' LIMIT $start, $limit ");
        $stmt->execute();
        return array($countrecords, $stmt->fetchAll(PDO::FETCH_CLASS, "Book"));
    }

    public function get_data_with_keywordAdvanced($start,$limit,$db,$searchkeyword,$sortingmethod,$sortas,$topic,$zustand){
        $countrecords = $db->query("SELECT COUNT(*) FROM buecher WHERE $topic like '%$searchkeyword%' and zustand like '%$zustand%'");
        $countrecords = $countrecords->fetchColumn();

        $stmt = $db->prepare("SELECT * FROM buecher WHERE $topic like '%$searchkeyword%' and zustand like '%$zustand%' ORDER BY $sortas $sortingmethod LIMIT $start, $limit");
        $stmt->execute();
        return array($countrecords, $stmt->fetchAll(PDO::FETCH_CLASS, "Book"));
    }

    public function get_data_with_keyword($start,$limit,$db,$searchkeyword){
        $countrecords = $db->query("SELECT COUNT(*) FROM buecher WHERE kurztitle like '%$searchkeyword%' or autor like '%$searchkeyword%' or verfasser like '%$searchkeyword%'");
        $countrecords = $countrecords->fetchColumn();

        $stmt = $db->prepare("SELECT * FROM buecher WHERE kurztitle like '%$searchkeyword%' or autor like '%$searchkeyword%' or verfasser like '%$searchkeyword%' LIMIT $start, $limit");
        $stmt->execute();
        return array($countrecords,$stmt->fetchAll(PDO::FETCH_CLASS, "Book"));
    }

    public function get_data_with_category_keyword($start,$limit,$db,$categoryid,$searchkeyword){
        $countrecords = $db->query("SELECT COUNT(*) FROM buecher WHERE kurztitle like '%$searchkeyword%' AND kategorie = '$categoryid'");
        $countrecords = $countrecords->fetchColumn();

        $stmt = $db->prepare("SELECT * FROM buecher WHERE kurztitle like '%$searchkeyword%' AND kategorie = '$categoryid' LIMIT $start, $limit ");
        $stmt->execute();
        return array($countrecords,$stmt->fetchAll(PDO::FETCH_CLASS, "Book"));
    }
    
}
?>