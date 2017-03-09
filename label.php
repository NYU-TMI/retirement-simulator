<?php

session_start();

?>
<!DOCTYPE html>
<html>
<head>
  <link rel="stylesheet" type="text/css" href="bower_components/bootstrap/dist/css/bootstrap.min.css">  
  <link rel="stylesheet" type="text/css" href="bower_components/font-awesome-4.3.0/css/font-awesome.min.css">
  <link rel="stylesheet" type="text/css" href="css/common.css">
  <link rel="stylesheet" type="text/css" href="css/label.css">
  <title>Retirement portfolio simulator</title>
</head>
<body>
  <div class="container">

    <div class="row">
      <h2>Interactive consumer information: retirement saving</h2>
    </div>

    <div class="row normal-top">
      <h4>Vanguard Total Stock Market Index Fund Investor Shares (VTSMX)</h4>
      <p>Diversified fund with exposure to the entire U.S. stock market. 100% stock fund.</p>
    </div>

    <div class="row thin-top">
      <div class="col-md-7 right">
        <b>Your investment timeframe <input class="label-input" size="2" maxlength="2" placeholder="10"></input> years</b>
      </div>
      <div class="col-md-5 right">
        <b>Investment amount <input class="label-input" size="8" maxlength="8" placeholder="$10,000"></input></b>
      </div>
    </div>

    <div class="row thick-top">
      <div class="col-md-9">
        <table class="table">
          <col width="4%">
          <col width="36%">
          <col width="20%">
          <col width="20%">
          <col width="20%">
          <tr>
            <td><span class="glyphicon glyphicon-info-sign blue" aria-hidden="true"></span></td>
            <th>Historical returns</th>
            <td class="right"><i>Last 1 year</i></td>
            <td class="right"><i>Last 5 years</i></td>
            <td class="right"><i>Last 10 years</i></td>
          </tr>
          <tr>
            <td></td>
            <td>Historical returns</td>
            <td class="right">$12,000</td>
            <td class="right">$15,000</td>
            <td class="right">$18,000</td>
          </tr>
          <tr>
            <td></td>
            <td>
              Benchmark comparison<br>
              <small>(S&P 500 index fund)</small>
            </td>
            <td class="right">$11,000</td>
            <td class="right">$11,000</td>
            <td class="right">$12,000</td>
          </tr>
        </table>
      </div>
      <div class="col-md-3 small-top-pad">
        <div align="right">
          <input class="pct-display" size="4" maxlength="4" placeholder="7.5%"></input>
          <p class="pct-desc"><b>Annual historical growth </b><span class="glyphicon glyphicon-info-sign blue" aria-hidden="true"></span></p>
        </div>
      </div>
    </div>

    <div class="row thin-top">
      <div class="col-md-9">
        <table class="table">
          <col width="4%">
          <col width="36%">
          <col width="20%">
          <col width="20%">
          <col width="20%">
          <tr>
            <td><span class="glyphicon glyphicon-info-sign blue" aria-hidden="true"></span></td>
            <th>Growth estimates</th>
            <td class="right"><i>1 year estimate</i></td>
            <td class="right"><i>5 year estimate</i></td>
            <td class="right"><i>10 year estimate</i></td>
          </tr>
          <tr>
            <td><span class="glyphicon glyphicon-info-sign blue" aria-hidden="true"></span></td>
            <td>Likely best case</td>
            <td class="right">$14,000</td>
            <td class="right">$17,000</td>
            <td class="right">$22,000</td>
          </tr>
          <tr>
            <td><span class="glyphicon glyphicon-info-sign blue" aria-hidden="true"></span></td>
            <td>Likely case</td>
            <td class="right">$12,000</td>
            <td class="right">$15,000</td>
            <td class="right">$18,000</td>
          </tr>
          <tr>
            <td><span class="glyphicon glyphicon-info-sign blue" aria-hidden="true"></span></td>
            <td>Likely worst case</td>
            <td class="right">$10,000</td>
            <td class="right">$11,000</td>
            <td class="right">$22,000</td>
          </tr>
        </table>
      </div>
      <div class="col-md-3 med-top-pad">
        <div align="right">
          <input class="pct-display" size="4" maxlength="4" placeholder="4.0%"><span class="plus-minus">+/-</span></input>
          <p class="pct-desc"><b>Likely volatility </b><span class="glyphicon glyphicon-info-sign blue" aria-hidden="true"></span></p>
        </div>
      </div>
    </div>

    <div class="row thin-top">
      <div class="col-md-9">
        <table class="table">
          <col width="4%">
          <col width="36%">
          <col width="20%">
          <col width="20%">
          <col width="20%">
          <tr>
            <td><span class="glyphicon glyphicon-info-sign blue" aria-hidden="true"></span></td>
            <th>Fees and costs</th>
            <td class="right"><i>1 year estimate</i></td>
            <td class="right"><i>5 year estimate</i></td>
            <td class="right"><i>10 year estimate</i></td>
          </tr>
          <tr>
            <td></td>
            <td>
              Fees over time<br>
              <small>(0.17% expense ratio)</small>
            </td>
            <td class="right">($17)</td>
            <td class="right">($85)</td>
            <td class="right">($170)</td>
          </tr>
          <tr>
            <td></td>
            <td nowrap>
              Benchmark comparison<br>
              <small>(0.8% expense ratio for S&P 500 index funds)</small>
            </td>
            <td class="right">($30)</td>
            <td class="right">($160)</td>
            <td class="right">($340)</td>
          </tr>
        </table>
      </div>
      <div class="col-md-3 med-top-pad">
        <div align="right">
          <input class="pct-display" size="4" maxlength="4" placeholder="0.3%"></input>
          <p class="pct-desc"><b>Annual fees </b><span class="glyphicon glyphicon-info-sign blue" aria-hidden="true"></span></p>
        </div>
      </div>
    </div>

    <div class="row thin-top">
      <div class="col-md-6">
        <div class="right-divider">
          <p>
            <h3>Ratings and risk</h3>
            <small>(Provided by Morningstar)</small>
          </p>

          <table class="ratings-risk">
            <col width="120px">
            <col width="120px">
            <col width="120px">
            <tr>
              <td>3 year rating</td>
              <td><big><i class="fa fa-star black"></i><i class="fa fa-star black"></i><i class="fa fa-star black"></i><i class="fa fa-star black"></i><i class="fa fa-star-o black"></i></big></td>
              <td>
                <div class="option">
                  <div class="inner-option">
                    <div class="option-card">
                      <p>A</p>
                    </div>
                  </div>
                  <div class="option-details">
                    <p>Return</p>
                  </div>
                </div>
              </td>
              <td>
                <div class="center">
                  <div class="inner-option">
                    <div class="option-card">
                      <p>B</p>
                    </div>
                  </div>
                  <div class="option-details">
                    <p>Risk</p>
                  </div>
                </div>
              </td>
            </tr>

            <tr>
              <td>5 year rating</td>
              <td><big><i class="fa fa-star black"></i><i class="fa fa-star black"></i><i class="fa fa-star black"></i><i class="fa fa-star black"></i><i class="fa fa-star-o black"></i></big></td>
              <td>
                <div class="center">
                  <div class="inner-option">
                    <div class="option-card">
                      <p>A</p>
                    </div>
                  </div>
                  <div class="option-details">
                    <p>Return</p>
                  </div>
                </div>
              </td>
              <td>
                <div class="center">
                  <div class="inner-option">
                    <div class="option-card">
                      <p>B</p>
                    </div>
                  </div>
                  <div class="option-details">
                    <p>Risk</p>
                  </div>
                </div>
              </td>
            </tr>

            <tr>
              <td>10 year rating</td>
              <td><big><i class="fa fa-star black"></i><i class="fa fa-star black"></i><i class="fa fa-star black"></i><i class="fa fa-star black"></i><i class="fa fa-star-o black"></i></big></td>
              <td>
                <div class="center">
                  <div class="inner-option">
                    <div class="option-card">
                      <p>A</p>
                    </div>
                  </div>
                  <div class="option-details">
                    <p>Return</p>
                  </div>
                </div>
              </td>
              <td>
                <div class="center">
                  <div class="inner-option">
                    <div class="option-card">
                      <p>B</p>
                    </div>
                  </div>
                  <div class="option-details">
                    <p>Risk</p>
                  </div>
                </div>
              </td>
            </tr>
          </table>
        </div>
      </div>

      <div class="col-md-6">
        <div>
          <h3>Recommendation</h3>
          <div class="row">
            <div class="col-md-4">
              <i class="fa fa-check-circle green recommend-icon"></i>
            </div>
            <div class="col-md-7 recommend-text">
              <p>
                <h4>Recommended to you for</h4>
                Retirement saving<br>
                Long-term saving<br>
                (10+ years)
              </p>
            </div>
          </div>
        </div>
      </div>
    </div>

  
  </div>  
  <script type="text/javascript" src="bower_components/jquery/dist/jquery.min.js"></script>
  <script type="text/javascript" src="bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
  <script type="text/javascript" src="bower_components/d3/d3.min.js"></script>
  <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/c3/0.4.9/c3.js"></script>
</body>
</html>
