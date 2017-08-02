
<!DOCTYPE html>
<html>
<head>
<script src="http://code.jquery.com/jquery-1.11.0.min.js"></script>
  <meta charset="utf-8">
  <title>Example</title>
</head>
<body>
  <table>
    <thead>
      <tr>
        <th>Quantity</th>
        <th>Price</th>
        <th>Total</th>
      </tr>
    </thead>
    <tbody>
      <tr>
        <td><input type="text"></td>
        <td><input type="text"></td>
        <td><input type="text" disabled></td>
      </tr>

       <tr>
        <td><input type="text"></td>
        <td><input type="text"></td>
        <td><input type="text" disabled></td>
      </tr>
      <!-- ...and so on... -->
    </tbody>
  </table>
<script>
  (function() {
    "use strict";

    $("table").on("change", "input", function() {
      var row = $(this).closest("tr");
      var qty = parseFloat(row.find("input:eq(0)").val());
      var price = parseFloat(row.find("input:eq(1)").val());
      var total = qty * price;
      row.find("input:eq(2)").val(isNaN(total) ? "" : total);
    });
  })();
</script>
</body>
</html>



