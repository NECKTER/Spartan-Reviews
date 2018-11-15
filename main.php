<?php
session_start();
require_once "config.php";
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
        <?php
        $restaurants = "SELECT name, score, reviews, id FROM markers";
        $restaurantList = mysqli_query($link, $restaurants) or die("database error:". mysqli_error($link));
        while($list = mysqli_fetch_assoc($restaurantList)){
            $rid = $list['id'];
            if ($list['reviews'] == 0)
                $avg = 0;
            else
                $avg = round($list['score'] / $list['reviews'], 1);
            echo '<p><b><a href=reviews.php?restid='.$rid.'>'.$list['name'].'</a></b> &nbsp;&nbsp;'.$avg.'&#9733</p>';
        }
        ?>
    </div>
    <div id="map" class="map"></div>
    <script>
        var customLabel = {
            restaurant: {
                label: 'R'
            },
            bar: {
                label: 'B'
            }
        };

        function initMap() {
            var map = new google.maps.Map(document.getElementById('map'), {
                center: new google.maps.LatLng(37.3351874, -121.8832602),
                zoom: 14
            });
            var infoWindow = new google.maps.InfoWindow;

            downloadUrl('domxml.php', function (data) {
                var xml = data.responseXML;
                var markers = xml.documentElement.getElementsByTagName('marker');
                Array.prototype.forEach.call(markers, function (markerElem) {
                    var id = markerElem.getAttribute('id');
                    var name = markerElem.getAttribute('name');
                    var address = markerElem.getAttribute('address');
                    var type = markerElem.getAttribute('type');
                    var point = new google.maps.LatLng(
                        parseFloat(markerElem.getAttribute('lat')),
                        parseFloat(markerElem.getAttribute('lng')));

                    var infowincontent = document.createElement('div');
                    var strong = document.createElement('strong');
                    strong.textContent = name
                    infowincontent.appendChild(strong);
                    infowincontent.appendChild(document.createElement('br'));

                    var text = document.createElement('text');
                    text.textContent = address
                    infowincontent.appendChild(text);
                    var icon = customLabel[type] || {};
                    var marker = new google.maps.Marker({
                        map: map,
                        position: point,
                        label: icon.label
                    });
                    marker.addListener('click', function () {
                        infoWindow.setContent(infowincontent);
                        infoWindow.open(map, marker);
                    });
                    marker.addListener('dblclick', function () {
                        window.location.href = 'reviews.php?restid=' + id;
                    });

                });
            });
        }

        function downloadUrl(url, callback) {
            var request = window.ActiveXObject ?
                new ActiveXObject('Microsoft.XMLHTTP') :
                new XMLHttpRequest;

            request.onreadystatechange = function() {
                if (request.readyState == 4) {
                    request.onreadystatechange = doNothing;
                    callback(request, request.status);
                }
            };

            request.open('GET', url, true);
            request.send(null);
        }

        function doNothing() {}

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
