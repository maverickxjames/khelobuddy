<?php
// Fetch data from the database for the current month
$first_day_this_month = date('01 M Y').", 12:00 AM";
$last_day_this_month = date('t M Y').", 11:59 PM";
$transections = $this->db->select('amount, created_at')->where('ctg', 'CMS')->where('created_at >=',strtotime($first_day_this_month))->where('created_at <=',strtotime($last_day_this_month))->get('transections')->result();

// Initialize an array to hold the data for the chart
$chartData1 = array();

// Loop through the transections and group the data by day
foreach($transections as $transection) {
    $day = date('d', $transection->created_at);
    if(!isset($chartData1[$day])) {
        $chartData1[$day] = 0;
    }
    $chartData1[$day] += $transection->amount;
}

// Sort the data by day
ksort($chartData1);

// Prepare the data for the chart
$chartLabels1 = array_keys($chartData1);
$chartValues1 = array_values($chartData1);

// Fetch data from the database for today
$first_day_this_today = date('d M Y').", 12:00 AM";
$transections_today = $this->db->select('amount, created_at')->where('ctg', 'CMS')->where('created_at >=',strtotime($first_day_this_today))->get('transections')->result();

// Fetch data from the database for the previous day
$first_day_previous_day = date('d M Y', strtotime('-1 day')).", 12:00 AM";
$transections_previous_day = $this->db->select('amount, created_at')->where('ctg', 'CMS')->where('created_at >=',strtotime($first_day_previous_day))->where('created_at <',strtotime($first_day_this_today))->get('transections')->result();

// Fetch data from the database for the day before the previous day
$first_day_day_before = date('d M Y', strtotime('-2 days')).", 12:00 AM";
$transections_day_before = $this->db->select('amount, created_at')->where('ctg', 'CMS')->where('created_at >=',strtotime($first_day_day_before))->where('created_at <',strtotime($first_day_previous_day))->get('transections')->result();

// Initialize arrays to hold the data for the chart
$chartDataToday = array();
$chartDataPreviousDay = array();
$chartDataDayBefore = array();

// Initialize arrays to hold cumulative data for the chart
$cumulativeDataToday = array();
$cumulativeDataPreviousDay = array();
$cumulativeDataDayBefore = array();

// Loop through the transections and group the data by hour for today
foreach($transections_today as $transection) {
    $hour = date('H', $transection->created_at);
    if(!isset($chartDataToday[$hour])) {
        $chartDataToday[$hour] = 0;
    }
    $chartDataToday[$hour] += $transection->amount;
    $cumulativeDataToday[$hour] = array_sum($chartDataToday);
}

// Loop through the transections and group the data by hour for the previous day
foreach($transections_previous_day as $transection) {
    $hour = date('H', $transection->created_at);
    if(!isset($chartDataPreviousDay[$hour])) {
        $chartDataPreviousDay[$hour] = 0;
    }
    $chartDataPreviousDay[$hour] += $transection->amount;
    $cumulativeDataPreviousDay[$hour] = array_sum($chartDataPreviousDay);
}

// Loop through the transections and group the data by hour for the day before the previous day
foreach($transections_day_before as $transection) {
    $hour = date('H', $transection->created_at);
    if(!isset($chartDataDayBefore[$hour])) {
        $chartDataDayBefore[$hour] = 0;
    }
    $chartDataDayBefore[$hour] += $transection->amount;
    $cumulativeDataDayBefore[$hour] = array_sum($chartDataDayBefore);
}

// Sort the data by hour
ksort($chartDataToday);
ksort($chartDataPreviousDay);
ksort($chartDataDayBefore);

// Sort the cumulative data by hour
ksort($cumulativeDataToday);
ksort($cumulativeDataPreviousDay);
ksort($cumulativeDataDayBefore);

// Prepare the data for the chart
$chartLabels2 = array_keys($chartDataToday);
$chartValues2Today = array_values($chartDataToday);
$chartValues2PreviousDay = array_values($chartDataPreviousDay);
$chartValues2DayBefore = array_values($chartDataDayBefore);

