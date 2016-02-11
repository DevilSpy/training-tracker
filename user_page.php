<?php
    $title = "User page " ;
    include_once("head.php");
        
?>
</head>

<body>

<?php 
    require_once("dbinit.php"); 
    include_once("functions.php");
    include_once("navbar.php");

    $id = $_GET['id'];

    $user = getUserInfo($db, $id);

    $hours = getUserHours($db, $id);
?>

<div class="content">
        <h2><?php echo $user->name; ?></h2>
        <div class="row">
        <div class="col-lg-12">
            <h4><?php echo "<a href='user_edit.php?id=" . $id . "'>View/Edit info</a>" ?></h4>
            <p>Total training hours: <?php echo $hours; ?></p>
            
            <div id="loadingIcon"></div>

            <div id="chart"></div>
            <script>
                function reqListener() {
                    console.log(this.responseText);
                }
                var id = <?php echo $id; ?>;
                var year2014 = "2014";
                var year2015 = "2015";
                var year2016 = "2016";
                var name = <?php echo "'" . $user->name . "'"; ?>;
                var request2014 = new XMLHttpRequest();
                var request2015 = new XMLHttpRequest();
                var request2016 = new XMLHttpRequest();
                var data2014;
                var data2015;
                var data2016;
                
                request2014.onload = function() {
                    data2014 = jQuery.parseJSON(this.responseText);
                };
                request2014.open("get", "getData.php?id=" + id + "&year=" + year2014, true);
                request2014.send();
                
                request2015.onload = function() {
                    data2015 = jQuery.parseJSON(this.responseText);
                };
                request2015.open("get", "getData.php?id=" + id + "&year=" + year2015, true);
                request2015.send();

                request2016.onload = function() {
                    data2016 = jQuery.parseJSON(this.responseText);
                }
                request2016.open("get", "getData.php?id=" + id + "&year=" + year2016, true);
                request2016.send();

                setTimeout(function() { 

                    $("#loadingIcon").hide();
                    
                    $(function () {
                        $('#chart').highcharts({
                            chart: {
                                type: 'column'
                            },
                            title: {
                                text: 'Monthly exercise hours'
                            },
                            subtitle: {
                                text: ''
                            },
                            xAxis: {
                                categories: [
                                    'Jan',
                                    'Feb',
                                    'Mar',
                                    'Apr',
                                    'May',
                                    'Jun',
                                    'Jul',
                                    'Aug',
                                    'Sep',
                                    'Oct',
                                    'Nov',
                                    'Dec'
                                ]
                            },
                            yAxis: {
                                min: 0,
                                title: {
                                    text: 'Hours'
                                }
                            },
                            tooltip: {
                                headerFormat: '<span style="font-size:10px">{point.key}</span><table>',
                                pointFormat: '<tr><td style="color:{series.color};padding:0">{series.name}: </td>' +
                                    '<td style="padding:0"><b>{point.y:.1f} h</b></td></tr>',
                                footerFormat: '</table>',
                                shared: true,
                                useHTML: true
                            },
                            plotOptions: {
                                column: {
                                    pointPadding: 0.2,
                                    borderWidth: 0
                                }
                            },
                            series: [{
                                name: "2014",
                                data:  data2014
                            },
                            {
                                name: "2015",
                                data: data2015
                            },
                            {
                                name: "2016",
                                data: data2016
                            }]
                        });
                    });
                }, 1000);
                
           
            </script>
            
        </div>
        </div>
    </div>


<?php include_once("footer.php"); ?>

</body>
</html>
