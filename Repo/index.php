<?php
require('navbar.php');

$to_address = $_POST['to_address'];
$to_city = $_POST['to_city'];
$to_state = $_POST['to_state'];
$to_postal = $_POST['to_postal'];
$from_address = $_POST['from_address'];
$from_city = $_POST['from_city'];
$from_state = $_POST['from_state'];
$from_postal = $_POST['from_postal'];
$retailer = $_POST['to_name'];

echo ' <div id="myProgress">
            <div id="myBar" style="width: 66%;">66%</div>
        </div><div class="container">
        <h2>'. $retailer .' Requirements<h2>';
        if($retailer == 'walmart') {
echo      '<h3>Carriers: Fedex</h3>
          <h3>Delivery Within: 3 Days</h3>';
        } else if ($retailer == 'target') {
echo      '<h3>Carriers: Stamps.com</h3>
          <h3>Delivery Within: 4 Days</h3>';
        }
echo    '</div>';

  $curl = curl_init();
    curl_setopt_array($curl, array(
      CURLOPT_URL => "https://api.shipengine.com/v1/rates",
      CURLOPT_RETURNTRANSFER => true,
      CURLOPT_ENCODING => "",
      CURLOPT_MAXREDIRS => 10,
      CURLOPT_TIMEOUT => 30000,
      CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
      CURLOPT_CUSTOMREQUEST => "POST",
      CURLOPT_POSTFIELDS => "\n{\n  \"shipment\": {\n    \"validate_address\": \"no_validation\",\n    \"ship_to\": {\n      \"name\": \"Mickey and Minnie Mouse\",\n      \"phone\": \"714-781-4565\",\n      \"company_name\": \"The Walt Disney Company\",\n      \"address_line1\": \"$to_address\",\n      \"city_locality\": \"$to_city\",\n      \"state_province\": \"$to_state\",\n      \"postal_code\": \"$to_postal\",\n      \"country_code\": \"US\"\n    },\n    \"ship_from\": {\n      \"name\": \"Dade Murphy\",\n      \"phone\": \"512-485-4282\",\n      \"company_name\": \"Zero Cool\",\n      \"address_line1\": \"$from_address\",\n      \"city_locality\": \"$from_city\",\n      \"state_province\": \"$from_state\",\n      \"postal_code\": \"$from_postal\",\n      \"country_code\": \"US\",\n    },\n    \"packages\": [\n      {\n        \"weight\": {\n          \"value\": 1.0,\n          \"unit\": \"ounce\"\n        }\n      }\n    ]\n  },\n  \"rate_options\": {\n    \"carrier_ids\": [\n      \"se-103353\",\n      \"se-103352\"\n    ]\n  }\n}",
      CURLOPT_HTTPHEADER => array(
        "Accept: */*",
        "Cache-Control: no-cache",
        "Connection: keep-alive",
        "Content-Type: application/json",
        "Host: api.shipengine.com",
        "Postman-Token: a38584dc-1af0-490b-9a85-3fb61e5a5c44,42531997-8d55-4c71-882e-f90242b37067",
        "User-Agent: PostmanRuntime/7.11.0",
        "accept-encoding: gzip, deflate",
        "api-key: TEST_DNI8r1W7l3taRjXGg1ADw5J+hy7uAPdadsM/8eNK6Gk",
        "cache-control: no-cache",
        "content-length: 890"
      ),
    ));



    $response = curl_exec($curl);
    $arr = json_decode($response, true);
    $rates = $arr['rate_response']['rates'];
    $err = curl_error($curl);

    curl_close($curl);
    echo '
    <div class="container">
    <div class="row">

    <table class="pg-2-table">
      <form action="purchase-form.php" method="get">
      <tr>
        <th>Carrier</th>
        <th>Estimated Transit</th>
        <th>Price</th>
        <th style="border:none;"></th>
      </tr>';


    if ($err) {
      echo "cURL Error #:" . $err;
    } else {
      foreach ($rates as $rate) {
        $delivery_time = $rate['delivery_days'];
        $carrier_friendly_name = $rate['carrier_friendly_name'];
        $package = $rate['package_type'];
        if ($carrier_friendly_name == 'FedEx') {
          $package = $rate['service_type'];
        }

        $estimated_delivery_date = $rate['estimated_delivery_date'];
        $estimated_delivery_date = explode("T",$estimated_delivery_date);
        $estimated_delivery_date = $estimated_delivery_date[0];

        $ship_price = $rate['shipping_amount']['amount'];
        $currency = strtoupper($rate['shipping_amount']['currency']);
        $service_type = $rate['service_type'];
        $rate_id = $rate['rate_id'];
        if ($delivery_time <= 3 && $carrier_friendly_name == 'FedEx' && $retailer == 'walmart') {
          echo '  <tr>
              <td>'.$carrier_friendly_name. '<span class="package-type"> '. $package .' </span></td>
              <td>'.$delivery_time . ' Days, ' . $estimated_delivery_date .'</td>
              <td>$'.$ship_price.'</td>
              <td><input type="radio" name="select" value="'.$rate_id.'"></td>
            </tr>';
        } else if ($delivery_time <= 4 && $carrier_friendly_name == 'Stamps.com' && $retailer == 'target') {
          echo '  <tr>
              <td>'.$carrier_friendly_name. '<span class="package-type"> '. $package .' </span></td>
              <td>'.$delivery_time . ' Days, ' . $estimated_delivery_date .'</td>
              <td>$'.$ship_price.'</td>
              <td><input type="radio" name="select" value="'.$rate_id.'"></td>
            </tr>';
        }
      }


    }
    echo '</table><input type="submit" value="Submit Order" style="height: 40px;"></form>
    </div>
    </div>';
