
  <?php
    function currencies()
    {
        $client = new SoapClient("http://www.mnb.hu/arfolyamok.asmx?WSDL");
        $result = new SimpleXMLElement($client->GetCurrencies()->GetCurrenciesResult);
        $stack = array();
        foreach ($result->xpath("//Currencies/Curr") as $item) { $stack[] = $item[0]; }
        return $stack;
    }

    function exc_rates($start_date, $end_date, $currency)
    {
          $stack2 = array();
          $soapClient = new Soapclient("http://www.mnb.hu/arfolyamok.asmx?singleWsdl");
          $res = $soapClient->GetExchangeRates(array('startDate' => $start_date, 'endDate' => $end_date, 'currencyNames' => $currency));
         
          $result=$res -> GetExchangeRatesResult;
          return $result;
    }
    function date_magic($raw_date)
    {
        $sdate = explode("/", $raw_date);
        return($sdate[2] . "-" . $sdate[0] ."-". $sdate[1]);
      
    }
  ?>
