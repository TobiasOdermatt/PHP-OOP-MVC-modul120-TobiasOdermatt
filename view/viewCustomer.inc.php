<!-- Seiteninhalt-->
<br>
<h1>Kundenverwaltung</h1>

<p>Auf dieser Seite können alle Kunden des Bücherantiquariat Basels einfach verwaltet werden.</p>
<?php
require_once('model/connection.php');
require_once('controller/CustomerController.php');
require_once('helpers/paginationmanagement.php');
include 'model/customer.php';

$db = Database::getInstance();
$countOfResults = 30; //Anzahl Kunden pro Seite
$paginationsystem = new paginationmanagement($countOfResults);
$start = $paginationsystem->get_start();
$limit = $paginationsystem->get_limit();
$customers  = new CustomerController($db);
$sortoption = ["ASC", "DESC"];
$displaysortmethod = "ASC";
if(isset($_GET['sortmethod']))
{
 if(in_array($_GET['sortmethod'], $sortoption))
  {
	$sortmethod = $_GET['sortmethod'];
  if($sortmethod == "ASC")
  {
      $displaysortmethod = "DESC";
  }
  else
  {
      $displaysortmethod = "ASC";
  }
  }
}
else
{
  $sortmethod = "ASC";
}

$sort = isset($_GET['sort']) ? $_GET['sort'] : null;
$searchkeyword = isset($_GET['search']) ? $_GET['search'] : null;
$totalcounts = 0;
if($searchkeyword == null)
{
  $result = $customers->load_customers($start, $limit, $db, $sortmethod, $sort);
  $totalcounts = $result[0];
  $customers = $result[1];
}
else
{
  $result = $customers->load_customersWithKeyword($start, $limit, $db, $searchkeyword, $sortmethod, $sort);
  $totalcounts = $result[0];
  $customers = $result[1];
}
$paginationsystem->set_total_records($totalcounts);

function createParam($sort, $sortmethod, $searchkeyword){
  $sortparam = '';
  if($sort != null){
    $sortparam = "&sortmethod=$sortmethod&sort=$sort";
  }
  $currentsearch = $searchkeyword == null ? '' : '&search=' . $searchkeyword;
  return $sortparam . $currentsearch;
}

if($searchkeyword == null){
  $displaysearch = '';
}
else{
  $displaysearch = '&search=' . $searchkeyword;
}
?>


<div class="input-group">
  <input type="search" class="form-control rounded" placeholder="Datenbank nach Kunden durchsuchen.." id="searchInput"/>
  <button type="button" onclick="addSearchParamToGET()" class="btn btn-primary">Suchen</button>
</div>
<p class="text-secondary py-2" style="font-style: italic"><?php echo $totalcounts?> Kunden gefunden.</p>
<table class="table">
  <thead class="thead-light">
    <tr>
      <th scope="col"><a href="./index.php?view=viewCustomer&sortmethod=<?php echo $displaysortmethod ?>&sort=kid<?php echo $displaysearch?>" class="link-secondary text-decoration-none">
          #Kundennummer</a></th>
      <th scope="col"><a href="./index.php?view=viewCustomer&sortmethod=<?php echo $displaysortmethod ?>&sort=vorname<?php echo $displaysearch?>" class="link-secondary text-decoration-none">
          Vorname</a></th>
      <th scope="col"><a href="./index.php?view=viewCustomer&sortmethod=<?php echo $displaysortmethod ?>&sort=name<?php echo $displaysearch?>" class="link-secondary text-decoration-none">
          Nachname</a></th>
      <th scope="col"><a href="./index.php?view=viewCustomer&sortmethod=<?php echo $displaysortmethod ?>&sort=geschlecht<?php echo $displaysearch?>" class="link-secondary text-decoration-none">
          Geschlecht</a></th>
      <th scope="col"><a href="./index.php?view=viewCustomer&sortmethod=<?php echo $displaysortmethod ?>&sort=kunde_seit<?php echo $displaysearch?>" class="link-secondary text-decoration-none">
          Kunde seit:</a></th>
      <th scope="col"><a href="./index.php?view=viewCustomer&sortmethod=<?php echo $displaysortmethod ?>&sort=email<?php echo $displaysearch?>" class="link-secondary text-decoration-none">
          E-Mail:</a></th>
      <th scope="col"><a href="./index.php?view=viewCustomer&sortmethod=<?php echo $displaysortmethod ?>&sort=geburtstag<?php echo $displaysearch?>" class="link-secondary text-decoration-none">
          Geburstag:</a></th>
      <th scope="col"><a href="./index.php?view=viewCustomer&sortmethod=<?php echo $displaysortmethod ?>&sort=kontaktpermail<?php echo $displaysearch?>" class="link-secondary text-decoration-none">
          Kontakt erwünscht</a></th>
    </tr>
  </thead>
  <tbody>
    <?php foreach ($customers as $customer) : ?>
      <tr>
        <th scope="row"><?php echo $customer->kid; ?></th>
        <td><?php echo $customer->vorname; ?></td>
        <td><?php echo $customer->name; ?></td>
        <td><?php echo $customer->geschlecht; ?></td>
        <td><?php echo $customer->kunde_seit; ?></td>
        <td><?php echo $customer->email; ?></td>
        <td><?php echo $customer->geburtstag; ?></td>
        <td><?php echo $customer->kontaktpermail == 1 ? "Ja" : "Nein"; ?></td>
      </tr>
    <?php endforeach; ?>
  </tbody>
</table>
<script>
function addSearchParamToGET(){
  var searchParam = document.getElementById("searchInput").value;
  const urlParams = new URLSearchParams(window.location.search);
  urlParams.set('search', searchParam);
  window.location.search = urlParams;
}
</script>

<?php 
  $searchparam = createParam($sort, $sortmethod, $searchkeyword);
  ?>

<?php $paginationsystem->generatePagination("viewCustomer", $searchparam) ?>