<?php

function generateWeightedList($list, $weight) {
  $weighted_list = array();
  for ($i = 0; $i < count($weight); $i++) {
    $multiples = $weight[$i] * 100;
    for ($j = 0; $j < $multiples; $j++) {
      array_push($weighted_list, $list[$i]);
    }
  }
  return $weighted_list;
}
// 1 Control
// 2 Interactive label
// 3 Static label
// 4 Short label
// 5 Interactive no recommendation
// 6 Required interactive recommendation, clear fields
// 7 Required interactive recommendation, don't clear fields
// 8 Survey
// 9 Interactive
// 10 Interactive
// 11 Vanguard-like condition
// 12 Required interactive no-recommendation
// 13 Static no-rec
// 14 Prospectus with comments
// 15 Prospectus without comments

$list   = array(1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15);
$weight = array(0, 1, 0, 0, 0, 0, 0, 0, 0,  0,  0,  0,  0,  0,  0);
$weighted_list = generateWeightedList($list, $weight);
$random_num = rand(0, count($weighted_list)-1);
$weighted_groupid = $weighted_list[$random_num];
?>
