<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="The order page for The Pizza club">
    <title>The Pizza Club</title>
    <meta name="robots" content="noindex, nofollow">
    <link rel="stylesheet" href="./css/style.css">
    <link href="https://fonts.googleapis.com/css2?family=Italiana&display=swap" rel="stylesheet">
  </head>
  <header>
    <div>
    <p>The Pizza Club</p>
  </div>
  <div>
    <ul>
      <li><a href="#">Home</a></li>
      <li><a href="#">Order a Pizza</a></li>
      <li><a href="#">About us</a></li>
    </ul>
  </div>
  </header>
  <body>
    
    <div class = "hero-image">
      <div>
        <h1 id="hero-text">Hungry?</h1>
        <p id="hero-text">Order a Pizza!</p>
      </div>
    </div>
  
    <div class="table">
      <form method="post">
        <h3>Fill out the following and we will start making your pizza!</h3>
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
    <textarea id ="notes" name="notes" placeholder="Please list any allergies or notes about your order that you might want us to know! (500 character limit)"></textarea><br>
  
    <input type="submit">
        
    </form>
    </div> 
      <?php
            require_once('database.php');

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
                $words = "";
                for($x = 1; $x<=3; $x+=1){
                  if($_POST['topping-'.$x] !=="none" && $x >= 3)
                  $words = $words ." and ".$_POST['topping-'.$x];
                  else if($_POST['topping-'.$x] !== "none"){
                    $words = $words ." ".$_POST['topping-'.$x].",";
                  }
                }
                echo"<p id='table-p'>Your pizza with ".$words." has been orderderd!</p>";
              }
              else
                echo "<p>Hmm... It seems there is an issue with submitting the order, make sure you entered all the boxes properly. There could also be a problem on our end.</p>";
            }
            
          ?>

     
  </body>
</html>
