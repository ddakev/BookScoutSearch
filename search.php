<?php
$isbn = $_GET["search"];
$title = "The Lightning Thief (Percy Jackson and the Olympians, Book 1";
function get_data($url) {
	$ch = curl_init();
	$timeout = 5;
	curl_setopt($ch, CURLOPT_URL, $url);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, $timeout);
	$data = curl_exec($ch);
    $arrayData = json_decode($data,TRUE);
	curl_close($ch);
	return $arrayData;
}
$notFound = 0;
$buy_content = get_data('http://api.bookscouter.com/v2/buy.php?key=ugahacks2015&isbn=' . $isbn);
$sell_content = get_data('http://api.bookscouter.com/v2/prices.php?key=ugahacks2015&isbn=' . $isbn);
$popularity = get_data('http://api.bookscouter.com/v2/salesranks.php?key=ugahacks2015&isbn=' . $isbn);
$history = get_data('http://api.bookscouter.com/v2/history.php?key=ugahacks2015&isbn=' . $isbn);
$pic_url = 'http://ec2.images-amazon.com/images/P/' . $isbn . '.01.LZZ.jpg';
if(array_key_exists('status',$buy_content)) {$notFound = 1;}
else $notFound = 0;
if($notFound == 0 && strlen($isbn)==13)
{
    $isbn = substr($isbn, 3);
    $isbn = substr($isbn,0,9);
    $mult = 10;
    $sum = 0;
    for($i= 0; $i < 9; $i++)
    {
        $sum += intval($isbn[$i])*$mult;
        $mult--;
    }
    $sum = (11-($sum % 11))%11;
    if($sum == 10) $isbn = $isbn . 'X';
    else $isbn = $isbn . strval($sum);
    $pic_url = 'http://ec2.images-amazon.com/images/P/' . $isbn . '.01.LZZ.jpg';
}
?>
<head>
<link rel="stylesheet" type="text/css" href="resultsStyle.css">
<!--<link rel=" -->
<!--<link rel="stylesheet" href="css/bootstrap.css" type="text/css">
<link rel="stylesheet" href="path/to/font-awesome/css/font-awesome.min.css">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
<link href="font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
<link href="http://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,700,300italic,400italic,700italic" rel="stylesheet" type="text/css">-->
<!-- -->
<script language="javascript" type="text/javascript" src="resultsJS.js"></script>
<script type="text/javascript" src="https://www.google.com/jsapi"></script>
<script type="text/javascript">
    google.load("visualization", "1", {packages:["corechart"]});
    google.setOnLoadCallback(drawChart);
    function drawChart() {
        var popData = google.visualization.arrayToDataTable(pop);
        var historyData = google.visualization.arrayToDataTable(hisData);
        var showEveryPop = parseInt(popData.getNumberOfRows() / 6);
        var showEveryHistory = parseInt(historyData.getNumberOfRows() / 6);
        var popOptions = {
          title: 'Popularity with Time',
          titleTextStyle: {
            color: '333333',
            fontName: 'Helvetica',
            fontSize: 16
          },
          vAxis: {title: 'Rank', direction: -1},
          hAxis: {title: 'Date (mm/dd/yyyy)', showTextEvery: showEveryPop, direction: -1},
          legend: 'none',
          pointSize: '2',
          colors: ['#6495ED']
        };
        var hisOptions = {
            title: "Average Selling Price with Time",
            titleTextStyle: {
                color: '333333',
                fontName: 'Helvetica',
                fontSize: 16
            },
            vAxis: {title: 'Average Selling Price ($)'},
            hAxis: {title: 'Date (mm/dd/yyyy)', showTextEvery: showEveryHistory, direction: -1},
            legend: 'none',
            pointSize: '2',
            colors: ['#6495ED']
        }

        var chart = new google.visualization.ScatterChart(document.getElementById('chart_div'));
        var history_chart = new google.visualization.ScatterChart(document.getElementById('price_chart_div'));

        chart.draw(popData, popOptions);
        history_chart.draw(historyData, hisOptions);
    }
