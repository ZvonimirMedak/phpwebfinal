<?php

  include_once('src/php/database.php');
  include_once('src/php/initial.php');
    if($_POST) {
        include_once('src/php/item.php');
        $item = new Item($db);
        
        
        $item->name = htmlentities(trim($_POST['name']));
        $item->amount = htmlentities(trim($_POST['amount']));
        $item->price = htmlentities(trim($_POST['price']));
        $item->imageURL = "https://i.ibb.co/LrGqJdz/cvarci-od-divljaci.png";
        #$item->imageURL = htmlentities(trim($_POST['imageURL']));
        if($item->delete()){
            echo "Item is created";
        }
        else{
            echo "Error";
        }
        $prep_state = $item->getAllItems();
        echo "<table>";
        while ($row = $prep_state->fetch(PDO::FETCH_ASSOC)){
            extract($row);
            echo "<tr>";
            echo "<td>$row[name]</td>";
            echo "<td>$row[amount]</td>";
            echo "<td>$row[price]</td>";
            echo "<td>$row[imageURL]</td>";
            echo "<td>$row[id]</td>";
            echo "<td>";
            
            echo "<a href='edit.php?id=" . $id . "' class='btn btn-warning left-margin'>";
            echo "<span class='glyphicon glyphicon-edit'></span> Edit";
            echo "</a>";
    

            echo "<a href='delete.php?id=" . $id . "' class='btn btn-danger delete-object'>";
            echo "<span class='glyphicon glyphicon-remove'></span> Delete";
            echo "</a>";
    
            echo "</td>";
            echo "</tr>";
        }
    
        echo "</table>";
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
    <title>??varci.net</title>
</head>

<body>
    <header class="mainContainer">
        <section class="infoContainer spaceBetweenXAxis">
            <div>
                <h1 id="mainTitle">Najbolji ??varci na ku??nom pragu</h1>
                <div class="optionsContainer">
                    <button class="customButton positionCenter" type="button">
                        <div>
                            <h2 class="family largeText">DOSTAVA</p>
                                <p class="family mediumText">Naru??i</p>
                        </div>
                    </button>
                    <button class="customButton positionCenter" type="button">
                        <div>
                            <h2 class="family largeText">PREUZMI</p>
                                <p class="family mediumText">Na ??varkomatu</p>
                        </div>
                    </button>
                </div>
            </div>
            <img src="src/assets/cvarci.jpg" alt="cvarci" loading="lazy" class="cvarciImage" aria-label="slika ??varaka">
        </section>
        <section class="headerContainer spaceBetweenXAxis">
            <img src="src/assets/menuButton.svg" alt="menu" class="menuStyle" aria-label="menu button" />
            <img src="src/assets/logo.svg" alt="logo" class="titleImage" aria-label="??varci.net logo" />
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
                <h2 class="cart-title mediumText family">Moja ko??arica</h2>
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
            <p class="mediumText family">dostavljamo ??varke za manje od 30 minuta</p>
        </li>
        <li class="deliveryItem spaceBetweenXAxis">
            <img src="src/assets/delivery.svg" alt="type of delivery" class="deliveryImage"
                aria-label="slika na??ina dostavee" />
            <p class="mediumText family">na??i ??oferi voze tomose</p>
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
                Novo u ponudi ! naru??ite ??varke online
            </h2>
        </div>
        <div  class="cvarciListContainer">
            <ul class="restaurantListContainer">
                <li class="instagramItemPadding cvarciMarginBottom">
                    <img src="src/assets/domaci_cvarci.png" loading="lazy" alt="??varci doma??i" class="cvarciListImageSize cvarciMarginBottom"/>
                    <h3 id="domaci_cvarciID"  class="cvarciMarginBottom family cvarciNameBoldStyle">
                        ??varci doma??i
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
                        <p class="mediumText family">Koli??ina:</p>
                    <input type="number" id="domaci_cvarci" class="amountContainer" size=1 value="1" />
                    </div>
                    <button id="domaci_cvarci_button" onclick="addToCart(domaci_cvarci)" class="addToCartButton positionCenter" type="submit">
                        <p class="largeText family buttonTextColor">Stavi u ko??aricu</p>
                    </button>
                </li>
                <li class="instagramItemPadding cvarciMarginBottom">
                    <img src="src/assets/slavonski_cvarci.png" loading="lazy" alt="??varci slavonski"
                        class="cvarciListImageSize cvarciMarginBottom"/>
                        <h3 id="slavonski_cvarciID" class="cvarciMarginBottom family cvarciNameBoldStyle">
                        ??varci slavonski
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
                        <p class="mediumText family">Koli??ina:</p>
                    <input type="number" id="slavonski_cvarci"  class="amountContainer" size=1 value="1" />
                    </div>
                    <button id="slavonski_cvarci_button" onclick="addToCart(slavonski_cvarci)" class="addToCartButton positionCenter" type="submit">
                        <p class="largeText family buttonTextColor">Stavi u ko??aricu</p>
                    </button>
                </li>
                <li class="instagramItemPadding cvarciMarginBottom">
                    <img src="src/assets/pileci_cvarci.png" loading="lazy" alt="??varci pile??i" class="cvarciListImageSize cvarciMarginBottom"/>
                        <h3 id="pileci_cvarciID" class="cvarciMarginBottom family cvarciNameBoldStyle">
                        ??varci pile??i
                    </h3>
                    <div class="cvarciMarginBottom positionLeft">
                        <p id="pileci_cvarci_price" class="mediumText textYellowColor family">
                            60,00 kn 
                        </p>
                        <p class="mediumText pricePerWeightMargin family">
                            / kg
                        </p>
                    </div>
                    <form method='POST'>
                        <div class="positionLeft cvarciMarginBottom">
                            <p class="mediumText family">Koli??ina:</p>
                            <input type="text"  class="amountContainer" id="input_name" size=1 value="name" name="name"/>
                            <input type="number"  class="amountContainer" id="input_not_name" size=1 value="price" name="price"/>
                        <input type="number"  class="amountContainer" id="input_not_not" size=1 value="1" name="amount"/>
                        <input type="number"  class="amountContainer" id="pileci_cvarci" size=1 value="1"/>
                        </div>
                        <button id="pileci_cvarci_button" class="addToCartButton positionCenter" name="submit" type="submit">
                            <p class="largeText family buttonTextColor">Stavi u ko??aricu</p>
                        </button>
                    </form>
                    
                </li>
                <li class="instagramItemPadding cvarciMarginBottom">
                    <img src="src/assets/cvarci_od_divljaci.png" loading="lazy" alt="??varci od divlja??i" class="cvarciListImageSize cvarciMarginBottom"/>
                        <h3 id="cvarci_od_divljaciID"  class="cvarciMarginBottom cvarciNameBoldStyle family">
                        ??varci od divlja??i
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
                        <p class="mediumText family">Koli??ina:</p>
                    <input type="number" id="cvarci_od_divljaci" class="amountContainer" size=1 value="1" />
                    </div>
                    <button id="cvarci_od_divljaci_button" onclick="addToCart(cvarci_od_divljaci)" class="addToCartButton positionCenter" type="submit">
                        <p class="largeText family buttonTextColor">Stavi u ko??aricu</p>
                    </button>
                </li>
            </ul>
        </div>
    </section>



    <section class="centerColumn">
        <div>
            <div class="restaurantHeaderContainer spaceBetweenXAxis">
                <h2 class="h2TitleStyle">
                    Na??e ??varke mo??ete prona??i
                </h2>
                <button class="seeAllButton buttonWithoutOutline" type="button">
                    <p class="largeText family buttonTextColor">prika??i vi??e</p>
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
                    ??elite biti na?? brand partner ?
                    <p class="mediumText family textWidth">
                        Po??aljite nam Va?? broj i kontaktirat ??emo Vas u najkra??em mogu??u roku
                    </p>
                </h2>
            </div>
            <div class="positionCenter">
                <input type="text" placeholder="Po??aljite Va??u email adresu" class="inputContainer" size=25 value="" />
                <button class="sendButton positionCenter" type="submit">
                    <p class="largeText family buttonTextColor">po??alji</p>
                </button>
            </div>
        </div>
    </form>
    <section class="mapContainer">
        <h2 class="h2TitleStyle mapTextWidth">
            Gdje se nalaze na??i ??varkomati ?
        </h2>
        <img src="src/assets/map.jpg" alt="Our location" loading="lazy" class="mapSize" aria-label="slika s lokacijama na??ih poslovnica" />
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
                <p class="largeBoldText family">vrsta ??varaka</p>
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
                    #??varcinet
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
                   <a class="securityColor" href=""> Uvjeti kori??tenja</a>
                </li>
                <li class="securityItem family mediumText">
                    <a class="securityColor" href="">?? 2021 ??varci.net</a>
                </li>
            </ul>
        </div>
    </footer>
</body>

</html>