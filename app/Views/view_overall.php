<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
  <link rel="stylesheet" href="http://cdn.datatables.net/1.13.2/js/jquery.dataTables.min.js">
  <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.5.0/Chart.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous"></script>
  <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
  <title>Document</title>
</head>

<body >
  <ul class="nav nav-tabs">
    <li class="nav-item"  >
      <a class="nav-link" href="overall">overall</a>
    </li>
    <li class="nav-item">
      <a class="nav-link" href="weekly">weekly</a>
    </li>
    <li class="nav-item">
      <a class="nav-link" href="monthly_table">monthly</a>
    </li>

  </ul>

  <h2 align='center'>OverAll</h2><br>


  <table  class="table table-bordered table-hover " id ="tablereport">
    <thead class="bg-primary p-2 text-light bg-opacity-25 " align='center' >
      <th>network</th>
      <th>account influencer</th>
      <th>follower</th>
      <th>total post</th>
      <th>unique post </th>
      <th>duplicate (%)</th>
    </thead>
    <tbody>
    <?php foreach ($totaloverall['overall'] as $key => $value) { ?>
      <tr align='center'>
        <td><?php echo @$value['network'] ?> </td>
        <td><?php echo number_format(@$value['account']) ?> </td>
        <td><?php echo number_format(@$value['follower']) ?> </td>
        <td><?php echo number_format(@$value['total_post']) ?> </td>
        <td><?php echo number_format(@$value['unique_post']) ?> </td>
        <td><?php echo number_format(@$value['duplicate'],2) ?> </td>
      </tr>
    <?php } ?>
  </table>
  <div id="chart_div" style="width: 90%; height: 500px;">
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
            echo "['" . @$row['network'] . "'," . @$row['total_post'] .  "," . @$row['unique_post'] ."],";
          } ?>
        ]);
        var options = {
          title: 'Over All',
        }; 
        var chart = new google.visualization.ColumnChart(
          document.getElementById('chart_div'));
        chart.draw(data, options);
      }
    </script>
  </div>

  <script src="https://code.jquery.com/jquery-3.6.3.min.js"></script>
  <script src="http://cdn.datatables.net/1.13.2/js/jquery.dataTables.min.js"></script>
  <script>
    $(document).ready( function () {
        $('#tablereport').DataTable();
    } );
  </script>
</body>

</html>