<?php

/**
 * Code for example 1
 */

if (isset($_POST["cookie-accept"])) {
    setcookie("login-cookie", 1, time() + (86400 * 30), "/");
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Primjer 12</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">
</head>

<body>

    <section class="container my-2">
        <h1 class="title">Ferit article 1</h1>
        <p class="w-75 py-3">
            Lorem ipsum dolor sit amet consectetur adipisicing elit. Repudiandae temporibus nulla ex vero vitae libero provident.
        </p>
        <?php if (isset($_COOKIE["login-cookie"])) : ?>
            <p>Cookie accepted: <?= var_dump($_COOKIE); ?></p>
        <?php endif; ?>
    </section>



    <?php if (!isset($_COOKIE["login-cookie"])) : ?>


        <div class="fixed-bottom">

            <!-- Example 1 - Using HTML forms -->
            <div class="alert-primary alert">
                Accept GDPR Cookies - Form version
                <form method="POST" action="<?php echo $_SERVER["PHP_SELF"]; ?>">
                    <input type="hidden" name="gdpr-input" value="1">
                    <input type="submit" class="btn btn-primary" />
                </form>
            </div>
            <!-- Example 1 - Using HTML forms END -->



            <!-- Example 2 - Using JS -->

            <div class="alert alert-secondary">
                Accept GDPR Cookies - JS version
                <button type="button" id="button" class="btn btn-secondary">Submit</button>
            </div>


            <script>
                const button = document.querySelector("#button");

                button.addEventListener("click", event => {
                    event.preventDefault();

                    document.cookie = "gdpr=1; expires=Thu, 18 Dec 2022 12:00:00 UTC; path=/";
                    location.reload();
                })
            </script>
            <!-- Example 2 - Using JS  END-->

        </div>



    <?php endif; ?>

</body>

</html>