</script>
<script type="text/javascript">
var vendorTitleBuy = [], vendorTitleSell = [], priceBuy = [], priceSell = [], linkSell = [], linkBuy = [];
var pop;
var hisData;
var vid = [];
var lScrollLoc = 0;
var scrollKeyFrames = [0, 300, 500];
function fixURLs()
{
    for(var i = 0; i < linkBuy.length; i++)
    {
        var s = linkBuy[i].substring(0,linkBuy[i].indexOf("id=")+"id=".length) + vid[i] + linkBuy[i].substring(linkBuy[i].indexOf("id=")+"id=".length,linkBuy[i].indexOf("isbn=")+"isbn=".length)+<?php echo $buy_content['book']['isbn10']; ?> + linkBuy[i].substring(linkBuy[i].indexOf("isbn=")+"isbn=".length,linkBuy[i].length);
        linkBuy[i] = s;
    }
}
</script>
    <title>Search results for ISBN <?php echo $_GET["search"]; ?> | UGAHacks BookScouter</title>
</head>
<body>
    <div id="searchForm">
        <form action="search.php" method="get" style="padding-top:0px;">
            <input type="text" name="search" id="searchbar" placeholder="Search ISBN/Book Title ">
            <input type="submit"id="searchbutton" value="Power Lv?">
        </form>
    </div>
    
   <!--<div class="row" id="topMenu">
        <style type="text/css">ul{align-items: center;margin-top: 5px; margin-right: 0px;}
