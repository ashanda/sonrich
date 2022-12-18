<?php
use Monarobase\CountryList\CountryListFacade;

 function getCountryList(){
    $countries = CountryListFacade::getList('en');
     return $countries;
 } 



