<!-- Extender plantilla -->
@extends('plantilla.app')

<!-- Título de la página -->
@section('titulo','Mi homologacion')

@section('cssLib')
<!-- Bootstrap Material Datetime Picker Css -->
<link href="{{ asset('plugins/bootstrap-material-datetimepicker/css/bootstrap-material-datetimepicker.css') }}" rel="stylesheet" />
<!-- Wait Me Css -->
<link href="{{ asset('plugins/waitme/waitMe.css') }}" rel="stylesheet" />
<!-- Bootstrap Select Css -->
<link href="{{ asset('plugins/bootstrap-select/css/bootstrap-select.css') }}" rel="stylesheet" />
<link href="{{ asset('plugins/jquery-datatable/skin/bootstrap/css/dataTables.bootstrap.css') }}" rel="stylesheet">
@endsection

@section('cssPag')
<!-- Estilo de el contenido -->
@endsection

@section('contenido')
<!-- Contenido de la página -->
<div class="block-header">
    <h2>Ver mi homologación</h2>
</div>
<form id="perfil" method="PATCH" action="{{ route('perfil.update', Auth::user()->id) }}">
  {{ csrf_field() }}
  <div class="row clearfix">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
          <div class="card">
              <div class="header">
                  <h2>Materias homologadas por Carlos Javier Pastrana</h2>
              </div>
              <div class="body">
                <div class="row">
                  <div class="col-md-12">
                    <div class="table-responsive">
                      <table class="table table-bordered table-striped table-hover" id="tb_notas">
                      <thead>
                        <tr>
                          <th>Item</th>
                          <th>Codigo</th>
                          <th>Asignatura</th>
                          <th>Semestre</th>
                          <th>Créditos</th>
                          <th>Nota</th>
                        </tr>
                      </thead>
                      <tbody>
                        <tr>
                        	<td>1</td><td>SOF1-02</td><td>ARQUITECTURA DE COMPUTADORES</td><td>I</td><td>2</td><td></td>
                        </tr>
                        <tr>
                        	<td>2</td><td>SOF1-04</td><td>CONSTITUCIÓN POLÍTICA</td><td>I</td><td>1</td><td></td>
                        </tr>
                        <tr>
                        	<td>3</td><td>SOF1-05</td><td>CULTURA AMBIENTAL</td><td>I</td><td>1</td><td></td>
                        </tr>
                        <tr>
                        	<td>4</td><td>SOF1-14</td><td>INGLÉS I</td><td>I</td><td>2</td><td></td>
                        </tr>
                        <tr>
                        	<td>5</td><td>SOF1-18</td><td>INTRODUCCIÓN A LA INFORMÁTICA</td><td>I</td><td>2</td><td>4.5</td>
                        </tr>
                        <tr>
                        	<td>6</td><td>SOF1-20</td><td>LEGISLACIÓN INFORMÁTICA</td><td>I</td><td>2</td><td>4.5</td>
                        </tr>
                        <tr>
                        	<td>7</td><td>SOF1-23</td><td>LIDERAZGO Y EMPRENDIMIENTO</td><td>I</td><td>2</td><td>4.5</td>
                        </tr>
                        <tr>
                        	<td>8</td><td>SOF1-24</td><td>LÓGICA MATEMÁTICA</td><td>I</td><td>3</td><td>4.5</td>
                        </tr>
                        <tr>
                        	<td>9</td><td>SOF1-31</td><td>TÉCNICA DE EXPRESIÓN ORAL </td><td>I</td><td>2</td><td>4.5</td>
                        </tr>
                        <tr>
                        	<td>10</td><td>SOF1-06</td><td>DIAGRAMACIÓN Y ALGORITMO</td><td>II</td><td>3</td><td>4.5</td>
                        </tr>

                        <tr>

                        <td>11</td><td>SOF1-08</td><td>ENSAMBLE Y MANTENIMIENTO DE COMPUTADORES I</td><td>II</td><td>2</td><td>4.5</td>

                        </tr>

                        <tr>

                        <td>12</td><td>SOF1-12</td><td>FÍSICA MECÁNICA</td><td>II</td><td>2</td><td>4.5</td>

                        </tr>

                        <tr>

                        <td>13</td><td>SOF1-15</td><td>INGLÉS II</td><td>II</td><td>2</td><td>4.5</td>

                        </tr>

                        <tr>

                        <td>14</td><td>SOF1-25</td><td>MATEMÁTICA FUNDAMENTAL</td><td>II</td><td>3</td><td>4.5</td>

                        </tr>

                        <tr>

                        <td>15</td><td>SOF1-28</td><td>SISTEMAS OPERATIVOS I (WINDOWS)</td><td>II</td><td>3</td><td>4.5</td>

                        </tr>

                        <tr>

                        <td>16</td><td>SOF1-30</td><td>TÉCNICA DE EXPRESIÓN ESCRITA</td><td>II</td><td>2</td><td>4.5</td>

                        </tr>

                        <tr>

                        <td>17</td><td>SOF1-01</td><td>ALGEBRA LINEAL</td><td>III</td><td>2</td><td></td>

                        </tr>

                        <tr>

                        <td>18</td><td>SOF1-33</td><td>ELECTIVA I</td><td>III</td><td>2</td><td></td>

                        </tr>

                        <tr>

                        <td>19</td><td>SOF1-07</td><td>ELECTRÓNICA BÁSICA</td><td>III</td><td>2</td><td></td>

                        </tr>

                        <tr>

                        <td>20</td><td>SOF1-09</td><td>LENGUAJE C (ENSAMBLE Y MANTENIMIENTO DE COMPUTADORES II)</td><td>III</td><td>2</td><td></td>

                        </tr>

                        <tr>

                        <td>21</td><td>SOF1-11</td><td>ESTRUCTURA DE DATOS </td><td>III</td><td>2</td><td></td>

                        </tr>

                        <tr>

                        <td>22</td><td>SOF1-16</td><td>INGLÉS III</td><td>III</td><td>2</td><td></td>

                        </tr>

                        <tr>

                        <td>23</td><td>SOF1-19</td><td>INTRODUCCIÓN A LAS BASES DE DATOS</td><td>III</td><td>2</td><td></td>

                        </tr>

                        <tr>

                        <td>24</td><td>SOF1-21</td><td>LENGUAJE DE PROGRAMACIÓN I</td><td>III</td><td>2</td><td></td>

                        </tr>

                        <tr>

                        <td>25</td><td>SOF1-29</td><td>SISTEMAS OPERATIVOS II (LINUX)</td><td>III</td><td>2</td><td></td>

                        </tr>

                        <tr>

                        <td>26</td><td>SOF1-03</td><td>CALCULO DIFERENCIAL</td><td>IV</td><td>2</td><td></td>

                        </tr>

                        <tr>

                        <td>27</td><td>SOF1-32</td><td>ELECTIVA DE FORMACIÓN COMPLEMENTARIA I</td><td>IV</td><td>2</td><td></td>

                        </tr>

                        <tr>

                        <td>28</td><td>SOF1-34</td><td>ELECTIVA II</td><td>IV</td><td>2</td><td></td>

                        </tr>

                        <tr>

                        <td>29</td><td>SOF1-10</td><td>ESTADÍSTICA </td><td>IV</td><td>2</td><td></td>

                        </tr>

                        <tr>

                        <td>30</td><td>SOF1-13</td><td>FUNDAMENTOS DE INVESTIGACIÓN</td><td>IV</td><td>2</td><td></td>

                        </tr>

                        <tr>

                        <td>31</td><td>SOF1-17</td><td>INGLÉS IV</td><td>IV</td><td>2</td><td></td>

                        </tr>

                        <tr>

                        <td>32</td><td>SOF1-22</td><td>LENGUAJE DE PROGRAMACIÓN II</td><td>IV</td><td>2</td><td></td>

                        </tr>

                        <tr>

                        <td>33</td><td>SOF1-26</td><td>MODELADO DE BASES DE DATOS </td><td>IV</td><td>2</td><td></td>

                        </tr>

                        <tr>

                        <td>34</td><td>SOF1-27</td><td>REDES Y COMUNICACIONES I</td><td>IV</td><td>2</td><td></td>

                        </tr>

                        <tr>

                        <td>35</td><td>SOF2-35</td><td>ADMINISTRACIÓN DE SISTEMAS DE INFORMACIÓN</td><td>V</td><td>2</td><td></td>

                        </tr>

                        <tr>

                        <td>36</td><td>SOF2-36</td><td>ANÁLISIS Y DISEÑO DE SISTEMAS DE INFORMACIÓN</td><td>V</td><td>2</td><td></td>

                        </tr>

                        <tr>

                        <td>37</td><td>SOF2-37</td><td>CALCULO INTEGRAL</td><td>V</td><td>3</td><td></td>

                        </tr>

                        <tr>

                        <td>38</td><td>SOF2-38</td><td>ELECTIVA TECNOLÓGICA I</td><td>V</td><td>2</td><td></td>

                        </tr>

                        <tr>

                        <td>39</td><td>SOF2-42</td><td>INGLÉS V</td><td>V</td><td>2</td><td></td>

                        </tr>

                        <tr>

                        <td>40</td><td>SOF2-44</td><td>MOTORES DE BASES DE DATOS</td><td>V</td><td>2</td><td></td>

                        </tr>

                        <tr>

                        <td>41</td><td>SOF2-72</td><td>PROBABILIDAD</td><td>V</td><td>2</td><td></td>

                        </tr>

                        <tr>

                        <td>42</td><td>SOF2-45</td><td>REDES Y COMUNICACIONES II</td><td>V</td><td>2</td><td></td>

                        </tr>

                        <tr>

                        <td>43</td><td>SOF2-73</td><td>ECUACIONES DIFERENCIALES</td><td>VI</td><td>2</td><td></td>

                        </tr>

                        <tr>

                        <td>44</td><td>SOF2-39</td><td>ELECTIVA TECNOLÓGICA II</td><td>VI</td><td>2</td><td></td>

                        </tr>

                        <tr>

                        <td>45</td><td>SOF2-40</td><td>GESTIÓN ADMINISTRATIVA (PLANEACIÓN Y ORGANIZACIÓN)</td><td>VI</td><td>2</td><td></td>

                        </tr>

                        <tr>

                        <td>46</td><td>SOF2-41</td><td>INGENIERÍA DE SOFTWARE I</td><td>VI</td><td>2</td><td></td>

                        </tr>

                        <tr>

                        <td>47</td><td>SOF2-74</td><td>INVESTIGACION DE OPERACIONES</td><td>VI</td><td>2</td><td></td>

                        </tr>

                        <tr>

                        <td>48</td><td>SOF2-43</td><td>LENGUAJE PROGRAMACIÓN III</td><td>VI</td><td>2</td><td></td>

                        </tr>

                        <tr>

                        <td>49</td><td>SOF2-46</td><td>SERVIDORES Y SERVICIOS</td><td>VI</td><td>2</td><td></td>

                        </tr>

                        <tr>

                        <td>50</td><td>SOF2-47</td><td>TEORÍA GENERAL DE SISTEMAS</td><td>VI</td><td>2</td><td></td>

                        </tr>

                        <tr>

                        <td>51</td><td>SOF3-55</td><td>ÉTICA PROFESIONAL</td><td>VII</td><td>2</td><td></td>

                        </tr>

                        <tr>

                        <td>52</td><td>SOF3-56</td><td>FORMULACIÓN Y EVALUACIÓN DE PROYECTOS</td><td>VII</td><td>2</td><td></td>

                        </tr>

                        <tr>

                        <td>53</td><td>SOF3-12</td><td>GESTIÓN ADMINISTRATIVA II (DIRECCIÓN – TALENTO HUMANO)</td><td>VII</td><td>3</td><td></td>

                        </tr>

                        <tr>

                        <td>54</td><td>SOF3-59</td><td>INGENIERÍA DE SOFTWARE II</td><td>VII</td><td>3</td><td></td>

                        </tr>

                        <tr>

                        <td>55</td><td>SOF3-63</td><td>MATEMÁTICAS ESPECIALES</td><td>VII</td><td>3</td><td></td>

                        </tr>

                        <tr>

                        <td>56</td><td>SOF3-66</td><td>SEGURIDAD INFORMÁTICA</td><td>VII</td><td>2</td><td></td>

                        </tr>

                        <tr>

                        <td>57</td><td>SOF3-68</td><td>SISTEMAS DISTRIBUIDOS</td><td>VII</td><td>2</td><td></td>

                        </tr>

                        <tr>

                        <td>58</td><td>SOF3-71</td><td>TELEMÁTICA</td><td>VII</td><td>2</td><td></td>

                        </tr>

                        <tr>

                        <td>59</td><td>SOF3-48</td><td>ANÁLISIS NUMÉRICO</td><td>VIII</td><td>3</td><td></td>

                        </tr>

                        <tr>

                        <td>60</td><td>SOF3-49</td><td>ARQUITECTURA DE SOFTWARE</td><td>VIII</td><td>3</td><td></td>

                        </tr>

                        <tr>

                        <td>61</td><td>SOF3-52</td><td>ELECTIVA PROFESIONAL I</td><td>VIII</td><td>2</td><td></td>

                        </tr>

                        <tr>

                        <td>62</td><td>SOF3-62</td><td>MATEMÁTICAS DISCRETAS</td><td>VIII</td><td>3</td><td></td>

                        </tr>

                        <tr>

                        <td>63</td><td>SOF3-65</td><td>PROGRAMACIÓN AVANZADA</td><td>VIII</td><td>3</td><td></td>

                        </tr>

                        <tr>

                        <td>64</td><td>SOF3-69</td><td>SISTEMAS EXPERTOS</td><td>VIII</td><td>2</td><td></td>

                        </tr>

                        <tr>

                        <td>65</td><td>SOF3-50</td><td>AUDITORÍA DE SISTEMAS</td><td>IX</td><td>2</td><td></td>

                        </tr>

                        <tr>

                        <td>66</td><td>SOF3-51</td><td>ECONOMÍA PARA INGENIEROS</td><td>IX</td><td>2</td><td></td>

                        </tr>

                        <tr>

                        <td>67</td><td>SOF3-53</td><td>ELECTIVA PROFESIONAL II</td><td>IX</td><td>2</td><td></td>

                        </tr>

                        <tr>

                        <td>68</td><td>SOF3-57</td><td>GERENCIA DE PROYECTOS SISTEMÁTICOS</td><td>IX</td><td>2</td><td></td>

                        </tr>

                        <tr>

                        <td>69</td><td>SOF3-60</td><td>INTELIGENCIA ARTIFICIAL</td><td>IX</td><td>2</td><td></td>

                        </tr>

                        <tr>

                        <td>70</td><td>SOF3-61</td><td>INVESTIGACIÓN E INNOVACIÓN TECNOLÓGICA</td><td>IX</td><td>2</td><td></td>

                        </tr>

                        <tr>

                        <td>71</td><td>SOF3-67</td><td>SIMULACIÓN</td><td>IX</td><td>3</td><td></td>

                        </tr>

                        <tr>

                        <td>72</td><td>SOF3-70</td><td>TELECOMUNICACIONES</td><td>IX</td><td>3</td><td></td>

                        </tr>

                        <tr>

                        <td>73</td><td>SOF3-54</td><td>ELECTIVA PROFESIONAL III</td><td>X</td><td>2</td><td></td>

                        </tr>

                        <tr>

                        <td>74</td><td>SOF3-64</td><td>PRÁCTICA PROFESIONAL</td><td>X</td><td>10</td><td></td>

                        </tr>

                        <tr>

                        <td>75</td><td>SOF3-XX</td><td>TRABAJO DE GRADO</td><td>X</td><td>6</td><td></td>

                        </tr>
                      </tbody>
                    </table>
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-12 align-right">
                    <a href="{{ url('homologar/descargar/' . encrypt(1)) }}" target="_blank" class="btn btn-success waves-effect">Ver pdf</a>
                  </div>
                </div>
              </div>
          </div>
      </div>
  </div>
