<?php
  session_start();
  $year = $_SESSION["year"];
  
  ?>
<div class="modal fade" id="label-modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog label-width">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <p class="modal-title" id="myModalLabel">
        <ul class="nav nav-tabs">
        </ul>
        </p>
      </div>
      <div class="modal-body">
        <h2 id="label-fund-name">Vanguard Total Stock Market Index Fund Investor Shares (VTSMX)</h2>
        <ul class="nav nav-tabs">
          <li class="nav active"><a href="#A" data-toggle="tab">Overview</a></li>
          <li class="nav"><a href="#B" data-toggle="tab">Price &amp; Performance</a></li>
          <li class="nav"><a href="#C" data-toggle="tab">Portfolio &amp; Management</a></li>
          <li class="nav"><a href="#D" data-toggle="tab">Fees</a></li>
          <li class="nav"><a href="#E" data-toggle="tab">Distributions</a></li>
          <li class="nav"><a href="#F" data-toggle="tab">News &amp; Reviews</a></li>
        </ul>
        <!-- Tab panes -->
        <div class="tab-content">
          <div class="tab-pane active" id="A">
            <div class="container">
              <div class="row">
                <div class="col-md-5">
                <h3>Product summary</h3>
                <p>
                  <span id="label-desc">Diversified fund with exposure to the entire U.S. stock market. 100% stock fund.</span>
                </p>

<h3>Price</h3>
<table class="table prices">
<tr>
                    <td class="prices-year">2000</td>
                    <td class="right prices-price">$100.00</td>
                  </tr>
</table>

                </div>
                <div class="col-md-5">
                <h3>Fund facts</h3>
                <table class="table">
                      <col width="20%">
                      <col width="20%">
                      <col width="20%">
                      <tr>
                        <td><i>Asset class</i></td>
                        <td class="right" id="fundType">-</td>
                      </tr>
                      <tr>
                        <td><i>Category</i></td>
                        <td class="right">Mutual Fund</td>
                      </tr>
                       <tr>
                        <td><i>Expense ratio</i></td>
                        <td class="right"><span id="expense-ratio">0.17%</span>%</td>
                      </tr>
                       <tr>
                        <td><i>Fund number</i></td>
                        <td class="right" id="fundNumber">-</td>
                      </tr>
                       <tr>
                        <td><i>Fund advisor</i></td>
                        <td class="right">Equity Investment Group</td>
                      </tr>
                    </table>
                </div>
                </div>
                <div class="row">
                  <div class="col-md-5">
                    <h3>Average annual performance</h3>
                    <table id="hist-label" class="table">
                      <col width="20%">
                      <col width="20%">
                      <col width="20%">
                      <tr>
                        <td class="right"><i>Last <span class="label-year1head">1</span> year</i></td>
                        <td class="right"><i>Last <span class="label-year2head">5</span> years</i></td>
                        <td class="right"><i>Last <span class="label-year3head">10</span> years</i></td>
                      </tr>
                      <tr>
                        <td class="right" id="label-hist1b">$12,000</td>
                        <td class="right" id="label-hist2b">$15,000</td>
                        <td class="right" id="label-hist3b">$18,000</td>
                      </tr>
                    </table>
                  </div>
                  <div class="col-md-5">
                    <h3>Hypothetical growth of $10,000</h3>
                    <table id="estimates-label" class="table">
                      <col width="20%">
                      <col width="20%">
                      <col width="20%">
                      <tr>
                        <td class="right"><i><span class="label-year1head">1</span> year</i></td>
                        <td class="right"><i><span class="label-year2head">5</span> year</i></td>
                        <td class="right"><i><span class="label-year3head">10</span> year</i></td>
                      </tr>
                      <tr>
                        <td id="label-likely1" class="right">$12,000</td>
                        <td id="label-likely2" class="right">$15,000</td>
                        <td id="label-likely3" class="right">$18,000</td>
                      </tr>
                    </table>
                  </div>
                </div>

                <div class="col-md-10">
                The performance data shown represent past performance, which is not a guarantee of future results. Investment returns and principal value will fluctuate, so that shares, when sold, may be worth more or less than their original cost. Current performance may be lower or higher than the performance data cited. The performance of an index is not an exact representation of any particular investment, as you cannot invest directly in an index.
                </div>
              
            </div>
          </div>
          <div class="tab-pane" id="B">
            <div class="row">
              <div class="col-md-8">

