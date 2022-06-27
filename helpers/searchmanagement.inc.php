<?php 
    class searchmanagement{


    public function loadCategory($db,$id){
        $Category = new Category();
        $Categoryname = $Category->get_single_data($db,$id);
        return $Categoryname;
    }

    public function loadCategories($db){
        $Categorsy = new Category();
        $Categorys = $Categorsy->get_all_data($db);
        return $Categorys;
    }


public function generateDropdownbar($db){?>
    <div class="dropdown">
    <button class="btn btn-secondary dropdown-toggle" type="button" id="category-dropdown" data-bs-toggle="dropdown" aria-expanded="false">
  <?php 
    if(isset($_GET['category']))
    {
        if(is_numeric($_GET['category'])){
            $CurrentCategorynumber = (int)$_GET['category'];
            if($CurrentCategorynumber == 0){echo "Alle Bücher";}
            else{echo( $this->loadCategory($db,$CurrentCategorynumber)[1]);}
        }}
        else{echo "Kategorie wählen";}
     ?>
    </button>
    <ul class="dropdown-menu">
      <li><a class="dropdown-item" href="./index.php?view=viewBook&category=0">Alle</a></li>
      <?php
      $Categorylist = $this->loadCategories($db);
      foreach($Categorylist as $category){
          ?><li><a class="dropdown-item" href="./index.php?view=viewBook&category=<?php echo $category->id;?>"><?php echo($category->kategorie)?></a></li><?php
      }
      ?>
    </ul>
  </div>
  <input type="hidden" id="view" name="view" value="viewBook">
  <?php if(!empty($CurrentCategorynumber)){?>
  <input type="hidden" id="category" name="category" value="<?php echo $CurrentCategorynumber?>"><?php }?>
    <button type="submit" class="btn btn-primary">Suchen</button>
  </div><br>
  <?php
}}

function loadCategoryID(){
    if($_SERVER['REQUEST_METHOD'] == 'GET'){
        if(isset($_GET['category']) && is_numeric($_GET['category'])){
        $categoryid = (int)$_GET['category'];
        return $categoryid;}else{return null;}}
        return null;
}

function loadSearchKeyword(){
    if($_SERVER['REQUEST_METHOD'] == 'GET'){
    if(isset($_GET['search'])){return htmlspecialchars($_GET['search']);}else{return null;}
    }
}

function loadSearchvalues($db,$start,$limit){
    $categoryid = loadCategoryID();
    $searchkeyword = loadSearchKeyword();
    $books  = new BookController($db);
    if($categoryid != null && $searchkeyword != null){
        $books = $books->loadBookwithCategoryandKeyword($start,$limit,$db,$categoryid,$searchkeyword);
        if($books == null){DisplayError("Keine Ergebnise");}
    }
    elseif($categoryid == null && $searchkeyword != null){
        $books = $books->loadBookwithKeyword($start,$limit,$db,$searchkeyword);
        if($books == null){DisplayError("Keine Ergebnise");}
    }
    elseif($categoryid != null && $searchkeyword == null){
        $books = $books->loadBookwithCategory($start,$limit,$db,$categoryid);
        if($books == null){DisplayError("Keine Ergebnise");}
    }
    else{return null;}
    return $books;
    }

function generateSearchBar(){
    ?>
    
    <input type="search" name="search" class="form-control rounded" placeholder="Datenbank nach Büchern durchsuchen.."/>
    <?php
}


 ?>