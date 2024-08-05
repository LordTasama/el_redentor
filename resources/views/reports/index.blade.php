@extends("layouts.app")
@section("title","Reportes")

@section('content')
<section class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between">
        <h1 class="h3 mb-0 text-gray-800">Reportes</h1>
    </div>
    <div class="d-sm-flex align-items-center justify-content-end mb-2">
        <a type="button" class="d-sm-inline-block btn btn-sm btn-primary shadow-sm mx-1 my-2"
            href="{{route('exportar.prisioneros')}}" style="width:100%"><i
                class="fas fa-download fa-sm text-white-50"></i>
            Generar lista
            de prisioneros</a>

        <a type="button" class="d-sm-inline-block btn btn-sm btn-primary shadow-sm mx-1 my-2"
            href="{{route('exportar.visitantes')}}" style="width:100%"><i
                class="fas fa-download fa-sm text-white-50"></i>
            Generar lista de
            visitantes</a>
    </div>


    <!-- Content Row -->

    <div class="row">
        <!-- Area Chart -->
        <div class="col">
            <div class="card shadow mb-4">
                <!-- Card Header - Dropdown -->
                <div class="card-header">
                    <div class="py-3 d-flex flex-row align-items-center justify-content-between">
                        <h6 class="m-0 font-weight-bold text-primary">Visitas</h6>
                        <div class="dropdown no-arrow">
                            <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink"
                                data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-ellipsis-v fa-sm fa-fw text-primary-400"></i>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right shadow animated--fade-in"
                                aria-labelledby="dropdownMenuLink">
                                <div class="dropdown-header">Visitas</div>

                                <a class="dropdown-item text-success font-weight-bold" style="cursor:pointer"
                                    id="downloadEXCELVisitas">Descargar
                                    EXCEL</a>
                                <a class="dropdown-item text-danger font-weight-bold" style="cursor:pointer"
                                    id="downloadPDFVisitas">Descargar
                                    PDF</a>

                            </div>
                        </div>
                    </div>

                    <form action="">
                        <div class="d-sm-flex align-items-center justify-content-end">
                            <input type="date" name="fechaInicio" id="fechaInicio" class="form-control mx-1 my-1"
                                title="Fecha de inicio">
                            <input type="date" name="fechaFin" id="fechaFin" class="form-control mx-1 my-1"
                                title="Fecha final">
                            <button type="button" class="btn btn-primary" id="sendQueryVisitas"><i
                                    class="fa-solid fa-magnifying-glass"></i></button>
                        </div>

                    </form>

                </div>



                <!-- Card Body -->
                <div class="card-body">
                    <div class="chart-area">
                        <canvas id="myChart"></canvas>
                    </div>
                </div>
            </div>
        </div>


    </div>

    <!-- Content Row -->
    <div class="row">
        <!-- Area Chart -->
        <div class="col">
            <div class="card shadow mb-4">
                <!-- Card Header - Dropdown -->
                <div class="card-header">
                    <div class="py-3 d-flex flex-row align-items-center justify-content-between">
                        <h6 class="m-0 font-weight-bold text-primary">Prisioneros</h6>
                        <div class="dropdown no-arrow">
                            <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink"
                                data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-ellipsis-v fa-sm fa-fw text-primary-400"></i>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right shadow animated--fade-in"
                                aria-labelledby="dropdownMenuLink">
                                <div class="dropdown-header">Prisioneros</div>

                                <a class="dropdown-item text-success font-weight-bold" href="#">Descargar EXCEL</a>
                                <a class="dropdown-item text-danger font-weight-bold" href="#">Descargar PDF</a>

                            </div>
                        </div>
                    </div>

                    <form action="">
                        <div class="d-sm-flex align-items-center justify-content-end">
                            <input type="date" name="fechaInicioPrisioneros" id="fechaInicioPrisioneros"
                                class="form-control mx-1 my-1" title="Fecha de inicio">
                            <input type="date" name="fechaFinPrisioneros" id="fechaFinPrisioneros"
                                class="form-control mx-1 my-1" title="Fecha final">
                            <button type="button" class="btn btn-primary"><i
                                    class="fa-solid fa-magnifying-glass"></i></button>
                        </div>
                    </form>


                </div>

                <!-- Card Body -->
                <div class="card-body">
                    <div class="chart-area">
                        <canvas id="myAreaChart2"></canvas>
                    </div>
                </div>
            </div>
        </div>


    </div>


</section>
@endsection
<script>
document.addEventListener('DOMContentLoaded', function() {

    function getRandomColor() {
        var letters = '0123456789ABCDEF';
        var color = '#';
        for (var i = 0; i < 6; i++) {
            color += letters[Math.floor(Math.random() * 16)];
        }
        return color;
    }

    var dataValues = [0, 10000, 5000, 15000, 10000, 20000, 15000, 25000, 20000, 30000, 25000, 40000];
    var backgroundColors = dataValues.map(() => getRandomColor());
    // Set new default font family and font color to mimic Bootstrap's default styling
    Chart.defaults.global.defaultFontFamily = 'Nunito',
        '-apple-system,system-ui,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,sans-serif';
    Chart.defaults.global.defaultFontColor = '#858796';

    function number_format(number, decimals, dec_point, thousands_sep) {
        // *     example: number_format(1234.56, 2, ',', ' ');
        // *     return: '1 234,56'
        number = (number + '').replace(',', '').replace(' ', '');
        var n = !isFinite(+number) ? 0 : +number,
            prec = !isFinite(+decimals) ? 0 : Math.abs(decimals),
            sep = (typeof thousands_sep === 'undefined') ? ',' : thousands_sep,
            dec = (typeof dec_point === 'undefined') ? '.' : dec_point,
            s = '',
            toFixedFix = function(n, prec) {
                var k = Math.pow(10, prec);
                return '' + Math.round(n * k) / k;
            };
        // Fix for IE parseFloat(0.55).toFixed(0) = 0;
        s = (prec ? toFixedFix(n, prec) : '' + Math.round(n)).split('.');
        if (s[0].length > 3) {
            s[0] = s[0].replace(/\B(?=(?:\d{3})+(?!\d))/g, sep);
        }
        if ((s[1] || '').length < prec) {
            s[1] = s[1] || '';
            s[1] += new Array(prec - s[1].length + 1).join('0');
        }
        return s.join(dec);
    }

    // Area Chart Example
    var ctx = document.getElementById("myChart");
    var myLineChart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov",
                "Dec"
            ],
            datasets: [{
                label: "Earnings",
                lineTension: 0.3,
                backgroundColor: backgroundColors,
                borderColor: "rgba(78, 115, 223, 1)",
                pointRadius: 3,
                pointBackgroundColor: "rgba(78, 115, 223, 1)",
                pointBorderColor: "rgba(78, 115, 223, 1)",
                pointHoverRadius: 3,
                pointHoverBackgroundColor: "rgba(78, 115, 223, 1)",
                pointHoverBorderColor: "rgba(78, 115, 223, 1)",
                pointHitRadius: 10,
                pointBorderWidth: 2,
                data: dataValues
            }],
        },
        options: {
            maintainAspectRatio: false,
            layout: {
                padding: {
                    left: 10,
                    right: 25,
                    top: 25,
                    bottom: 0
                }
            },
            scales: {
                xAxes: [{
                    time: {
                        unit: 'date'
                    },
                    gridLines: {
                        display: false,
                        drawBorder: false
                    },
                    ticks: {
                        maxTicksLimit: 7
                    }
                }],
                yAxes: [{
                    ticks: {
                        maxTicksLimit: 5,
                        padding: 10,
                        // Include a dollar sign in the ticks
                        callback: function(value, index, values) {
                            return '$' + number_format(value);
                        }
                    },
                    gridLines: {
                        color: "rgb(234, 236, 244)",
                        zeroLineColor: "rgb(234, 236, 244)",
                        drawBorder: false,
                        borderDash: [2],
                        zeroLineBorderDash: [2]
                    }
                }],
            },
            legend: {
                display: false
            },
            tooltips: {
                backgroundColor: "rgb(255,255,255)",
                bodyFontColor: "#858796",
                titleMarginBottom: 10,
                titleFontColor: '#6e707e',
                titleFontSize: 14,
                borderColor: '#dddfeb',
                borderWidth: 1,
                xPadding: 15,
                yPadding: 15,
                displayColors: false,
                intersect: false,
                mode: 'index',
                caretPadding: 10,
                callbacks: {
                    label: function(tooltipItem, chart) {
                        var datasetLabel = chart.datasets[tooltipItem.datasetIndex].label || '';
                        return datasetLabel + ': $' + number_format(tooltipItem.yLabel);
                    }
                }
            }
        }
    });

    document.querySelector("#sendQueryVisitas").addEventListener("click", () => {
        const fechaInicioPrisioneros = document.querySelector("#fechaInicioPrisioneros");
        const fechaFinPrisioneros = document.querySelector("#fechaFinPrisioneros");
        const fechaInicio = document.querySelector("#fechaInicio");
        const fechaFin = document.querySelector("#fechaFin");


        fetch("/consulta-visitas?startDate=" + fechaInicio.value + "&endDate=" + fechaFin.value, )
            .then(res => res.json())
            .then(res => {
                console.log(res); // Muestra la respuesta en la consola
            })
            .catch(error => {
                console.error('Error:', error); // Maneja posibles errores
            });

    })

});
</script>