</form>
<!-- #END# Basic Validation -->
@endsection

@section('jsLib')
<!-- Autosize Plugin Js -->
<script src="{{ asset('plugins/autosize/autosize.js') }}"></script>
<!-- Select Plugin Js -->
<script src="{{ asset('plugins/bootstrap-select/js/bootstrap-select.js') }}"></script>
<!-- Moment Plugin Js -->
<script src="{{ asset('plugins/momentjs/moment.js') }}"></script>
<!-- Bootstrap Material Datetime Picker Plugin Js -->
<script src="{{ asset('plugins/bootstrap-material-datetimepicker/js/bootstrap-material-datetimepicker.js') }}"></script>
<!-- Dropzone Plugin Js -->
<script src="{{ asset('plugins/file/file.js') }}"></script>
<!-- Jquery DataTable Plugin Js -->
<script src="{{ asset('plugins/jquery-datatable/jquery.dataTables.js') }}"></script>
<script src="{{ asset('plugins/jquery-datatable/skin/bootstrap/js/dataTables.bootstrap.js') }}"></script>
<script src="{{ asset('plugins/jquery-datatable/responsive/dataTables.responsive.min.js') }}"></script>
@endsection

<!-- Librerias JS -->
@section('jsPag')
  <script src="{{ asset('js/pages/validar/validar_index_homologacion.js') }}"></script>
@endsection
