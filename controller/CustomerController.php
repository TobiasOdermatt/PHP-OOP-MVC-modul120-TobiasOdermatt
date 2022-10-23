<?php
class CustomerController {
    public function load_customers($start,$limit,$db,$sortmethod,$sort){
        $Customers = new Customer();
        $Customers = $Customers->get_data($start,$limit,$db,$sortmethod,$sort);
        return $Customers;
    }

    public function load_customersWithKeyword($start,$limit,$db,$searchkeyword,$sortmethod,$sort){
        $Customers = new Customer();
        $Customers = $Customers->get_data_with_keyword($start,$limit,$db,$searchkeyword,$sortmethod,$sort);
        return $Customers;
    }
}
?>