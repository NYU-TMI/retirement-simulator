<!DOCTYPE html>
<html>
  <head>
    <title>Fund Details</title>
    <link rel="stylesheet" type="text/css" href="bower_components/bootstrap/dist/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="bower_components/font-awesome-4.3.0/css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="css/common.css">
    <link rel="stylesheet" type="text/css" href="css/details.css">
  </head>
  <body>
  <?php
include 'api/include.php';
$query = "SELECT name, description, fees, recommendation, fid FROM fund WHERE symbol = 'BFA'";

$name = '';
if ($result = mysqli_query($conn, $query)) {
  while ($row = mysqli_fetch_row($result)) {
    $name = $row[0];
    $description = $row[1];
    $fees = $row[2] * 100;
    $recommendation = $row[3];
    $fid = $row[4] * 100;
  }
}
?>
    <div class="container">
    <div class="row">
    <div class="col-md-12">
      <h1><?=$name?></h1>
      <div class="container">
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
          <div class="tab-pane fade in active" id="A">
            <div class="innerContentPanel900">
              <div>
                <div class="profilePageContainer">
                  <div class="blockContainer">
                    <div class="halfBlock">
                      <h2>Product summary</h2>
                      <div>
                        <ul>
                          <li><?=$description?></li>
                        </ul>
                      </div>
                    </div>
                    <div class="halfBlock">
                      <h2>Fund facts</h2>
                      <table class="summarytable">
                        <tbody>
                          <tr>
                            <td>Asset class</td>
                            <td><?=$recommendation?></td>
                          </tr>
                          <tr>
                            <td>Category</td>
                            <td>Mutual Fund</td>
                          </tr>
                          <tr>
                            <td>Expense ratio</td>
                            <td><?=$fees?>%</td>
                          </tr>
                          <tr>
                            <td>Fund number</td>
                            <td><?=$fid?></td>
                          </tr>
                          <tr>
                            <td>Fund advisor</td>
                            <td>Various Investment Companies</td>
                          </tr>
                          <tr style="display: none;">
                            <td>&nbsp;</td>
                            <td>
                              <div fund-videos="">
                                <a href="" class="ngpopup fundVideoImage"></a>
                                <p></p>
                              </div>
                            </td>
                          </tr>
                        </tbody>
                      </table>
                    </div>
                    <div class="clearDivFloat"></div>
                    <div>
                      <div class="halfBlock">
                        <h2>Price and performance</h2>
                        <table class="summarytable">
                          <tbody>
                            <tr>
                              <td>Price</td>
                              <td>$27.85</td>
                              <td>&nbsp;</td>
                            </tr>
                            <tr>
                              <td>Change</td>
                              <td>$0.02</span></td>
                              <td>0.07%</span></td>
                            </tr>
                            <tr>
                              <td>SEC yield</td>
                              <td></span>
                              </td>
                              <td>
                              </td>
                            </tr>
                          </tbody>
                        </table>
                      </div>
                      <div class="fullBlock">
                        <div class="halfBlock">
                          <div class="avgAnnPrfChart" data-avg-ann-prf-chart="performance">
                            <div class="chartHeader">
                              <h3>Average annual performance</h3>


