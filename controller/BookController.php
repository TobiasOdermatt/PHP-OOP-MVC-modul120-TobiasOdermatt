<?php 
    class BookController{


    public function loadBooks($start,$limit,$db){
        $Books = new Book();
        $Books = $Books->get_data($start,$limit,$db);
        return $Books;
    }

    public function loadBookwithCategory($start,$limit,$db,$categoryID){
        $Books = new Book();
        $Books = $Books->get_data_with_category($start,$limit,$db,$categoryID);
        return $Books;
    }

    public function loadBookwithKeyword($start,$limit,$db,$searchkeyword){
        $Books = new Book();
        $Books = $Books->get_data_with_keyword($start,$limit,$db,$searchkeyword);
        return $Books;
    }

    
    public function loadBookwithCategoryandKeyword($start,$limit,$db,$categoryID,$searchkeyword){
        $Books = new Book();
        $Books = $Books->get_data_with_category_keyword($start,$limit,$db,$categoryID,$searchkeyword);
        return $Books;
    }

}
 ?>