<h3>Price</h3>
<table class="table prices">
<tr>
                    <td class="prices-year">2000</td>
                    <td class="right prices-price">$100.00</td>
                  </tr>
</table>


        <!-- 	    <a href="api/get_price.php">.</a> -->
                <h3>Hypothetical growth of $10,000</h3>
                <table id="estimates-label" class="table">
                <col width="20%">
                  <col width="20%">
                  <col width="20%">
                  <col width="20%">
                  <tr>
                  <td></td>
                    <td class="right"><i><span class="label-year1head">1</span> year</i></td>
                    <td class="right"><i><span class="label-year2head">5</span> year</i></td>
                    <td class="right"><i><span class="label-year3head">10</span> year</i></td>
                  </tr>
                  <tr>
                  <td>
                      This fund
                    </td>
                    <td id="label-likely1b" class="right">$12,000</td>
                    <td id="label-likely2b" class="right">$15,000</td>
                    <td id="label-likely3b" class="right">$18,000</td>
                  </tr>
                  <td>
                      Benchmark comparison<br>
                      <small>(S&P 500 index fund)</small>
                    </td>
                    <td class="right" id="label-hbench1">$11,000</td>
                    <td class="right" id="label-hbench2">$11,000</td>
                    <td class="right" id="label-hbench3">$12,000</td>
                </table>
              </div>
            </div>
          </div>
          <div class="tab-pane" id="C">
            <h3>Portfolio</h3>
            <p id="label-desc2">Diversified fund with exposure to the entire U.S. stock market. 100% stock fund.</p>
            <h3>Plain talk about risk</h3>
            <p> The trust is subject to several stock and bond market risks, any of which could cause an investor to lose money. However, based on the trust's current allocation between stocks and the less volatile asset class of bonds, the trust's overall level of risk should be higher than those funds that invest mostly in bonds, but lower than those investing mostly in stocks. As the trust's allocation between underlying funds gradually changes, the trust's overall level of risk also will decline. In addition to the risks inherent in the asset classes of the underlying funds, the trust also is subject to asset allocation risk, which is the chance that the selection of underlying funds and the allocation of fund assets will cause the trust to underperform other funds with a similar investment objective. Investments in Target Retirement Trusts are subject to the risks of their underlying funds. The year in the trust name refers to the approximate year 2050 when an investor in the trust would retire and leave the work force. The trust will gradually shift its emphasis from more aggressive investments to more conservative ones based on its target date. An investment in the Target Retirement Trust is not guaranteed at any time, including on or after the target date.</p>
            <h3>Management</h3>
            <h4>Equity Investment Group</h4>
            <p>As chief investment officer and managing director, Mortimer J. Buckley oversees Equity Investment and Fixed Income Groups. Joseph Brennan, CFA, Principal and global head of Equity Index Group, has oversight responsibility for all equity index funds managed by the Equity Investment Group. John Ameriks, Ph.D., Principal of Vanguard and head of Quantitative Equity Group, has oversight responsibility for all active equity funds managed by the Equity Investment Group. The Equity Investment Group manages indexed and structured equity portfolios covering U.S. and international markets. It has developed sophisticated portfolio construction methodologies and efficient trading strategies that seek to deliver returns that are highly correlated with target portfolio benchmarks.</p>
          </div>
          <div class="tab-pane" id="D">
            <div class="row">
              <div class="col-md-5">
              <h3>Expenses</h3>
                <table id="fees-label" class="table">
                  <col width="50%">
                  <col width="50%">
                  <tr>
                    <td>
                      Fees on $10,000 invested over 5 years<br>
                      <small>(<span id="expense-ratio">0.17%</span> expense ratio)</small>
                    </td>
                    <td class="right">-<span id="label-fee2">$85</span></td>
                  </tr>
                  <tr>
                    <td nowrap>
                      Benchmark comparison<br>
                      <small>(0.8% expense ratio for S&P 500 index funds)</small>
                    </td>
                    <td class="right">-<span id="label-lbench2">$160</span></td>
                  </tr>
                </table>
              </div>

