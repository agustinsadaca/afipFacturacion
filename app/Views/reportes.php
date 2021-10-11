<!DOCTYPE html>
<html>
<head>
    <script src="<?php echo base_url().'/Chart/chart.min.js';?>"></script>
	<meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php if (isset($data['js_files'])) {
    /* -------------------------------------------------------------------------- */
    /*                                 CSS import                                 */
    /* -------------------------------------------------------------------------- */
    foreach ($data['css_files'] as $file):
        // echo '<pre>';
        // var_dump($data['css_files']);die;
    ?>
        <link type="text/css" rel="stylesheet" href="<?php echo $file; ?>" />
<?php
endforeach;
}
/* -------------------------------------------------------------------------- */
/*                                   Titulo                                   */
/* -------------------------------------------------------------------------- */
?>
    <title>
        <?php 
            if(isset($data['title'])) 
            {
                echo $data['title'];
            }
        ?>
    </title>
</head>
<body>
<style>
.errors_validation{
    color:red;
    padding: 50px 0 0 10px ;


}
</style>

<?=
/* -------------------------------------------------------------------------- */
/*                                  Menu Bar                                  */
/* -------------------------------------------------------------------------- */
$menu; ?>

<?php foreach($data['errors'] as $error) { 
/* -------------------------------------------------------------------------- */
/*                                   errores                                  */
/* -------------------------------------------------------------------------- */
?>
        <div  class="errors_validation">   
            <?php echo $error;?>
        </div>
<?php } ?>

	<div style='height: 30px;'></div>
    <div style="padding: 10px">

        <?php
/* -------------------------------------------------------------------------- */
/*                          CRUD tabla de GroceryCrud                         */
/* -------------------------------------------------------------------------- */
if (isset($data['output'])) {
    echo $data['output'];
}
?>

</div>
<div class="box effect1" style="position: relative; height:50vh; width:auto">
    <canvas id="myChart" width="100" height="100"></canvas>
</div>
<div class="reports">
<div class="box effect1" style="position: relative; height:50vh; width:70%">
    <canvas id="myChart2" width="100" height="100"></canvas>
</div>
<div class="box effect1" style="position: relative; height:auto; width:30%">
    <canvas id="myChart3" width="400" height="400"></canvas>
</div>
</div>
<div class="box effect1" style="position: relative; height:70vh; width:100%">
    <canvas id="myChart4" width="400" height="400"></canvas>
</div>
<div class="box effect1" style="position: relative; height:70vh; width:100%">
    <canvas id="myChart5" width="400" height="400"></canvas>
</div>


<script>
/* -------------------------------------------------------------------------- */
/*                                 Mes Actual                                 */
/* -------------------------------------------------------------------------- */
let masVendidoMesActual = <?php echo json_encode($data["masVendidoMesActual"]);?>;
let cantidad = []
let label = []
masVendidoMesActual.map(item=>{cantidad.push(parseInt(item.totalVenta))})
masVendidoMesActual.map(item=>{label.push(item.nombre)})

var ctx = document.getElementById('myChart');

var myChart = new Chart(ctx, {
    type: 'bar',
    data: {
        labels: 
            label
        ,
        datasets: [{
            label: 'Productos mas vendidos mes actual x cantidad',
            data: cantidad
            ,
            backgroundColor: [
                'rgba(255, 99, 132, 0.2)',
                'rgba(54, 162, 235, 0.2)',
                'rgba(255, 206, 86, 0.2)',
                'rgba(75, 192, 192, 0.2)',
                'rgba(153, 102, 255, 0.2)',
                'rgba(255, 159, 64, 0.2)'
            ],
            borderColor: [
                'rgba(255, 99, 132, 1)',
                'rgba(54, 162, 235, 1)',
                'rgba(255, 206, 86, 1)',
                'rgba(75, 192, 192, 1)',
                'rgba(153, 102, 255, 1)',
                'rgba(255, 159, 64, 1)'
            ],
            borderWidth: 1
        }]
    },
    options: {
        maintainAspectRatio: false,
        responsive:true,
        scales: {
            y: {
                beginAtZero: true
            }
        }
    }
});
/* -------------------------------------------------------------------------- */
/*                                Mes Anterior                                */
/* -------------------------------------------------------------------------- */
let masVendidoMesAnterior = <?php echo json_encode($data["masVendidoMesAnterior"]);?>;
let cantidadMesAnterior = []
let labelMesAnterior = []
masVendidoMesAnterior.map(item=>{cantidadMesAnterior.push(parseInt(item.totalVenta))})
masVendidoMesAnterior.map(item=>{labelMesAnterior.push(item.nombre)})

