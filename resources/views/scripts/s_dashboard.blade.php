<?php
    use App\Providers\UrlManagement;
?>

<script>

const Toast = Swal.mixin({
    toast: true,
    position: 'top-end',
    showConfirmButton: false,    
});

'use strict'

var ticksStyle = {
	fontColor: '#495057',
	fontStyle: 'bold',    
}

var mode = 'index';
var intersect = true;
var TrendBCChart;

//--------------------------
//- SALES PER CANVASER CHART - TAHUN
//--------------------------
var TrendBCTahunData = {
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
                @for ($i=1; $i <= 12; $i++)
                    {{$target_canvaser->target}},
                @endfor
            ]
        },

        <?php 
            $color = ["#ed7c31", '#a5a5a5', '#5b9bd5', '#ffbf00', '#70ad47', '#4473c4']; 
            $no = 0;
        ?>
        @foreach($data as $key => $value)
            <?php
                $text = "";
                for ($i=1; $i <= 12; $i++) { 
                    if(!isset($value[$i]))
                        $value[$i] = 0;
                    $text .= $value[$i].",";
                }
            ?>
            {
                label: '{{$key}}',
                fill: false,
                borderWidth: 2,
                lineTension: 0,
                spanGaps: true,
                borderColor: '{{$color[$no]}}',
                pointRadius: 3,
                pointHoverRadius: 7,
                pointColor: '{{$color[$no]}}',
                pointBackgroundColor: '{{$color[$no]}}',
                backgroundColor: '{{$color[$no]}}',
                data: [{{substr($text,0,-1)}}],                        
            },
            <?php $no++; ?>
        @endforeach
        
    ]
}

//--------------------------
//- SALES PER CANVASER CHART - BULAN
//--------------------------
<?php
    $tanggal = "";    
    $s = date('Y-m-01');  
    $e = date('Y-m-t');   
    while (strtotime($s) <= strtotime($e)) {         
        $tanggal .= substr($s,-2).",";
        $s = date ("Y-m-d", strtotime("+1 day", strtotime($s)));
    }
?>
var TrendBCBulanData = {
    labels: [{{$tanggal}}],
    datasets: [        
        <?php 
            $color = ["#ed7c31", '#a5a5a5', '#5b9bd5', '#ffbf00', '#70ad47', '#4473c4']; 
            $no = 0;
        ?>
        @foreach($data_bulan as $key => $value)
        <?php
            $text = "";
            $s = date('Y-m-01');  
            $e = date('Y-m-t');  
            while (strtotime($s) <= strtotime($e)) {                   
                if(!isset($value[str_replace("-","",$s)]))
                    $value[str_replace("-","",$s)] = 0;    
                $text .= $value[str_replace("-","",$s)].",";
                $s = date ("Y-m-d", strtotime("+1 day", strtotime($s)));
            }            
        ?>
        {
            label: '{{$key}}',
            fill: false,
            borderWidth: 2,
            lineTension: 0,
            spanGaps: true,
            borderColor: '{{$color[$no]}}',
            pointRadius: 3,
            pointHoverRadius: 7,
            pointColor: '{{$color[$no]}}',
            pointBackgroundColor: '{{$color[$no]}}',
            data: [{{substr($text,0,-1)}}],                        
        },
        <?php $no++; ?>
        @endforeach
        
    ]
}

//--------------------------
//- SALES PER CANVASER CHART - MINGGU
//--------------------------
<?php
    $tanggal = "";    
    $s = date('Y-m-d', strtotime("-7 day", strtotime('now')));
    $e = date('Y-m-d');
    while (strtotime($s) <= strtotime($e)) {
        $tanggal .= substr($s,-2).",";
        $s = date ("Y-m-d", strtotime("+1 day", strtotime($s)));
    }
?>
var TrendBCMingguData = {
    labels: [{{$tanggal}}],
    datasets: [
        <?php 
            $color = ["#ed7c31", '#a5a5a5', '#5b9bd5', '#ffbf00', '#70ad47', '#4473c4']; 
            $no = 0;
        ?>
        @foreach($data_bulan as $key => $value)
        <?php
            $text = "";
            $s = date('Y-m-d', strtotime("-7 day", strtotime('now')));
            $e = date('Y-m-d'); 
            while (strtotime($s) <= strtotime($e)) {                   
                if(!isset($value[str_replace("-","",$s)]))
                    $value[str_replace("-","",$s)] = 0;    
                $text .= $value[str_replace("-","",$s)].",";
                $s = date ("Y-m-d", strtotime("+1 day", strtotime($s)));
            }            
        ?>
        {
            label: '{{$key}}',
            fill: false,
            borderWidth: 2,
            lineTension: 0,
            spanGaps: true,
            borderColor: '{{$color[$no]}}',
            pointRadius: 3,
            pointHoverRadius: 7,
            pointColor: '{{$color[$no]}}',
            pointBackgroundColor: '{{$color[$no]}}',
            data: [{{substr($text,0,-1)}}],                        
        },
        <?php $no++; ?>
        @endforeach
        
    ]
}

//--------------------------
//- SALES PER CANVASER CHART - HARIAN
//--------------------------

var TrendBCHarianData = {
    labels: [
        @foreach($data_bulan as $key => $value)
            '{{$key}}',
        @endforeach
    ],
    datasets: [
        <?php 
            $color = ["#ed7c31", '#a5a5a5', '#5b9bd5', '#ffbf00', '#70ad47', '#4473c4']; 
            $no = 0;
        ?>        
        {
            label: 'BC',
            fill: false,
            borderWidth: 2,
            lineTension: 0,
            spanGaps: true,
            borderColor: '{{$color[$no]}}',            
            pointRadius: 3,
            pointHoverRadius: 7,
            pointColor: '{{$color[$no]}}',
            pointBackgroundColor: '{{$color[$no]}}',
            backgroundColor:'{{$color[$no]}}',
            data: [
                <?php 
                    foreach ($data as $k => $val) {
                        if (isset($data_harian[$k])) {
                            echo $data_harian[$k];
                        }else{
                            echo "0,";
                        }
                    } 
                ?>
            ],                        
        },        
        
    ]
}

var TrendBCCanvas = $('#line-chart').get(0).getContext('2d');
var TrendBCOptions = {
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
                display: false,
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

//--------------------------
//- TARGET CHART -
//--------------------------

var $targetChart = $('#donutChart')
var targetChart = new Chart($targetChart, {
	type: 'bar',
	data: {
		labels: ['<?php echo date('F') ?>'],
		datasets: [{
				backgroundColor: '#dc3545',
				borderColor: '#dc3545',
				data: [<?php echo @$target_bulanan[date('m')-1]->target; ?>]
			},
			{
				backgroundColor: '#007bff',
				borderColor: '#007bff',
				data: [<?php echo @$current_ach; ?>]
			}
		]
	},
	options: {
		maintainAspectRatio: false,
		tooltips: {
			mode: mode,
			intersect: intersect
		},
		hover: {
			mode: mode,
			intersect: false
		},
		legend: {
			display: false
		},
		scales: {
			yAxes: [{
				// display: false,
				gridLines: {
					display: true,
					lineWidth: '4px',
					color: 'rgba(0, 0, 0, .2)',
					zeroLineColor: 'transparent'
				},
				ticks: $.extend({
					beginAtZero: true,					
				}, ticksStyle)
			}],
			xAxes: [{
				display: true,
				gridLines: {
					display: false
				},
				ticks: ticksStyle
			}]
		},
        plugins: {
            datalabels: {
                align: 'center',
                anchor: 'center',                
                borderRadius: 4,
                color: 'white',
                formatter: Math.round
            }
        }
	}
})

//--------------------------
//- REVENUE CHART -
//--------------------------

var $salesChart = $('#sales-chart')
var salesChart = new Chart($salesChart, {
	type: 'bar',
	data: {
		labels: ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul', 'Agu', 'Sep', 'Okt', 'Nov', 'Des'],
		datasets: [{
                backgroundColor: '#ced4da',
				borderColor: '#ced4da',
				data: [0,0,0,0,0,0,0,0,0,0,0,0,]
			},
			{
                backgroundColor: '#007bff',
				borderColor: '#007bff',				
				data: [0,0,0,0,0,0,0,0,0,0,0,0,]
			}
		]
	},
	options: {
		maintainAspectRatio: false,
		tooltips: {
			mode: mode,
			intersect: intersect
		},
		hover: {
			mode: mode,
			intersect: false
		},
		legend: {
			display: false
		},
		scales: {
			yAxes: [{
				// display: false,
				gridLines: {
					display: true,
					lineWidth: '4px',
					color: 'rgba(0, 0, 0, .2)',
					zeroLineColor: 'transparent'
				},
				ticks: $.extend({
					beginAtZero: true,

					// Include a dollar sign in the ticks
					callback: function(value, index, values) {
						if (value >= 1000) {
							value /= 1000
							value += 'k'
						}
						return '$' + value
					}
				}, ticksStyle)
			}],
			xAxes: [{
				display: true,
				gridLines: {
					display: false
				},
				ticks: ticksStyle
			}]
		},
        plugins: {
            datalabels: {
                display: false,         
            }
        }
	}
})

//--------------------------
//- SALES TOTAL CHART -
//--------------------------
<?php
    $target = "";
    foreach($target_bulanan as $tb){
        $target .= $tb->target.",";
    }

    $sales = "";
    $realisasi = "";
    $realisasi_current = "";
    foreach($billcomp as $bc){    
        $realisasi .= $bc->realisasi.",";
        $sales .= $bc->sales.",";
        $realisasi_current .= $bc->realisasi_current.",";
    }    
?>

var salesTotalGraphChartCanvas = $('#line-chart2').get(0).getContext('2d');
var salesTotalOptions = {
    maintainAspectRatio: true,
    legend: {
        display: true
    },
    scales:{
        yAxes:[{
            ticks:{
                beginAtZero:true
            }
        }]
    },
    plugins: {
        datalabels: {
            display: false,         
        }
    }
}
var mixedChart = new Chart(salesTotalGraphChartCanvas, {
    type: 'bar',
    data: {
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
                pointColor: '#dc3545',
                pointBackgroundColor: '#dc3545',
                backgroundColor: '#dc3545',
                data: [{{$target}}],
                type: 'line',
                order: 1
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
                data: [{{$sales}}],
                type: 'bar',            
                order: 2
            },
            {
                label: 'BC Total',
                fill: true,
                borderWidth: 2,
                lineTension: 0,
                spanGaps: true,
                borderColor: '#28a745',
                pointRadius: 3,
                pointHoverRadius: 7,
                pointColor: '#28a745',
                pointBackgroundColor: '#28a745',
                backgroundColor: '#28a745',
                data: [{{$realisasi}}],
                type: 'bar',            
                order: 3
            },
            {
                label: 'BC Bulan',
                fill: true,
                borderWidth: 2,
                lineTension: 0,
                spanGaps: true,
                borderColor: '#20c997',
                pointRadius: 3,
                pointHoverRadius: 7,
                pointColor: '#20c997',
                pointBackgroundColor: '#20c997',
                backgroundColor: '#20c997',
                data: [{{$realisasi_current}}],
                type: 'bar',            
                order: 3
            }
        ],
        labels: ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul', 'Agu', 'Sep', 'Okt', 'Nov', 'Des']
    },
    options: salesTotalOptions
});

//--------------------------------------------------------------------------------------

$('.count').each(function() {
    $(this).prop('Counter', -1).animate({
        Counter: $(this).text()
    }, {
        duration: 1200,
        easing: 'swing',
        step: function(now) {
            $(this).text(Math.ceil(now));
        }
    });
});

$( "#update_data_button" ).click(function() {    
    Toast.fire({
        type: 'info',
        title: 'Mohon tunggu, sedang memperbarui data dari server'
    })
    updateData();
});

$( "#btn_target_canvaser" ).click(function() {    
    Toast.fire({
        type: 'info',
        title: 'Mohon tunggu, sedang memperbarui data'
    })
    updateTarget($("#target_canvaser").val(), 'canvaser');    
});

$( "#btn_target_bulanan" ).click(function() {    
    Toast.fire({
        type: 'info',
        title: 'Mohon tunggu, sedang memperbarui data'
    })
    updateTarget($("#target_current_month").val(), 'bulanan');    
});

$( ".set-range" ).click(function() {    
    $(".set-range").removeClass('active');
    $(this).addClass('active');
});

//--------------------------------------------------------------------------------------

var target_count, startdate, startdate_raw , enddate, enddate_raw;
var extracted_data = [];

function updateData(){    
    extracted_data = [];
    startdate_raw = new Date(new Date().setMonth(new Date().getMonth()-1));
    startdate = startdate_raw.getFullYear()+'%2F'+ (startdate_raw.getMonth()+1) +'%2F'+startdate_raw.getDate();
    enddate_raw = new Date();
    enddate = enddate_raw.getFullYear()+'%2F'+ (enddate_raw.getMonth()+1) +'%2F'+enddate_raw.getDate();

    // only for initiate data
    startdate   = '2019%2F01%2F01';
    enddate     = '2019%2F11%2F30';

    $.ajax({
        type: 'POST',
        url: 'https://dashboard.telkom.co.id/idwifi/public/ajaxdetailresume/data/all?kolom=SALES&l0=2&l1=12&l2=CONS&l3=WMS&sql=&fokus=TREG&ap_order=AP&mon_rep=REPORTING&startdate='+startdate+'&enddate='+enddate+'&group_ubis%5B%5D=CONS&group_ubis%5B%5D=PARTNERSHIP+SALES&treg%5B%5D=2&paket%5B%5D=Basic+Indischool&paket%5B%5D=WMS&paket%5B%5D=Basic+WICO&paket%5B%5D=WISTA&paket%5B%5D=WICO+2.0&paket%5B%5D=WLAN+MNS&paket%5B%5D=Basic+TSEL&paket%5B%5D=OTHER&source=ALL&p_on_air=0',
        data: '_token = <?php echo csrf_token() ?>',
        success: function(data) {
            var data_response = data.aaData;
            target_count = 0;
            data_response.forEach(extractData);                        
        },
        complete: function(data){
            saveData(extracted_data);                        
        }
    });
}