<div class="col-md-5">
<h3>Fees</h3>
                <table class="table">
                  <col width="50%">
                  <col width="50%">
                  <tr>
                    <td>Purchase fee</td>
                    <td class="right">None</td>
                  </tr>
                  <tr>
                    <td>
                      Redemption fee
                    </td>
                    <td class="right">None</td>
                  </tr>
                  <tr>
                    <td>
                      12b-1 fee
                    </td>
                    <td class="right">None</td>
                  </tr>
                </table>
              </div>

            </div>
          </div>
          <div class="tab-pane" id="E">
            <p>There are no distributions to date for this fund. Dividends and Capital Gains remain in the fund are reflected in the NAV rather than being distributed and reinvested in additional shares of the fund.</p>
          </div>
          <div class="tab-pane" id="F">
            <div class="row">
              <div class="col-md-5">
                <h3>News</h3>
                <p>There are no recent news stories associated with this fund.</p>
              </div>
              <div class="col-md-5">
                <h3>Reviews</h3>
                <p>There are no review articles available at this time.</p>
              </div>
            </div>
          </div>
        </div>
        <div style="display: none">
          <div class="container label-wrap">
            <div class="row">
              <div class="col-md-8">
                <p class="red label-experiment-desc">Click the "See how changes affect fund performance" button, and change the annual growth, volatility and fees to see how they affect the fund's performance.</p>
              </div>
              <div class="col-md-4">
                <button type="button" class="btn btn-danger label-experiment" id="tip-experiment" data-toggle="tooltip" title="Change fund attributes like growth rate, volatility and fees to see hypothetically how the fund would behave. This does not affect actual fund performance.">See how changes affect fund performance</button>
              </div>
            </div>
            <div class="row thin-top">
              <div class="col-md-7 right">
                <b>Your saving timeframe is: <input id="label-timeframe" class="label-input" maxlength="2" placeholder=
                  "<?php 
                    if (2016 - $year > 20) {
                      echo 20; 
                    } else {
                      echo 2016 - $year;
                    }
                    ?>"
                  > years</b>
              </div>
              <div class="col-md-5 right">
                <b>Saving amount <input id="label-invest" class="label-input" maxlength="7" placeholder="$10,000" readonly></b>
              </div>
            </div>
            <div class="row thick-top">
              <div class="col-md-9">
                <table id="hist-label" class="table label-table">
                  <col width="4%">
                  <col width="36%">
                  <col width="20%">
                  <col width="20%">
                  <col width="20%">
                  <tr>
                    <td><span class="glyphicon glyphicon-info-sign blue" id="tip-historical" aria-hidden="true" data-toggle="tooltip" data-placement="left" title="Historical returns of this fund over the past years and a benchmark comparison"></span></td>
                    <th>Historical growth</th>
                    <td class="right"><i>Last <span class="label-year1head">1</span> year</i></td>
                    <td class="right"><i>Last <span class="label-year2head">5</span> years</i></td>
                    <td class="right"><i>Last <span class="label-year3head">10</span> years</i></td>
                  </tr>
                  <tr>
                    <td></td>
                    <td>Historical growth of <span id="historical-growth-amount">$10,000</span></td>
                    <td class="right" id="label-hist1">$12,000</td>
                    <td class="right" id="label-hist2">$15,000</td>
                    <td class="right" id="label-hist3">$18,000</td>
                  </tr>
                  <tr>
                    <td></td>
                    <td>
                      Benchmark comparison<br>
                      <small>(S&P 500 index fund)</small>
                    </td>
                    <td class="right" id="label-hbench1">$11,000</td>
                    <td class="right" id="label-hbench2">$11,000</td>
                    <td class="right" id="label-hbench3">$12,000</td>
                  </tr>
                </table>
              </div>
              <div class="col-md-3">
                <div class="small-top-pad"></div>
                <div align="right">
                  <input id="label-growth-pct" class="pct-display" size="4" maxlength="4" placeholder="7.5" readonly>
                  <span class="pct-display-after">%</span>
                  <p class="pct-desc"><b>Annual growth </b><span class="glyphicon glyphicon-info-sign blue" id="tip-historical-pct" aria-hidden="true" data-toggle="tooltip" data-placement="right" title="Yearly growth this fund based on historical data."></span></p>
                </div>
              </div>
            </div>
            <div class="row thin-top">
              <div class="col-md-9">
                <table id="estimates-label" class="table label-table">
