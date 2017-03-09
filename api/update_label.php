<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);

include 'include.php';

$view = $_POST["view"];
$timeframe = $_POST["timeframe"];
$amount = $_POST["amount"];
$historical = $_POST["historical"];
$volatility = $_POST["volatility"];
$fee = $_POST["fee"];
$experimentClick = $_POST["experimentClick"];

$tipArray = json_decode($_POST["tipArray"], true);
$queryString = "";
$orderedTipArray = array();

/*
foreach ($tipArray as $key => $value) {
  $queryString .= ", `$key` = `$key` + ?";
  $orderedTipArray[] = $value;
}
*/

$usercode = $_SESSION["usercode"];

$tipString = ", tip_experiment = tip_experiment + ?, tip_historical = tip_historical + ?, tip_historical_pct = tip_historical_pct + ?, tip_growth = tip_growth + ?, tip_best = tip_best + ?, tip_likely = tip_likely + ?, tip_worst = tip_worst + ?, tip_volatility_pct = tip_volatility_pct + ?, tip_fees = tip_fees + ?, tip_fees_over_time = tip_fees_over_time + ?, tip_fees_pct = tip_fees_pct + ? ";

$stmtString = "UPDATE label SET view_minute = view_minute + ?, timeframe_change = timeframe_change + ?, amount_change = amount_change + ?, historical_change = historical_change + ?, volatility_change = volatility_change + ?, fee_change = fee_change + ?, experiment_click = experiment_click + ?$tipString WHERE usercode = ?";

$stmt = mysqli_prepare($conn, $stmtString);

$tipExperiment = $tipArray["tip-experiment"] ? $tipArray["tip-experiment"] : 0;
$tipHistorical = $tipArray["tip-historical"] ? $tipArray["tip-historical"] : 0;
$tipHistoricalPct = $tipArray["tip-historical-pct"] ? $tipArray["tip-historical-pct"] : 0;
$tipGrowth = $tipArray["tip-growth"] ? $tipArray["tip-growth"] : 0;
$tipBest = $tipArray["tip-best"] ? $tipArray["tip-best"] : 0;
$tipLikely = $tipArray["tip-likely"] ? $tipArray["tip-likely"] : 0;
$tipWorst = $tipArray["tip-worst"] ? $tipArray["tip-worst"] : 0;
$tipVolatilityPct = $tipArray["tip-volatility-pct"] ? $tipArray["tip-volatility-pct"] : 0;
$tipFees = $tipArray["tip-fees"] ? $tipArray["tip-fees"] : 0;
$tipFeesOverTime = $tipArray["tip-fees-over-time"] ? $tipArray["tip-fees-over-time"] : 0;
$tipFeesPct = $tipArray["tip-fees-pct"] ? $tipArray["tip-fees-pct"] : 0;

mysqli_stmt_bind_param($stmt, "diiiiiiiiiiiiiiiiis", $view, $timeframe, $amount, $historical, $volatility, $fee, $experimentClick, $tipExperiment, $tipHistorical, $tipHistoricalPct, $tipGrowth, $tipBest, $tipLikely, $tipWorst, $tipVolatilityPct, $tipFees, $tipFeesOverTime, $tipFeesPct, $usercode);

/*
$stmt = mysqli_prepare($conn, "UPDATE label SET view_minute = view_minute + ?, timeframe_change = timeframe_change + ?, amount_change = amount_change + ?, historical_change = historical_change + ?, volatility_change = volatility_change + ?, fee_change = fee_change + ? WHERE usercode = ?");
mysqli_stmt_bind_param($stmt, "diiiiis", $view, $timeframe, $amount, $historical, $volatility, $fee, $usercode);
*/
mysqli_stmt_execute($stmt);
mysqli_stmt_close($stmt);

?>
