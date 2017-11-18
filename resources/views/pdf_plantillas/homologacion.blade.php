<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title>{{ $nombre_archivo }}</title>
        <!-- Estilos para la plantilla -->
        <link href="{{ asset('css/pdf/estilos.css') }}" rel="stylesheet">
    </head>
    <body>
        <div align="center">
            <table class="MsoNormalTable" border="1" cellspacing="3" cellpadding="3" width="100%" style="border-collapse:collapse;border:none;">
                <tr>
                    <td rowspan="4">
                      <p class="MsoHeader" align="center" style="text-align:center;">
                        <span style="font-size:8.0pt; color:gray; "> </span>
                        <img src="{{ asset('images/pdf/logo.jpg') }}" width="139" height="68" />
                      </p>
                    </td>
                    <td rowspan="2">
                      <p class="MsoNoSpacing" align="center" style="text-align:center;">
                          <strong>FORMATO DE ACTA DE ESTUDIO DE HOMOLOGACIÓN</strong>
                      </p>
                        <p class="MsoHeader" align="center" style="text-align:center;"><strong><span style="font-size:10.0pt; color:black; ">PROCEDIMIENTO: </span></strong><strong><span style="font-size:10.0pt; ">HOMOLOGACIONES</span></strong></p>
                        <p class="MsoNoSpacing" align="center" style="text-align:center;"><strong>&nbsp;</strong></p>
                    </td>
                    <td><p class="MsoHeader"><strong><span style="font-size:10.0pt; color:black; ">CÓDIGO: </span></strong><br><span style="font-size:10.0pt; color:black; ">F-HM-1</span></p></td>
                </tr>
                <tr>
                    <td rowspan="2"><p class="MsoHeader"><strong><span style="font-size:10.0pt; color:black; ">VERSIÓN: </span></strong><br><span style="font-size:10.0pt; ">1.1      13-07-2017</span></p></td>
                </tr>
                <tr>
                    <td rowspan="2">
                      <p class="MsoHeader" align="center" style="text-align:center;"><span style="font-family:'Tahoma',sans-serif; font-size:7.0pt; ">Institución    Educativa Superior con Personería Jurídica No. 1595 de febrero 28 de 2011, Sujeta    a Inspección y Vigilancia por el Ministerio de Educación Nacional</span></p>
                        <p class="MsoHeader" align="center" style="text-align:center;"><strong><span style="font-family:'Tahoma',sans-serif; font-size:7.0pt; ">NIT 900440771-2</span></strong></p></td>
                </tr>
                <tr>
                    <td>
                        <p class="MsoHeader">
                            <strong>
                                <span style="font-size:10.0pt; ">PÁGINAS: </span>
                            </strong>
                        </p>
                        <p class="MsoHeader"><span style="font-size:10.0pt; ">Página </span><span style="font-size:10.0pt; ">1</span><span style="font-size:10.0pt; "> de </span><span style="font-size:10.0pt; ">1</span><span style="font-size:10.0pt; "><span style="color:black; "> </span></span></p>
                    </td>
                </tr>
            </table>
        </div>
        <blockquote>
            <blockquote>
                <p align="center">&nbsp;</p>
                <p align="left">Rivera, {{ $meses[date('n')-1]." ".date('d')." de ".date('Y' )}} </p>
                <p align="center">Consecutivo  No. {{ $adenda->codigo }}<br />
                    Por  el cual se aprueban estudios de homologación</p>
                <p align="center">Considerando</p>
                <p align="center"><br>
                </p>
                <p align="justify">Que el Consejo Superior  Universitario mediante Acuerdo 011 del 17 de febrero de 2017 expidió el  Reglamento Estudiantil de la FUNDACIÓN ESCUELA TECNOLÓGICA DE NEIVA JESÚS  OVIEDO PEREZ, el cual en su artículo 55 establece que el Consejo Académico,  oficializará el resultado de los estudios de homologación.</p>
                <p align="center">Acuerda:</p>
                <p>Artículo primero: Aprobar el siguiente  estudio de homologación:</p>
                <div align="center">
                    <table width="100%" border="1">
                        <tr>
                            <td>Nombre    del Aspirante:</td>
                            <td>{{ $estudiante->nombres . ' ' .$estudiante->apellidos  }}</td>
                        </tr>
                        <tr>
                            <td>Tipo    y número de Documento:</td>
                            <td>CC {{ $estudiante->numIdent }}</td>
                        </tr>
                        <tr>
                            <td>Programa    al que aspira:</td>
                            <td>{{ $programa->nombre }}</td>
                        </tr>
                        <tr>
                            <td>Programa    de origen:</td>
                            <td>
                              @foreach ( $estudios as $i => $estudio )
                                @if($i > 0)
                                  -
                                @endif
                                {{ $estudio->nombre_carrera }}
                              @endforeach
                            </td>
                        </tr>
                        <tr>
                            <td>Institución    de origen:</td>
                            <td>
                              @foreach ( $estudios as $i => $estudio )
                                @if($i > 0)
                                  -
                                @endif
                                {{ $estudio->nombre_institucion }}
                              @endforeach
                            </td>
                        </tr>
                    </table>
                </div>
                <p align="left">&nbsp; </p>
                <p align="left">1 . ASIGNATURAS HOMOLOGADAS</p>
                <p align="left">&nbsp;</p>
                <div align="center">
                    <table width="100%" border="1" cellpadding="1" cellspacing="1">
                      <thead>
                        <tr>
                            <th><p align="center">ITEM</p></th>
                            <th><p align="center">ASIGNATURA</p></th>
                            <th><p align="center">SEMESTRE</p></th>
                            <th><p align="center">CREDITOS</p></th>
                            <th><p align="center">CALIFICACION</p></th>
                            <th><p align="center">CÓDIGO</p></th>
                        </tr>
                      </thead>
                      <tbody>
                        @foreach ($asignaturas as $i => $asignatura)
                          <tr>
                            <td>{{ $i + 1 }}</td>
                            <td>{{ $asignatura->nombre }}</td>
                            <td align="center">{{ $asignatura->semestre }}</td>
                            <td align="center">{{ $asignatura->creditos }}</td>
                            <td align="center">{{ $asignatura->nota }}</td>
                            <td>{{ $asignatura->cog_asignatura }}</td>
                          </tr>
                        @endforeach
                      </tbody>
                    </table>
                </div>
                <div>
                  <br><br>
                  <p align="justify" class="MsoNormal" style="text-align:justify;">Se homologan un total de ({{ count($asignaturas) }}) asignaturas correspondientes a ({{ $creditos }}) créditos  académicos y se registran con las calificaciones establecidas por la  institución que acredita el certificado de notas y/o puntuación, para efectos  de registro en plataforma.</p>
                  <p align="left">&nbsp;</p>
                </div>
                <p align="left">2 . DOCUMENTACIÓN</p>
                <p align="justify"> Para realizar este  estudio se analizaron los siguientes documentos expedidos por la institución: </p>
                <div align="justify">
                    <ul>
                      @foreach ($estudios as $i => $estudio)
                        <li>{{ $estudio->nombre_institucion . ', ' . $estudio->nombre_carrera }}</li>
                      @endforeach
                    </ul>
                </div>
                <ul>
                </ul>
                <p align="center">&nbsp;</p>
                <p align="justify">El  presente acuerdo rige a partir de la fecha de expedición.</p>
                <p align="center">COMUNÍQUESE  Y CÚMPLASE</p>
                <p align="center">&nbsp;</p>
                <p align="justify">Dado  en Rivera a los ({{ date('d') }}) días del mes {{ $meses[date('n')-1]." de ".date('Y' )}}</p>
                <p align="justify">&nbsp;</p>
                <br><br>
                <p align="justify">_____________________________________</p>
                <p align="justify"><strong>{{ $director->nombres .' '. $director->apellidos }}</strong><br />
                    Coordinador de Programa {{ $programa->nombre }}</p>
                <p align="justify">&nbsp;</p>
                <p align="justify">&nbsp;</p>
                <br><br>
                <p align="justify">_____________________________________</p>
                <p align="justify"><strong>JAIME  RIVERA CORTÉS</strong><br />
                    Vicerrector Académico</p>
                <p align="center">&nbsp;</p>
                <p align="center">&nbsp;</p>
                <p class="MsoFooter1" align="center" style="text-align:center;"><img src="{{ asset('images/pdf/raya.png') }}" alt="" width="709" height="1" /></p>
                <p class="MsoFooter1" align="center" style="text-align:center;"><em><span style="font-family:'Tahoma',sans-serif; font-size:7.0pt; color:#00B050; ">¡Agregando valor al desarrollo del Huila y el Sur Colombiano!</span></em></p>
                <p class="MsoFooter1" align="center" style="text-align:center;"><span style="font-family:'Tahoma',sans-serif; font-size:7.0pt; ">Km  11 vía al sur Teléfonos: 8600117 - 8603438 - 8703107</span></p>
                <p class="MsoFooter1" align="center" style="text-align:center;"><span style="font-family:'Tahoma',sans-serif; font-size:7.0pt; ">www.fet.edu.co</span></p>
                <p class="MsoFooter1" align="center" style="text-align:center;"><span style="font-family:'Tahoma',sans-serif; font-size:7.0pt; ">RIVERA  HUILA, COLOMBIA</span></p>
            </blockquote>
        </blockquote>
    </body>
</html>
