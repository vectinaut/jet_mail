<?php
include("app/controllers/users.php");

//$all_subs = selectAllSubscription(['user_id'=>38]);
//tt($all_subs);
//$some_time = $all_subs[0]['created'];
//$duration = $all_subs[0]['duration']+1;
//
////$current_date = date('Y.m.d', time());
//$current_date = date("Y.m.d", strtotime("+5 month"));
//$expired = [];
//$active = [];
//foreach ($all_subs as $key=>$value){
//  $duration = $value['duration']+1;
//  $dateAt = strtotime("+$duration MONTH", strtotime($value['created']));
//  $newDate = date('Y.m.d', $dateAt);
//
//  if($current_date >= $newDate){
//    $expired[] = $value['pub_id'];
//  }else{
//    $active[] = $value['pub_id'];
//  }
//}
//print_r("Истекшие подписки: ");
//print_r($expired);
//print_r("\nАктивные подписки: ");
//print_r($active);




//function check_subscription($user_id, $type){
//  $all_subs = selectAllSubscription(['user_id'=>$user_id]);
//  $current_date = date('Y.m.d', time());
////  $current_date = date("Y.m.d", strtotime("+5 month"));
//  $expired = [];
//  $active = [];
//  foreach ($all_subs as $key=>$value){
//    $duration = $value['duration']+1;
//    $dateAt = strtotime("+$duration MONTH", strtotime($value['created']));
//    $newDate = date('Y.m.d', $dateAt);
//
//    if($current_date >= $newDate){
//      $expired['pub_id'][] = $value['pub_id'];
//      $expired['duration'][] = $value['duration'];
//    }else{
//      $active['pub_id'][] = $value['pub_id'];
//      $active['duration'][] = $value['duration'];
//    }
//  }
//  if ($type==="active"){
//    return $active;
//  }else{
//    return $expired;
//  }
//}
//$active = check_subscription($_COOKIE['user_id'], $type='active');
//$expired = check_subscription($_COOKIE['user_id'], $type='expired');

$active_pub = [];
$expired_pub = [];
//tt($expired);
//if($active){
//  for ($i=0; $i<count($active['pub_id']); $i++){
//    $pub = selectOne('publication',['publication_id'=>$active['pub_id'][$i]]);
//    $active_pub[$i]['pub'] = $pub;
//    $active_pub[$i]['duration'] = $active['duration'][$i];
//  }
//}




$current_date = date('Y-m-d', time());
$new_date= date("Y-m-d", strtotime("+2 month"));
print_r($current_date." ".$new_date."\n");


$date_time_current = new DateTime($current_date);
$date_time_new = new DateTime("2022-02-01");
$interval = $date_time_current->diff($date_time_new)->y;
print_r(time());




//tt($active);
//foreach ($active_pub as $key=>$value){
//  tt($value['pub']);
//}

//for ($i=0; $i<count($active['pub_id']); $i++){
//  $pub = selectOne('publication',['publication_id'=>$active['pub_id'][$i]]);
//  $active_pub[$i] = $pub;
//}
//
//for ($i=0; $i<count($expired['pub_id']); $i++){
//  $pub = selectOne('publication',['publication_id'=>$expired['pub_id'][$i]]);
//  $expired_pub[$i] = $pub;
//}