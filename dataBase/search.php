<?php
//$inputSearch = $_REQUEST['search'];
//require_once("../dataBase/config.php");
//$dbn = new PDO('mysql:dbname=php;host=localhost:3340', 'root', 'root');
//// Создаём SQL запрос
//$sql = "SELECT * FROM `pineapple` WHERE  `email` like '$inputSearch' ";
//
//// Отправляем SQL запрос
//$result = $dbn -> query($sql);
//
//function doesItExist(array $arr) {
//    // Создаём новый массив
//    return array(
//        'id' => $arr['id'] != false ? $arr['id'] : 'No dates',
//        'email' => $arr['email'] != false ? $arr['email'] : 'No dates',
//        'createDate' => $arr['createDate'] != false ? $arr['createDate'] : 'No dates'
//    ); // Возвращаем этот массив
//}
//function countPeople($result) {
//
//    // Проверка на то, что строк больше нуля
//    if ($result -> num_rows > 0) {
//        // Цикл для вывода данных
//        while ($row = $result -> fetch_assoc()) {
//            // Получаем массив с строками которые нужно выводить
//            $arr = doesItExist($row);
//            // Вывод данных
//            echo "ID: ". $row['id'] ."<br>
//                  Имя: ". $row['name'] ."<br>
//                  Фамилия: ". $row['surname'] ."<br>
//                  Телефон: ". $row['number_phone'] ."<br>
//                  Email: ". $arr['email'] ."<br>
//                  Город: ". $arr['city'] ."<br>
//                  Год рождения: ". $arr['year'] ."<hr>";
//        }
//        // Если данных нет
//    } else {
//        echo "Не кто не найден";
//    }
//}