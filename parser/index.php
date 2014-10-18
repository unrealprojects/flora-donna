<meta charset="UTF-8">
<?php

/**
 * Сделать Бэкап БД.
 * Почитать про функции вывода на экран. Каждый этап выводить print_r
1)Подкинуть в папку все ЦСВшки в отдельную папку
2)Отсканировать папку и получить все названия файлов(гугл) scanDir
3)Загрузить эти файлы(гугл). Один из вариантов - чтение в потоке.
4)Погуглить преобразование ЦСВ в массив (получу массив. Если будет объект, то преобразов. в массив.). Вариантов много.
 *
 *
1)Подключение к БД. Погуглить. Есть варианты. Выбрать лучший. Потестить стандарт и libs(библиотеки)
2)Выбрать item and items to categories таблицу и вывести на экран
3)Разобраться, как делать записис в БД

 *
 1)Разобраться, какие поля за что отвечают в таблице item
 2)elements - json data, разобраться what is its
 3)Разобраться в элементс, где какое поле

 *
 1)Написать фукнкцию, которая добавляет в БД строчку с данными без Json массива. Во все поля добавляет записть. Кроме Элементс и Парамс
 2)Сформировать массив всех элементов, которые должны быть. Преобразоваь их в Джейсон строку.(но всё равно это массив)
 Добиться. чтоб структура Джейсон массива была такая же, как в БД.
 3)Дописать в первую функцию, чтобы она забирала данные из Джейсон массива в БД.
 4)В цикле пебрать все массивы из Цсв файлов по строкам. (Двухмерный массив.)
 5)Данные из двухмерного масива записать в БД с помщью функции 1)
 *
 *
 1)При каждом добавлении в БД в первой ф.4 разд. узнавать ID вставленного Itema
 * Функция в Мysql, которая возвращает последний добавленные в таблицу ID
 2)Написать функцию, которая будет делать запись в таблицу Категори Итемс.
 3)Для каждого ЦСв файла своя категория
 *
 *
 *
 *
 *
 *
 *
 *
 *
 * Каждый пункт - это функиция, которая возвращает результат return
 */

function niceFilename($filename) {
    $changes = array(
        "Є"=>"EH", "І"=>"I", "і"=>"i", "№"=>"#", "є"=>"eh",
        "А"=>"A", "Б"=>"B", "В"=>"V", "Г"=>"G", "Д"=>"D",
        "Е"=>"E", "Ё"=>"E", "Ж"=>"ZH", "З"=>"Z", "И"=>"I",
        "Й"=>"J", "К"=>"K", "Л"=>"L", "М"=>"M", "Н"=>"N",
        "О"=>"O", "П"=>"P", "Р"=>"R", "С"=>"S", "Т"=>"T",
        "У"=>"U", "Ф"=>"F", "Х"=>"H", "Ц"=>"C", "Ч"=>"CH",
        "Ш"=>"SH", "Щ"=>"SCH", "Ъ"=>"", "Ы"=>"Y", "Ь"=>"",
        "Э"=>"E", "Ю"=>"YU", "Я"=>"YA", "Ē"=>"E", "Ū"=>"U",
        "Ī"=>"I", "Ā"=>"A", "Š"=>"S", "Ģ"=>"G", "Ķ"=>"K",
        "Ļ"=>"L", "Ž"=>"Z", "Č"=>"C", "Ņ"=>"N", "ē"=>"e",
        "ū"=>"u", "ī"=>"i", "ā"=>"a", "š"=>"s", "ģ"=>"g",
        "ķ"=>"k", "ļ"=>"l", "ž"=>"z", "č"=>"c", "ņ"=>"n",
        "а"=>"a", "б"=>"b", "в"=>"v", "г"=>"g", "д"=>"d",
        "е"=>"e", "ё"=>"e", "ж"=>"zh", "з"=>"z", "и"=>"i",
        "й"=>"j", "к"=>"k", "л"=>"l", "м"=>"m", "н"=>"n",
        "о"=>"o", "п"=>"p", "р"=>"r", "с"=>"s", "т"=>"t",
        "у"=>"u", "ф"=>"f", "х"=>"h", "ц"=>"c", "ч"=>"ch",
        "ш"=>"sh", "щ"=>"sch", "ъ"=>"", "ы"=>"y", "ь"=>"",
        "э"=>"e", "ю"=>"yu", "я"=>"ya", "Ą"=>"A", "Ę"=>"E",
        "Ė"=>"E", "Į"=>"I", "Ų"=>"U", "ą"=>"a", "ę"=>"e",
        "ė"=>"e", "į"=>"i", "ų"=>"u", "ö"=>"o", "Ö"=>"O",
        "ü"=>"u", "Ü"=>"U", "ä"=>"a", "Ä"=>"A", "õ"=>"o",
        "Õ"=>"O");
    $alias=strtr($filename, $changes);
    $alias = strtolower( $alias );
    $alias = preg_replace('/&.+?;/', '', $alias); // kill entities
    $alias = str_replace( '_', '-', $alias );
    $alias = preg_replace('/[^a-z0-9\s-.]/', '', $alias);
    $alias = preg_replace('/\s+/', '-', $alias);
    $alias = preg_replace('|-+|', '-', $alias);
    $alias = trim($alias, '-');
    return $alias;
}


