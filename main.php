<?php
session_start();
?>

<!HTMLDOC>

<head lang="en">
    <meta charset="utf-8">
    <title>Spartan Reviews</title>
    <link href="login.css" rel="stylesheet" type="text/css">
</head>

<body>
<header>
    <div>
        <a href="main.php"><img src="image/spartanLogo.png" alt="Logo" title="Logo"></a>
        <h1>Spartan Reviews</h1>
    </div>
    <nav>
        <?php
        if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true){
            echo '<a href="logout.php" title="logout page">logout</a>';
            echo '<a>Hello ',$_SESSION["username"], '</a>';
        }
        else {
            echo '
            <a href="register.php" title="Account creation">Create Account</a>
            <a href="login.php" title="login page">Login</a>';
        }
        ?>
    </nav>
</header>
<main>
    <div class="sidebar">
        <h2>Restaurants</h2>
        <p><b>McDonald</b> &#9733&#9733&#9733</p>
        <p><b>Taco Bell</b> &#9733&#9733&#9733</p>
        <p><b>Burger King</b> &#9733&#9733&#9733</p>
        <p><b>Jack in the box</b> &#9733&#9733&#9733</p>
        <p><b>Wendy's</b> &#9733&#9733&#9733</p>
        <p><b>Carl's Jr.</b> &#9733&#9733&#9733</p>
        <p><b>Subway</b> &#9733&#9733&#9733</p>
    </div>
    <div id="map" class="map"></div>
    <script>
        // Initialize and add the map
        function initMap() {
            // The location of sjsu
            var sjsu = {
                lat: 37.3351874,
                lng: -121.8832602
            };
            var mcdonald1 = {
                lat: 37.331129,
                lng: -121.860721
            };
            var mcdonald2 = {
                lat: 37.348768,
                lng: -121.865085
            };
            var tacobell = {
                lat: 37.328762,
                lng: -121.858909
            };
            var burgerking = {
                lat: 37.333749,
                lng: -121.854261
            };
            var jackinthebox1 = {
                lat: 37.332663,
                lng: -121.884107
            };
            var jackinthebox2 = {
                lat: 37.314984,
                lng: -121.872029
            };
            var wendys = {
                lat: 37.315924,
                lng: -121.874005
            };
            var carlsjr = {
                lat: 37.341255,
                lng: -121.909998
            };
            var subway1 = {
                lat: 37.336406,
                lng: -121.877097
            };
            var subway2 = {
                lat: 37.330148,
                lng: -121.887260
            };
            var subway3 = {
                lat: 37.333216,
                lng: -121.892105
            };
            var subway4 = {
                lat: 37.324497,
                lng: -121.900020
            };
            var subway5 = {
                lat: 37.341479,
                lng: -121.911553
            };
            // The map, centered at sjsu
            var map = new google.maps.Map(
                document.getElementById('map'), {
                    zoom: 14,
                    center: sjsu
                });
            // The marker, positioned at sjsu
            var sjsuMarker = new google.maps.Marker({
                position: sjsu,
                map: map
            });

            var mcdonald1Marker = new google.maps.Marker({
                position: mcdonald1,
                map: map
            });

            var mcdonald2Marker = new google.maps.Marker({
                position: mcdonald2,
                map: map
            });

            var tacobellMarker = new google.maps.Marker({
                position: tacobell,
                map: map
            });

            var burgerkingMarker = new google.maps.Marker({
                position: burgerking,
                map: map
            });

            var jackinthebox1Marker = new google.maps.Marker({
                position: jackinthebox1,
                map: map
            });

            var jackinthebox2Marker = new google.maps.Marker({
                position: jackinthebox2,
                map: map
            });

            var wendysMarker = new google.maps.Marker({
                position: wendys,
                map: map
            });

            var carlsjrMarker = new google.maps.Marker({
                position: carlsjr,
                map: map
            });

            var subway1Marker = new google.maps.Marker({
                position: subway1,
                map: map
            });

            var subway2Marker = new google.maps.Marker({
                position: subway2,
                map: map
            });

            var subway3Marker = new google.maps.Marker({
                position: subway3,
                map: map
            });

            var subway4Marker = new google.maps.Marker({
                position: subway4,
                map: map
            });

            var subway5Marker = new google.maps.Marker({
                position: subway5,
                map: map
            });
        }

    </script>
    <!--Load the API from the specified URL
* The async attribute allows the browser to render the page while the API loads
* The key parameter will contain your own API key (which is not needed for this tutorial)
* The callback parameter executes the initMap() function
-->
    <script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDZGMiY9JGL3v9RXq5SgAhbnF73nCHT5uk&callback=initMap">
    </script>
</main>
</body>
