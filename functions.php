<?php


/*
 * Возвращает код видео из ссылки на youtube
 * $url - УРЛ видео youtube
 * */
if (!function_exists('GetYouTubeId')) {
    function GetYouTubeId($url)
    {
        $videoId = '';
        //This is a general function for generating an embed link of an FB/Vimeo/Youtube Video.
        $finalUrl = '';
        if (strpos($url, 'facebook.com/') !== false) {
            //it is FB video
        } elseif (strpos($url, 'vimeo.com/') !== false) {
            //it is Vimeo video
            $videoId = explode("vimeo.com/", $url)[1];
            if (strpos($videoId, '&') !== false)
                $videoId = explode("&", $videoId)[0];
        } elseif (strpos($url, 'youtube.com/') !== false) {
            //it is Youtube video
            $videoId = explode("v=", $url)[1];
            if (strpos($videoId, '&') !== false)
                $videoId = explode("&", $videoId)[0];
        } elseif (strpos($url, 'youtu.be/') !== false) {
            //it is Youtube video
            $videoId = explode("youtu.be/", $url)[1];
            if (strpos($videoId, '&') !== false)
                $videoId = explode("&", $videoId)[0];
        }
        return $videoId;
    }
}


/*
 * Проверка на кол-во символов в телефоне
 */
if (!function_exists('IsCorrectMobilePhone')) {
    function IsCorrectMobilePhone($number)
    {
        $clearPhone = preg_replace("/[^0-9]/", '', $number);
        return strlen($clearPhone) === 11;
    }
}



function mb_ucfirst($str, $encoding='UTF-8')
{
    $str = mb_ereg_replace('^[\ ]+', '', $str);
    $str = mb_strtoupper(mb_substr($str, 0, 1, $encoding), $encoding).
        mb_substr($str, 1, mb_strlen($str), $encoding);
    return $str;
}


/*
* Сортировка многомерных массивов
*/

if (!function_exists('sortByOrder')) {
    function sortByOrder($a, $b) {
        if ($a['DATE_ACTIVE_FROM'] > $b['DATE_ACTIVE_FROM']) {
            return 1;
        } elseif ($a['DATE_ACTIVE_FROM'] < $b['DATE_ACTIVE_FROM']) {
            return -1;
        }
        return 0;
    }
}



usort($arr, 'sortByOrder');

function debug($data, $isHide = false)
{
    if ($isHide) {
        echo '<pre style="display: none">' . print_r($data, 1) . '</pre>';
        return;
    }

    echo '<pre>' . print_r($data, 1) . '</pre>';
}

function checkNestedArrayWithId($items, $idToCheck) {
    if (array_key_exists($idToCheck, $items) && is_array($items[$idToCheck])) {
        return true;
    } else {
        return false;
    }
}
function findElementById($array, $id) {
    foreach ($array as $item) {
        foreach ($item as $key => $value) {
            if (is_array($value) && in_array($id, $value)) {
                return $item; // если найден элемент с нужным ID, возвращаем этот элемент
            }
        }
    }
    return null; // если элемент не найден, возвращаем null
}
function findElementIndexByID($array, $id) {
    foreach ($array as $index => $item) {
        if (isset($item['ID']) && $item['ID'] == $id) {
            return $index;
        }
    }
    return -1; // Возвращаем -1, если элемент не найден
}
function checkForId($array, $id) {
    foreach ($array as $item) {
        if ($item['ID'] == $id) {
            return true; // если найден элемент с нужным ID, возвращаем true
        }
    }
    return false; // если элемент не найден, возвращаем false
}
/* ищем в многомерном массиве '$array' массив у которого есть ключ '$key' со значением '$value'  */
function searchArrayByKeyValue($array, $key, $value) {
    foreach ($array as $item) {
        if (is_array($item) && isset($item[$key]) && $item[$key] === $value) {
            return true;
        }
    }
    return false;
}
/*Используем встроенную функцию PHP для проверки формата email*/
function isValidEmail($email) {
    if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
        return true; // Строка является действительным email
    } else {
        return false; // Строка не соответствует формату email
    }
}
/* группируем элементы по свойству типа строка $propValue */
function getGroupItemsByPropertiesValue($arrItems, $propValue)
{
    // Создаем пустой массив для группированных элементов
    $groupedItems = [];

// Проходимся по каждому элементу в $arResult['items']
    foreach ($arrItems as $item) {
        // Получаем значение свойства из подмассива 'properties'
        $propertyValue = strtoupper(
            implode(
                "_",
                explode(' ', $item['PROPERTIES'][$propValue]['VALUE'])
            )
        );

        // Проверяем, существует ли уже такая группа
        if (!isset($groupedItems[$propertyValue])) {
            // Если нет, создаем новую группу с текущим элементом
            $groupedItems[$propertyValue] = [];
        }

        // Добавляем текущий элемент в соответствующую группу
        $groupedItems[$propertyValue][] = $item;
    }


    return $groupedItems;
}

function getSectionInfo($sectionId) {
    return SectionTable::getList([
        'select' => ['ID', 'NAME', 'IBLOCK_ID', 'IBLOCK_SECTION_ID', 'CODE'],
        'filter' => ['=ID' => $sectionId],
    ])->fetch();
}

// Функция для получения цепочки разделов от текущего и выше
function getSectionChain($sectionId) {
    $sectionChain = [];
    $currentSection = getSectionInfo($sectionId);

    // Пока есть текущий раздел и он не является корневым
    while ($currentSection && $currentSection['IBLOCK_SECTION_ID'] > 0) {
        $sectionChain[] = $currentSection;
        $currentSection = getSectionInfo($currentSection['IBLOCK_SECTION_ID']);
    }

    // Добавляем корневой раздел, если он существует
    if ($currentSection) {
        $sectionChain[] = $currentSection;
    }

    return array_reverse($sectionChain);
}
/**
 * Группирует элементы по значению свойства типа список.
 *
 * @param array $arrItems Массив элементов для группировки.
 * @param string $propValue Название свойства, по которому происходит группировка.
 * @return array Массив с группами элементов.
 */
function getGroupItemsByListPropertyValue($arrItems, $propValue)
{
    // Создаем пустой массив для группированных элементов
    $groupedItems = [];

    // Проходимся по каждому элементу в $arrItems
    foreach ($arrItems as $item) {

        // Получаем значение свойства из подмассива 'properties'
        $propertyValue = $item['PROPERTIES'][$propValue]['VALUE'] ? 'WITH_DESC' : 'NO_DESC';

        // Проверяем, существует ли уже такая группа
        if (!isset($groupedItems[$propertyValue])) {
            // Если нет, создаем новую группу с текущим элементом
            $groupedItems[$propertyValue] = [];
        }

        // Добавляем текущий элемент в соответствующую группу
        $groupedItems[$propertyValue][] = $item;
    }

    return $groupedItems;
}