<table id="hist-label" class="table label-table">
                <colgroup>
                <col width="36%">
                <col width="20%">
                <col width="20%">
                <col width="20%">
                </colgroup><tbody><tr>
                                <td class="right"></td>
                  <td class="right"><span class="label-year1head">1</span> year</td>
                  <td class="right"><span class="label-year2head">5</span> years</td>
                  <td class="right"><span class="label-year3head">20</span> years</td>
                </tr>
                <tr>

  <td>Historical growth of <span id="historical-growth-amount">$10,000</span></td>
                  <td class="right" id="label-hist1">$10,320</td>
                  <td class="right" id="label-hist2">$16,840</td>
                  <td class="right bg-lightblue" id="label-hist3">$54,802</td>
                </tr>
                <tr>
                  <td>
                    Benchmark comparison<br>
                    <small>(S&amp;P 500 index fund)</small>
                  </td>
                  <td class="right" id="label-hbench1">$11,264</td>
                  <td class="right" id="label-hbench2">$15,251</td>
                  <td class="right bg-lightblue" id="label-hbench3">$116,148</td>
                </tr>
              </tbody></table>

                            </div>

                            <div>
                              <div>
                                <div class="avgAnnPrfQuarter chartWrapper" avg-ann-prf-quarterly-chart="data" view-quarter-end="viewQuarterEnd" view-chart="viewChart">
                                  <canvas class="avgAnnPrfQuarterlyCanvas" width="390" height="194"></canvas>
                                  <span class="chartLabelY" style="width:18px;top:5px;left:28px;">15</span><span class="chartLabelY" style="width:18px;top:34px;left:28px;">10</span><span class="chartLabelY" style="width:18px;top:63px;left:28px;">5</span><span class="chartLabelY" style="width:18px;top:92px;left:28px;">0</span><span class="chartLabelY" style="width:18px;top:121px;left:28px;">-5</span><span class="chartLabelY" style="width:18px;top:149px;left:28px;">-10</span><span class="chartLabelY" style="width:22px;top:78.5px;left:0px;">%</span>
                                  <div class="avgAnnPrfChartBar yellow" style="top:99.5px;left:98px;height:20px;"></div>
                                  <span class="barData" style="top:121.5px;left:98px;">-3.37</span><span class="chartLabelX" style="width:64px;top:160px;left:64px;">1 Year</span>
                                  <div class="avgAnnPrfChartBar yellow" style="top:48px;left:164.8px;height:51px;"></div>
                                  <span class="barData" style="top:40px;left:164.8px;">8.81</span><span class="chartLabelX" style="width:64px;top:160px;left:130px;">3 Year</span>
                                  <div class="avgAnnPrfChartBar yellow" style="top:44px;left:231.6px;height:55px;"></div>
                                  <span class="barData" style="top:36px;left:231.6px;">9.42</span><span class="chartLabelX" style="width:64px;top:160px;left:197px;">5 Year</span><span class="chartLabelX" style="width:64px;top:160px;left:264px;">10 Year</span>
                                  <div class="avgAnnPrfChartBar blue" style="top:99.5px;left:335.2px;height:46px;"></div>
                                  <span class="barData" style="top:147.5px;left:335.2px;">-7.94</span><span class="chartLabelX" style="width:64px;top:160px;left:331px;">Since inception 06/30/2015</span>
                                </div>
                              </div>
                              <div class="avgAnnPrfChartLegend">
                                <div class="legendKey"></span></div>
                                <div>*</span></div>
                              </div>
                            </div>
                            <table class="summarytable">
                              <tbody>
                                <tr>
                                  <th></th>
                                  <th>1 Year</th>
                                  <th>3 Year</th>
                                  <th>5 Year</th>
                                  <th>10 Year</th>
                                  <th>Since<br>Inception<br>06/30/2015</th>
                                </tr>
                                <tr>
                                  <td>Target Ret 2050 Tr Sel   <span></span></td>
                                  <td class="noWrapWhitespace">-</td>
                                  <td class="noWrapWhitespace">-</td>
                                  <td class="noWrapWhitespace">-</td>
                                  <td class="noWrapWhitespace">-</td>
                                  <td class="noWrapWhitespace">-7.94%</td>
                                </tr>
                                <tr>
                                  <td>Target Retirement 2050 Composite Ix               <span>*</span></td>
                                  <td class="noWrapWhitespace">-3.37%</td>
                                  <td class="noWrapWhitespace">8.81%</td>
                                  <td class="noWrapWhitespace">9.42%</td>
                                  <td class="noWrapWhitespace">-</td>
                                  <td class="noWrapWhitespace">-</td>
                                </tr>
                              </tbody>
                            </table>
                            <p class="footnote"></span></p>
                          </div>
                        </div>
                        <div>
                          <h3>Hypothetical growth of $10,000</h3>
                          <div class="hypoGrowthChart" data-hypothetical-growth-chart="growth10k">
                            <p>As of 11/30/2015</p>
                            <div class="chartWrapper">
                              <canvas class="hypoGrowthCanvas" width="370" height="194" style="display: block;"></canvas>
                              <div class="mouseoverBubble"><span class="labelColor"></span><span class="pointValue"></span></div>
                              <span class="chartLabelX chartLabel" style="top:168.5px;left:39.5px;">2005</span><span class="chartLabelX chartLabel" style="top:168.5px;left:99.5px;">2007</span><span class="chartLabelX chartLabel" style="top:168.5px;left:159.5px;">2009</span><span class="chartLabelX chartLabel" style="top:168.5px;left:219.5px;">2011</span><span class="chartLabelX chartLabel" style="top:168.5px;left:279.5px;">2013</span><span class="chartLabelX chartLabel" style="top:168.5px;left:339.5px;">2015</span><span class="chartLabelY chartLabel" style="top:6.5px;left:0px;">11,000</span><span class="chartLabelY chartLabel" style="top:42.5px;left:0px;">10,500</span><span class="chartLabelY chartLabel" style="top:78.5px;left:0px;">10,000</span><span class="chartLabelY chartLabel" style="top:114.5px;left:0px;">9,500</span><span class="chartLabelY chartLabel" style="top:150.5px;left:0px;">9,000</span><span class="chartLabelY chartLabel" style="width:16px;top:78.5px;left:0px;">$</span>
                            </div>
                            <div class="hypoGrowthLegend">
                              <div class="legendKey"></span>Target Ret 2050 Tr Sel   </div>
                              <div>*</span></div>
                            </div>
                          </div>
                        </div>
                      </div>
                      <div class="clearDivFloat"></div>
                    </div>
                    <div class="fullBlock">
                      <div class="disclaimers">
                        <div>
                          <p class="ng-scope">The performance data shown represent past performance, which is not a
                            guarantee of future results. Investment returns and principal value will
                            fluctuate, so that investors' shares, when sold, may be worth more or less
                            than their original cost. Current performance may be lower or higher than the
                            performance data cited. The performance of an index is
                            not an exact representation of any particular investment, as you cannot invest
                            directly in an index.
                          </p>
                        </div>
                      </div>
                    </div>
                    <h2>Portfolio composition</h2>
                    <div>
                      <div class="halfBlock">
                        <div>
                          <h4><b>Allocation to underlying funds</b> as of 10/31/2015</h4>
                          <table class="summarytable">
                            <tbody>
                              <tr>
                                <th>Ranking by Percentage</th>
                                <th>Fund</th>
                                <th>Percentage</th>
                              </tr>
                              <tr>
                                <td class="label">1</td>
                                </td>
                                <td class="right">54.4%</td>
                              </tr>
                              <tr>
                                <td class="label">2</td>
                                </td>
                                <td class="right">35.6%</td>
                              </tr>
                              <tr>
                                <td class="label">3</td>
                                <span>**</span></span></td>
                                <td class="right">7.0%</td>
                              </tr>
                              <tr>
                                <td class="label">4</td>
                                </td>
                                <td class="right">3.0%</td>
                              </tr>
                              <tr>
                                <td class="subHead">Total</td>
                                <td>-</td>
                                <td class="total">100.0%</td>
                              </tr>
                            </tbody>
                          </table>
                        </div>
                      </div>
                    </div>
                    <div class="halfBlock">
                      <div>
                        <h4 class="ng-scope"><b>Characteristics</b> as of 10/31/2015</h4>
                        <table class="summarytable">
                          <tbody>
                            <tr>
                              <td>Fund total net assets as of 10/31/2015</td>
                              <td>$7.3 billion</td>
                            </tr>
                          </tbody>
                        </table>
                      </div>
                    </div>
                    <div class="fullBlock">
                      <div>
                        <div>
                          <p class="footnote"><span>Derived by applying the fund's target asset allocation to the results of the following benchmarks: for international stocks of developed markets, the MSCI EAFE Index through December 15, 2010, the MSCI ACWI ex USA IMI Index through June 2, 2013, and the FTSE Global All Cap ex US Index thereafter; for emerging-market stocks, the Select Emerging Markets Index through August 23, 2006, the MSCI Emerging Markets Index through December 15, 2010, the MSCI ACWI ex USA IMI Index through June 2, 2013, and the FTSE Global All Cap ex US Index thereafter; for U.S. bonds, the Barclays U.S. Aggregate Bond Index through December 31, 2009, and the Barclays U.S. Aggregate Float Adjusted Index thereafter; for international bonds, the Barclays Global Aggregate ex-USD Float Adjusted RIC Capped Index beginning June 3, 2013; and for U.S. stocks, the MSCI US Broad Market Index through June 2, 2013, and the CRSP US Total Market Index thereafter. International stock benchmark returns are adjusted for withholding taxes.</span></p>
                        </div>
                        <div>
                          <p class="footnote"><span>**</span>Information on this fund can be found on Vanguard's Institutional Investors site.</p>
                        </div>
                        <div>
                          </a>
                        </div>
                      </div>
                      <div></div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="tab-pane fade" id="B">
            <div>
              <div class="profilePageContainer">
                <h2>Price</h2>
                <div class="halfBlock">
                  <h3>Current prices</h3>
                  <table class="summarytable">
                    <tbody>
                      <tr>
                        <td>Price as of 12/14/2015</td>
                        <td>$27.85</td>
                        <td class="right">&nbsp;</td>
                      </tr>
                      <tr>
                        <td>Change</td>
                        <td>$0.02</span></td>
                        <td class="right">0.07%</span></td>
                      </tr>
                      <tr>
                        <td>SEC yield as of </td>
                        <td>-<span></span>
                        </td>
                        <td class="right">
                        </td>
                      </tr>
                      <tr>
                        <td>52-week high 07/16/2015
                        </td>
                        <td>$30.02</td>
                        <td class="right">&nbsp;</td>
                      </tr>
                      <tr>
                        <td>52-week low 09/29/2015
                        </td>
                        <td>$26.65</td>
                        <td class="right">&nbsp;</td>
                      </tr>
                      <tr>
                        <td>Range</td>
                        <td> $3.37</td>
                        <td class="right">12.65%</td>
                      </tr>
                    </tbody>
                  </table>
                </div>
                <div class="halfBlockRight">
                  <h3>Historical prices</h3>
                  <table class="summarytable">
                    <tbody>
                      <tr>
                        <td>12/11/2015</td>
                        <td class="right">$27.83</td>
                      </tr>
                      <tr>
                        <td>12/10/2015</td>
                        <td class="right">$28.31</td>
                      </tr>
                      <tr>
                        <td>12/09/2015</td>
                        <td class="right">$28.29</td>
                      </tr>
                      <tr>
                        <td>12/08/2015</td>
                        <td class="right">$28.44</td>
                      </tr>
                      <tr>
                        <td>12/07/2015</td>
                        <td class="right">$28.68</td>
                      </tr>
                      <tr>
                        <td><a>Search for
                          more historical price information</a>
                        </td>
                        <td>&nbsp;</td>
                      </tr>
                    </tbody>
                  </table>
                </div>
                <h2>Performance</h2>
                <div>
                  <div class="fullBlock">
                    <div>
                      <h3 class="halfBlock">Hypothetical growth of $10,000</h3>
                      <p class="halfBlockRight text-right">
                        <a href="">View price history chart</a>
                      </p>
                    </div>
                    <div>
                      <ul class="linkBar">
                        <li>Range</li>
                        <li>1 year</a></li>
                        <li>3 years</a></li>
                        <li>5 years</a></li>
                        <li>10 years</a></li>
                      </ul>
                      <div class="halfBlock">
                        <div class="perfGrowthChart" data-performance-growth-chart="" data-data="hypGrowthChart.data" data-remove-click="hypGrowthChart.removeFund(fund)">
                          <canvas class="perfGrowthCanvas" width="470" height="200"></canvas>
                        </div>
                      </div>
                      <div class="halfBlockRight">
                        <p>
                          <select>
                            <option value="0" selected="selected">Select a benchmark</option>
                            <option value="1">Dow Jones Industrial Average                      </option>
                            <option value="2">NASDAQ Composite Index                            </option>
                            <option value="3">Barclays US Aggregate Bond Index                  </option>
                            <option value="4">S&amp;P 500 Index                                     </option>
                            <option value="5">Dow Jones U.S. Total Stock Mkt Ix-D               </option>
                            <option value="6">MSCI EAFE Index                                   </option>
                          </select>
                        </p>
                        <p>Compare the growth of a hypothetical $10,000 investment in this fund with the growth of the same amount in a benchmark. Move your mouse over the graph to see the changes in returns.</p>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="fullBlock">
                  <h4><b>Average annual returns-updated monthly</b> as of 11/30/2015</h4>
                  <table class="summarytable">
                    <tbody>
                      <tr>
                        <th>&nbsp;</th>
                        <th>1 Year</th>
                        <th>3 Year</th>
                        <th>5 Year</th>
                        <th>10 Year</th>
                        <th>Since Inception<br>06/30/2015</th>
                      </tr>
                      <tr>
                        <td>Target Ret 2050 Tr Sel   </td>
                        <td class="right">-</td>
                        <td class="right">-</td>
                        <td class="right">-</td>
                        <td class="right">-</td>
                        <td class="right">-2.14%</td>
                      </tr>
                      <tr>
                        <td>Target Retirement 2050 Composite Ix               *</td>
                        <td class="right">-0.42%</td>
                        <td class="right">11.11%</td>
                        <td class="right">10.14%</td>
                        <td class="right">-</td>
                        <td class="right">-</td>
                      </tr>
                    </tbody>
                  </table>
                </div>
                <div class="fullBlock">
                  <p class="halfBlockRight text-right">See cumulative, yearly, and quarterly historical returns</a></p>
                </div>
                <div class="fullBlock">
                  <h3>Recent investment returns</h3>
                  <table class="summarytable">
                    <tbody>
                      <tr>
                        <th>&nbsp;
                        </th>
                        <th>Year-to-Date<br>as of 11/30/2015</th>
                        <th>Previous Month<br>11/30/2015</th>
                        <th>3-Month total<br>as of 11/30/2015</th>
                      </tr>
                      <tr>
                        <td>Target Ret 2050 Tr Sel   </td>
                        <td class="right">-</td>
                        <td class="right">-0.17%</td>
                        <td class="right">3.22%</td>
                      </tr>
                      <tr>
                        <td>Target Retirement 2050 Composite Ix               *</td>
                        <td class="right">0.43%</td>
                        <td class="right">-0.36%</td>
                        <td class="right">3.22%</td>
                      </tr>
                    </tbody>
                  </table>
                </div>
                <div class="fullBlock">
                  <p class="footnote">Derived by applying the fund's target asset allocation to the results of the following benchmarks: for international stocks of developed markets, the MSCI EAFE Index through December 15, 2010, the MSCI ACWI ex USA IMI Index through June 2, 2013, and the FTSE Global All Cap ex US Index thereafter; for emerging-market stocks, the Select Emerging Markets Index through August 23, 2006, the MSCI Emerging Markets Index through December 15, 2010, the MSCI ACWI ex USA IMI Index through June 2, 2013, and the FTSE Global All Cap ex US Index thereafter; for U.S. bonds, the Barclays U.S. Aggregate Bond Index through December 31, 2009, and the Barclays U.S. Aggregate Float Adjusted Index thereafter; for international bonds, the Barclays Global Aggregate ex-USD Float Adjusted RIC Capped Index beginning June 3, 2013; and for U.S. stocks, the MSCI US Broad Market Index through June 2, 2013, and the CRSP US Total Market Index thereafter. International stock benchmark returns are adjusted for withholding taxes.</span></p>
                  <div class="disclaimers">
                    <div>
                      <p class="ng-scope">The performance data shown represent past performance, which is not a
                        guarantee of future results. Investment returns and principal value will
                        fluctuate, so that investors' shares, when sold, may be worth more or less
                        than their original cost. Current performance may be lower or higher than the
                        performance data cited. The performance of an index is
                        not an exact representation of any particular investment, as you cannot invest
                        directly in an index.
                      </p>
                    </div>
                  </div>
                  <div>
                    </a>
                  </div>
                </div>
              </div>
              <div>
                <div class="profilePageContainer">
                  <div class="fullBlock">
                    <p><a href="">«</span>&nbsp;Previous page</a></p>
                    <h2>Historical returns</h2>
                  </div>
                  <div class="fullBlock">
                    <h4><b>Cumulative total returns</b> as of 11/30/2015</h4>
                    <table class="summarytable">
                      <tbody>
                        <tr>
                          <th>&nbsp;</th>
                          <th>1 Year</th>
                          <th>3 Year</th>
                          <th>5 Year</th>
                          <th>10 Year</th>
                          <th>Since<br>Inception<br>06/30/2015</th>
                        </tr>
                        <tr>
                          <td>Target Ret 2050 Tr Sel   </td>
                          <td class="right">-</td>
                          <td class="right">-</td>
                          <td class="right">-</td>
                          <td class="right">-</td>
                          <td class="right">-2.14%</td>
                        </tr>
                        <tr>
                          <td>Target Retirement 2050 Composite Ix               *</td>
                          <td class="right">-0.42%</td>
                          <td class="right">37.18%</td>
                          <td class="right">62.08%</td>
                          <td class="right">-</td>
                          <td class="right">-</td>
                        </tr>
                      </tbody>
                    </table>
                  </div>
                  <div class="fullBlock">
                    <h4><b>Annual investment returns</b> as of </h4>
                    <table class="summarytable">
                      <tbody>
                        <tr>
                          <th>&nbsp;</th>
                          <th>Vanguard Target Retirement 2050 Trust Select</th>
                          <th>Target Retirement 2050 Composite Ix               *</th>
                        </tr>
                        <tr>
                          <th>Year Ended</th>
                          <th>Capital Return</th>
                          <th>Income Return***</th>
                          <th>Total Return</th>
                          <th>Total Return</th>
                        </tr>
                      </tbody>
                    </table>
                    <p class="footnote">The income return in the annual investment chart may vary significantly year-to-year for funds and ETFs that invest internationally in passive foreign investment companies (PFICs) due to the tax treatment of these holdings. Specifically, realized gains or losses and unrealized gains or losses for these holdings may increase or decrease the fund's income dividends paid to shareholders for the year, affecting the reported income return. Funds that invest internationally have the most potential exposure to PFICs. For more information on a fund's holdings and the impact of PFIC holdings on its taxable income and distributions to shareholders, refer to the fund's annual report.</p>
                  </div>
                  <div class="fullBlock">
                    <h4><b>Quarterly investment returns</b> as of 09/30/2015</h4>
                    <table class="summarytable">
                      <tbody>
                        <tr>
                          <th>&nbsp;</th>
                          <th>Vanguard Target Retirement 2050 Trust Select</th>
                          <th>Target Retirement 2050 Composite Ix               *</th>
                        </tr>
                        <tr>
                          <th>Year</th>
                          <th>First Quarter</th>
                          <th>Second Quarter</th>
                          <th>Third Quarter</th>
                          <th>Fourth Quarter</th>
                          <th>Year-End Return</th>
                          <th>Year-End Average</th>
                        </tr>
                        <tr>
                          <td class="center">
                            <div></div>
                            2015**
                          </td>
                          <td class="right">-</td>
                          <td class="right">-</td>
                          <td class="right">-7.94%</td>
                          <td class="right">-</td>
                          <td class="right">-</td>
                          <td class="right">-</td>
                        </tr>
                      </tbody>
                    </table>
                    <p class="footnote">Derived by applying the fund's target asset allocation to the results of the following benchmarks: for international stocks of developed markets, the MSCI EAFE Index through December 15, 2010, the MSCI ACWI ex USA IMI Index through June 2, 2013, and the FTSE Global All Cap ex US Index thereafter; for emerging-market stocks, the Select Emerging Markets Index through August 23, 2006, the MSCI Emerging Markets Index through December 15, 2010, the MSCI ACWI ex USA IMI Index through June 2, 2013, and the FTSE Global All Cap ex US Index thereafter; for U.S. bonds, the Barclays U.S. Aggregate Bond Index through December 31, 2009, and the Barclays U.S. Aggregate Float Adjusted Index thereafter; for international bonds, the Barclays Global Aggregate ex-USD Float Adjusted RIC Capped Index beginning June 3, 2013; and for U.S. stocks, the MSCI US Broad Market Index through June 2, 2013, and the CRSP US Total Market Index thereafter. International stock benchmark returns are adjusted for withholding taxes.</span></p>
                  </div>
                  <div class="fullBlock">
                    <p class="footnote">**Since inception on 06/30/2015</p>
                  </div>
                  <div class="fullBlock">
                    <div class="disclaimers">
                      <div>
                        <p class="ng-scope">The performance data shown represent past performance, which is not a
                          guarantee of future results. Investment returns and principal value will
                          fluctuate, so that investors' shares, when sold, may be worth more or less
                          than their original cost. Current performance may be lower or higher than the
                          performance data cited. The performance of an index is
                          not an exact representation of any particular investment, as you cannot invest
                          directly in an index.
                        </p>
                      </div>
                    </div>
                    <div>
                      </a>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="tab-pane fade" id="C">
            <div class="innerContentPanel900">
              <div>
                <div class="profilePageContainer">
                  <div>
                  </div>
                  <div class="blockContainer">
                    <h2>Portfolio</h2>
                    <div>
                      <div>
                        <p>
                        <p>Vanguard Target Retirement 2050 Trust Select seeks to provide capital appreciation and current income consistent with its current asset allocation.<br></p>
                      </div>
                    </div>
                    <div>
                      <div>
                        <div>
                          as of 10/31/2015</p>
                          <div class="pieChart" pie-chart="assetAllocationPie.data">
                            <canvas class="pieChartCanvas" width="100" height="100"></canvas>
                            <p>No data available</p>
                            <table class="pieChartKey">
                              <tbody>
                                <tr>
                                  <td></td>
                                  <td></td>
                                  <td class="percent">89.77%</td>
                                  <td class="assetType">Stocks</td>
                                </tr>
                                <tr>
                                  <td></td>
                                  <td></td>
                                  <td class="percent">10.05%</td>
                                  <td class="assetType">Bonds</td>
                                </tr>
                                <tr>
                                  <td></td>
                                  <td></td>
                                  <td class="percent">0.18%</td>
                                  <td class="assetType">Short-term reserves</td>
                                </tr>
                              </tbody>
                            </table>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div>
                      <div>
                        <div class="fullBlock">
                          <h4><b>Allocation to underlying funds</b> as of 11/30/2015</h4>
                          <table class="summarytable">
                            <tbody>
                              <tr>
                                <th class="middleWidth">Ranking by Percentage</th>
                                <th>Fund</th>
                                <th>Percentage</th>
                              </tr>
                              <tr>
                                <td class="label">1</td>
                                <td class="label">Vanguard Total Stock Market Index Fund            Institutional Plus Shares</td>
                                <td class="right">54.4%</td>
                              </tr>
                              <tr>
                                <td class="label">2</td>
                                <td class="label">Vanguard Total International Stock Index Fund Institutional Plus Shares</td>
                                <td class="right">35.6%</td>
                              </tr>
                              <tr>
                                <td class="label">3</td>
                                <td class="label">*</span></span></td>
                                <td class="right">7.0%</td>
                              </tr>
                              <tr>
                                <td class="label">4</td>
                                <td class="label">Vanguard Total International Bond Index Fund Institutional Shares</td>
                                <td class="right">3.0%</td>
                              </tr>
                              <tr>
                                <td class="subHead">Total</td>
                                <td>-</td>
                                <td class="total">100.0%</td>
                              </tr>
                            </tbody>
                          </table>
                        </div>
                      </div>
                    </div>
                    <div></div>
                    <div>
                      <div class="fullBlock">
                        <h4><b>Fund characteristics</b> as of 10/31/2015</h4>
                        <table class="summarytable">
                          <tbody>
                            <tr>
                              <th class="bigSmallSmallCol1">&nbsp;</th>
                              <th>Target Ret 2050 Tr Sel   </th>
                            </tr>
                            <tr>
                              <td>Fund total net assets as of 10/31/2015</td>
                              <td>$7.3 billion</td>
                            </tr>
                            <tr>
                              <td>Share class total net assets</td>
                              <td>$1.4 billion</td>
                            </tr>
                          </tbody>
                        </table>
                      </div>
                    </div>
                    <div>    </div>
                    <div></div>
                    <div></div>
                    <div>
                      <div>
                        <div class="halfBlock">
                          <div>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div></div>
                    <div>
                      <div class="fullBlock">
                        <h3>Plain talk about risk</h3>
                        <p class="plainTalkContent">&nbsp;The trust is subject to several stock and bond market risks, any of which could cause an investor to lose money. However, based on the trust's current allocation between stocks and the less volatile asset class of bonds, the trust's overall level of risk should be higher than those funds that invest mostly in bonds, but lower than those investing mostly in stocks. As the trust's allocation between underlying funds gradually changes, the trust's overall level of risk also will decline. In addition to the risks inherent in the asset classes of the underlying funds, the trust also is subject to asset allocation risk, which is the chance that the selection of underlying funds and the allocation of fund assets will cause the trust to underperform other funds with a similar investment objective. Investments in Target Retirement Trusts are subject to the risks of their underlying funds. The year in the trust name refers to the approximate year 2050 when an investor in the trust would retire and leave the work force. The trust will gradually shift its emphasis from more aggressive investments to more conservative ones based on its target date. An investment in the Target Retirement Trust is not guaranteed at any time, including on or after the target date.<br> 
                        <ul></ul>
                        </p>
                      </div>
                    </div>
                    <div></div>
                    <div>
                      <div>
                        <h2>Management</h2>
                        <span>
                          <p><strong>Vanguard Equity Investment Group</strong></p>
                          <p><strong><em>Firm Description</em></strong></p>
                          <p>Launched in 1975, The Vanguard Group, Malvern, Pennsylvania, is among the world's largest equity and fixed income managers. As chief investment officer and managing director, Mortimer J. Buckley oversees Vanguard's Equity Investment and Fixed Income Groups. Joseph Brennan, CFA, Principal of Vanguard and global head of Vanguard's Equity Index Group, has oversight responsibility for all equity index funds managed by the Equity Investment Group. John Ameriks, Ph.D., Principal of Vanguard and head of Vanguard's Quantitative Equity Group, has oversight responsibility for all active equity funds managed by the Equity Investment Group. The Equity Investment Group manages indexed and structured equity portfolios covering U.S. and international markets. It has developed sophisticated portfolio construction methodologies and efficient trading strategies that seek to deliver returns that are highly correlated with target portfolio benchmarks. The group has advised Vanguard Target Retirement 2050 Trust Select since 2015.</p>
                        </span>
                      </div>
                    </div>
                    <div>
                      <div class="fullBlock">
                        <p class="footnote">*</span>Information on this fund can be found on Vanguard's Institutional Investors site.</p>
                      </div>
                    </div>
                    <div></div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="tab-pane fade" id="D">
            <div class="innerContentPanel900">
              <div>
                <div class="profilePageContainer">
                  <div>
                  </div>
                  <div class="blockContainer">
                    <div>
                      <div>
                        <h2>Expenses</h2>
                        <table class="summarytable">
                          <tbody>
                            <tr>
                              <th>&nbsp;</th>
                              <th>Gross Expense Ratio</th>
                            </tr>
                            <tr>
                              <td>This Fund</td>
                              <td class="right"><?=$fees?>%</td>
                            </tr>
                            <tr>
                              <td>Average Fund*</td>
                              <td class="right">0.48%</td>
                            </tr>
                          </tbody>
                        </table>
                      </div>
                    </div>
                    <div class="halfBlock">
                      <h3>Fees on $10,000 invested over 10 years</h3>
                      
                      <table id="fees-label" class="table label-table">
                <colgroup>
                <col width="36%">
                <col width="20%">
                <col width="20%">
                <col width="20%">
                </colgroup><tbody><tr>

                  <th></th>
                  <td class="right"><i><span class="label-year1head">1</span> year</i></td>
                  <td class="right"><i><span class="label-year2head">5</span> year</i></td>
                  <td class="right bg-lightblue"><i><span class="label-year3head">20</span> year</i></td>
                </tr>
                <tr>
                  <td>
                    Fees over time<br>
                    <small>(<span id="expense-ratio">0.78</span> expense ratio)</small>
                  </td>
                  <td class="right">-<span id="label-fee1">$87</span></td>
                  <td class="right">-<span id="label-fee2">$506</span></td>
                  <td class="right bg-lightblue">-<span id="label-fee3">$4,986</span></td>
                </tr>
                <tr>
                  <td nowrap="">
                    Benchmark comparison<br>
                    <small>(0.8% expense ratio for S&amp;P 500 index funds)</small>
                  </td>
                  <td class="right">-<span id="label-lbench1">$91</span></td>
                  <td class="right">-<span id="label-lbench2">$493</span></td>
                  <td class="right bg-lightblue">-<span id="label-lbench3">$6,078</span></td>
                </tr>
              </tbody></table>

                      <div>
                        <p>See how costs can impact a hypothetical $10,000&nbsp;investment with an annual rate of return of&nbsp;6.00% over a period of 10 years, assuming no additional investments in the fund. This illustration does not represent the return on any particular investment.</p>
                      </div>
                    </div>
                    <div class="fullBlock">
                      <h2>Fees</h2>
                      <table class="summarytable">
                        <tbody>
                          <tr>
                            <td class="feeRowHead">Purchase fee</td>
                            <td class="feeRowData">None</span></td>
                          </tr>
                          <tr>
                            <td class="feeRowHead">Redemption fee</td>
                            <td class="feeRowData">None</td>
                          </tr>
                          <tr>
                            <td class="feeRowHead">
                              12b-1 fee
                            </td>
                            <td class="feeRowData">None</td>
                          </tr>
                          <tr>
                          </tr>
                          <tr>
                          </tr>
                          <tr>
                          </tr>
                          <tr>
                          </tr>
                          <tr>
                          </tr>
                          <tr>
                          </tr>
                          <tr>
                          </tr>
                          <tr>
                          </tr>
                        </tbody>
                      </table>
                    </div>
                    <div>
                    </div>
                    <div class="fullBlock">
                      <p class="footnote">* Most recent data available. (c) 2014 Morningstar, Inc. All rights reserved. The information contained herein: (1) is proprietary to Morningstar and/or its content providers; (2) may not be copied or distributed; (3) does not constitute investment advice offered by Morningstar; and (4) is not warranted to be accurate, complete, or timely. Neither Morningstar nor its content providers are responsible for any damages or losses arising from any use of this information. Past performance is no guarantee of future results.</p>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="tab-pane fade" id="E">
            <div>
              <div class="profilePageContainer">
                <div class="blockContainer">
                  <div class="fullBlock">
                    <p>There are no distributions to date for this fund.  Dividends and Capital Gains remain in the fund are reflected in the NAV rather than being distributed and reinvested in additional shares of the fund.</p>
                  </div>
                  <div></div>
                  <div class="fullBlock">
                  </div>
                  <div class="fullBlock">
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="tab-pane fade" id="F">
            <div>
              <div class="profilePageContainer">
                <div>
                </div>
                <div class="vanguardNewsReviews" fund-news-reviews="">
                  <div class="newsReviews">
                    <div class="newsSection">
                      <h2>News</h2>
                      <div class="vanguardFundNews">
                        <table>
                          <tbody>
                            <tr colspan="3">
                              <td>
                                <p>There are no recent news stories associated with this fund.</p>
                              </td>
                            </tr>
                            <tr>
                              <td>
                                <p>&nbsp;</p>
                              </td>
                              <td>
                                <p>&nbsp;</p>
                              </td>
                              <td>
                                <p>&nbsp;</p>
                              </td>
                            </tr>
                          </tbody>
                        </table>
                      </div>
                    </div>
                    <div class="reviewsSection">
                      <h2>Reviews</h2>
                      <div>
                        <p>There are no review articles available at this time.</p>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <script type="text/javascript" src="bower_components/jquery/dist/jquery.min.js"></script>
          <script type="text/javascript" src="bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
        </div>
      </div>
    </div>
  </body>
</html>