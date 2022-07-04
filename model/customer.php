<?php
class Customer{
public $kid;
public $geburstag;
public $vorname;
public $name;
public $geschlecht;
public $kunde_seit;
public $email;
public $kontaktpermail;


public function get_data($start,$limit,$db,$sortmethod,$sort){
    //Falls etwas zum sortieren zur auswahl steht.
    if($sort != null && $sortmethod !=null){
        $stmt = $db->prepare("SELECT * FROM kunden ORDER BY $sort $sortmethod LIMIT $start, $limit ");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_CLASS, "customer");
    }
    $stmt = $db->prepare("SELECT * FROM kunden LIMIT $start, $limit");
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_CLASS, "customer");
}

}
?>