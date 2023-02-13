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
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.min.js" integrity="sha384-cuYeSxntonz0PPNlHhBs68uyIAVpIIOZZ5JqeqvYYIcEL727kskC66kF92t6Xl2V" crossorigin="anonymous"></script>
  <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
  <script type="text/javascript">
    google.charts.load('visualization', "1", {
      packages: ['corechart']
    });
  </script>
  <title>Document</title>
</head>

<body >
  <?php
  $weekly = null;
  $year = null;
  $network = null;

  if (isset($_GET["weekly"])) {
    $weekly = $_GET["weekly"];
  }
  if (isset($_GET["year"])) {
    $year = $_GET["year"];
  }
  if (isset($_GET["network"])) {
    $network = $_GET["network"];
  }
  ?>
  <html>

  <body>

    <ul class="nav nav-tabs">
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




    <h2 align='center'><?php echo $network ?> Weekly</h2><br>

    <form method="get" action="weekly" align='center'>
      <div class="heard">
        <div class="dropdown-itim">

          select year&nbsp;
          <select type="text" name="year" class="btn btn-light dropdown-toggle btn-lg">
            <option value="<?php echo @$year ?>"><?php echo @$year ?></option>
            <option value=""></option>
            <option value="2022">2022</option>
            <option value="2023">2023</option>
            <option value="2024">2024</option>
          </select>&nbsp;&nbsp;
          select week&nbsp;
          <select type="text" name="weekly" class="btn btn-light dropdown-toggle btn-lg">
            <option value="<?php echo @$weekly ?>"><?php echo @$weekly ?></option>
            <option value=""></option>
            <option value="1">1</option>
            <option value="2">2</option>
            <option value="3">3</option>
            <option value="4">4</option>
            <option value="5">5</option>
            <option value="6">6</option>
            <option value="7">7</option>
            <option value="8">8</option>
            <option value="9">9</option>
            <option value="10">10</option>
            <option value="11">11</option>
            <option value="12">12</option>
            <option value="13">13</option>
            <option value="14">14</option>
            <option value="15">15</option>
            <option value="16">16</option>
            <option value="17">17</option>
            <option value="18">18</option>
            <option value="19">19</option>
            <option value="20">20</option>
            <option value="21">21</option>
            <option value="22">22</option>
            <option value="23">23</option>
            <option value="24">24</option>
            <option value="25">25</option>
            <option value="26">26</option>
            <option value="27">27</option>
            <option value="28">28</option>
            <option value="29">29</option>
            <option value="30">30</option>
            <option value="31">31</option>
            <option value="32">32</option>
            <option value="33">33</option>
            <option value="34">34</option>
            <option value="35">35</option>
            <option value="36">36</option>
            <option value="37">37</option>
            <option value="38">38</option>
            <option value="39">39</option>
            <option value="40">40</option>
            <option value="41">41</option>
            <option value="42">42</option>
            <option value="43">43</option>
            <option value="44">44</option>
            <option value="45">45</option>
            <option value="46">46</option>
            <option value="47">47</option>
            <option value="48">48</option>
            <option value="49">49</option>
            <option value="50">50</option>
            <option value="51">51</option>
            <option value="52">52</option>
          </select>&nbsp;&nbsp;
          <button class="btn btn-info btn-lg" type="submit" >report</button>&nbsp;
          </br>

        </div>
      </div>
    </form><br>
    
    <table class="table table-bordered table-hover " id ="tablereport">
      <thead class="bg-primary p-2 text-light bg-opacity-25 " align='center'>
          <th>week</th>
          <th>year</th>
          <th>network</th>
          <th>account influencer</th>
          <th>follower</th>
          <th>total post</th>
          <th>unique post</th>
          <th>duplicate (%)</th>
      </thead>
      <?php foreach ($totalweek['weekly'] as $key => $value) { ?>
        <tr align='center'>
          <td><?php echo @$value['week'] ?> </td>
          <td><?php echo @$value['year'] ?> </td>
          <td><?php echo @$value['network'] ?> </td>
          <td><?php echo number_format(@$value['account']) ?> </td>
          <td><?php echo number_format(@$value['follower']) ?> </td>
          <td><?php echo number_format(@$value['total_post']) ?> </td>
          <td><?php echo number_format(@$value['unique_post'])  ?> </td>
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
              ['week', 'total post','unique post'],
              <?php
              foreach ($total as $row) {
                echo "['" . $row['week']. " ". $row['network']. " '," . $row['total_post'] ."," . @$row['unique_post'] . "],";
              } ?>
            ]);
            var options = {
              title: 'weekly',
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