function extractData(value) {
    t = value[42]
    if(t == null)
        t = "Kosong";
    
    var obj = {
        'nsorder_quo'               : value[1],
        'createdon_quo'             : value[2],
        'umur_createdon_quo'        : value[3],
        'userstatus_quo'            : value[4],

        'nsorder_ao'                : value[5],
        'createdon_ao'              : value[6],
        'umur_createdon_ao'         : value[7],
        'userstatus_ao'             : value[8],

        'sid'                       : value[9],

        'sotp_no'                   : value[10],
        'nipnas'                    : value[11],
        'name_sold'                 : value[12],
        'region_sotp'               : value[13],
        'segmen_sotp'               : value[14],

        'shtp'                      : value[15],        
        'name_shtp'                 : value[16],
        'region_shtp'               : value[17],

        'accountnas'                : value[18],
        'productid'                 : value[19],

        'sero_id_fs'                : value[20],
        'status_abbreviation_fs'    : value[21],
        'status_date_fs'            : value[22],
        'umur_status_date_fs'       : value[23],

        'sero_id_prov'              : value[24],
        'status_abbreviation_prov'  : value[25],
        'status_date_prov'          : value[26],

        'witel'                     : value[27],
        'skema_bisnis'              : value[28],
        'groupstatus_tenoss'        : value[29],
        'ubis'                      : value[30],
        'groupstatus'               : value[31],
        'reg_id'                    : value[32],

        'projectname_prov'          : value[33],
        'projectname_fs'            : value[34],
        'amount_price'              : value[35],
        'jml_ap_attr'               : value[36],
        'billcompdate'              : value[37],
        'group_ubis'                : value[38],

        'task_name'                 : value[39],
        'task_name_date'            : value[40],
        'tgl_pcom_ao'               : value[41],

        'kcontact'                  : value[42],
        
        'ap_status'                 : value[43],
        'partner_name'              : value[44],
        'loc_id'                    : value[45],        
        'durasi_fs_closed'          : value[46],
        'durasi_ao_closed'          : value[47],
        'durasi_order_closed'       : value[48],

        'id_canvaser'               : t.slice(t.toLowerCase().indexOf("jkb0"), t.toLowerCase().indexOf("jkb0") + 6),
    };  
    extracted_data.push(obj);
}

function saveData(extracted_data) {
    var parsed_data = JSON.stringify(extracted_data);
    jQuery.ajax({
        method: 'POST',
        dataType: 'json',
        url: "{{UrlManagement::insert_extracted_data}}",
        crossDomain : true,
        data: {
            _token: "{{ csrf_token() }}",
            data_object: parsed_data,
            data_target: target_count
        },
        beforeSend: function(){
            console.log("Sending Data");
        },
    })
    .done(function(data) {
        Swal.mixin({
            toast: true,
            position: 'top-end',
            showConfirmButton: false,
            timer: 2000,
            onClose: () => {
                location.reload()
            }
        }).fire({
            type: 'success',
            title: 'Berhasil, data telah berhasil diperbarui',            
        })
    });
}

function updateTarget(target, category){
    var url, modal;
    if(category == 'canvaser'){
        url = "{{UrlManagement::set_target_canvaser}}";
        modal = $('#modal-atur-target');
    }else{
        url = "{{UrlManagement::set_target_current_month}}";
        modal = $('#modal-atur-target-bulan-ini');
    }    

    jQuery.ajax({
        method: 'POST',
        dataType: 'json',
        url: url,
        crossDomain : true,
        data: {
            _token: "{{ csrf_token() }}",
            target_data: target
        },
        beforeSend: function(){            
            modal.modal('hide');
        },
    })
    .done(function(data) {
        Swal.mixin({
            toast: true,
            position: 'top-end',
            showConfirmButton: false,
            timer: 2000,
            onClose: () => {
                location.reload()
            }
        }).fire({
            type: 'success',
            title: 'Berhasil, Target telah berhasil diperbarui',            
        })
    });
}

setChartBC(TrendBCTahunData,'Tahunan');
function setChartBC(data, range){       
    if(typeof TrendBCChart !== "undefined")     {
        TrendBCChart.destroy();
    }
    if(range == 'Harian'){
        TrendBCChart = new Chart(TrendBCCanvas, {
            type: 'bar',
            data: data,
            options: TrendBCOptions
        });
    }else{
        TrendBCChart = new Chart(TrendBCCanvas, {
            type: 'line',
            data: data,
            options: TrendBCOptions
        });
    }    
}

</script>