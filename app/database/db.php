<?php
$time = 18000;
session_start();


//cookie
if (isset($_COOKIE['user_id'])) {
  setcookie('user_id', $_SESSION['id'], time()+$time);
  header("Refresh: $time");
//  echo "<script> setTimeout(function () {location.reload();}, 120010); </script>";
}
if (!isset($_COOKIE['user_id'])){
  if (!$_COOKIE['close']){
      echo '<script>alert("Время сессии истекло. Пройдите авторизацию заново.");window.location.href = "log-out.php";</script>';

  echo "ВСЁ. НЕТ КУКОВ!!";
  }

}
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
    pub.publication_id,
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


function selectAllCarts($params=[]){
  global $pdo;

  $sql = "SELECT 
    user.id as user_id,
    user.first_name as first_name,
    cart.publication_id as pub_id,
    pub.name as pub_name,
    pub.price,
    cart.status as cart_status,
    pub.img
    
    
    FROM cart 
    JOIN user ON cart.user_id = user.id
    JOIN publication as pub ON pub.publication_id = cart.publication_id";
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

function updateCart($user_id, $publication_id, $params){
  global $pdo;

  $i = 0;
  $str = '';
  foreach ($params as $key => $value) {
    if ($i === 0){
      $str = $str . "$key ='$value'";
    }else{
      $str = $str . ", $key='$value'";
    }
    $i++;

  }

  $sql = "UPDATE cart SET $str WHERE 
                         user_id = $user_id 
                         AND publication_id = $publication_id
                         AND status=1";

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
