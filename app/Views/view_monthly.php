<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
  <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.5.0/Chart.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.min.js" integrity="sha384-cuYeSxntonz0PPNlHhBs68uyIAVpIIOZZ5JqeqvYYIcEL727kskC66kF92t6Xl2V" crossorigin="anonymous"></script>
  <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.21/css/jquery.dataTables.min.css" />
  <script type="text/javascript">
    google.charts.load('visualization', "1", {
      packages: ['corechart']
    });
  </script>
  <title>Document</title>
</head>

<body >

  <?php
  $monthly = null;
  $network = null;
  $year = null;
  if (isset($_GET["monthly"])) {
    $monthly = $_GET["monthly"];
  }
  if (isset($_GET["network"])) {
    $network = $_GET["network"];
  }
  if (isset($_GET["year"])) {
    $year = $_GET["year"];
  }
  ?>

  <html>

  <body>
    <ul class="nav nav-tabs" >
      <li class="nav-item">
        <a class="nav-link" href="overall">overall</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="weekly">weekly</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="monthly_table">monthly</a>
      </li>

    </ul>

    <h2 align='center'><?php echo $network ?> monthly</h2><br>

    <form method="get" action="monthly_table" align='center' >
      <div class="heard">
        <div class="dropdown-itim">

          select year&nbsp;
          <select type="text" name="year" class="btn btn-light dropdown-toggle btn-lg">
            <option value="<?php echo @$year ?>"><?php echo @$year ?></option>
            <option value=""></option>
            <option value="2022">2022</option>
            <option value="2023">2023</option>
          </select>&nbsp;&nbsp;
          select month&nbsp;
          <select type="text" name="monthly" class="btn btn-light dropdown-toggle btn-lg">
            <option value="<?php echo @$monthly ?>"><?php echo @$monthly ?></option>
            <option value=""></option>
            <option value="1">January</option>
            <option value="2">February</option>
            <option value="3">March</option>
            <option value="4">April</option>
            <option value="5">May</option>
            <option value="6">June</option>
            <option value="7">July</option>
            <option value="8">August</option>
            <option value="9">September</option>
            <option value="10">October</option>
            <option value="11">November</option>
            <option value="12">December</option>
          </select>&nbsp;&nbsp;
          <button class="btn btn-info btn-lg" type="submit" name="network" value="">report</button>&nbsp;
          </br>
          </p>
        </div>
      </div>
    </form><br>
    
    <div >
      <table class="table table-bordered table-hover " id ="tablereport">
        <thead class="bg-primary p-2 text-light bg-opacity-25 " align='center'>
          <th>month</th>
          <th>year</th>
          <th>network</th>
          <th>account influencer</th>
          <th>follower</th>
          <th>total post</th>
          <th>unique post</th>
          <th>duplicate (%)</th>
        </thead>
        <?php foreach ($totalmonthly['monthly'] as $key => $value) { ?>
          <tr align='center'>
            <td><?php echo @$value['month'] ?> </td>
            <td><?php echo @$value['year'] ?> </td>
            <td><?php echo @$value['network'] ?> </td>
            <td><?php echo number_format(@$value['account']) ?> </td>
            <td><?php echo number_format(@$value['follower']) ?> </td>
            <td><?php echo number_format(@$value['total_post']) ?> </td>
            <td><?php echo number_format(@$value['unique_post']) ?> </td>
            <td><?php echo number_format(@$value['duplicate'],2) ?> </td>
          </tr>
        <?php } ?>
      </table>

      #Datatable
      <script>
        $(document).ready( function () {
        $('#tablereport').DataTable();
        } );
      </script>
    </div>

      <div id="chart_div" style="width: 90%; height: 500px;"></div>
      <script>
        google.charts.load('current', {
          'packages': ['corechart', 'bar']
        });
        google.charts.setOnLoadCallback(drawBasic);

        function drawBasic() {
          var data = google.visualization.arrayToDataTable([
            ['network', 'total post','unique post'],
            <?php
            foreach ($total as $row) {
              echo "['" .$row['month']." ". $row['network'] . "'," . $row['total_post'] ."," . @$row['unique_post'] . "],";
            } ?>
          ]);
          var options = {
            title: 'monthly',
          };
          var chart = new google.visualization.ColumnChart(
            document.getElementById('chart_div'));
          chart.draw(data, options);
        }
      </script>
  </body>

  </html>