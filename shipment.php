<?php
require('navbar.php');
 ?>

  <form action="index.php" method="post">
    <div id="myProgress">
        <div id="myBar">33%</div>
    </div>
    <div class="headerdiv"><p id="header">New Shipment</p></div>

</div>
<div class="pickup-section">
  <div class="pickup-address">
    <div class="form-group col-md-6">
      <label for="pickup-name">Pickup Name</label>
      <input type="text" class="form-control" id="pickup-name" name="from_name" value="Vendorly">
    </div>

    <div class="form-group col-md-6">
      <label for="pickup-address">Pickup Address</label>
      <input type="text" class="form-control" id="input-address" name="from_address" value="345 Chambers Street">
    </div>

    <div class="form-group">
      <label for="pickup-city">City</label>
      <input type="text" class="form-control" id="pickup-city" name="from_city" value="New York City">
    </div>
    <div class="form-group">
      <label for="pickup-state">State</label>
      <input type="text" class="form-control" id="pickup-state" name="from_state" value="NY">
    </div>
    <div class="form-group">
      <label for="pickup-postal">Postal Code</label>
      <input type="text" class="form-control" id="pickup-postal" name="from_postal" value="10282">
    </div>
  </div>
  </div>

<div class="delivery-section">
  <div class="ship-address">
    <div class="form-group col-md-6">
      <label for="ship-name"> Name</label>
      <input type="text" class="form-control" id="ship-name" name="to_name" value="walmart">
    </div>
    <div class="form-group col-md-6">
      <label for="ship-address">Delivery Address</label>
      <input type="text" class="form-control" id="input-address" name="to_address" value="500 South Buena Vista Street">
    </div>

    <div class="form-group">
      <label for="ship-city">City</label>
      <input type="text" class="form-control" id="ship-city" name="to_city" value="Burbank">
    </div>
    <div class="form-group">
      <label for="ship-state">State</label>
      <input type="text" class="form-control" id="ship-state" name="to_state" value="CA">
    </div>
    <div class="form-group">
      <label for="ship-postal">Postal Code</label>
      <input type="text" class="form-control" id="ship-postal" name="to_postal" value="91521">
    </div>
  </div>
  </div>

<div class="shipment-details" style="width: 80%;">
  <div class="container">
    <div class="form-group col-md-6">
      <label for="weight">Weight</label>
      <input type="text" class="form-control" name="weight_value" id="weight">
    </div>

    <div class="form-group col-md-6">
      <label for="unit_weight">Unit</label>
      <select id="unit_weight" name="unit_weight" class="form-control">
        <option value="pound">lbs</option>
        <option value="kilogram">kg</option>
      </select>
    </div>
  </div>
<div class="container">

    <div class="form-group col-md-6">
      <label for="width">Width</label>
      <input type="text" class="form-control" name="width_value" id="width">
    </div>
    <div class="form-group col-md-6">
      <label for="length">Length</label>
      <input type="text" class="form-control" name="length_value" id="length">
    </div>
    <div class="form-group col-md-6">
      <label for="height">Height</label>
      <input type="text" class="form-control" name="height_value" id="height">
    </div>
    <div class="form-group col-md-4">
      <label for="dimensions">Unit</label>
      <select id="unit_dimensions" name="unit_dimensions" class="form-control">
        <option value="inch" selected>inches</option>
      </select>
    </div>
</div>


</div>
<br>


<button type="save" class="btnsave">Save for later</button>
<button type="submit" class="btn btn-primary">Get Quotes</button>
</form>


</body>
</html>