v                  <col width="4%">
                  <col width="36%">
                  <col width="20%">
                  <col width="20%">
                  <col width="20%">
                  <tr>
                    <td><span class="glyphicon glyphicon-info-sign blue" id="tip-growth" aria-hidden="true" data-toggle="tooltip" data-placement="left" title="Investment scenarios that show how this fund may fluctuate over time."></span></td>
                    <th>Growth estimates</th>
                    <td class="right"><i><span class="label-year1head">1</span> year estimate</i></td>
                    <td class="right"><i><span class="label-year2head">5</span> year estimate</i></td>
                    <td class="right"><i><span class="label-year3head">10</span> year estimate</i></td>
                  </tr>
                  <tr>
                    <td><span class="glyphicon glyphicon-info-sign blue" id="tip-best" aria-hidden="true" data-toggle="tooltip" data-placement="left" title="Estimated performance of this fund in a best case scenario."></span></td>
                    <td>Best case</td>
                    <td id="label-best1" class="right">$14,000</td>
                    <td id="label-best2" class="right">$17,000</td>
                    <td id="label-best3" class="right">$22,000</td>
                  </tr>
                  <tr>
                    <td><span class="glyphicon glyphicon-info-sign blue" id="tip-likely" aria-hidden="true" data-toggle="tooltip" data-placement="left" title="Estimated performance of this fund in an average case scenario."></span></td>
                    <td>Average case</td>
                    <td id="label-likely1" class="right">$12,000</td>
                    <td id="label-likely2" class="right">$15,000</td>
                    <td id="label-likely3" class="right">$18,000</td>
                  </tr>
                  <tr>
                    <td><span class="glyphicon glyphicon-info-sign blue" id="tip-worst" aria-hidden="true" data-toggle="tooltip" data-placement="left" title="Estimated performance of this fund in a worst case scenario."></span></td>
                    <td>Worst case</td>
                    <td id="label-worst1" class="right">$10,000</td>
                    <td id="label-worst2" class="right">$11,000</td>
                    <td id="label-worst3" class="right">$22,000</td>
                  </tr>
                </table>
              </div>
              <div class="col-md-3">
                <div class="small-top-pad"></div>
                <div class="volatility-pct-display" align="right">
                  <input id="label-volatility-pct" class="pct-display" size="4" maxlength="4" placeholder="4.0" readonly><span class="plus-minus">+/-</span>
                  <span class="pct-display-after">%</span>
                  <p class="pct-desc"><b>Volatility </b><span class="glyphicon glyphicon-info-sign blue" id="tip-volatility-pct" aria-hidden="true" data-toggle="tooltip" data-placement="right" title="Shows the likely fluctuation of this fund on a yearly basis based on historical data."></span></p>
                </div>
              </div>
            </div>
            <div class="row thin-top">
              <div class="col-md-9">
                <table id="fees-label" class="table label-table">
                  <col width="4%">
                  <col width="36%">
                  <col width="20%">
                  <col width="20%">
                  <col width="20%">
                  <tr>
                    <td><span class="glyphicon glyphicon-info-sign blue" id="tip-fees" aria-hidden="true" data-toggle="tooltip" data-placement="left" title="Fees you pay for owning this fund such as management fees or redemption fees."></span></td>
                    <th>Fees and costs</th>
                    <td class="right"><i><span class="label-year1head">1</span> year</i></td>
                    <td class="right"><i><span class="label-year2head">5</span> year</i></td>
                    <td class="right"><i><span class="label-year3head">10</span> year</i></td>
                  </tr>
                  <tr>
                    <td><span class="glyphicon glyphicon-info-sign blue" id="tip-fees-over-time" aria-hidden="true" data-toggle="tooltip" data-placement="left" title="The expense ratio is the annual fee that all funds charge. It expresses the percentage of assets deducted each fiscal year for fund expenses."></span></td>
                    <td>
                      Fees over time<br>
                      <small>(<span id="expense-ratio">0.17%</span> expense ratio)</small>
                    </td>
                    <td class="right">-<span id="label-fee1">$17</span></td>
                    <td class="right">-<span id="label-fee2">$85</span></td>
                    <td class="right">-<span id="label-fee3">$170</span></td>
                  </tr>
                  <tr>
                    <td></td>
                    <td nowrap>
                      Benchmark comparison<br>
                      <small>(0.8% expense ratio for S&P 500 index funds)</small>
                    </td>
                    <td class="right">-<span id="label-lbench1">$30</span></td>
                    <td class="right">-<span id="label-lbench2">$160</span></td>
                    <td class="right">-<span id="label-lbench3">$340</span></td>
                  </tr>
                </table>
              </div>
              <div class="col-md-3">
                <div class="small-top-pad"></div>
                <div align="right">
                  <input id="label-fee-pct" class="pct-display" size="4" maxlength="4" placeholder="0.3" readonly>
                  <span class="pct-display-after">%</span>
                  <p class="pct-desc"><b>Annual fees </b><span class="glyphicon glyphicon-info-sign blue" id="tip-fees-pct" aria-hidden="true" data-toggle="tooltip" data-placement="right" title="Percentage of fund used to pay for fees each year."></span></p>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-md-12 right small-bottom-pad">
                <button type="button" id="apply-btn" class="btn btn-primary">Apply changes</button>
              </div>
            </div>
            <div class="error-label alert alert-danger" style="display: none;" role="alert">
              <div class="error-label" style="display: none;">
                <span class="glyphicon glyphicon-exclamation-sign"></span> Please enter percentages into the fields.
              </div>
            </div>
            <div id="label-bottom" class="row thin-top">
              <div class="col-md-6">
                <div class="right-divider">
                  <p>
                  <h3 class="label-title">Ratings and risk</h3>
                  <!--<small>(Provided by Morningstar)</small>-->
                  </p>
                  <table class="ratings-risk">
                    <col width="120px">
                    <col width="120px">
                    <col width="120px">
                    <tr>
                      <td>3 year rating</td>
                      <td><big id="label-3rating"></big></td>
                      <td>
                        <div class="label-option">
                          <div class="label-inner-option">
                            <div class="label-option-card">
                              <p id="label-3return">A</p>
                            </div>
                          </div>
                          <div class="label-option-details">
                            <p>Return</p>
                          </div>
                        </div>
                      </td>
                      <td>
                        <div class="center">
                          <div class="label-inner-option">
                            <div class="label-option-card">
                              <p id="label-3risk">B</p>
                            </div>
                          </div>
                          <div class="label-option-details">
                            <p>Risk</p>
                          </div>
                        </div>
                      </td>
                    </tr>
                    <tr>
                      <td>5 year rating</td>
                      <td><big id="label-5rating"></big></td>
                      <td>
                        <div class="center">
                          <div class="label-inner-option">
                            <div class="label-option-card">
                              <p id="label-5return">A</p>
                            </div>
                          </div>
                          <div class="label-option-details">
                            <p>Return</p>
                          </div>
                        </div>
                      </td>
                      <td>
                        <div class="center">
                          <div class="label-inner-option">
                            <div class="label-option-card">
                              <p id="label-5risk">B</p>
                            </div>
                          </div>
                          <div class="label-option-details">
                            <p>Risk</p>
                          </div>
                        </div>
                      </td>
                    </tr>
                    <tr>
                      <td>10 year rating</td>
                      <td><big id="label-10rating"></big></td>
                      <td>
                        <div class="center">
                          <div class="label-inner-option">
                            <div class="label-option-card">
                              <p id="label-10return">A</p>
                            </div>
                          </div>
                          <div class="label-option-details">
                            <p>Return</p>
                          </div>
                        </div>
                      </td>
                      <td>
                        <div class="center">
                          <div class="label-inner-option">
                            <div class="label-option-card">
                              <p id="label-10risk">B</p>
                            </div>
                          </div>
                          <div class="label-option-details">
                            <p>Risk</p>
                          </div>
                        </div>
                      </td>
                    </tr>
                  </table>
                </div>
              </div>
              <div class="col-md-6">
                <div class="recommendation-label">
                  <h3 class="label-title">Recommendation</h3>
                  <div class="row">
                    <div class="col-md-4">
                      <i class="fa fa-check-circle green recommend-icon"></i>
                      <i class="fa fa-times-circle red reject-icon"></i>
                    </div>
                    <div class="col-md-7 recommend-text">
                      <p>
                      <h4 id="label-recommend-head">Recommended to you for</h4>
                      <span id="label-recommend">Retirement saving</span>
                      </p>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>