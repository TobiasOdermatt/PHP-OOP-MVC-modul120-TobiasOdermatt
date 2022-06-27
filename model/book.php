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
        $stmt = $db->prepare("SELECT * FROM buecher LIMIT $start, $limit");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_CLASS, "Book");
    }
    public function get_data_with_category($start,$limit,$db,$categoryid){
        $stmt = $db->prepare("SELECT * FROM buecher WHERE kategorie = '$categoryid' LIMIT $start, $limit ");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_CLASS, "Book");
    }
    public function get_data_with_keyword($start,$limit,$db,$searchkeyword){
        $stmt = $db->prepare("SELECT * FROM buecher WHERE kurztitle like '%$searchkeyword%' LIMIT $start, $limit");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_CLASS, "Book");
    }
    public function get_data_with_category_keyword($start,$limit,$db,$categoryid,$searchkeyword){
        $stmt = $db->prepare("SELECT * FROM buecher WHERE kurztitle like '%$searchkeyword%' AND kategorie = '$categoryid' LIMIT $start, $limit ");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_CLASS, "Book");
    }
}


?>