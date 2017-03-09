<?php
session_start();
if (!isset($_SESSION["usercode"])) {
  header("Location: index.php");
}
$year = $_SESSION["year"];
if ($year - 1 == 2015) {
  header("Location: questionnaire.php");
}
?>
<!DOCTYPE html>
<html>
<head>
  <link rel="stylesheet" type="text/css" href="bower_components/bootstrap/dist/css/bootstrap.min.css">  
  <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/c3/0.4.9/c3.min.css">
  <link rel="stylesheet" type="text/css" href="css/common.css">
  <link rel="stylesheet" type="text/css" href="css/home.css">
  <title>Retirement portfolio simulator</title>
</head>
<body>
  <div class="container">
    <div class="row">
      <div class="col-md-12">
        <div class="page-header">
          <h1>Retirement portfolio simulator</h1>
          <button data-toggle="modal" data-target="#modal1" class="btn btn-primary pull-right" type="button">Allocate savings for this year</button>
          <p class="lead">Current year: <?php echo $year - 1 + 35; ?>. Retiring in 2050. Current amount saved: <strong class="total-balance">$0</strong>.</p>
        </div>
      </div>
    </div>
    <?php if ($year != 1981) { ?>
      <div class="row">
       <div class="col-md-6 center">
        <h3>Current portfolio asset mix</h3>
        <div id="currentChart" class="pie chart"></div>
      </div>
      <div class="col-md-6 center">
        <h3>Balances over time</h3>
        <div id="balanceChart" class="chart"></div>
        <div class="btn-group" role="group">
          <button type="button" class="btn btn-active balance-btn" value="99">All Years</button>
          <button type="button" class="btn btn-default balance-btn" value="2">1 Year</button>
          <button type="button" class="btn btn-default balance-btn" value="4">3 Years</button>
          <button type="button" class="btn btn-default balance-btn" value="6">5 Years</button>
          <button type="button" class="btn btn-default balance-btn" value="11">10 Years</button>
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-md-12">
        <h3>Transaction history</h3>
        <p>The most recent transactions.</p>
        <table id="transaction-table" class="table table-striped">
          <tr>
            <thead>
              <th>Date</th>
              <th>Transaction</th>
              <th>Amount</th>
            </thead>
            <tbody></tbody>
          </tr>
        </table>
        <div class="center">
          <a data-toggle="modal" style="display:none;" data-target="#modal2" class="all-transactions clickable">View All Transactions</a>
        </div>
      </div>
      <?php } ?>
    </div>
    <div class="row">
      <div class="col-md-12 footer"></div>
    </div>
    <div class="modal fade" id="modal2" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title" id="myModalLabel">All transactions</h4>
          </div>
          <div class="modal-body">
            <table id="transaction-table2" class="table table-striped">
              <thead>
                <th>Date</th>
                <th>Transaction</th>
                <th>Amount</th>
              </thead>
              <tbody></tbody>
            </table>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
          </div>
        </div>
      </div>
    </div>
    <!-- Modals -->
    <div class="modal fade" id="modal1" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title" id="myModalLabel">Change Savings</h4>
          </div>
          <div class="modal-body">
            <div class="options">
              <h2 class="modal-title center">Select a transaction</h2>
              <p class="center">Use "Set this year's savings" to determine how to allocate your savings for this year.</p>
              <?php if ($year != 1981) { ?>
              <p class="center">Optionally, use "Rebalance your entire savings" to redistribute how your current savings to date are allocated.</p>
              <?php } ?>
              <div class="option-container center">
                <ul class="option-list">
                  <div class="option-block">
                    <li class="select-option">
                      <a href="contribution.php">
                        <div class="inner-option">
                          <div class="option-card"><i class="fa fa-arrow-up fa-5x"></i>
                            <p>Set this year's savings mix</p>
                          </div>
                        </div>
                      </a>
                      <div class="option-details">
                        <p>
                        Change how new contributions are saved for this year.
                        </p>
                      </div>
                    </li>
                  </div>
                  <div class="option-block block-padding"<?php if ($year == 1981) echo "style=\"display: none;\""; ?> >
                    <li class="select-option second-option">
                      <a class="option-block" href="entire.php">
                        <div class="inner-option">
                          <div class="option-card"><i class="fa fa-pie-chart fa-5x"></i>
                            <p>Rebalance your entire savings (optional)</p>
                          </div>
                        </div>
                      </a>
                      <div class="option-details">
                        <p>
                        Change how your entire account balance is divided between funds.
                        </p>
                      </div>
                    </li>
                  </div>
                </ul>
                <div class="clear"></div>
              </div>
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
          </div>
        </div>
      </div>
    </div>
  </div>  
  <script type="text/javascript" src="bower_components/jquery/dist/jquery.min.js"></script>
  <script type="text/javascript" src="bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
  <script type="text/javascript" src="bower_components/d3/d3.min.js"></script>
  <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/c3/0.4.9/c3.js"></script>
  <script charset="utf-8" src="js/home.js"></script>
</body>
</html>
