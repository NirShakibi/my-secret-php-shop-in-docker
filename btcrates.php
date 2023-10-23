<?php
$url = 'https://test.bitpay.com/rates/BTC/USD'; // Replace with the actual API URL
$data = file_get_contents($url);
$bitcoinData = json_decode($data, true);
$rate = $bitcoinData['data']['rate'];

$url2 = 'https://test.bitpay.com/rates/BTC/EUR';
$btc2euroratedata = file_get_contents($url2);
$btc2euroratedatadecoded = json_decode($btc2euroratedata, true);
$btc2eurorate = $btc2euroratedatadecoded['data']['rate'];
?>

<!DOCTYPE html>
<html>

<head>
    <title>Bitcoin Exchange Rates</title>
</head>

<body>
    <h1>Bitcoin Exchange Rates</h1>
    <!--<p>1 BTC = <?php //echo $bitcoinData['usd']; 
                    ?> USD</p>-->
    <!--<p>1 BTC = <?php //echo $bitcoinData['eur']; 
                    ?> EUR</p>-->
    <!-- Add more currencies as needed -->
    <p><?php //$bitcoinData->data->rate;
        echo "usd/btc rate: " . $rate ?></p>
    <p><?php echo "eur/btc rate: " . $btc2eurorate ?></p>


    <h1>convert me</h1>
    <!-- https://blockchain.info/tobtc?currency=USD&value=500 -->
    <!-- https://test.bitpay.com/rates/BTC/USD -->
</body>

</html>