<?php
include 'api/funds.php';
if (!isset($_SESSION["usercode"])) {
  header("Location: index.php");
}
$groupid = $_SESSION["groupid"];
$year = $_SESSION["year"];
?>
<!DOCTYPE html>
<html>
<head>
  <title>Contributions <?php echo $year; ?></title>
  <link rel="stylesheet" type="text/css" href="bower_components/bootstrap/dist/css/bootstrap.min.css">
  <link rel="stylesheet" type="text/css" href="bower_components/font-awesome-4.3.0/css/font-awesome.min.css">
  <link rel="stylesheet" type="text/css" href="css/common.css">
  <link rel="stylesheet" type="text/css" href="css/label.css">
</head>
<body>

<?php 
if ($groupid == 11) { 
  include "label-modal-detailed.php"; 
} else if ($groupid == 14 || $groupid == 15) {
  include "prospectus-container.php";
} else {
  include "label-modal.php";
}
?>

<div class="modal fade" id="alertModal" role="dialog">
  <div class="modal-dialog modal-sm">
    <div class="modal-content">
      <div class="modal-header">
      </div>
      <div class="modal-body">
        <p>You must click on fund link to view a prospectus document before continuing.</p>
        <button data-dismiss="modal" class="btn btn-primary">OK</button>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="cond6AlertModal" role="dialog">
  <div class="modal-dialog modal-sm">
    <div class="modal-content">
      <div class="modal-header">
      </div>
      <div class="modal-body">
        <p>Please click on a fund to continue.</p>
        <button data-dismiss="modal" class="btn btn-primary">OK</button>
      </div>
    </div>
  </div>
</div>
 
  <form id="form" method="POST" name="contribution-form" action="home.php">
    <div class="container">
      <div class="row">
        <div class="col-md-12">
          <div class="page-header">
	          <input type="hidden" id="contribYear" name="contribYear" value="<?php echo $year; ?>">
            <h1>Set this year's savings mix</h1>
            <p>Specify how your savings for this year should be used to buy the funds below. Your choices will only affect this year. 
<?php if ($groupid != 1) { ?>
<p><strong class="red">Click on fund names to learn more about them</strong> - this will improve your chances of reaching your retirement goal.</p>
<?php } ?>
<?php if ($groupid == 14) { ?>
<p><strong class="red">Pay attention to comments other users have made in the prospectus documents about which funds are good or bad.</strong> Selecting the best funds will help you reach your retirement goal. Selecting the worst funds will make it more difficult for you to reach your retirement goal.</p>
<?php } ?> 

</p>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-md-12">
          <div class="table-responsive">
            <table class="table table-striped">
              <col width="2%">
              <col width="68%">
              <col width="15%">
              <col width="15%">
               <thead>
                <tr>
                  <th></th>
                  <th>Name</th>
                  <th class="title">Entire portfolio</th>
                  <th class="title">This year</th>
                </tr>
              </thead>
              <tbody>
                <tr class="data_row">
                  <td></td>
                  <td class="name">Amount saved</td>
                  <td class="current_percentage">
                    <span class="invest">$0.00</span>
                  </td>
                  <td class="new_percentage">
                    <input id="total-input" type="text" name="amount" maxlength="6" size="6" value="10000" class="form-control contribution-input" readonly>
                  </td>
                </tr>
                <?php
                $j = 0;
                for ($i = 0; $i < $total; $i++) {
                  if ($accept[$i]) {
                    $j++;
                    $class = "fund" . $j;
  
                    echo
                    '<tr class="data_row">';

                    if ($groupid != 1 && $groupid != 14 && $groupid != 15) {
                      echo
                      '<td><input type="checkbox" name="' . $name[$i] . '"></td>
                      <td><span class="fake-link" data-toggle="modal" data-target="#label-modal">' . $name[$i] . ' <span class="glyphicon glyphicon-new-window" data-toggle="tooltip" title="Learn more about this fund"></span></span></td>';
                    } else if ($groupid != 1) {
                      echo
                      '<td></td>
                      <td><span class="fake-link" data-toggle="modal" data-target="#label-modal">' . $name[$i] . ' <span class="glyphicon glyphicon-new-window" data-toggle="tooltip" title="Learn more about this fund"></span></span></td>';

                    } else {
                      echo
                      ' <td></td>
                      <td><span>' . $name[$i] . '</span></td>'; 
                    }

                    echo
                    '<td class="current_percentage">
                      <span class="' . $class . '-pct">0.0%</span>
                    </td>
                    <td class="new_percentage">
                      <input id="' . $class . '-input" type="text" name="' . $class . '-percent" maxlength="4" size="4" class="form-control contribution-input" placeholder="0%"></td>
                    </tr>';
                  }  
                }
                ?>
                <tr>
                  <td colspan="3">
 <?php if ($groupid != 1 && $groupid != 14 && $groupid != 15) { ?>                    
 <button type="button" class="btn btn-success" id="btn-compare">Compare funds</button>
<?php } ?>  
                  </td>
                  <td class="total">
                    Total <span class="total_percentage">0.00%</span>
                  </td>
                </tr>
              </tbody>
            </table>
          </div>
          <div class="error alert alert-danger" style="display: none" role="alert">
            <div class="error1" style="display: none">
              <span class="glyphicon glyphicon-exclamation-sign"></span> The percentages do not add up to 100%.
            </div>
            <div class="error2" style="display: none">
              <span class="glyphicon glyphicon-exclamation-sign"></span> The amount must be greater than $0 and equal to or less than $10,000.
            </div>
            <div class="error3" style="display: none">
              <span class="glyphicon glyphicon-exclamation-sign"></span> All of the fields must be filled.
            </div>
          </div>
          <button type="button" class="btn btn-default" onclick="location.href='home.php'">Back</button>
          <input id="contSubmit" type="submit" class="btn btn-primary pull-right" value="Continue to next year">
        </div>
      </div>
      <div class="row">
        <div class="col-md-12 footer"></div>
      </div>
    </div>
  </form>
  <script type="text/javascript" src="bower_components/jquery/dist/jquery.min.js"></script>
  <script type="text/javascript" src="bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
  <script type="text/javascript" src="js/contribution.js" charset="utf-8"></script>
<?php if ($groupid == 11) { ?>
<script type="text/javascript" src="js/label-modal-detailed.js" charset ="utf-8"></script> 
<?php } else if ($groupid == 14 || $groupid == 15) { ?>
<script type="text/javascript" src="js/prospectus-container.js" charset="utf-8"></script> 
<?php } else { ?>
<script type="text/javascript" src="js/label-modal.js" charset ="utf-8"></script> 
<?php } ?>
</body>
</html>
