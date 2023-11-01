<? $xml = file_get_contents("https://ws3.morpher.ru/russian/declension?s=" . $arResult['SECTION_INFO']['UF_ANIMAL_NAME']);

if ($xml) {
    $xml = simplexml_load_string($xml, "SimpleXMLElement", LIBXML_NOCDATA);
    $json = json_encode($xml);
    $array = json_decode($json,TRUE);

    print_r($array);
}