var ctx2 = document.getElementById('myChart2');
var myChart2 = new Chart(ctx2, {
    type: 'bar',
    data: {
        labels: labelMesAnterior,
        datasets: [{
            label: 'Productos mas vendidos mes anterior x cantidad',
            data: cantidadMesAnterior,
            backgroundColor: [
                'rgba(255, 99, 132, 0.2)',
                'rgba(54, 162, 235, 0.2)',
                'rgba(255, 206, 86, 0.2)',
                'rgba(75, 192, 192, 0.2)',
                'rgba(153, 102, 255, 0.2)',
                'rgba(255, 159, 64, 0.2)'
            ],
            borderColor: [
                'rgba(255, 99, 132, 1)',
                'rgba(54, 162, 235, 1)',
                'rgba(255, 206, 86, 1)',
                'rgba(75, 192, 192, 1)',
                'rgba(153, 102, 255, 1)',
                'rgba(255, 159, 64, 1)'
            ],
            borderWidth: 1
        }]
    },
    options: {
        maintainAspectRatio: false,
        scales: {
            y: {
                beginAtZero: true
            }
        }
    }
});
/* -------------------------------------------------------------------------- */
/*                                    donut                                   */
/* -------------------------------------------------------------------------- */
var ctx3 = document.getElementById('myChart3');
var myChart3 = new Chart(ctx3, {
  type: 'pie',
  data: {
    labels: labelMesAnterior,
    datasets: [{
      label: '# of Tomatoes',
      data: cantidadMesAnterior,
      backgroundColor: [
        'rgba(255, 99, 132, 0.5)',
        'rgba(54, 162, 235, 0.2)',
        'rgba(255, 206, 86, 0.2)',
        'rgba(75, 192, 192, 0.2)'
      ],
      borderColor: [
        'rgba(255,99,132,1)',
        'rgba(54, 162, 235, 1)',
        'rgba(255, 206, 86, 1)',
        'rgba(75, 192, 192, 1)'
      ],
      borderWidth: 1
    }]
  },
  options: {
   	//cutoutPercentage: 40,
    responsive: false,

  }
});
/* -------------------------------------------------------------------------- */
/*                                 Line Chart                                 */
/* -------------------------------------------------------------------------- */
let ventasMensualesYDiarias = <?php echo json_encode($data["ventasMensualesYDiarias"]);?>;
let labelsMeses = ["Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre"]
let labelMensualBruto = [0,0,0,0,0,0,0,0,0,0,0,0]
let labelGananciasEstimadas = [0,0,0,0,0,0,0,0,0,0,0,0]
ventasMensualesYDiarias[0].map(item=>{
    labelMensualBruto[parseInt(item.Mes)-1]=(parseInt(item.Total))
})
labelMensualBruto.map((item,index)=>{
    if(item!=0){
        labelGananciasEstimadas[index] = item - (item / 1.3)
    }
})


var ctx4 = document.getElementById('myChart4');
var myChart4 = new Chart(ctx4, {
  type: 'line',
  data: {
    labels: labelsMeses,
    datasets: [{ 
        data: labelMensualBruto,
        label: "Ventas Mensuales Bruto",
        borderColor: "#3e95cd",
        fill: false
      }, { 
        data: labelGananciasEstimadas,
        label: "Ganancias Estimadas",
        borderColor: "#8e5ea2",
        fill: false
      }
    ]
  },
  options: {
    maintainAspectRatio: false,
    title: {
      display: true,
      text: 'World population per region (in millions)'
    }
  }
});
/* -------------------------------------------------------------------------- */
/*                         LineChart Mes Actual Ventas                        */
/* -------------------------------------------------------------------------- */
let labelDiarioBruto = []
let labelDaysActualMonth = []
let mesActual = new Intl.DateTimeFormat('es-ES', { month: 'long'}).format(new Date());
function daysInThisMonth() {
  var now = new Date();
  return new Date(now.getFullYear(), now.getMonth()+1, 0).getDate();
}
let amountDaysCurrentMonth = daysInThisMonth()
for (let index = 0; index < amountDaysCurrentMonth; index++) {
    labelDiarioBruto.push(0);  
}
for (let index = 0; index < amountDaysCurrentMonth; index++) {
    labelDaysActualMonth.push(index+1);  
}
ventasMensualesYDiarias[1].map(item=>{
    labelDiarioBruto[parseInt(item.DayOfMonth)-1]=(parseInt(item.Total))
})
var ctx5 = document.getElementById('myChart5');
var myChart5 = new Chart(ctx5, {
    type: 'bar',
    data: {
        labels: labelDaysActualMonth,
        datasets: [{
            label: `Bruto Venta Diaria Mes ${mesActual}`,
            data: labelDiarioBruto,
            backgroundColor: 
                'rgb(25, 117, 216)',
            borderWidth: 1
        }]
    },
    options: {
        maintainAspectRatio: false,
        scales: {
            y: {
                beginAtZero: true
            }
        }
    }
});
</script>
    <?php
/* -------------------------------------------------------------------------- */
/*                                 JS imports                                 */
/* -------------------------------------------------------------------------- */
    if (isset($data['js_files'])) {
    foreach ($data['js_files'] as $file): ?>
        <script src="<?php echo $file; ?>"></script>
    <?php endforeach;
}?>


</body>
<style>
    
    /* 1975d8 azul */
canvas{
    padding: 30px;
}
.reports{
    max-height: 60vh;
    display:flex;
    justify-content: space-between;
}

body {
  background-color:#ccc;
}

.box h3{
	text-align:center;
	position:relative;
	top:80px;
}
.box {
	width:70%;
	height:700px;
	background:#FFF;
	margin:20px 30px;
}


    /* d2d6de */
    .effect1 {
	-webkit-box-shadow: 0 10px 6px -6px #777;
	   -moz-box-shadow: 0 10px 6px -6px #777;
	        box-shadow: 0 10px 6px -6px #777;
}
</style>
</html>
