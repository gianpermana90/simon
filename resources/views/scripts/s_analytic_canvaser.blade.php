<script>

//--------------------------
//- SALES PER CANVASER CHART -
//--------------------------

var ticksStyle = {
    fontColor: '#495057',
    fontStyle: 'bold'
}

var mode = 'index';
var intersect = true;

var salesBCDataTahun = {
    labels: ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul', 'Agu', 'Sep', 'Okt', 'Nov', 'Des'],
    datasets: [
        {
            label: 'Target',
            fill: false,
            borderWidth: 2,
            lineTension: 0,
            spanGaps: true,
            borderColor: '#dc3545',
            pointRadius: 3,
            pointHoverRadius: 7,
            pointColor: '#efefef',
            pointBackgroundColor: '#dc3545',
            backgroundColor: '#dc3545',
            data: [                
                <?php 
                    for ($i=1; $i <= 12; $i++){
                        echo $target_canvaser->target.",";
                    }                    
                ?>
            ]
        },
        {
            label: 'Sales',
            fill: false,
            borderWidth: 2,
            lineTension: 0,
            spanGaps: true,
            borderColor: '#007bff',
            pointRadius: 3,
            pointHoverRadius: 7,
            pointColor: '#007bff',
            pointBackgroundColor: '#007bff',
            backgroundColor: '#007bff',
            data: [
                <?php
                    foreach($yearly_data as $data){                        
                        echo $data->sales.",";
                    }
                ?>
            ],                        
        },
        {
            label: 'BC',
            fill: false,
            borderWidth: 2,
            lineTension: 0,
            spanGaps: true,
            borderColor: '#28a745',
            pointRadius: 3,
            pointHoverRadius: 7,
            pointColor: '#28a745',
            pointBackgroundColor: '#28a745',
            backgroundColor: '#28a745',
            data: [
                <?php
                    foreach($yearly_data as $data){
                        if($target_canvaser->target != 0)
                            $achievement = number_format(($data->bc/$target_canvaser->target)*100); 
                        echo $data->bc.",";
                    }
                ?>
            ],                        
        },          
    ]
}

<?php
    $tanggal = "";
    $bc = "";
    $sales = "";
    $s = date('Y-m-01');  
    $e = date('Y-m-t');       
    while (strtotime($s) <= strtotime($e)) {
        $tanggal .= substr($s,-2).",";        

        $is_found = false;
        foreach($monthly_data_sales as $data){               
            if ($data->tanggal == $s) {                
                $sales .= $data->total.",";
                $is_found = true;
            }       
        }
        if (!$is_found) {
            $sales .= "0,";
        }

        $is_found = false;
        foreach($monthly_data_bc as $data){                        
            if ($data->tanggal == $s) {
                $bc .= $data->total.",";
                $is_found = true;
            }
        }
        if (!$is_found) {
            $bc .= "0,";
        }

        $s = date ("Y-m-d", strtotime("+1 day", strtotime($s)));
    }    
?>
var salesBCDataBulan = {
    labels: [{{$tanggal}}],
    datasets: [        
        {
            label: 'Sales',
            fill: false,
            borderWidth: 2,
            lineTension: 0,
            spanGaps: true,
            borderColor: '#007bff',
            pointRadius: 3,
            pointHoverRadius: 7,
            pointColor: '#007bff',
            pointBackgroundColor: '#007bff',
            backgroundColor: '#007bff',
            data: [
                {{$sales}}
            ],                        
        },
        {
            label: 'BC',
            fill: false,
            borderWidth: 2,
            lineTension: 0,
            spanGaps: true,
            borderColor: '#28a745',
            pointRadius: 3,
            pointHoverRadius: 7,
            pointColor: '#28a745',
            pointBackgroundColor: '#28a745',
            backgroundColor: '#28a745',
            data: [
                {{$bc}}
            ],                        
        },          
    ]
}

<?php
    $tanggal = "";
    $bc_m = "";
    $sales_m = "";
    $s_m = date('Y-m-d', strtotime("-7 day", strtotime('now')));
    $e_m = date('Y-m-d');
    while (strtotime($s_m) <= strtotime($e_m)) {        
        $tanggal .= substr($s_m,-2).",";        

        $is_found = false;
        foreach($monthly_data_sales as $data){               
            if ($data->tanggal == $s_m) {                
                $sales_m .= $data->total.",";
                $is_found = true;
            }       
        }
        if (!$is_found) {
            $sales_m .= "0,";
        }

        $is_found = false;
        foreach($monthly_data_bc as $data){                        
            if ($data->tanggal == $s_m) {
                $bc_m .= $data->total.",";
                $is_found = true;
            }
        }
        if (!$is_found) {
            $bc_m .= "0,";
        }

        $s_m = date ("Y-m-d", strtotime("+1 day", strtotime($s_m)));
    }    
?>
var salesBCDataMinggu = {
    labels: [{{$tanggal}}],
    datasets: [        
        {
            label: 'Sales',
            fill: false,
            borderWidth: 2,
            lineTension: 0,
            spanGaps: true,
            borderColor: '#007bff',
            pointRadius: 3,
            pointHoverRadius: 7,
            pointColor: '#007bff',
            pointBackgroundColor: '#007bff',
            backgroundColor: '#007bff',
            data: [
                {{$sales_m}}
            ],                        
        },
        {
            label: 'BC',
            fill: false,
            borderWidth: 2,
            lineTension: 0,
            spanGaps: true,
            borderColor: '#28a745',
            pointRadius: 3,
            pointHoverRadius: 7,
            pointColor: '#28a745',
            pointBackgroundColor: '#28a745',
            backgroundColor: '#28a745',
            data: [
                {{$bc_m}}
            ],                        
        },          
    ]
}

var salesBCChart;
var salesBCCanvas = $('#visitors-chart').get(0).getContext('2d');
var salesBCOptions = {
    maintainAspectRatio: false,
    responsive: true,
    legend: {
        display: true,
    },    
    scales: {
        xAxes: [{
            ticks: {
                fontColor: '#000',
            },
            gridLines: {
                display: true,
                color: '#efefef',
                drawBorder: false,
            }
        }],
        yAxes: [{
            ticks: {
                stepSize: 5,
                fontColor: '#000',
            },
            gridLines: {
                display: true,
                color: '#dfdfdf',
                drawBorder: false,
            }
        }]
    },
    plugins: {
        datalabels: {
            display: false,         
        }
    }
}

$( ".set-range" ).click(function() {    
    $(".set-range").removeClass('active');
    $(this).addClass('active');
});

setChartBC(salesBCDataBulan,'Bulan');

function setChartBC(data, range){       
    if(typeof salesBCChart !== "undefined")     {
        salesBCChart.destroy();
    }
    if(range == 'Minggu'){
        setChartOption(1);
        salesBCChart = new Chart(salesBCCanvas, {
            type: 'bar',
            data: data,
            options: salesBCOptions
        });
    }else if(range == "Bulan"){
        setChartOption(1);
        salesBCChart = new Chart(salesBCCanvas, {
            type: 'line',
            data: data,
            options: salesBCOptions
        });
    }else{
        setChartOption(5);
        salesBCChart = new Chart(salesBCCanvas, {
            type: 'line',
            data: data,
            options: salesBCOptions
        });
    }  
}

function setChartOption(step){
    salesBCOptions = {
        maintainAspectRatio: false,
        responsive: true,
        legend: {
            display: true,
        },    
        scales: {
            xAxes: [{
                ticks: {
                    fontColor: '#000',
                },
                gridLines: {
                    display: true,
                    color: '#efefef',
                    drawBorder: false,
                }
            }],
            yAxes: [{
                ticks: {
                    stepSize: step,
                    fontColor: '#000',
                },
                gridLines: {
                    display: true,
                    color: '#dfdfdf',
                    drawBorder: false,
                }
            }]
        },
        plugins: {
            datalabels: {
                display: false,         
            }
        }
    }
}

</script>