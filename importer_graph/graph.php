<?php
$conn = mysqli_connect("", "", "", "");
$query = "SELECT country_by_ip,count(*) FROM user_data GROUP BY country_by_ip";
$result = mysqli_query($conn, $query);
$result = mysqli_fetch_all($result);
?>
<h2>Map chart</h2>
 <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
      google.charts.load('current', {
        'packages':['geochart'],
        'mapsApiKey': 'AIzaSyD-9tSrke72PouQMnMX-a7eZSW0jkFMBWY'
      });
      google.charts.setOnLoadCallback(drawRegionsMap);

      function drawRegionsMap() {
        var data = google.visualization.arrayToDataTable([
          ['Country', 'Popularity'],
          <?php foreach ($result as $item): ?>
            ['<?php echo $item[0] ?>', <?php echo $item[1] ?>],
          <?php endforeach;?>
        ]);

        var options = {};

        var chart = new google.visualization.GeoChart(document.getElementById('regions_div'));

        chart.draw(data, options);
      }
    </script>
    <div id="regions_div" style="width: 900px; height: 500px;"></div>
