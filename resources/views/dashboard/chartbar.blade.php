<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <meta http-equiv="X-UA-Compatible" content="ie=edge">
   <title>Chart</title>


   <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
      integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
</head>

<body>
   <div class="panel card">
      <div id="chartPelangaran">
      </div>
   </div>

   <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
      integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
   <script src="https://code.highcharts.com/highcharts.js"></script>
   <script>
      Highcharts.chart('chartPelangaran', {
         chart: {
            type: 'column'
         },
         title: {
            text: 'Statistik Pelanggaran & Penghargaan'
         },
         subtitle: {
            text: 'Pelanggaran & Penghargaan Siswa Perbulan'
         },
         xAxis: {
            categories: [
               'Jan',
               'Feb',
               'Mar',
               'Apr',
               'May',
               // 'Jun',
               // 'Jul',
               // 'Aug',
               // 'Sep',
               // 'Oct',
               // 'Nov',
               // 'Dec'
            ],
            crosshair: true
         },
         yAxis: {
            min: 0,
            title: {
               text: 'Rainfall (mm)'
            }
         },
         tooltip: {
            headerFormat: '<span style="font-size:10px">{point.key}</span><table>',
            pointFormat: '<tr><td style="color:{series.color};padding:0">{series.name}: </td>' +
               '<td style="padding:0"><b>{point.y:.1f} mm</b></td></tr>',
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
            name: 'Pelanggaran',
            data: [100.9, 71.5, 106.4, 129.2, 144.0]

         }, {
            name: 'Penghargaan',
            data: [83.6, 78.8, 98.5, 93.4, 106.0]

         }]
      });
   </script>
</body>

</html>