$chartCumulativeValuesToday = array_values($cumulativeDataToday);
$chartCumulativeValuesPreviousDay = array_values($cumulativeDataPreviousDay);
$chartCumulativeValuesDayBefore = array_values($cumulativeDataDayBefore);
?>

<!-- Include the Chart.js library -->
<script src="https://cdn.jsdelivr.net/npm/chart.js@2.9.3/dist/Chart.min.js"></script>

<!-- Create a canvas element for the chart -->
<div>
<div class="bg-white shadow-md rounded my-6">
  <canvas id="myChart1" class="bordered"></canvas>
</div>

<div class="bg-white shadow-md rounded my-6">
  <canvas id="myChart2" class="bordered"></canvas>
</div>

<div class="bg-white shadow-md rounded my-6">
  <canvas id="myChart3" class="bordered"></canvas>
</div>
</div>

<script>
// Get the canvas element
var ctx = document.getElementById('myChart1').getContext('2d');

// Create the chart
var myChart = new Chart(ctx, {
    type: 'line',
    data: {
        labels: <?=json_encode($chartLabels1)?>,
        datasets: [{
            label: 'Transaction Amount',
            data: <?=json_encode($chartValues1)?>,
            backgroundColor: 'rgba(54, 162, 235, 0.2)',
            borderColor: 'rgba(54, 162, 235, 1)',
            borderWidth: 1
        }]
    },
    options: {
        scales: {
            yAxes: [{
                ticks: {
                    beginAtZero: true
                }
            }]
        }
    }
});

// Get the canvas element
var ctxx = document.getElementById('myChart2').getContext('2d');

// Create the chart
var myChart = new Chart(ctxx, {
    type: 'line',
    data: {
        labels: <?=json_encode($chartLabels2)?>,
        datasets: [
            {
                label: 'Transaction Amount Today',
                data: <?=json_encode($chartValues2Today)?>,
                backgroundColor: 'rgba(54, 162, 235, 0.2)',
                borderColor: 'rgba(54, 162, 235, 1)',
                borderWidth: 1
            },
            {
                label: 'Transaction Amount Previous Day',
                data: <?=json_encode($chartValues2PreviousDay)?>,
                backgroundColor: 'rgba(255, 99, 132, 0.2)',
                borderColor: 'rgba(255, 99, 132, 1)',
                borderWidth: 1
            },
            {
                label: 'Transaction Amount Day Before',
                data: <?=json_encode($chartValues2DayBefore)?>,
                backgroundColor: 'rgba(75, 192, 192, 0.2)',
                borderColor: 'rgba(75, 192, 192, 1)',
                borderWidth: 1
            }
        ]
    },
    options: {
        scales: {
            yAxes: [{
                ticks: {
                    beginAtZero: true
                }
            }]
        }
    }
});

// Get the canvas element for the cumulative chart
var ctxy = document.getElementById('myChart3').getContext('2d');

// Create the cumulative chart
var myChart = new Chart(ctxy, {
    type: 'line',
    data: {
        labels: <?=json_encode($chartLabels2)?>,
        datasets: [
            {
                data: <?=json_encode($chartCumulativeValuesToday)?>,
                backgroundColor: 'rgba(54, 162, 235, 0.2)',
                borderColor: 'rgba(54, 162, 235, 1)',
                borderWidth: 1
            },
            {
                data: <?=json_encode($chartCumulativeValuesPreviousDay)?>,
                backgroundColor: 'rgba(255, 99, 132, 0.2)',
                borderColor: 'rgba(255, 99, 132, 1)',
                borderWidth: 1
            },
            {
                data: <?=json_encode($chartCumulativeValuesDayBefore)?>,
                backgroundColor: 'rgba(75, 192, 192, 0.2)',
                borderColor: 'rgba(75, 192, 192, 1)',
                borderWidth: 1
            }
        ]
    },
    options: {
        scales: {
            yAxes: [{
                ticks: {
                    beginAtZero: true
                }
            }]
        }
    }
});

</script>
<?php
echo end($chartCumulativeValuesToday);
?>
