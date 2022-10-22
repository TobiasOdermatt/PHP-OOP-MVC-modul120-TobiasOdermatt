<!-- Seiteninhalt-->
<br>
<h1>Kundenverwaltung</h1>

<p>Auf dieser Seite kÃ¶nnen alle Kunden des BÃ¼cherantiquariat Basels einfach verwaltet werden.</p>
<?php
require_once('model/connection.php');
require_once('controller/CustomerController.php');
require_once('helpers/paginationmanagement.php');
include 'model/customer.php';

$db = Database::getInstance();
$paginationsystem = new paginationmanagement("kunden", $db, 30);
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
  $displaysortmethod = $sortoption[array_search($_GET['sortmethod'], $sortoption)+1];
  }
}

$sort = isset($_GET['sort']) ? $_GET['sort'] : null;
$searchkeyword = isset($_GET['search']) ? $_GET['search'] : null;
if($searchkeyword == null)
{
  $customers = $customers->load_customers($start, $limit, $db, $sortmethod, $sort);
}
else
{
  $customers = $customers->load_customersWithKeyword($start, $limit, $db, $searchkeyword, $sortmethod, $sort);
}
?>


<div class="input-group">
  <input type="search" class="form-control rounded" placeholder="Datenbank nach Kunden durchsuchen.." id="searchInput"/>
  <button type="button" onclick="addSearchParamToGET()" class="btn btn-primary">Suchen</button>
</div>
<table class="table">
  <thead class="thead-light">
    <tr>
      <th scope="col"><a href="./index.php?view=viewCustomer&sortmethod=<?php echo $displaysortmethod ?>&sort=kid" class="link-secondary text-decoration-none">
          #Kundennummer</a></th>
      <th scope="col"><a href="./index.php?view=viewCustomer&sortmethod=<?php echo $displaysortmethod ?>&sort=vorname" class="link-secondary text-decoration-none">
          Vorname</a></th>
      <th scope="col"><a href="./index.php?view=viewCustomer&sortmethod=<?php echo $displaysortmethod ?>&sort=name" class="link-secondary text-decoration-none">
          Nachname</a></th>
      <th scope="col"><a href="./index.php?view=viewCustomer&sortmethod=<?php echo $displaysortmethod ?>&sort=geschlecht" class="link-secondary text-decoration-none">
          Geschlecht</a></th>
      <th scope="col"><a href="./index.php?view=viewCustomer&sortmethod=<?php echo $displaysortmethod ?>&sort=kunde_seit" class="link-secondary text-decoration-none">
          Kunde seit:</a></th>
      <th scope="col"><a href="./index.php?view=viewCustomer&sortmethod=<?php echo $displaysortmethod ?>&sort=email" class="link-secondary text-decoration-none">
          E-Mail:</a></th>
      <th scope="col"><a href="./index.php?view=viewCustomer&sortmethod=<?php echo $displaysortmethod ?>&sort=geburtstag" class="link-secondary text-decoration-none">
          Geburstag:</a></th>
      <th scope="col"><a href="./index.php?view=viewCustomer&sortmethod=<?php echo $displaysortmethod ?>&sort=kontaktpermail" class="link-secondary text-decoration-none">
          Kontakt erwÃ¼nscht</a></th>
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

<?php $paginationsystem->generatePagination("viewCustomer", '') ?>