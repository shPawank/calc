<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link href="css/bootstrap.css" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="bootstrip.css">
    <link href="style.css" rel="stylesheet" type="text/css">
    <link href="css/hhi-style.css" rel="stylesheet" type="text/css">
</head>

<body>


    <?php include('header.php'); ?>



    <div class="innerheadingsbg">
        <div class="container">
            <h1>HHI Calculator (Herfindahl-Hirschman Index Calculator)</h1>
            <ul>
                <li><a href="index.php">Home</a></li>
                <li><a href="circ_hhi.php">Herfindahl-Hirschman Index Calculator (Beta Version)</a></li>
            </ul>
        </div>
    </div>



    <div class="hhi-bg">
        <div class="container">
            <div class="row">

                <div class="col-lg-8 col-md-7">

                    <div class="table-responsive" style="border-radius: 10px;">

                        <div class="scheduletable">
                            <form id="hhi-form">
                                <table id="calculator" class="tableizer-table" style="background-color: #e8e8e8; ">
                                    <thead>
                                        <tr>
                                            <th style="background-color: #98c1d9; color: #081466;">Serial No.</th>
                                            <th style="background-color: #98c1d9; color: #081466;">Company Name</th>
                                            <th style="background-color: #98c1d9; color: #081466;">Market Share (%) / Sales Percentage</th>
                                            <th style="background-color: #98c1d9; color: #081466;">Square of Value</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <!-- Rows will be dynamically added here -->
                                    </tbody>
                                </table>

                                 <div id="result"></div>

                                <div class="user-info" id="user-info" style="display:none;">
                                    <label for="user-name">Name:</label>
                                    <input type="text" id="user-name" name="user_name">
                                    <label for="user-email">Email:</label>
                                    <input type="email" id="user-email" name="user_email" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,4}$" required/>
                                </div>
                                <div class="buttons float-right">
                                    <button type="button" id="add-row" style="background: #3CB371; border-radius: 5px;" class="mr-3">Add Row</button>
                                    <button type="button" id="reduce-row" style="background: #e5001d; border-radius: 5px;" class="mr-3">Delete Row</button>
                                    <!--<button type="button" id="show-result" style="background: #008CBA;">Calculate HHI</button>-->
                                    <button type="button" id="download-data" style="background: #4682B4; border-radius: 5px;" >Download Result</button>
                                </div> 

                            </form>
                        </div>
                    </div>
                </div>





                <!--<div class="col-lg-4 col-md-5">-->
                <!--    <div class="recentposts">-->
                <!--        <div class="col">-->

                <!--            <p>The Herfindahl-Hirschman Index (HHI) is a common measure of market concentration and is used to determine market competitiveness, often pre- and post-merger and acquisition (M&A) transactions</p>-->
                <!--        </div>-->
                <!--    </div>-->
                <!--</div>-->
            </div>




            <div class="row">

                <!--<div class="col-lg-8 col-md-7">-->
                    <!-- <div id="result" class="result-hhi"></div> -->
                <!--    <div id="result"></div>-->
                <!--</div>-->

                <!--<div class="col-lg-8 col-md-7">-->

                <!--    <button type="button" id="download-data" style="background: #4682B4; border-radius: 5px;" class="float-right ">Download Result</button>-->
                <!--    <button type="button" id="reduce-row" style="background: #e5001d; border-radius: 5px;" class="float-right mr-3">Delete Row</button>-->
                <!--    <button type="button" id="add-row" style="background: #3CB371; border-radius: 5px;" class="float-right mr-3">Add Row</button>-->




                <!--</div>-->

                <div class="col-lg-8 col-md-7" style="border-bottom: solid 1px #ccc;">
                    <button type="button" id="show-result" style="background: #006400;" class="readmore float-right ">Calculate HHI</button>
                </div>

                <div class="col-lg-8 col-md-7">
                    
                    <p><b><i>What is the HHI Index?</i></b> <br>
The Herfindahl index (also known as Herfindahl–Hirschman Index, HHI, or sometimes HHI-score) measures the size of firms in relation to an industry. Economists Orris C. Herfindahl and Albert O. Hirschman developed this tool. 

It is an economic concept widely applied in competition law, antitrust regulation and technology management to evaluate and understand the extent of market concentration. <br><br>

<b><i>How is it calculated?</i></b><br>
HHI is calculated by squaring the market share of each competing firm in the industry and then summing the resulting numbers. The result is proportional to the average market share, weighted by market share. <br><br>

<b><i>How to interpret the results?</i></b><br>
As such, it can range from 0 to 1.0, moving from a huge number of very small firms to a single monopolistic producer. Alternatively, the index can be expressed per 10,000 "points". For example, an index of .25 is the same as 2,500 points. 

Increases in the HHI generally indicate a decrease in competition and an increase of market power, whereas decreases indicate the opposite. </p>
                    
                    <p><b>Credit:</b> <br><br>
                    
                    <i>Syed Abid and Syed Rubiya contributed to the conceptual framework. Tauheed Akhtar developed the code. Navneet Sharma conceptualized and led the development of the HHI Calculator. Feedback and suggestions are welcome at: nas@circ.in </i>
                    
                    </p>
                </div>




            </div>



            <!-- <div class="row">

                <div class="col-lg-8 col-md-7">
                    <div id="result" class="result-hhi"></div>
                </div>

                <div class="col-lg-8 col-md-7">

                    <button id="download-btn" style="background: #4682B4;" class="readmore float-right">Download Result</button>
                    <button id="remove-row-btn" style="background: #e5001d;" class="readmore mr-3 float-right">Delete Row</button>
                    <button id="add-row-btn" style="background: #3CB371;" class="readmore mr-3 float-right">Add Row </button>


                </div>

                <div class="col-lg-8 col-md-7">
                    <button id="calculate-btn" style="background: #008CBA;" class="readmore float-right ">Calculate HHI</button>
                </div>




            </div> -->




        </div>
    </div>


    <!-- <div class="hhi-bg">
        <div class="container">
            <div class="row">

                <div class="col-lg-8 col-md-7">
                    <div id="result" class="result-hhi"></div>
                </div>
            </div>
        </div>
    </div>



    <div class="hhi-bg">
        <div class="container">
            <div class="row">

                <div class="col-lg-8 col-md-7">
                    <button id="calculate-btn" style="background: #008CBA;" class="readmore">Calculate HHI</button>
                </div>
            </div>
        </div>
    </div> -->










    <script src="hhi.js"></script>





    <?php include('footer.php') ?>

</body>

</html>