li{display: inline-block; color: #6495ED;  padding:0; margin-right: 0px;}</style>
            <ul class="ul1">
                <li class="li1">
                    <a href="index.html#top"> 
                        <span class="fa-stack fa-2x">
                            <i class="fa fa-circle-thin fa-stack-2x text-primary" id="circleformat" ></i>
                            <i class="fa fa-home fa-stack-1x " ></i>
                        </span>
                    </a>
                    <ul class="ul1">
                        <a href="index.html#top" >Tools</a>
                    </ul>
                </li>
                <li class="li1">
                    <a href="index.html#about">
                        <span class="fa-stack fa-2x">
                            <i class="fa fa-circle-thin fa-stack-2x text-primary"id="circleformat"></i>
                            <i class="fa fa-book fa-stack-1x "></i>
                        </span>
                    </a>
                    <ul class="ul1">
                        <a href="index.html#about">About Us</a>
                    </ul>
                </li>
                <li class="li1">
                    <a href="index.html#tools"> 
                        <span class="fa-stack fa-2x">
                            <i class="fa fa-circle-thin fa-stack-2x text-primary" id="circleformat" ></i>
                            <i class="fa fa-cogs fa-stack-1x " ></i>
                        </span>
                    </a>
                    <ul class="ul1">
                        <a href="index.html#tools" >Tools</a>
                    </ul>
                </li>
                <li class="li1">
                    <a href="index.html#faq">
                        <span class="fa-stack fa-2x">
                            <i class="fa fa-circle-thin fa-stack-2x text-primary"id="circleformat"></i>
                            <i class="fa fa-question fa-stack-1x "></i>
                        </span>
                    </a>
                    <ul>
                        <a href="index.html#faq">FAQ</a>
                    </ul>
                </li>
            </ul>
    </div>-->
    
    <div id="topBg">
    </div>
    <div id="topMenu">
        <ul id="menuItems">
            <li id="home">
                <a href="../index.html#top">
                    <svg id="houseImage" xmlns="http://www.w3.org/2000/svg" height="30" width="30" viewbox="0 0 1000 1000">
                        <path class="house" d="M785.664 553.6v267.84q0 14.508 -10.602 25.11t-25.11 10.602h-214.272v-214.272h-142.848v214.272h-214.272q-14.508 0 -25.11 -10.602t-10.602 -25.11v-267.84q0 -.558 .279 -1.674t.279 -1.674l320.85 -264.492 320.85 264.492q.558 1.116 .558 3.348zm124.434 -38.502l-34.596 41.292q-4.464 5.022 -11.718 6.138h-1.674q-7.254 0 -11.718 -3.906l-386.136 -321.966 -386.136 321.966q-6.696 4.464 -13.392 3.906 -7.254 -1.116 -11.718 -6.138l-34.596 -41.292q-4.464 -5.58 -3.906 -13.113t6.138 -11.997l401.202 -334.242q17.856 -14.508 42.408 -14.508t42.408 14.508l136.152 113.832v-108.81q0 -7.812 5.022 -12.834t12.834 -5.022h107.136q7.812 0 12.834 5.022t5.022 12.834v227.664l122.202 101.556q5.58 4.464 6.138 11.997t-3.906 13.113z" fill="#000000"/>
                    </svg>
                    <label>Home</label>
                </a>
            </li>
            <li id="about">
                <a href="../index.html#about">
                    <svg id="bookImage" xmlns="http://www.w3.org/2000/svg" height="30" width="30" viewbox="0 0 1000 1000">
                        <path class="book" d="M914.562 266.788q22.32 31.806 10.044 71.982l-153.45 505.548q-10.602 35.712 -42.687 59.985t-68.355 24.273h-515.034q-42.966 0 -82.863 -29.853t-55.521 -73.377q-13.392 -37.386 -1.116 -70.866 0 -2.232 1.674 -15.066t2.232 -20.646q.558 -4.464 -1.674 -11.997t-1.674 -10.881q1.116 -6.138 4.464 -11.718t9.207 -13.113 9.207 -13.113q12.834 -21.204 25.11 -51.057t16.74 -51.057q1.674 -5.58 .279 -16.74t-.279 -15.624q1.674 -6.138 9.486 -15.624t9.486 -12.834q11.718 -20.088 23.436 -51.336t13.95 -50.22q.558 -5.022 -1.395 -17.856t.279 -15.624q2.232 -7.254 12.276 -17.019t12.276 -12.555q10.602 -14.508 23.715 -47.151t15.345 -53.847q.558 -4.464 -1.674 -14.229t-1.116 -14.787q1.116 -4.464 5.022 -10.044t10.044 -12.834 9.486 -11.718q4.464 -6.696 9.207 -17.019t8.37 -19.53 8.928 -20.088 10.881 -17.856 14.787 -13.113 20.088 -6.417 26.505 3.069l-.558 1.674q21.204 -5.022 28.458 -5.022h424.638q41.292 0 63.612 31.248t10.044 72.54l-152.892 505.548q-20.088 66.402 -39.897 85.653t-71.703 19.251h-484.902q-15.066 0 -21.204 8.37 -6.138 8.928 -.558 23.994 13.392 39.06 80.352 39.06h515.034q16.182 0 31.248 -8.649t19.53 -23.157l167.4 -550.746q3.906 -12.276 2.79 -31.806 21.204 8.37 32.922 23.994zm-593.712 1.116q-2.232 7.254 1.116 12.555t11.16 5.301h339.264q7.254 0 14.229 -5.301t9.207 -12.555l11.718 -35.712q2.232 -7.254 -1.116 -12.555t-11.16 -5.301h-339.264q-7.254 0 -14.229 5.301t-9.207 12.555zm-46.314 142.848q-2.232 7.254 1.116 12.555t11.16 5.301h339.264q7.254 0 14.229 -5.301t9.207 -12.555l11.718 -35.712q2.232 -7.254 -1.116 -12.555t-11.16 -5.301h-339.264q-7.254 0 -14.229 5.301t-9.207 12.555z" fill="#000000"/>
                    </svg>
                    <label>About us</label>
                </a>
            </li>
            <li id="tools">
                <a href="../index.html#tools">
                    <svg id="toolsImage" xmlns="http://www.w3.org/2000/svg" height="30" width="30" viewbox="0 0 1000 1000">
                        <path class="tools" d="M0 605.263l0 -97.65l93.744 -7.812q7.812 -29.295 23.436 -54.684l-60.543 -74.214 68.355 -68.355 74.214 60.543q25.389 -15.624 54.684 -23.436l7.812 -93.744l97.65 0l9.765 93.744q29.295 7.812 54.684 23.436l74.214 -60.543 68.355 68.355 -60.543 74.214q15.624 25.389 23.436 54.684l93.744 7.812l0 97.65l-93.744 9.765q-7.812 29.295 -23.436 54.684l60.543 72.261 -68.355 70.308 -74.214 -60.543q-25.389 15.624 -54.684 23.436l-9.765 93.744l-97.65 0l-7.812 -93.744q-29.295 -7.812 -54.684 -23.436l-74.214 60.543 -68.355 -70.308 60.543 -72.261q-15.624 -25.389 -23.436 -54.684zm220.689 -48.825q0 37.107 26.366 63.473t63.473 26.366 63.473 -26.366 26.366 -63.473 -26.366 -63.473 -63.473 -26.366 -63.473 26.366 -26.366 63.473zm318.339 -238.266l7.812 -72.261 70.308 1.953q7.812 -21.483 19.53 -39.06l-37.107 -56.637 54.684 -44.919 48.825 48.825q19.53 -9.765 41.013 -13.671l13.671 -66.402 72.261 7.812 -1.953 68.355q21.483 7.812 39.06 21.483l56.637 -39.06 44.919 54.684 -48.825 48.825q9.765 19.53 11.718 42.966l68.355 13.671 -7.812 70.308l-68.355 0q-7.812 19.53 -21.483 37.107l39.06 58.59 -56.637 44.919 -46.872 -48.825q-21.483 7.812 -42.966 11.718l-13.671 66.402 -70.308 -5.859l0 -70.308q-19.53 -7.812 -37.107 -19.53l-58.59 37.107 -44.919 -54.684 48.825 -48.825q-7.812 -19.53 -11.718 -41.013zm31.248 445.284l5.859 -50.778l48.825 0q5.859 -15.624 13.671 -27.342l-25.389 -42.966 37.107 -33.201 35.154 37.107q13.671 -7.812 29.295 -9.765l9.765 -48.825 48.825 5.859l0 48.825q15.624 5.859 27.342 15.624l41.013 -27.342 31.248 41.013 -35.154 35.154q5.859 13.671 9.765 29.295l46.872 11.718 -5.859 50.778l-48.825 0q-3.906 15.624 -13.671 27.342l27.342 42.966 -39.06 33.201 -35.154 -37.107q-13.671 7.812 -29.295 9.765l-9.765 48.825 -48.825 -5.859l0 -50.778q-13.671 -3.906 -27.342 -13.671l-41.013 27.342 -31.248 -41.013 35.154 -35.154q-5.859 -13.671 -7.812 -29.295zm117.18 -13.671q-3.906 21.483 8.789 36.13t31.248 17.577 34.178 -9.765 17.577 -33.201 -10.742 -35.154 -30.271 -18.553l-5.859 0q-17.577 0 -31.248 12.694t-13.671 30.271zm17.577 -451.143q-3.906 27.342 13.671 48.825t44.919 24.413 47.849 -14.648 23.436 -44.919 -13.671 -47.849 -43.943 -24.413l-7.812 0q-25.389 0 -43.943 16.601t-20.506 41.989z" fill="#000000"/>
                    </svg>
                    <label>Tools</label>
                </a>
            </li>
            <li id="faq">
                <a href="../index.html#faq">
                    <svg id="questionImage" version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
                        width="30" height="30" viewBox="0 0 400 400"
                        xml:space="preserve">
                        <path class="question" d="M212.994,274.074h-68.522c-3.042,0-5.708,1.149-7.992,3.429c-2.286,2.286-3.427,4.948-3.427,7.994v68.525
                            c0,3.046,1.145,5.712,3.427,7.994c2.284,2.279,4.947,3.426,7.992,3.426h68.522c3.042,0,5.715-1.144,7.99-3.426
                            c2.29-2.282,3.433-4.948,3.433-7.994v-68.525c0-3.046-1.14-5.708-3.433-7.994C218.709,275.217,216.036,274.074,212.994,274.074z" fill="#000000"
                        />
                        <path class="question" d="M302.935,68.951c-7.806-14.378-17.891-26.506-30.266-36.406c-12.367-9.896-26.271-17.799-41.685-23.697
                            C215.567,2.952,200.246,0,185.016,0C127.157,0,83,25.315,52.544,75.946c-1.521,2.473-2.046,5.137-1.571,7.993
                                c0.478,2.852,1.953,5.232,4.427,7.135l46.824,35.691c2.474,1.52,4.854,2.281,7.139,2.281c3.427,0,6.375-1.525,8.852-4.57
                            c13.702-17.128,23.887-28.072,30.548-32.833c8.186-5.518,18.461-8.276,30.833-8.276c11.61,0,21.838,3.046,30.692,9.132
                            c8.85,6.092,13.271,13.135,13.271,21.129c0,8.942-2.375,16.178-7.135,21.698c-4.757,5.518-12.754,10.845-23.986,15.986
                                c-14.842,6.661-28.457,16.988-40.823,30.978c-12.375,13.991-18.558,28.885-18.558,44.682v12.847c0,3.62,0.994,7.187,2.996,10.708
                            c2,3.524,4.425,5.283,7.282,5.283h68.521c3.046,0,5.708-1.472,7.994-4.432c2.279-2.942,3.426-6.036,3.426-9.267
                                c0-4.757,2.617-11.14,7.847-19.13c5.235-7.994,11.752-14.186,19.562-18.565c7.419-4.186,13.219-7.56,17.411-10.133
                            c4.196-2.566,9.664-6.715,16.423-12.421c6.756-5.712,11.991-11.375,15.698-16.988c3.713-5.614,7.046-12.896,9.996-21.844
                            c2.956-8.945,4.428-18.558,4.428-28.835C314.639,98.397,310.734,83.314,302.935,68.951z" fill="#000000"/>
                    </svg>
                    <label>FAQs</label>
                </a>
            </li>
        </ul>
    </div>
    
    <div id="firstSlide">
        <?php if($notFound == 1) {echo '<h1 class="err">No books found with ISBN ' . $isbn . '. Please try another ISBN.</h1>';}
        else
        {
            echo '<div id="book_info">';
            echo '<img id="book_pic" src="' . $pic_url . '">';
            echo '<span id="book_title">' . $buy_content['book']['title'] . '</span>';
            echo '<span class="lesserText" id="book_author">' . $buy_content['book']['author'] . '</span><br>';
            echo '<span class="lesserText" id="isbn10">ISBN10: ' . $buy_content['book']['isbn10'] . '</span>';
            echo '<span class="lesserText" id="isbn13">ISBN13: ' . $buy_content['book']['isbn13'] . '</span>';
        }
        ?>
        </div>
        <script type="text/javascript" style="display:none;">
        <?php
            if($notFound == 0) {
            for($i = 0; $i < count($sell_content['prices']); $i++)
            {
                echo 'vendorTitleSell.push("' . $sell_content['prices'][$i]['vendor'] . '"); priceSell.push("' . $sell_content['prices'][$i]['price'] . '"); linkSell.push("' . $sell_content['prices'][$i]['link'] . '");';
            }
            for($j = 0; $j < count($buy_content['prices']); $j++)
            {
                echo 'vendorTitleBuy.push("' . $buy_content['prices'][$j]['seller'] . '"); priceBuy.push("' . ($buy_content['prices'][$j]['priceItem']+$buy_content['prices'][$j]['priceShipping']) . '"); linkBuy.push("' . $buy_content['prices'][$j]['url'] . '"); vid.push("' . $buy_content['prices'][$j]['vendorId'] . '");';
            }
            echo 'pop = [["Timestamp", "Rank"], ';
            for($i = 0; $i < count($popularity['ranks']); $i++)
            {
                echo '["' . $popularity['ranks'][$i]['timestamp'] . '".split("-")[1] + "/" + "' . $popularity['ranks'][$i]['timestamp'] . '".substring(0, "' . $popularity['ranks'][$i]['timestamp'] . '".indexOf(" ")).split("-")[2] + "/" + "' . $popularity['ranks'][$i]['timestamp'] . '".split("-")[0], parseInt(' . $popularity['ranks'][$i]['rank'] . ')]';
                if($i != count($popularity['ranks'])-1) echo ', ';
                else echo '];';
            }
            echo 'hisData = [["Timestamp", "Average Price"]';
            foreach($history['prices'] as $key => $item)
            {
                echo ", ";
                echo '["' . $key . '".split("-")[1] + "/" + "' . $key . '".split("-")[2] + "/" + "' . $key . '".split("-")[0], parseFloat(' . $item['avgprice'] . ')]';
            }
            echo '];';
            }
        ?>
        </script>
        <?php if($notFound == 0) echo '<button type="button" id="showGraphs" onClick="showGraphs()">See Book History</button>'; ?>
    </div>
    <?php
    if($notFound == 0) {
    echo '<div id="graphSlide">';
        echo '<div id="chart_div"></div>';
        echo '<div id="price_chart_div"></div>';
    echo '</div>';
    echo '<div id="buy_sell_info">';
        echo '<table id="sell">';
            echo '<tr>';
                echo '<th colspan="2" class="sectionTitle" style="padding:20px 0;"><span>Sell</span></th>';
            echo '</tr>';
            echo '<tr style="background:#444444;">';
                echo '<th>Vendor name</th>';
                echo '<th>Price</th>';
            echo '</tr>';
            echo '<!--Here go results-->';
        echo '</table>';
        echo '<table id="buy">';
            echo '<tr>';
                echo '<th colspan="2" class="sectionTitle" style="padding:20px 0;"><span>Buy</span></th>';
            echo '</tr>';
            echo '<tr style="background:#444444;">';
                echo '<th>Vendor name</th>';
                echo '<th>Price (with delivery)</th>';
            echo '</tr>';
            echo '<!--Here go results-->';
        echo '</table>';
    echo '</div>';
    } ?>
    <script type="text/javascript"><?php if($notFound == 0) echo 'fixURLs(); writeTable();'; ?></script>
</body>