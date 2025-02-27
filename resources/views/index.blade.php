<!DOCTYPE html>
<html>
   <head>
      <style>
         body{
         background-color: black;          
         color: gold;
         font-family: "verdana";
         font-size: 14px;
         padding:20px;
         }
	div{
		float:left;
		padding-right: 50px;
	}
         form{
         border: 1px solid gold;
         padding:20px;
         }
         h1{
         font-family: "Arial";
         font-size: 22px;
         color:salmon;
         }
         form>label{
         padding:20px;
         font-family: "calibri";
         font-size: 16px;
         color:cyan;
         }
         input{
         padding:5px;
         margin: 5px;
         font-family: "Arial";
         font-size: 14px;
         background-color:white;
         }
         table, th, td {
         border: 1px solid gold;
         border-collapse: collapse;
         padding: 10px;
         color:black;
         font-size:14px;
         }
         th {
         background-color: salmon;
         }
      </style>
   </head>
   <body>
      <div>
         <form action="" method="GET">
            <table>
               <tr>
                  <td><h1>Item Name</h1></td>
                  <td><input type="text" id="itemname" name="itemname"></br></td>
               </tr>
               <tr>
                  <td><h1>Price</h1></td>
                  <td><input type="number" id="price" name="price"></br></td>
               </tr>
            </table>
         
            <h1>Card</h1> 
            <input type="radio" id="wife" name="card" value="wife">  
            <label for="wife">Wife's Scotiabank Scene VISA</label></br>
         
            <input type="radio" id="moeed" name="card" value="moeed">
            <label for="moeed">Moeed's Scotiabank PASSPORT VISA</label></br>
         
            <h1>Category</h1> 
            <input type="radio" id="grocery" name="category" value="grocery">
            <label for="grocery">costco/fortinos/freshco/grocery</label></br>
         
            <input type="radio" id="decor" name="category" value="decor">
            <label for="decor">decoration/plates/pots/pans/airfryer/barbeque/blender/whisker</label></br>
         
            <input type="radio" id="furniture" name="category" value="furniture">
            <label for="furniture">bed/workstation/bookshelves/dresser/diningtables/coffeetables</label></br>
         
            <input type="radio" id="food" name="category" value="food">
            <label for="food">shawarma/pizza/burgers/restaurants</label></br>
         
            <input type="radio" id="travel" name="category" value="travel">
            <label for="travel">uber/taxicab/bus/train/flight/boatride</label></br>
         
            <input type="radio" id="beauty" name="category" value="beauty">
            <label for="beauty">hair salon/nails/makeup/hair straightner/glitter/eyebrow plucking</label></br>
         
            <input type="radio" id="clothes" name="category" value="clothes">
            <label for="clothes">dress shirts/hoodies/pants/suits/socks/shoes/dresses/coats/sports apparel</label></br>
         
            <input type="submit" value="Submit">
         </form>
      </div>

      <?php
      if ($_SERVER["REQUEST_METHOD"] == "GET") {
          // Retrieve text inputs
          $item_name = isset($_GET['itemname']) ? htmlspecialchars($_GET['itemname']) : '';
          $price = isset($_GET['price']) ? htmlspecialchars($_GET['price']) : '';
          
          // Retrieve selected radio buttons
          $card = isset($_GET['card']) ? htmlspecialchars($_GET['card']) : '';
          $category = isset($_GET['category']) ? htmlspecialchars($_GET['category']) : '';
          
          // Append data to log.txt if all fields are filled
          if ($item_name && $price && $card && $category) {
              $log_entry = "$item_name,$price,$card,$category\n";
              file_put_contents(resource_path("views/log.txt"), $log_entry, FILE_APPEND);
          }
      }

      // Clean log file contents
      $log_contents = file(resource_path("views/log.txt"), FILE_IGNORE_NEW_LINES);
      $valid_entries = array_filter($log_contents, function($line) {
          return count(explode(",", $line)) === 4 && trim($line) !== 'N/A,N/A,None selected,None selected';
      });
      file_put_contents(resource_path("views/log.txt"), implode("\n", $valid_entries) . "\n");

      // Display log file contents
      echo "<h2>Log File Contents</h2>";
      echo "<table>";
      echo "<tr><th>Item Name</th><th>Price</th><th>Card Used</th><th>Category</th></tr>";
      foreach ($valid_entries as $line) {
          list($item_name, $price, $card, $category) = explode(",", $line);
          $row_class = ($card == 'moeed') ? 'style="background-color: lightblue;"' : (($card == 'wife') ? 'style="background-color: pink;"' : '');
          echo "<tr $row_class>";
          echo "<td>" . htmlspecialchars($item_name) . "</td>";
          echo "<td>" . htmlspecialchars($price) . "</td>";
          echo "<td>" . htmlspecialchars($card) . "</td>";
          echo "<td>" . htmlspecialchars($category) . "</td>";
          echo "</tr>";
      }
      echo "</table>";
      ?>
   </body>
</html>