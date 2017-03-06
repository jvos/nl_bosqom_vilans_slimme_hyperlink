<?php
$params  = array("soap_version"=> SOAP_1_1,
    "trace"=>1,
    "exceptions"=>0,
    'classmap'=>array('GetTokenForUser'=>'GetTokenForUser'),
);

$client = new SoapClient('https://www.vilanskickprotocollen.nl/Management/Webservices/UserManagementAPI.asmx?WSDL', $params);

$params = array('strTrustedApplicationID' => 'DeZorgmensen_dyrneeiflg', 'strLoginCode' => 'De Zorgmensen');
$result = $client->GetTokenForUser($params);

$logintoken = '';
if (is_soap_fault($result)) {
    var_dump($result->faultcode);
    var_dump($result->faultstring);
    exit();
}
else{
    $logintoken = $result->GetTokenForUserResult;
}

header("Location: https://www.vilanskickprotocollen.nl/?token=$logintoken");
die();