<div id="googleDataChart" class="google-data-chart"></div>

<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
<script type="text/javascript">
    var getCurrentEquipmentId = <?php echo $getCurrentEquipmentId; ?>;
    if (getCurrentEquipmentId == "1" || getCurrentEquipmentId == "2") {
        var googleDataChart = <?php echo $googleDataChart; ?>;
        var googleChartTitle = <?php echo $googleChartTitle; ?>;
        var googleChartHorizontalAxisTitle = <?php echo $googleChartHorizontalAxisTitle; ?>;
        var googleChartVerticalAxisTitle = <?php echo $googleChartVerticalAxisTitle; ?>;
        console.log(googleDataChart);
        google.charts.load('current', {
            'packages': ['corechart']
        });
        google.charts.setOnLoadCallback(lineChart);

        function lineChart() {
            var data = google.visualization.arrayToDataTable(googleDataChart);
            var options = {
                aggregationTarget: 'category',
                animation: { 
                    duration: 800,
                    startup: true,
                    easing: 'linear',
                },
                colors: [ '#FF6361' ],
                hAxis: { 
                    title: googleChartHorizontalAxisTitle,
                    titleTextStyle: '#000000',
                    direction: 1,
                    textStyle: { 
                        fontSize: 14,
                        fontName: 'Times New Roman',
                    },
                    slantedText: true,
                    slantedTextAngle: 50,
                },
                height: 800,
                legend: {
                    alignment: 'left',
                    position: 'top', 
                    textStyle: { 
                        fontSize: 14,
                        fontName: 'Times New Roman',
                        bold: true,
                        color: '#000000',
                    } 
                },
                lineWidth: 4,
                selectionMode: 'multiple',
                title: googleChartTitle,
                titlePosition: 'out',
                titleTextStyle: { 
                    fontSize: 20,
                    fontName: 'Times New Roman',
                },
                tooltip: {
                    isHTML: false,
                    textStyle: { 
                        fontSize: 12,
                        fontName: 'Times New Roman',
                        bold: true,
                        color: '#000000',
                    },
                    trigger: 'focus',
                },
                vAxis: {
                    title: googleChartVerticalAxisTitle,
                    titleTextStyle: '#000000',
                    direction: 1,
                    textStyle: { 
                        fontSize: 14,
                        fontName: 'Times New Roman',
                    },
                },
                width: 'auto',
            };
            var chart = new google.visualization.LineChart(document.getElementById('googleDataChart'));
            chart.draw(data, options);
        }    
    }
    if (getCurrentEquipmentId == "3") {
        var googleDataChart = <?php echo $googleDataChart; ?>;
        var googleChartTitle = <?php echo $googleChartTitle; ?>;
        console.log(googleDataChart);
        google.charts.load('current', {
            'packages': ['corechart']
        });
        google.charts.setOnLoadCallback(drawChart);

        function drawChart() {
            var data = google.visualization.arrayToDataTable(googleDataChart);
            var options = {
                backgroundColor: '#FFFFFF',
                colors: [ '#FF9900', '#198754', '#DC3545' ],
                height: 800,
                legend: { 
                    alignment: 'start',
                    position: 'top',
                    textStyle: {
                        fontSize: 14,
                        fontName: 'Times New Roman',
                    },
                },
                pieHole: 0.3,
                pieSliceTextStyle: {
                    fontSize: 14,
                    fontName: 'Times New Roman',
                },
                pieStartAngle: 0,
                title: googleChartTitle,
                titleTextStyle: {
                    fontSize: 20,
                    fontName: 'Times New Roman',
                },
                tooltip: {
                    textStyle: {
                        fontSize: 12,
                        fontName: 'Times New Roman',
                        bold: true,
                        color: '#000000',
                    },
                    trigger: 'focus',
                },
                sliceVisibilityThreshold: 0.01,
                width: 900,
            };
            var chart = new google.visualization.PieChart(document.getElementById('googleDataChart'));
            chart.draw(data, options);
        }
    }
    if (getCurrentEquipmentId == "4" || getCurrentEquipmentId == "5" || getCurrentEquipmentId == "6") {
        var googleDataChart = <?php echo $googleDataChart; ?>;
        var googleChartTitle = <?php echo $googleChartTitle; ?>;
        console.log(googleDataChart);
        google.charts.load('current', {
            'packages': ['corechart']
        });
        google.charts.setOnLoadCallback(drawChart);

        function drawChart() {
            var data = google.visualization.arrayToDataTable(googleDataChart);
            var options = {
                backgroundColor: '#FFFFFF',
                colors: [ '#DC3545', '#198754' ],
                height: 800,
                legend: { 
                    alignment: 'start',
                    position: 'top',
                    textStyle: {
                        fontSize: 14,
                        fontName: 'Times New Roman',
                    },
                },
                pieHole: 0.3,
                pieSliceTextStyle: {
                    fontSize: 14,
                    fontName: 'Times New Roman',
                },
                pieStartAngle: 0,
                title: googleChartTitle,
                titleTextStyle: {
                    fontSize: 20,
                    fontName: 'Times New Roman',
                },
                tooltip: {
                    textStyle: {
                        fontSize: 12,
                        fontName: 'Times New Roman',
                        bold: true,
                        color: '#000000',
                    },
                    trigger: 'focus',
                },
                sliceVisibilityThreshold: 0.01,
                width: 900,
            };
            var chart = new google.visualization.PieChart(document.getElementById('googleDataChart'));
            chart.draw(data, options);
        }
    }
</script>