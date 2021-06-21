<script type="text/javascript">
  const goToProductsPage=()=>{
    window.location.href = './products.php'
  }

  const navigateToCreateProduct = () => {
  location.href = "./create-product.php";
};
</script>

<?php
    session_start(); 
  include_once('src/php/database.php');
  include_once('src/php/initial.php');
  include_once('src/php/item.php');
    if(isset($_POST['delete'])) {
        $item = new Item($db);
        if($item->delete(htmlspecialchars($_POST['delete']))) {
            echo '<script type="text/javascript" >',
            'goToProductsPage();',
            '</script>'
       ;
        }else {
            echo "delete failed";
        }
    }

    if(isset($_POST['edit'])) {
        $_SESSION['editItem'] = htmlspecialchars($_POST['edit']);
        echo '<script type="text/javascript" >',
            'navigateToCreateProduct();',
            '</script>';
    }
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=s, initial-scale=1.0" />
    
    <link rel="stylesheet" href="src/css/side-nav.css" />
    <link rel="stylesheet" href="src/css/products.css" />

    <script src="src/script/products.js" type="text/javascript" defer></script>
    <script src="src/script/sideNav.js" type="text/javascript" defer></script>

    <title>Products</title>
  </head>
  <body>
    <header>
      <div class="headerContainer">
        <button class="withoutStyle" onclick="openDrawer()">
          <img
            src="src/assets/menuButton.svg"
            alt="menu"
            class="menuStyle"
            aria-label="menu button"
          />
        </button>
        <h1 id="mainTitle">Svi proizvodi</h1>
        <div class="dummySpacer"></div>
      </div>
      <side-navigation></side-navigation>
    </header>
    <section class="tableSectionContainer">
      <div class="addProductContainer">
        <button class="addProductButton" onclick="navigateToCreateProduct()">
          Dodaj proizvod
        </button>
      </div>

      <table id="productTable" class="tableContainer">
        <tr class="columnContainer">
          <th class="columnName"></th>
          <th class="columnName">Ime proizvoda</th>
          <th class="columnName">Cijena</th>
          <th class="columnName">Količina</th>
          <th class="columnName"></th> 
          <th class="columnName"></th>
        </tr>
        <?php
        $item = new Item($db);
        $prep_state = $item->getAllItems();
        while ($row = $prep_state->fetch(PDO::FETCH_ASSOC)){
            extract($row);
            echo "<tr class='rowContainer'>";
              echo "<td ><img class='imageStyle' src='$row[imageURL]'/></td>";
              echo "<td class='rowStyle'>$row[name]</td>";
              echo "<td class='rowStyle'>$row[amount]</td>";
              echo "<td class='rowStyle'>$row[price]</td>";
              echo "<td>";
              echo "<form method='POST'><button class='tableButton deleteButtonBG' value='$row[id]' name='delete'>Obriši</button></form>";
              echo "</td>";
              echo "<td>";
              echo "<form method='POST'><button class='tableButton editButtonBG' value='$row[id]' name='edit'>Uredi</button>";
              echo "</td>";
            echo "</tr>";
        }
        ?>
      </table>
    </section>
  </body>
</html>