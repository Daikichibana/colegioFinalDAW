@extends('layouts.app')


@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">{{ Auth::user()->rol }}</div>
                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    @if (Auth::user()->rol == "Administrador")
                        <nav class="navbar navbar-expand-lg navbar-light bg-light">
                        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
                            <span class="navbar-toggler-icon"></span>
                        </button>
                        <div class="collapse navbar-collapse" id="navbarNavDropdown">
                            <ul class="navbar-nav">
                            <li class="nav-item active"  >
                                <a class="nav-link" href="#" @click="menu=0">Inicio <span class="sr-only">(current)</span></a>
                            </li>
                            <li class="nav-item" >
                                <a class="nav-link"  href="#" @click="menu=1">Calificaciones</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#" @click="menu=2">Inscripciones</a>
                            </li>
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                Gestion de cursos
                                </a>
                                <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                                    <a class="dropdown-item" href="#" @click="menu=3">Estudiante</a>
                                    <a class="dropdown-item" href="#" @click="menu=4">Apoderados</a>
                                    <a class="dropdown-item" href="#" @click="menu=5">Docentes</a>
                                    <a class="dropdown-item" href="#" @click="menu=6">Usuarios</a>
                                    <a class="dropdown-item" href="#" @click="menu=7">Gestion</a>
                                    <a class="dropdown-item" href="#" @click="menu=8">Apoderados</a>
                                    <a class="dropdown-item" href="#" @click="menu=9">Paralelo</a>
                                    <a class="dropdown-item" href="#" @click="menu=10">Bimestre</a>
                                    <a class="dropdown-item" href="#" @click="menu=11">Cursos</a>
                                    <a class="dropdown-item" href="#" @click="menu=12">Materia</a>
                                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    Armar Curso
                                    </a>
                                    <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                                        <a class="dropdown-item" href="#" @click="menu=13">Asignar Curso y Gestion</a>
                                        <a class="dropdown-item" href="#" @click="menu=14">Asignar Curso, Materia y Docente</a>
                                        <a class="dropdown-item" href="#" @click="menu=15">Asignar Curso y Estudiante</a>
                                    </div>
                                </div>
                            </li>
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                Gestion de Horarios
                                </a>
                                <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                                    <a class="dropdown-item" href="#" @click="menu=16">Aula</a>
                                    <a class="dropdown-item" href="#" @click="menu=17">Turno</a>
                                    <a class="dropdown-item" href="#" @click="menu=18">Horario</a>
                                    <a class="dropdown-item" href="#" @click="menu=19">Armar Horario</a>
                                </div>
                            </li>
                            
                            </ul>
                        </div>
                        </nav>
                    @endif

                    @if (Auth::user()->rol == "Estudiante")
                        <nav class="navbar navbar-expand-lg navbar-light bg-light">
                        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
                            <span class="navbar-toggler-icon"></span>
                        </button>
                        <div class="collapse navbar-collapse" id="navbarNavDropdown">
                            <ul class="navbar-nav">
                            <li class="nav-item active">
                                <a class="nav-link" href="#" @click="menu=20">Inicio <span class="sr-only">(current)</span></a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#" @click="menu=21">Consultar Calificacion</a>
                            </li>
                            </ul>
                        </div>
                        </nav>
                    @endif

                    @if (Auth::user()->rol == "Profesor")
                        <nav class="navbar navbar-expand-lg navbar-light bg-light">
                        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
                            <span class="navbar-toggler-icon"></span>
                        </button>
                        <div class="collapse navbar-collapse" id="navbarNavDropdown">
                            <ul class="navbar-nav">
                            <li class="nav-item active">
                                <a class="nav-link" href="#" @click="menu=22">Inicio <span class="sr-only">(current)</span></a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#" @click="menu=23">Ingresar Calificacion</a>
                            </li>
                            </ul>
                        </div>
                        </nav>
                    @endif
                   
                    <template v-if="menu==0">
                        <frmbienvenida></frmbienvenida>
                    </template>
                    <template v-if="menu==1">
                        <frmcalificacion></frmcalificacion>
                    </template>
                    <template v-if="menu==2">
                        <!-- -->
                        <frminscripcion></frminscripcion>
                    </template>
                    <template v-if="menu==3">
                        <!-- -->
                        <frmestudiante></frmestudiante>
                    </template>
                    <template v-if="menu==4">
                        <!-- -->
                        <frmapoderado></frmapoderado>
                    </template>
                    <template v-if="menu==5">
                        <!-- -->
                        <frmdocente></frmdocente>
                    </template>
                    <template v-if="menu==6">
                        <!-- -->
                        <frmusuarios></frmusuarios>
                    </template>
                    <template v-if="menu==7">
                        <!-- -->
                        <frmgestion></frmgestion>
                    </template>
                    <template v-if="menu==8">
                        <!-- -->
                        <frmapoderado></frmapoderado>
                    </template>
                    <template v-if="menu==9">
                        <!-- -->
                        <frmparalelo></frmparalelo>
                    </template>
                    <template v-if="menu==10">
                        <!-- -->
                        <frmbimestre></frmbimestre>
                    </template>
                    <template v-if="menu==11">
                        <!-- -->
                        <frmcursos></frmcursos>
                    </template>
                    <template v-if="menu==12">
                        <!-- -->
                        <frmmateria></frmmateria>
                    </template>
                    <template v-if="menu==13">
                        <!-- -->
                        <frmasignarcursogestion></frmasignarcursogestion>
                    </template>
                    <template v-if="menu==14">
                        <!-- -->
                        <frmasignarcursomateriadocente></frmasignarcursomateriadocente>
                    </template>
                    <template v-if="menu==15">
                        <!-- -->
                        <frmasignarcursoestudiante></frmasignarcursoestudiante>
                    </template>
                    <template v-if="menu==16">
                        <!-- -->
                        <frmaula></frmaula>
                    </template>
                    <template v-if="menu==17">
                        <!-- -->
                        <frmturno></frmturno>
                    </template>
                    <template v-if="menu==18">
                        <!-- -->
                        <frmhorario></frmhorario>
                    </template>
                    <template v-if="menu==19">
                        <!-- -->
                        <frmarmarhorario></frmarmarhorario>
                    </template>
                    <template v-if="menu==20">
                        <!-- -->
                        <frmbienvenida></frmbienvenida>
                    </template>
                    <template v-if="menu==21">
                        <!-- -->
                        <frmconsultarcalificacion></frmconsultarcalificacion>
                    </template>
                    <template v-if="menu==22">
                        <!-- -->
                        <frmbienvenida></frmbienvenida>
                    </template>
                    <template v-if="menu==23">
                        <!-- -->
                        <frmingresarcalificacion></frmingresarcalificacion>
                    </template>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection


