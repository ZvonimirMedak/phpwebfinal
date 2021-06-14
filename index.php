<?php
//Get Heroku ClearDB connection information
//dodan komentar
$cleardb_url = parse_url(getenv("CLEARDB_DATABASE_URL"));
$cleardb_server = $cleardb_url["host"];
$cleardb_username = $cleardb_url["user"];
$cleardb_password = $cleardb_url["pass"];
$cleardb_db = substr($cleardb_url["path"],1);
$active_group = 'default';
$query_builder = TRUE;
// Connect to DB
$conn = mysqli_connect($cleardb_server, $cleardb_username, $cleardb_password, $cleardb_db);
// sql to create table
$sql = "CREATE TABLE Items (
    id INT unsigned auto_increment primary key,
    name VARCHAR(50) NOT NULL,
    amount INT unsigned NOT NULL,
    price FLOAT(2) NOT NULL)";
    
    if ($conn->query($sql) === TRUE) {
      echo "Table MyGuests created successfully";
    } else {
      echo "Error creating table: " . $conn->error;
    }
?>

<?php
echo "<div class='right-button-margin'>";
    echo "<a href='index.php' class='btn btn-info pull-right'>";
        echo "<span class='glyphicon glyphicon-list-alt'></span> Read Users ";
    echo "</a>";
echo "</div>";


// check if the form is submitted
if ($_POST){

    // instantiate user object
    include_once 'src/php/Item.php';
    $item = new Item($conn);

    // set user property values
    //$item->name = htmlentities(trim($_POST['name']));
    //$item->amount = htmlentities(trim($_POST['amount']));
    //$item->price = htmlentities(trim($_POST['price']));
    $item->name = "čvarak";
    $item->amount = 12;
    $item->price = 50.0;

    // if the user able to create
    if($item->create()){
        echo "<div class=\"alert alert-success alert-dismissable\">";
            echo "<button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-hidden=\"true\">
                        &times;
                  </button>";
            echo "Success! User is created.";
        echo "</div>";
    }

    // if the user unable to create
    else{
       /* echo "<div class=\"alert alert-danger alert-dismissable\">";
            echo "<button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-hidden=\"true\">
                        &times;
                  </button>";
            echo "Error! Unable to create user.";
        echo "</div>";*/
    }
}
?>


<!DOCTYPE html>
<html lang="hr">

<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="src/css/index.css">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400&display=swap" rel="stylesheet">
    <script src="./src/script/index.js"></script>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Čvarci.net</title>
</head>

<body>
    <header class="mainContainer">
        <section class="infoContainer spaceBetweenXAxis">
            <div>
                <h1 id="mainTitle">Najbolji čvarci na kućnom pragu</h1>
                <div class="optionsContainer">
                    <button class="customButton positionCenter" type="button">
                        <div>
                            <h2 class="family largeText">DOSTAVA</p>
                                <p class="family mediumText">Naruči</p>
                        </div>
                    </button>
                    <button class="customButton positionCenter" type="button">
                        <div>
                            <h2 class="family largeText">PREUZMI</p>
                                <p class="family mediumText">Na čvarkomatu</p>
                        </div>
                    </button>
                </div>
            </div>
            <img src="src/assets/cvarci.jpg" alt="cvarci" loading="lazy" class="cvarciImage" aria-label="slika čvaraka">
        </section>
        <section class="headerContainer spaceBetweenXAxis">
            <img src="src/assets/menuButton.svg" alt="menu" class="menuStyle" aria-label="menu button" />
            <img src="src/assets/logo.svg" alt="logo" class="titleImage" aria-label="čvarci.net logo" />
            <div class="spaceBetweenXAxis">
                <button class="loginButton spaceBetweenXAxis buttonWithoutOutline" type="button">
                    <img src="src/assets/person.svg" alt="login" class="loginIcon" />
                    <p class="headerRightText family">PRIJAVI SE</p>
                </button>
                <button onclick="toggleCart()" class="cartButton buttonWithoutOutline">
                    <img src="src/assets/cart.svg" alt="cart" class="cartIcon" />
                </button>
                <p id="cartAmountID" class="cartAmount mediumText family">0</p>
            </div>
            <div id="cart" class="cartContainer">
                <div class="triangleContainer">
                    <img src="./src/assets/triangle.svg" alt="triangle" loading="lazy"/>
                </div>
                <h2 class="cart-title mediumText family">Moja košarica</h2>
                <button id="slideUpButton" type="button" aria-label="scroll up button" class="buttonSliderContainer arrow">
                    <img loading="lazy" src="src/assets/arrowUp.svg" class="arrowImage" alt="arrow-up">
                </button>
                <ul id="cartList"></ul>
                <button id="slideDownButton" aria-label="scroll down button" type="button" class="buttonSliderContainer arrow">
                    <img loading="lazy" src="src/assets/arrowDown.svg" class="arrowImage" alt="arrow-down">
                </button>
                <button class="buyNowButton" type="submit">
                    <p class="buyNowButtonText largeText family">Kupi sada</p>
                </button>
            </div>
        </section>
    </header>
    <ul class="deliveryList" aria-label="lista o dostavi i porijeklu">
        <li class="deliveryItem firstItemMargin spaceBetweenXAxis">
            <img src="src/assets/timeEat.svg" alt="delivery time" class="deliveryImage"
                aria-label="slika vremena dostave" />
            <p class="mediumText family">dostavljamo čvarke za manje od 30 minuta</p>
        </li>
        <li class="deliveryItem spaceBetweenXAxis">
            <img src="src/assets/delivery.svg" alt="type of delivery" class="deliveryImage"
                aria-label="slika načina dostavee" />
            <p class="mediumText family">naši šoferi voze tomose</p>
        </li>
        <li class="deliveryItem spaceBetweenXAxis">
            <img src="src/assets/paris.svg" alt="origin of cracklings" class="deliveryImage"
                aria-label="slika porijekla prasaca" />
            <p class="mediumText family">nabavljamo najbolje prasce iz francuske</p>
        </li>
    </ul>

    <section class="centerColumn">
        <div class="cvarciTitleBottomMargin positionCenter">
            <h2 class="h2TitleStyle family cvarciTitle">
                Novo u ponudi ! naručite čvarke online
            </h2>
        </div>
        <div  class="cvarciListContainer">
            <ul class="restaurantListContainer">
                <li class="instagramItemPadding cvarciMarginBottom">
                    <img src="src/assets/domaci_cvarci.png" loading="lazy" alt="Čvarci domaći" class="cvarciListImageSize cvarciMarginBottom"/>
                    <h3 id="domaci_cvarciID"  class="cvarciMarginBottom family cvarciNameBoldStyle">
                        Čvarci domaći
                    </h3>
                    <div class="cvarciMarginBottom positionLeft spaceBetweenXAxis">
                        <p id="domaci_cvarci_price" class="mediumText textYellowColor family">
                            50,00 kn 
                        </p>
                        <p class="mediumText pricePerWeightMargin family">
                            / kg
                        </p>
                    </div>
                    <div  class="positionLeft cvarciMarginBottom">
                        <p class="mediumText family">Količina:</p>
                    <input type="number" id="domaci_cvarci" class="amountContainer" size=1 value="1" />
                    </div>
                    <button id="domaci_cvarci_button" onclick="addToCart(domaci_cvarci)" class="addToCartButton positionCenter" type="submit">
                        <p class="largeText family buttonTextColor">Stavi u košaricu</p>
                    </button>
                </li>
                <li class="instagramItemPadding cvarciMarginBottom">
                    <img src="src/assets/slavonski_cvarci.png" loading="lazy" alt="Čvarci slavonski"
                        class="cvarciListImageSize cvarciMarginBottom"/>
                        <h3 id="slavonski_cvarciID" class="cvarciMarginBottom family cvarciNameBoldStyle">
                        Čvarci slavonski
                    </h3>
                    <div class="cvarciMarginBottom positionLeft">
                        <p id="slavonski_cvarci_price" class="mediumText textYellowColor family">
                            80,00 kn 
                        </p>
                        <p class="mediumText pricePerWeightMargin family">
                            / kg
                        </p>
                    </div>
                    <div class="positionLeft cvarciMarginBottom">
                        <p class="mediumText family">Količina:</p>
                    <input type="number" id="slavonski_cvarci"  class="amountContainer" size=1 value="1" />
                    </div>
                    <button id="slavonski_cvarci_button" onclick="addToCart(slavonski_cvarci)" class="addToCartButton positionCenter" type="submit">
                        <p class="largeText family buttonTextColor">Stavi u košaricu</p>
                    </button>
                </li>
                <li class="instagramItemPadding cvarciMarginBottom">
                    <img src="src/assets/pileci_cvarci.png" loading="lazy" alt="Čvarci pileći" class="cvarciListImageSize cvarciMarginBottom"/>
                        <h3 id="pileci_cvarciID" class="cvarciMarginBottom family cvarciNameBoldStyle">
                        Čvarci pileći
                    </h3>
                    <div class="cvarciMarginBottom positionLeft">
                        <p id="pileci_cvarci_price" class="mediumText textYellowColor family">
                            60,00 kn 
                        </p>
                        <p class="mediumText pricePerWeightMargin family">
                            / kg
                        </p>
                    </div>
                    <form  method='POST'>
                        <div class="positionLeft cvarciMarginBottom">
                            <p class="mediumText family">Količina:</p>
                            <input type="text"  class="amountContainer" id="pileci_cvarci" size=1 value="name" name="name"/>
                            <input type="number"  class="amountContainer" id="pileci_cvarci" size=1 value="price" name="price"/>
                        <input type="number"  class="amountContainer" id="pileci_cvarci" size=1 value="1" name="amount"/>
                        </div>
                        <button id="pileci_cvarci_button" class="addToCartButton positionCenter" type="submit">
                            <p class="largeText family buttonTextColor">Stavi u košaricu</p>
                        </button>
                    </form>
                    
                </li>
                <li class="instagramItemPadding cvarciMarginBottom">
                    <img src="src/assets/cvarci_od_divljaci.png" loading="lazy" alt="Čvarci od divljači" class="cvarciListImageSize cvarciMarginBottom"/>
                        <h3 id="cvarci_od_divljaciID"  class="cvarciMarginBottom cvarciNameBoldStyle family">
                        Čvarci od divljači
                    </h3>
                    <div class="cvarciMarginBottom positionLeft">
                        <p id="cvarci_od_divljaci_price" class="mediumText textYellowColor family">
                            100,00 kn 
                        </p>
                        <p class="mediumText pricePerWeightMargin family">
                            / kg
                        </p>
                    </div>
                    <div class="positionLeft cvarciMarginBottom">
                        <p class="mediumText family">Količina:</p>
                    <input type="number" id="cvarci_od_divljaci" class="amountContainer" size=1 value="1" />
                    </div>
                    <button id="cvarci_od_divljaci_button" onclick="addToCart(cvarci_od_divljaci)" class="addToCartButton positionCenter" type="submit">
                        <p class="largeText family buttonTextColor">Stavi u košaricu</p>
                    </button>
                </li>
            </ul>
        </div>
    </section>



    <section class="centerColumn">
        <div>
            <div class="restaurantHeaderContainer spaceBetweenXAxis">
                <h2 class="h2TitleStyle">
                    Naše čvarke možete pronaći
                </h2>
                <button class="seeAllButton buttonWithoutOutline" type="button">
                    <p class="largeText family buttonTextColor">prikaži više</p>
                </button>
            </div>
            <ul class="restaurantListContainer">
                <li class="edgeContainer">
                    <button class="navigationButton buttonWithoutOutline leftNavigation positionCenter" type="button">
                        <img src="src/assets/arrow.svg" alt="arrow left" aria-label="swipe left" />
                    </button>
                    <img src="src/assets/firstRestaurant.jpg" loading="lazy" alt="first restaurant"
                        class="listImageSize" ar />
                </li>
                <li>
                    <img src="src/assets/secondRestaurant.png" loading="lazy" alt="second restaurant"
                        class="listImageSize" />
                </li>
                <li>
                    <img src="src/assets/thirdRestaurant.png" loading="lazy" alt="third restaurant"
                        class="listImageSize" />
                </li>
                <li class="edgeContainer">
                    <button class="navigationButton buttonWithoutOutline rightNavigation positionCenter" type="button">
                        <img src="src/assets/arrow.svg" alt="arrow right" aria-label="swipe right" />
                    </button>
                    <img src="src/assets/fourthRestaurant.png" loading="lazy" alt="fourth restaurant"
                        class="listImageSize" />
                </li>
            </ul>
            <div class="paginationContainer">
                <button class="buttonWithoutOutline">
                    <p class="largeText">Prev</p>
                </button>
                <div class="positionCenter">
                    <div class="paginatedCircle activeCircle">
                        <p>1</p>
                    </div>
                    <p>....</p>
                    <div class="paginatedCircle">
                        <p>584</p>
                    </div>
                </div>

                <button class="buttonWithoutOutline">
                    <p class="largeText">Next</p>
                </button>
            </div>
        </div>
    </section>
    <form class="userInfoContainer positionCenter">
        <div class="innerContainer positionCenter">
            <div class="infoTextPosition">
                <h2 class="h2TitleStyle">
                    Želite biti naš brand partner ?
                    <p class="mediumText family textWidth">
                        Pošaljite nam Vaš broj i kontaktirat ćemo Vas u najkraćem moguću roku
                    </p>
                </h2>
            </div>
            <div class="positionCenter">
                <input type="text" placeholder="Pošaljite Vašu email adresu" class="inputContainer" size=25 value="" />
                <button class="sendButton positionCenter" type="submit">
                    <p class="largeText family buttonTextColor">pošalji</p>
                </button>
            </div>
        </div>
    </form>
    <section class="mapContainer">
        <h2 class="h2TitleStyle mapTextWidth">
            Gdje se nalaze naši čvarkomati ?
        </h2>
        <img src="src/assets/map.jpg" alt="Our location" loading="lazy" class="mapSize" aria-label="slika s lokacijama naših poslovnica" />
    </section>
    <section class="positionCenter infoListContainer">
        <ul class="circleList">
            <li class="centerColumn itemMargin">
                <div class="circle circleSize">
                    <div class="innerCircle circleSize">
                        <p class="largeBoldText family" aria-label="1 unutar kruga">1</p>
                    </div>
                </div>
                <p class="largeBoldText family">klaonica</p>
            </li>
            <li class="centerColumn itemMargin">
                <div class="circle circleSize">
                    <div class="innerCircle circleSize">
                        <p class="largeBoldText family" aria-label="6 unutar kruga">6</p>
                    </div>
                </div>
                <p class="largeBoldText family">vrsta čvaraka</p>
            </li>
            <li class="centerColumn itemMargin">
                <div class="circle circleSize">
                    <div class="innerCircle circleSize">
                        <p class="largeBoldText family" aria-label="11 unutar kruga">11</p>
                    </div>
                </div>
                <p class="largeBoldText family">restorana</p>
            </li>
            <li class="centerColumn itemMargin">
                <div class="circle circleSize">
                    <div class="innerCircle circleSize">
                        <p class="largeBoldText family" aria-label="1 unutar kruga">1</p>
                    </div>
                </div>
                <p class="largeBoldText family">najbolja cijena</p>
            </li>
        </ul>
    </section>
    <section class="centerColumn">
        <div>
            <div class="instagramTitleContainer">
                <h2 class="h2TitleStyle">
                    #čvarcinet
                </h2>
                <b class="largeBoldText instagramTextPosition">na instagramu</b>
            </div>
            <ul class="positionCenter instagramContainer restaurantListContainer">
                <li class="instagramItemPadding">
                    <img src="src/assets/instagramFirst.jpg" alt="first instagram image" loading="lazy"
                        class="listImageSize" />
                </li>
                <li class="instagramItemPadding">
                    <img src="src/assets/instagramSecond.png" alt="second instagram image" loading="lazy"
                        class="listImageSize" />
                </li>
                <li class="instagramItemPadding">
                    <img src="src/assets/instagramThird.png" alt="third instagram image" loading="lazy"
                        class="listImageSize" />
                </li>
                <li class="instagramItemPadding">
                    <img src="src/assets/instagramFourth.png" alt="fourth instagram image" loading="lazy"
                        class="listImageSize" />
                </li>
            </ul>
        </div>
    </section>


    <footer class="footerContainer">
        <div class="footerTopContainer">
            <div class="logoBorder">
                <img src="src/assets/logo.svg" alt="logo" class="titleImage" aria-label="cvarci.net logo"/>
            </div>
            <ul class="contactList spaceBetweenXAxis">
                <li class="contactItem largeBoldText family">
                    <a class="anchorColor" href="">O nama</a>
                </li>
                <li class="contactItem largeBoldText family">
                    <a class="anchorColor" href="">Cijenik</a>
                </li>    
                <li class="contactItem largeBoldText family">
                    <a class="anchorColor" href="">Kontakt</a>
                </li>
            </ul>
        </div>
        <div class="footerBottomContainer spaceBetweenXAxis">
            <ul class="footerIconList">
                <li class="iconItem">
                    <img src="src/assets/insta.svg" alt="insta logo" class="footerIconSize"/>
                </li>
                <li class="iconItem">
                    <img src="src/assets/twitter.svg" alt="twitter logo" class="footerIconSize"/>
                </li>
                <li class="iconItem">
                    <img src="src/assets/fb.svg" alt="fb logo" class="footerIconSize"/>
                </li>
            </ul>
            <ul class="securityContainer">
                <li class="securityItem family mediumText">
                    <a class="securityColor" href="">Polica privatnosti</a>
                </li>
                <li class="securityItem family mediumText">
                   <a class="securityColor" href=""> Uvjeti korištenja</a>
                </li>
                <li class="securityItem family mediumText">
                    <a class="securityColor" href="">© 2021 čvarci.net</a>
                </li>
            </ul>
        </div>
    </footer>
</body>

</html>