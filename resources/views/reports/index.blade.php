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
            href="{{route('exportar',['tipo'=>'prisioneros','option'=>'empty'])}}" style="width:100%"><i
                class="fas fa-download fa-sm text-white-50"></i>
            Generar lista
            de prisioneros</a>

        <a type="button" class="d-sm-inline-block btn btn-sm btn-primary shadow-sm mx-1 my-2"
            href="{{route('exportar',['tipo'=>'visitantes','option'=>'empty'])}}" style="width:100%"><i
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
                    <div class="py-3 d-flex flex-row align-items-center justify-content-center">
                        <h6 class="m-0 font-weight-bold text-primary">Visitas</h6>

                    </div>

                    <form action="">
                        <div class="d-sm-flex align-items-center justify-content-end">
                            <input type="date" name="fechaInicialVisitas" id="fechaInicialVisitas"
                                class="form-control mx-1 my-1" title="Fecha de inicio">
                            <input type="date" name="fechaFinalVisitas" id="fechaFinalVisitas"
                                class="form-control mx-1 my-1" title="Fecha final">
                        </div>

                    </form>

                </div>



                <!-- Card Body -->
                <div class="card-body">
                    <div class="chart-area">
                        <div class="row" id="download-container-visitas">
                            <div class="d-flex justify-content-center"><button type="button"
                                    class="btn btn-success my-1" id="excelVisitas" style="width:100%"><i
                                        class="fa-solid fa-download me-2"></i><strong>Descargar
                                        Excel</strong></button>
                            </div>
                            <div class="d-flex justify-content-center"><button type="button" class="btn btn-danger my-1"
                                    id="pdfVisitas" style="width:100%"><i class="fa-solid fa-download me-2"></i><strong
                                        class="me-1">Descargar
                                        PDF</strong></button>

                            </div>
                            <strong class="text-center text-danger" id="errorVisitas"></strong>
                        </div>
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
                    <div class="py-3 d-flex flex-row align-items-center justify-content-center">
                        <h6 class="m-0 font-weight-bold text-primary">Prisioneros</h6>

                    </div>

                    <form action="{{route('exportar',['prisioneros-rango','Excel'])}}">
                        <div class="d-sm-flex align-items-center justify-content-end">
                            <input type="date" name="fechaInicialPrisioneros" class="form-control mx-1 my-1"
                                id="fechaInicialPrisioneros" title="Fecha de inicio">
                            <input type="date" name="fechaFinalPrisioneros" class="form-control mx-1 my-1"
                                id="fechaFinalPrisioneros" title="Fecha final">

                        </div>

                    </form>

                </div>

                <!-- Card Body -->
                <div class="card-body">
                    <div class="chart-area">
                        <div class="row" id="download-container-prisioneros">
                            <div class="d-flex justify-content-center"><button type="button"
                                    class="btn btn-success my-1" id="excelPrisioneros" style="width:100%"><i
                                        class="fa-solid fa-download me-2"></i><strong>Descargar
                                        Excel</strong></button>
                            </div>
                            <div class="d-flex justify-content-center"><button type="button" class="btn btn-danger my-1"
                                    id="pdfPrisioneros" style="width:100%"><i
                                        class="fa-solid fa-download me-2"></i><strong class="me-1">Descargar
                                        PDF</strong></button></div>
                            <strong class="text-center text-danger" id="errorPrisioneros"></strong>
                        </div>

                    </div>
                </div>
            </div>
        </div>


    </div>


</section>
@endsection

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Botones
    const pdfVisitas = document.querySelector("#pdfVisitas");
    const excelVisitas = document.querySelector("#excelVisitas")
    const pdfPrisioneros = document.querySelector("#pdfPrisioneros");
    const excelPrisioneros = document.querySelector("#excelPrisioneros")

    // Error Message
    const errorPrisioneros = document.querySelector("#errorPrisioneros");
    const errorVisitas = document.querySelector("#errorVisitas")
    // Inputs
    const fechaInicialVisitas = document.querySelector("#fechaInicialVisitas");
    const fechaFinalVisitas = document.querySelector("#fechaFinalVisitas")
    const fechaInicialPrisioneros = document.querySelector("#fechaInicialPrisioneros");
    const fechaFinalPrisioneros = document.querySelector("#fechaFinalPrisioneros")

    pdfVisitas.addEventListener("click", () => {
        handleFetch('visitas', 'pdf');
    })
    excelVisitas.addEventListener("click", () => {
        handleFetch('visitas', 'xlsx');
    })
    pdfPrisioneros.addEventListener("click", () => {
        handleFetch('prisioneros-rango', 'pdf');
    })
    excelPrisioneros.addEventListener("click", () => {
        handleFetch('prisioneros-rango', 'xlsx');
    })
    const handleFetch = (option, option2) => {
        let startDate = '';
        let endDate = ''
        if (option == 'visitas') {
            startDate = fechaInicialVisitas.value;
            endDate = fechaFinalVisitas.value;
        } else {
            startDate = fechaInicialPrisioneros.value;
            endDate = fechaFinalPrisioneros.value;
        }
        fetch("/exportar/" + option + "/" + option2 + "?fechaInicial=" + startDate + "&fechaFinal=" +
                endDate)
            .then(res => {
                if (res.status == 200) {
                    return res.blob() // Convierte la respuesta en un Blob;
                }
                return res.json();
            })
            .then(res => {
                if (!res.error) {
                    // Crea un enlace para descargar el archivo
                    const url = window.URL.createObjectURL(res);
                    const a = document.createElement('a');
                    a.href = url;
                    a.download = option; // Nombre del archivo a descargar
                    document.body.appendChild(a);
                    a.click();
                    document.body.removeChild(a);
                    window.URL.revokeObjectURL(url); // Libera el objeto URL
                    errorVisitas.innerHTML = "";
                    errorPrisioneros.innerHTML = "";
                } else {
                    if (option == "visitas") {
                        errorVisitas.innerHTML = "";
                        Object.keys(res.error).forEach((item) => {
                            errorVisitas.innerHTML += `<li>${res.error[item][0]}</li>`;
                        })
                    } else {
                        errorPrisioneros.innerHTML = "";
                        Object.keys(res.error).forEach((item) => {
                            errorPrisioneros.innerHTML += `<li>${res.error[item][0]}</li>`;
                        })
                    }

                }
            })

    }



});
</script>