/*** Сканирование директории с каталогами растений (так комментить функции) ***/
function scan(){
    $dir = "CSV";
    $files = scandir($dir);

    /* Удаление элементов из массива */
    unset($files[0], $files[1]);
    return $files;
}

$files = scan();



/*** Загрузка файлов и преобразование в массив***/
function load(){
    $handle = fopen("CSV/shlumb.csv", "r");
    $csvData = [];
    $key =1;
    while ($line = fgetcsv($handle, 1000, ";")) {
        $csvData[$key] = $line;
        $key++;
    }
    return $csvData;
}
$csvData = load();
//print_r($csvData);


/*** Подключение к БД ***/
function connection(){
    $lnk = mysql_connect('localhost', 'root', '987975')
    or die ('Not connected : ' . mysql_error());

    /*сделать flora текущей базой данных*/
    mysql_select_db('flora-donna', $lnk) or die ('Can\'t use flora : ' . mysql_error());
}
connection();

    /*** Выборка записей из таблицы БД***/
function selectFrom(){
    $query = "";
    $res = mysql_query($query);
    while($row = mysql_fetch_array($res))
    {
        echo "Значение1: ".$row['elements']."<br>\n";
    }
}
/*selectfrom();*/


    /*** Добавить запись в БД ***/
function insertIntoCategoryItem($category_id, $item_id){
    $inst = "INSERT INTO `qlg9a_zoo_category_item`(`category_id`, `item_id`) VALUES ($category_id,$item_id)";
    $res = mysql_query($inst);
}
//*insertIntoCategoryItem(1500,1500);


function insertIntoItem($jsonData){
    header("Content-Type: text/html; charset=UTF-8");
    mysql_query("SET NAMES 'utf8'");
    mysql_query('SET CHARACTER SET utf8');

    foreach ($jsonData as $line){
        $inst = "INSERT INTO `qlg9a_zoo_item`
        (`application_id`, `type`, `name`, `alias`, `modified_by`,  `priority`, `hits`, `state`, `access`, `created_by`, `searchable`,`elements`, `params`)
                VALUES (1,'article','". ($line ["name"]) ."','". niceFilename($line ["name"]) ."',64,0,0,1,1,64, 1, '". ($line ["elements"]) ."', '" . ($line["params"]) ."')";




        $res =mysql_query('SELECT MAX(`id`) as max FROM `qlg9a_zoo_item`');

        $Last = mysql_fetch_array($res)['max'];

        if(mysql_query($inst)){
           echo('Запрос удался!');
        }else{
            echo('Ошибка!');
        }


        insertIntoCategoryItem(2,$Last);
    }
}

$jsonData = [];

foreach($csvData as $key=>$line){
    if($key>1){
    $jsonData[$key]["elements"] = '{
        "ec4c24be-b8fa-4b68-9303-8dff7f1ea630": {
            "value":"",
            "title":""
        },
        "7341f855-4eee-4a48-adf8-08a06cd91dc9":{
            "file":"/images/img/shlumb/main/' . $line[5] . '",
            "title":"",
            "link":"",
            "target":"0",
            "rel":"",
            "lightbox_image":"",
            "spotlight_effect":"",
            "caption":"",
            "width":323,
            "height":260
        },
        "1b440425-3698-4164-b250-a34aa3e23d58": {
            "0":{
                "value":""
            }
        },
        "40cd825d-ab6d-45ef-a5b1-177d71c9b72e": {
            "0": {
                "value":"<p>' . $line[2] .  '</p><p> ' . $line[4] . ' </p>"
            }
        },
        "adb2c124-2a2b-490d-acdc-5201202b6d51": {
            "0":{
                "value":"'.round($line[3]/14).'"
            }
        },
        "855bb72d-00cb-40c6-b845-438e9ff90cbf":{
            "0":{
                "value":"'.round($line[3]*0.3).'"
            }
        },
        "4473a7db-eaa1-419a-beea-6a7634652abd":{
            "0":{
                "value":"'.$line[3].'"
            }
        }
    }';

        $jsonData[$key]["params"] =
            '{
                "metadata.title" : "'.$line[1] .'",
                "metadata.description" : "'.$line[1] .'",
                "metadata.keywords" : "'.$line[2] .'",
                "metadata.robots": "",
                "metadata.author": "",
                "config.enable_comments": "1",
                "config.primary_category": "1"
            }';
            
        $jsonData[$key]["name"] =  $line[1];

    }
}

insertIntoItem($jsonData);




?>


