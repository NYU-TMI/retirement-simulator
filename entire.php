<?php
include 'api/funds.php';
if (!isset($_SESSION["usercode"])) {
  header("Location: index.php");
}
$groupid = $_SESSION["groupid"];

?>
<!DOCTYPE html>
<html>
<head lang="en">
  <title>Entire Portfolio</title>
  <link rel="stylesheet" type="text/css" href="bower_components/bootstrap/dist/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/c3/0.4.9/c3.min.css">
  <link rel="stylesheet" type="text/css" href="bower_components/font-awesome-4.3.0/css/font-awesome.min.css">
  <link rel="stylesheet" type="text/css" href="css/common.css">
  <link rel="stylesheet" type="text/css" href="css/label.css">
</head>
<body>
<?php if ($groupid == 11) { ?>
<?php include "label-modal-detailed.php"; ?>
<?php } else if ($groupid == 14 || $groupid == 15) { ?>
<?php include "prospectus-container.php"; ?>
<?php } else { ?>
<?php include "label-modal.php"; ?> 
<?php } ?> 

  <form method="POST" id="asset-form" action="home.php">
    <div class="container">
      <div class="row">
        <div class="col-md-12">
          <div class="page-header">
            <h1>Rebalance your entire savings for all years to date</h1>
          </div>
        </div>
      </div>
     <div class="row">
      <div class="col-md-12">
        <input type="hidden" id="usercode" value=<?php echo $_SESSION["usercode"]; ?>>
        <div class="asset-management">
          <h4 class="asset-management-title">Change asset mix for all years</h4>
          <p>You can change your current funds used for retirement savings. Enter new percentages for the funds you wish to use.</p>
          <p>This will affect all of your savings for all the years you have saved.</p>
          <div class="table-responsive">
            <table class="table table-striped">
              <thead>
                <tr>
                  <th>Name</th>
                  <th class="title">Current Balance as of 02/17/2015</th>
                  <th class="title">Current Asset Mix</th>
                  <th class="title">Allowable Range</th>
                  <th class="title">New Asset Mix</th>
                  <th class="title">Estimated New Balance</th>
                </tr>
              </thead>
              <tbody>
                <?php
                $j = 0;
                for ($i = 0; $i < $total; $i++) {
                  if ($accept2[$i]) {
                    $j++;
                    $class = "fund" . $j;
                    echo 
                    '<tr>';

                    if ($groupid != 1) {
                      echo
                      '<td class="name"><span class="fake-link" data-toggle="modal" data-target="#label-modal">' . $name[$i]. ' <span class="glyphicon glyphicon-new-window" data-toggle="tooltip" title="Learn more about this fund"></span></span></td>';
                    } else {
                      echo
                      '<td class="name"><span>' . $name[$i] . '</span></td>';
                    }

                    echo
                    '<td class="data" id="' . $class . '-balance">$0.00</td>
                    <td class="data" id="' . $class . '-pct">0%</td>
                    <td class="data">0-100%</td>
                    <td class="data">
                      <input id="' . $class . '-input" name="' . $class . '" type="text" maxlength="4" size="4" class="form-control entire-input" placeholder="0%"></td>
                      <td class="data" id="new-' . $class . '">$0.00</td>
                    </tr>';
                  }
                }
                ?>
                <tr>
                  <td></td>
                  <td></td>
                  <td></td>
                  <td></td>
                  <td colspan="2" class="total">
                    <span class="total_text">
                     Total
                     <span class="values" id="total-percent">0.00%</span>
                     of
                     <span class="values" id="total">$0.00</span>
                   </span>
                 </td>
               </tr>
             </tbody>
           </table>
         </div>
       </div>
     </div>
   </div>
   <div class="row">
        <div class="col-md-4 center">
         <h4>Current Asset Mix</h4>
         <div id="current-mix" class="chart"></div>
         <p>Your current mix is how assets are allocated now.</p>
       </div>
       <div class="col-md-4 center">
         <h4>Suggested Asset Mix</h4>
         <div id="suggested-mix" class="chart"></div>
         <p>The suggested asset mix is based on how close you are to retirement in this simulation.</p>
       </div>
       <div class="col-md-4 center" id="new-mix-section" style="display: none;">
         <h4>New Asset Mix</h4>
         <div id="new-mix" class="chart"></div>
         <p>The new asset mix is the mix you've just selected.</p>
       </div>
     </div>
   <div class="row">
     <div class="col-md-12">
       <div class="error alert alert-danger" style="display: none" role="alert">
         <span class="glyphicon glyphicon-exclamation-sign"></span> The new percentages do not add up to 100%.
       </div>
       <button class="btn btn-default" type="button" onclick="location.href='home.php'">Back</button>
       <input class="btn btn-primary pull-right" type="submit" value="Change percentages and return to current year">
     </div>
   </div>
   <div class="row">
    <div class="col-md-12 footer"></div>
  </div>
</div>
</form>
<script type="text/javascript" src="bower_components/jquery/dist/jquery.min.js"></script>
<script type="text/javascript" src="bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
<script type="text/javascript" src="bower_components/d3/d3.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/c3/0.4.9/c3.min.js"></script>
<script type="text/javascript" src="js/entire.js"></script>

<?php if ($groupid == 11) { ?>                                                     
<script type="text/javascript" src="js/label-modal-detailed.js" charset ="utf-8"></script>
<?php } else if ($groupid == 14 || $groupid == 15) { ?>
<script type="text/javascript" src="js/prospectus-container.js" charset="utf-8"></script> 
<?php } else { ?>
<script type="text/javascript" src="js/label-modal.js"></script>
<?php } ?> 
</body>

</html>
