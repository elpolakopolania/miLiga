<div>        
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
        <table border="1" cellpadding="0" cellspacing="0" align="center">
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
    <p align="left">1 . ASIGNATURAS HOMOLOGADAS</p>
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
        <p align="justify" class="MsoNormal" style="text-align:justify;">Se homologan un total de ({{ count($asignaturas) }}) asignaturas correspondientes a ({{ $creditos }}) créditos  académicos y se registran con las calificaciones establecidas por la  institución que acredita el certificado de notas y/o puntuación, para efectos  de registro en plataforma.</p>
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
</div>