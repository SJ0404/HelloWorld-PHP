<?php

require_once(__DIR__ . '/vendor/autoload.php');
use QuickBooksOnline\API\DataService\DataService;

session_start();

function makeAPICall()
{

    // Create SDK instance
    $config = include('config.php');
    $dataService = DataService::Configure(array(
        'auth_mode' => 'oauth2',
        'ClientID' => $config['client_id'],
        'ClientSecret' =>  $config['client_secret'],
        'RedirectURI' => $config['oauth_redirect_uri'],
        'scope' => $config['oauth_scope'],
        'baseUrl' => "development"
    ));

    /*
     * Retrieve the accessToken value from session variable
     */
    $accessToken = $_SESSION['eyJlbmMiOiJBMTI4Q0JDLUhTMjU2IiwiYWxnIjoiZGlyIn0..oxFoinqwMN2y-wUSlX7Bwg.9BZTiZR1wwbMqL-de12v2YsabC6qCUZQn-MmZwKBhZMLhaNlPw3zJ5gZDW_g6PZctMrGw__7KNLPtJ_AkGJxhsy7YXVUCFc291X5NsY-C7jDxgYPwkMjLptzr4hHFHM32nOOzL3iXrvNNmSftbBq7E2vQCXi14TMAyUd9Uf9W3xFVuDukfzPT9uQUkOZoLf9aQ1rOxKduqmluu5nEzjd-nxkOnEZgQjRPejTPCh_LuAfWLYft3_mDGR6nL8KBX_VZT-iEY8BwE30DTUAN44k5XpHXvN9-VbGzorw5huhSHb8cMPIXKFl3KLHTV2hZBUdwVRd1B9DFotZD1RcUKnt_m6MOD35guDPwQfDjU1Hp-M80m-F80LOdSt91lK4PDPHvv3puPI-kQ6cJ781AFE4ZLvMV4cil1CrwgmFSa-FrelJ8Z9IkEiZYWb76464tfCwnoHOBnTz-hxSu-bCRQmTHFXcWD88Jk62VQ-YuWAncWpWk7m7WIvxY7MsglsjqeJY04l2suJ180cDpBCIFvsgbDJvYnqlOE7jLHA1A-MiUqzdDrp5zCUVaRPeiV4gOo1hco0GyEFmwUyuDPJkF5MHV3K_hXRfbfekmJ0_6bl5sNCHSbzEFERkjJ3biHMXnOJ9HRGOG1JRv3w1VZMx99xbfeKkFYO9gM5LD8kuqdqVKI60d-lRC8ZuLZa4W2iAN8msPNyNWaq2BpVgHWoJ6KoySYKm7jel9IJx0Vf4wgWH89qXhiD9Qr90lTPEUT-lIm0K.aRK4aE3wue-aewLckHBG-w'];

    /*
     * Update the OAuth2Token of the dataService object
     */
    $dataService->updateOAuth2Token($accessToken);
    $companyInfo = $dataService->getCompanyInfo();
    $address = "QBO API call Successful!! Response Company name: " . $companyInfo->CompanyName . " Company Address: " . $companyInfo->CompanyAddr->Line1 . " " . $companyInfo->CompanyAddr->City . " " . $companyInfo->CompanyAddr->PostalCode;
    print_r($address);
    return $companyInfo;
}

$result = makeAPICall();

?>
