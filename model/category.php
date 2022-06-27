<?php
class Category{
public $id;
public $name;


public function get_single_data($db,$id){
    $stmt = $db->prepare("SELECT * FROM kategorien where id=?");
    $stmt->execute([$id]); 
    return $stmt->fetch();
}

public function get_all_data($db){
    $stmt = $db->prepare("SELECT * FROM kategorien");
    $stmt->execute(); 
    return $stmt->fetchAll(PDO::FETCH_CLASS, "Category");
}
}
?>