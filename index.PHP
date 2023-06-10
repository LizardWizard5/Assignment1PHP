<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="The order page for The Pizza club">
    <title>The Pizza Club</title>
    <meta name="robots" content="noindex, nofollow">
    <link rel="stylesheet" href="./css/style.css">

    <link href="https://fonts.googleapis.com/css2?family=EB+Garamond:ital@1&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Quicksand:wght@700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Lobster&display=swap" rel="stylesheet">

    <script src="https://kit.fontawesome.com/3bdd956d40.js" crossorigin="anonymous"></script>


  </head>
  <body>
  <header class="heder">
    
    <p id="logo-text"><a href="index.php">The Pizza Club</a></p>
  
    <ul>
      <li><a href="#">Home</a></li>
      <li><a href="#">Order a Pizza</a></li>
      <li><a href="#">About us</a></li>
    </ul>
  
  </header>
  
    
    <div class ="hero-image">
      <div>
        <h1>Hungry?</h1>
        <p>Order a Pizza!</p>
      </div>
    </div>
  
    <div class="table">
      <form method="post">
        <h3>Fill out your contact and order information and we will start making your pizza!</h3>
        <section>
          <label for="name">Your Name</label><br>
          <input id="name" type="text" name ="fName" placeholder="* Firstname" required>
          <input type="text" name="lName" placeholder="* Lastname" required><br>
          <label for="contact">Email and phone number</label><br>
          <input id="contact" type="text" name="email" placeholder="* Example@myMail.com" required>
          <input type="tel" name="pNumber" placeholder="*123-456-7890" pattern="[0-9]{3}-[0-9]{3}-[0-9]{4}" required><br>
      </section>

      <section>
        <label>Pizza toppings</label><br>
        <select name="topping-1">
          <option value="none">None</option>
          <option value="pepperoni">Pepperoni</option>
          <option value="bacon-bits">Bacon Bits</option>
          <option value="pineapple">Pineapple</option>
        </select>
        <select name="topping-2">
          <option value="none">None</option>
          <option value="pepperoni">Pepperoni</option>
          <option value="bacon-bits">Bacon Bits</option>
          <option value="pineapple">Pineapple</option>
        </select>
        <select name="topping-3">
          <option value="none">None</option>
          <option value="pepperoni">Pepperoni</option>
          <option value="bacon-bits">Bacon Bits</option>
          <option value="pineapple">Pineapple</option>
        </select>
        
    </section>
    <label for="notes">Special Notes</label><br>
    <textarea id ="notes" name="notes" placeholder="Please list any allergies or notes about your order that you might want us to know! (500 character limit)"></textarea><br>
  
    <input id="submit" type="submit" value="Place Order">
        
    </form>
    </div> 
      <?php
            $outputData = false;//Sets up the data print out in the footer
            require_once('DB.php');

            if(isset($_POST) & !empty($_POST)){
              $fName = $database -> sanitize($_POST['fName']);//Sanitizes all the information in the forms and fixes and character that might mess with mySQL syntax
              $lName = $database -> sanitize(($_POST['lName']));
              $pNumber = $database -> sanitize(($_POST['pNumber']));
              $email = $database -> sanitize(($_POST['email']));
              $topping1 = $database -> sanitize(($_POST['topping-1']));
              $topping2 = $database -> sanitize(($_POST['topping-2']));
              $topping3 = $database -> sanitize(($_POST['topping-3']));
              $notes = $database -> sanitize(($_POST['notes']));
              $response = $database ->sendData($fName, $lName, $pNumber, $email, $topping1, $topping2, $topping3, $notes);//goes to the sendData function belonging to the database object to send
              if($response){
                $words = "";//Empty string variable for the string builder
                $outputData = true;//Set to true to state that the data has been sent to the db and tell the script on line 135 that it can print out the data
                if($_POST['topping-1'] == "none" && $_POST['topping-2'] == "none" && $_POST['topping-3'] == "none"){//If there were no topping chosen
                  echo"<p class='table-p'>Your plain cheese pizza has been ordered!</p>";//If the user selected no toppings
                }

                else{
                  for($x = 1; $x<=3; $x+=1){//String builder for if the toppings value isn't none. If it's none it will skip the topping and move to the next one. This works if you want to add more toppings options

                    if($_POST['topping-'.$x] !=="none" && $x >= 3){
                      $words = $words ." and ".$_POST['topping-'.$x];//This s for the last topping option so that we can have proper english for a lst and add a "and"
                    }

                    else if($_POST['topping-'.$x] !== "none"){//if the topping does not equal none we add it to the string
                      $words = $words ." ".$_POST['topping-'.$x].",";
                    }
                  }

                  echo"<p class='table-p'>Your pizza with ".$words." has been orderderd!</p>";//Prints out the finished order prinout if you selected toppings
                }
              }
              else{
                echo "<p>Hmm... It seems there is an issue with submitting the order, make sure you entered all the boxes properly. There could also be a problem on our end.</p>";
              }
            }
            
          ?>
    <footer class="footer">
            <div id="social">
              <p>Check out the social pages</p>
              <ul>
              <li><i class="fa-brands fa-twitter" style="color: #0000f0;"></i><a href="#"> Twitter</a></li>
              <li><i class="fa-brands fa-instagram" style="color: #e623eb;"></i><a href="#"> Instagram</a></li>
              <li><i class="fa-brands fa-facebook" style="color: #0000f0;"></i><a href="#"> Facebook</a></li>
              </ul>
            </div>

            <div id = "data-out">
              <?php
              if($outputData){//If the data is sent, this prints out the data that was sent to the SQL server
              echo "<p> Data sent! </p>";
              echo "<p>Name: ".$fName." ".$lName."</p>";
              echo "<p>Phone Number: ".$pNumber."</p>";
              echo "<p>Email: ".$email."</p>";
              echo "<p>Toppings: ".$topping1.", ".$topping2.", ".$topping3."</p>";
              }
              ?>
            </div>
            <p id="copyright">Pizza company (c) 2023</p>
            

    </footer>
     
  </body>
</html>