<?php

$to_address = "500 South Buena Vista Street";
$to_city = "Burbank";
$to_state = "CA";
$to_postal = "91521";
$from_address = "345 Chambers Street";
$from_city = "New York City";
$from_state = "NY";
$from_postal = "10282";

function rates($to_address, $to_city, $to_state, $to_postal, $from_address, $from_city, $from_state, $from_postal) {
  $curl = curl_init();
    curl_setopt_array($curl, array(
      CURLOPT_URL => "https://api.shipengine.com/v1/rates",
      CURLOPT_RETURNTRANSFER => true,
      CURLOPT_ENCODING => "",
      CURLOPT_MAXREDIRS => 10,
      CURLOPT_TIMEOUT => 30000,
      CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
      CURLOPT_CUSTOMREQUEST => "POST",
      CURLOPT_POSTFIELDS => "\n{\n  \"shipment\": {\n    \"validate_address\": \"no_validation\",\n    \"ship_to\": {\n      \"name\": \"Mickey and Minnie Mouse\",\n      \"phone\": \"714-781-4565\",\n      \"company_name\": \"The Walt Disney Company\",\n      \"address_line1\": \"$to_address\",\n      \"city_locality\": \"$to_city\",\n      \"state_province\": \"$to_state\",\n      \"postal_code\": \"$to_postal\",\n      \"country_code\": \"US\"\n    },\n    \"ship_from\": {\n      \"name\": \"Dade Murphy\",\n      \"phone\": \"512-485-4282\",\n      \"company_name\": \"Zero Cool\",\n      \"address_line1\": \"$from_address\",\n      \"address_line2\": \"\",\n      \"city_locality\": \"$from_city\",\n      \"state_province\": \"$from_state\",\n      \"postal_code\": \"$from_postal\",\n      \"country_code\": \"US\",\n    },\n    \"packages\": [\n      {\n        \"weight\": {\n          \"value\": 1.0,\n          \"unit\": \"ounce\"\n        }\n      }\n    ]\n  },\n  \"rate_options\": {\n    \"carrier_ids\": [\n      \"se-103353\",\n      \"se-103352\"\n    ]\n  }\n}",
      CURLOPT_HTTPHEADER => array(
        "Accept: */*",
        "Cache-Control: no-cache",
        "Connection: keep-alive",
        "Content-Type: application/json",
        "Host: api.shipengine.com",
        "Postman-Token: c1a3d63b-c939-42b0-b5dd-bf819b95ec9d,a46f12b3-f5be-4dd5-9425-6f736b4f8536",
        "User-Agent: PostmanRuntime/7.11.0",
        "accept-encoding: gzip, deflate",
        "api-key: TEST_DNI8r1W7l3taRjXGg1ADw5J+hy7uAPdadsM/8eNK6Gk",
        "cache-control: no-cache",
        "content-length: 926"
      ),
    ));


    $response = curl_exec($curl);
    $arr = json_decode($response, true);
    $rates = $arr['rate_response']['rates'];
    $err = curl_error($curl);

    curl_close($curl);

    if ($err) {
      echo "cURL Error #:" . $err;
    } else {
      foreach ($rates as $rate) {
        $delivery_time = $rate['delivery_days'];
        $package = $rate['package_type'];
        $estimated_delivery_date = $rate['estimated_delivery_date'];
        $estimated_delivery_date = explode("T",$estimated_delivery_date);
        $estimated_delivery_date = $estimated_delivery_date[0];
        $carrier_friendly_name = $rate['carrier_friendly_name'];
        $ship_price = $rate['shipping_amount']['amount'];
        $currency = strtoupper($rate['shipping_amount']['currency']);
        $service_type = $rate['service_type'];
        if ($delivery_time >= 3) {
          echo $package . ': '. $delivery_time .'days, ' . $estimated_delivery_date . '  ' . $service_type. ' ' . $carrier_friendly_name . ' Price: ' . $ship_price . $currency .'<br>';
        }
      }


    }
}

rates($to_address, $to_city, $to_state, $to_postal, $from_address, $from_city, $from_state, $from_postal);
