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
    $countrecords = $db->query("SELECT COUNT(*) FROM kunden");
    $countrecords = $countrecords->fetchColumn();
    
    //Falls etwas zum sortieren zur auswahl steht.
    if($sort != null && $sortmethod !=null){
        $stmt = $db->prepare("SELECT * FROM kunden ORDER BY $sort $sortmethod LIMIT $start, $limit ");
        $stmt->execute();
        return array($countrecords,$stmt->fetchAll(PDO::FETCH_CLASS, "customer"));
    }
    $stmt = $db->prepare("SELECT * FROM kunden LIMIT $start, $limit");
    $stmt->execute();
    return array($countrecords,$stmt->fetchAll(PDO::FETCH_CLASS, "customer"));
}


//Search for Customers with a Keyword and sort them
public function get_data_with_keyword($start,$limit,$db,$searchkeyword,$sortmethod,$sort){
    $countrecords = $db->query("SELECT COUNT(*) FROM kunden WHERE vorname LIKE '%$searchkeyword%' OR name LIKE '%$searchkeyword%' OR email LIKE '%$searchkeyword%'");
    $countrecords = $countrecords->fetchColumn();
    
    //Falls etwas zum sortieren zur auswahl steht.
    if($sort != null && $sortmethod !=null){
        $stmt = $db->prepare("SELECT * FROM kunden WHERE vorname like '%$searchkeyword%' OR name like '%$searchkeyword%' ORDER BY $sort $sortmethod LIMIT $start, $limit ");
        $stmt->execute();
        return array($countrecords, $stmt->fetchAll(PDO::FETCH_CLASS, "customer"));
    }
    $stmt = $db->prepare("SELECT * FROM kunden WHERE vorname like '%$searchkeyword%' OR name like '%$searchkeyword%' LIMIT $start, $limit");
    $stmt->execute();
    return array($countrecords, $stmt->fetchAll(PDO::FETCH_CLASS, "customer"));
}

}
?>