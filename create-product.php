<script type="text/javascript">
  const goToProductsPage=()=>{
    window.location.href = './products.php'
  }
</script>

<?php
session_start(); 
include_once('src/php/database.php');
include_once('src/php/initial.php');
include_once('src/php/item.php');
if(isset($_SESSION['editItem'])){
    $itemToChange = new Item($db);
    $itemToChange->id = $_SESSION['editItem'];
    $itemToChange->getItem();
}
 if(isset($_POST["create"]))  
 {  
      if(empty($_POST["productName"]) && empty($_POST["url"] && empty($_POST["price"]) && empty($_POST["amount"])))  
      {  
           echo "Jedan od input fieldova je prazan";  
      }  else {
        $productName = htmlspecialchars($_POST["productName"]);
        $url = htmlspecialchars($_POST["url"]);
        $price = htmlspecialchars($_POST["price"]);
        $amount = htmlspecialchars($_POST["amount"]);
        $item = new Item($db);
        $item->imageURL = $url;
        $item->name = $productName;
        $item->amount = $amount;
        $item->price = $price;
        if(isset($_SESSION['editItem'])) {
            $item->id = htmlspecialchars($_SESSION['editItem']);
            if($item->update()) {
                unset($_SESSION['editItem']);
                echo '<script type="text/javascript" >',
                'goToProductsPage();',
                '</script>'
           ;
            } else {
                echo "item update failed";
            }
        }else {
            if($item->create()) {
                echo '<script type="text/javascript" >',
                        'goToProductsPage();',
                        '</script>'
                   ;
            }else {
                echo "item creation failed";
            }
        }
      }
 } 
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />

    <link rel="stylesheet" href="src/css/side-nav.css" />
    <link rel="stylesheet" href="src/css/create-product.css" />

    <script src="src/script/sideNav.js" type="text/javascript" defer></script>

    <title>Create</title>
  </head>
  <body>
  <header>
      <button class="withoutStyle" onclick="openDrawer()">
        <img
          src="src/assets/menuButton.svg"
          alt="menu"
          class="menuStyle"
          aria-label="menu button"
          />
      </button>
      <side-navigation/>
    </header>
    <div class="positionCenter">
      <form class="formContainer" method='POST'>
        <div class="innerFormContainer">
          <div class="positionCenter">
            <h1 class="titleText">Kreiraj novi proizvod</h1>
          </div>
          <div class="inputContainer firstFieldContainer">
            <label class="labelStyle" for="name">Naziv proizvoda</label>
            <input
              class="inputField"
              type="text"
              id="productName"
              name="productName"
              placeholder="Unesite ime proizvoda"
              value="<?php echo (isset($itemToChange))?$itemToChange->name:'';?>"
              required
            />
          </div>
          <div class="inputContainer">
            <label class="labelStyle" for="url">Url slike</label>
            <input
              class="inputField"
              type="text"
              id="url"
              name="url"
              placeholder="Unesite url slike"
              value="<?php echo (isset($itemToChange))?$itemToChange->imageURL:'';?>"
              required
            />
          </div>
          <div class="smallInputContainer">
            <div class="innerInputContainer firstInputContainer">
              <label class="labelStyle" for="price">Cijena</label>
              <input
                class="smallInputField"
                type="number"
                id="price"
                name="price"
                placeholder="0"
                value="<?php echo (isset($itemToChange))?$itemToChange->price:'';?>"
                required
              />
            </div>
            <div class="innerInputContainer">
              <label class="labelStyle" for="amount">Količina</label>
              <input
                class="smallInputField"
                type="number"
                id="amount"
                name="amount"
                placeholder="0"
                value="<?php echo (isset($itemToChange))?$itemToChange->amount:'';?>"
                required
              />
            </div>
          </div>
        </div>
        <button type="submit" class="submitButton" name="create">Potvrdi proizvod</button>
      </form>
    </div>
  </body>
</html>