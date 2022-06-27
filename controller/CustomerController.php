<?php

class CustomerController {
	
    public function load_customers($start,$limit,$db,$sortmethod,$sort){
        $Customers = new Customer();
        $Customers = $Customers->get_data($start,$limit,$db,$sortmethod,$sort);
        return $Customers;
    }
}
?>