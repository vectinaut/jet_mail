<?php

session_start();
require ("connect.php");

function tt($value){
    echo '<pre>';
    print_r($value);
    echo '<pre>';
}

//Проверка выполнения запроса к БД
function dbCheckError($query){
    $errInfo = $query->errorInfo();

    if ($errInfo[0] !== PDO::ERR_NONE){
        echo $errInfo[2];
        exit();
    }
    return true;
}

//Запрос на получение данных одной таблицы
function selectAll($table, $params=[]){
    global $pdo;

    $sql = "SELECT * FROM $table";
    if(!empty($params)){
        $i = 0;
        foreach ($params as $key => $value) {
            if (!is_numeric($value)){
                $value = "'".$value."'";
            }
            if ($i===0){
                $sql = $sql . " WHERE $key=$value";
            }else{
                $sql = $sql . " AND $key=$value";
            }
            $i++;

        }
    }

    $query = $pdo->prepare($sql);
    $query->execute();

    dbCheckError($query);

    return $query->fetchAll();
}

// Получение одной строки с таблицы
function selectOne($table, $params=[]){
    global $pdo;

    $sql = "SELECT * FROM $table";
    if(!empty($params)){
        $i = 0;
        foreach ($params as $key => $value) {
            if (!is_numeric($value)){
                $value = "'".$value."'";
            }
            if ($i===0){
                $sql = $sql . " WHERE $key=$value";
            }else{
                $sql = $sql . " AND $key=$value";
            }
            $i++;
        }
    }
    $sql = $sql . " LIMIT 1";

    $query = $pdo->prepare($sql);
    $query->execute();

    dbCheckError($query);

    return $query->fetch();
}

function selectOnePublication($params=[]){
  global $pdo;

  $sql = "SELECT 
    pub.name as name,
    pub.description,
    pub.price,
    pub.img,
    publisher.name as publisher_name
       FROM publication as pub 
    JOIN publisher ON pub.publisher_id = publisher.publisher_id";
  if(!empty($params)){
    $i = 0;
    foreach ($params as $key => $value) {
      if (!is_numeric($value)){
        $value = "'".$value."'";
      }
      if ($i===0){
        $sql = $sql . " WHERE $key=$value";
      }else{
        $sql = $sql . " AND $key=$value";
      }
      $i++;

    }
  }
  $sql = $sql . " LIMIT 1";

  $query = $pdo->prepare($sql);
  $query->execute();

  dbCheckError($query);

  return $query->fetch();
}

function insert($table, $params){
    global $pdo;

    $i = 0;
    $col = '';
    $mask = '';
    foreach ($params as $key => $value) {
        if ($i === 0){
            $col = $col . $key;
            $mask = $mask . "'$value'";
        }else{
            $col = $col . ", $key";
            $mask = $mask . ", '$value'";
        }
        $i++;

    }

    $sql = "INSERT INTO $table ($col) VALUES ($mask)";

    $query = $pdo->prepare($sql);
    $query->execute();

    dbCheckError($query);

    return $pdo->lastInsertId();
}

// Обновление строки
function update($table, $id, $params){
    global $pdo;

    $i = 0;
    $str = '';
    foreach ($params as $key => $value) {
        if ($i === 0){
            $str = $str . "$key='$value'";
        }else{
            $str = $str . ", $key='$value'";
        }
        $i++;

    }

    $sql = "UPDATE $table SET $str WHERE id = $id";

    $query = $pdo->prepare($sql);
    $query->execute();

    dbCheckError($query);
}

function delete($table, $id){
    global $pdo;



    $sql = "DELETE FROM $table WHERE id = $id";

    $query = $pdo->prepare($sql);
    $query->execute();

    dbCheckError($query);
}
