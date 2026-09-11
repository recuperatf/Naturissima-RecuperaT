<template>
  <div class="container">
    <div class="row">
      <div>
        <h2>ANÁLISIS DE PUESTO</h2>
      </div>
    </div>
    <div class="row">
      <div class="col-12">
        <h3>Datos del trabajador</h3>
      </div>
      <div class="col-lg-6">
        <input type=text class="form-control" v-model="jobValoration.patient.name" placeholder="Nombre del trabajador" outlined/>
      </div>
      <div class="col-lg-6">
        <input type=text class="form-control" v-model="jobValoration.patient.surname" placeholder="Apellido del trabajador" outlined/>
      </div>
      <div class="col-lg-6">
        <input type=text class="form-control" v-model="jobValoration.patient.second_surname" placeholder="Segundo apellido del trabajador" outlined/>
      </div>
      <div class="col-lg-6">
        <input type=date class="form-control" v-model="jobValoration.patient.birth_date" placeholder="Fecha de nacimiento" outlined/>
      </div>
      <div class="col-lg-6">
        <select type=text class="form-control" v-model="jobValoration.patient.sex">
          <option value='' selected>Sexo</option>
          <option value="0">Hombre</option>
          <option value="1">Mujer</option>
          <option value="2">Otro</option>
        </select>
      </div>
    </div>
    <div class="row">
      <div class="col-12">
        <h3>Datos de la empresa</h3>
      </div>
      <div class="col-lg-6">
        <input type=text class="form-control" placeholder="Empresa" :value="workspace.laboral_company.name" disabled outlined/>
      </div>
      <div class="col-lg-6">
        <input type=text class="form-control" placeholder="Puesto de trabajo" disabled :value="workspace.name" outlined/>
      </div>
      <div class="col-lg-6">
        <input type=text class="form-control" v-model="department" placeholder="Departamento" outlined/>
      </div>
      <div class="col-lg-6">
        <input type=text class="form-control" v-model="work" placeholder="Tarea" outlined/>
      </div>
      <div class="col-lg-6">
        <input type=text class="form-control" v-model="asignation" placeholder="Asignación" outlined/>
      </div>
      <div class="col-lg-6">
        <textarea type=text class="form-control" v-model="equipment" placeholder="Maquinaria/Equipo"></textarea>
      </div>
      <div class="col-lg-6">
        <textarea type=text class="form-control" v-model="work_description" placeholder="Descripción de la tarea, fases de trabajo (1,2,3...)"></textarea>
      </div>
      <div class="col-lg-6">
        <label>Fotografía del puesto de trabajo</label>
        <input type="file" placeholder="Hola" />
      </div>
      <div class="col-lg-6">
        <label>Dibujo del puesto de trabajo</label>
        <input type="file" placeholder="Hola" />
      </div>
    </div>
    <div class="row">
      <h3>1 Puesto de trabajo (marcar deficiencias)</h3>
    </div>
    <div class="row">
      <div class="col-lg-6">
        <table>
          <tr>
            <td><label>Area horizontal</label></td>
            <input type=checkbox />
          </tr>
          <tr>
            <td><label>Altura de trabajo</label></td>
            <input type=checkbox />
          </tr>
          <tr>
            <td><label>Vista</label></td>
            <input type=checkbox />
          </tr>
          <tr>
            <td><label>Espacio piernas</label></td>
            <input type=checkbox />
          </tr>
          <tr>
            <td><label>Asientos</label></td>
            <input type=checkbox />
          </tr>
          <tr>
            <td><label>Herramientas</label></td>
            <input type=checkbox />
          </tr>
          <tr>
            <td><label>Otros equpos</label></td>
            <input type=checkbox />
          </tr>
        </table>
      </div>
      <div class="col-lg-12">
        <div class="row">
          <div class="col-lg-12">
            <textarea class="form-control" id="" placeholder="Observaciones"></textarea>
          </div>
          <div class="col-lg-6">
            <input type="number" class="form-control" placeholder="Analista">
          </div>
          <div class="col-lg-6">
            <input type="number" class="form-control" placeholder="Trabajador">
          </div>
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-lg-12">
        <h3>2 Actividad física general</h3>
      </div>
      <div class="col-lg-12">
        <div class="row">
          <div class="col-lg-12">
            <textarea class="form-control" id="" placeholder="Observaciones"></textarea>
          </div>
          <div class="col-lg-6">
            <input type="number" class="form-control" placeholder="Analista">
          </div>
          <div class="col-lg-6">
            <input type="number" class="form-control" placeholder="Trabajador">
          </div>
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-lg-12">
        <h3>3 Levantamiento de cargas</h3>
      </div>
      <div class="col-lg-12">
        Altura del levantamiento
      </div>
      <div class="col-lg-6">
        Normal <input type="checkbox">
        Bajo <input type="checkbox">
      </div>
      <div class="col-lg-6">
        N° de cargas levantadas
        <input type="number" class="form-control">
      </div>
      <div class="col-lg-12">
        <div class="row">
          <div class="col-lg-12">
            <textarea class="form-control" id="" placeholder="Condiciones del levantamiento"></textarea>
          </div>
          <div class="col-lg-6">
            <input type="number" class="form-control" placeholder="Analista">
          </div>
          <div class="col-lg-6">
            <input type="number" class="form-control" placeholder="Trabajador">
          </div>
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-lg-12">
        <h3>4 Posturas de trabajo y movimientos</h3>
      </div>
      <div class="col-lg-12">
        <div class="row">
          <div class="col-lg-4">
            Cuello-hombros
          </div>
          <div class="col-lg-5">
            <input type="text" class="form-control" placeholder="ratio" style="display:inline; width: 75px;">
            <input type="text" class="form-control" placeholder="Duración (h)" style="display:inline; width: 100px;">
            <input type="text" class="form-control" placeholder="ratio" style="display:inline; width: 75px;">
          </div>
        </div>
        <div class="row">
          <div class="col-lg-4">
            Codo-muñeca
          </div>
          <div class="col-lg-5">
            <input type="text" class="form-control" placeholder="ratio" style="display:inline; width: 75px;">
            <input type="text" class="form-control" placeholder="Duración (h)" style="display:inline; width: 100px;">
            <input type="text" class="form-control" placeholder="ratio" style="display:inline; width: 75px;">
          </div>
        </div>
        <div class="row">
        <div class="col-lg-4">
          Espalda
        </div>
          <div class="col-lg-5">
            <input type="text" class="form-control" placeholder="ratio" style="display:inline; width: 75px;">
            <input type="text" class="form-control" placeholder="Duración (h)" style="display:inline; width: 100px;">
            <input type="text" class="form-control" placeholder="ratio" style="display:inline; width: 75px;">
          </div>
        </div>
        <div class="row">
          <div class="col-lg-4">
            Caderas-piernas
          </div>
          <div class="col-lg-5">
            <input type="text" class="form-control" placeholder="ratio" style="display:inline; width: 75px;">
            <input type="text" class="form-control" placeholder="Duración (h)" style="display:inline; width: 100px;">
            <input type="text" class="form-control" placeholder="ratio" style="display:inline; width: 75px;">
          </div>
        </div>
      </div>
      <div class="col-lg-12">
        <div class="row">
          <div class="col-lg-12">
            <textarea class="form-control" id="" placeholder="Observaciones"></textarea>
          </div>
          <div class="col-lg-6">
            <input type="number" class="form-control" placeholder="Analista">
          </div>
          <div class="col-lg-6">
            <input type="number" class="form-control" placeholder="Trabajador">
          </div>
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-lg-12">
        <h3>6 Contenido del trabajo</h3>
      </div>
      <div class="col-lg-12">
        <div class="row">
          <div class="col-lg-12">
            <textarea class="form-control" id="" placeholder="Observaciones"></textarea>
          </div>
          <div class="col-lg-6">
            <input type="number" class="form-control" placeholder="Analista">
          </div>
          <div class="col-lg-6">
            <input type="number" class="form-control" placeholder="Trabajador">
          </div>
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-lg-12">
        <h3>7 Autonomía</h3>
      </div>
      <div class="col-lg-12">
        <div class="row">
          <div class="col-lg-12">
            <textarea class="form-control" id="" placeholder="Observaciones"></textarea>
          </div>
          <div class="col-lg-6">
            <input type="number" class="form-control" placeholder="Analista">
          </div>
          <div class="col-lg-6">
            <input type="number" class="form-control" placeholder="Trabajador">
          </div>
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-lg-12">
        <h3>8 Comunicación del trabajador y conf. personales</h3>
      </div>
      <div class="col-lg-12">
        <div class="row">
          <div class="col-lg-12">
            <textarea class="form-control" id="" placeholder="Observaciones"></textarea>
          </div>
          <div class="col-lg-6">
            <input type="number" class="form-control" placeholder="Analista">
          </div>
          <div class="col-lg-6">
            <input type="number" class="form-control" placeholder="Trabajador">
          </div>
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-lg-12">
        <h3>9 Toma de decisiones</h3>
      </div>
      <div class="col-lg-12">
        <div class="row">
          <div class="col-lg-12">
            <textarea class="form-control" id="" placeholder="Observaciones"></textarea>
          </div>
          <div class="col-lg-6">
            <input type="number" class="form-control" placeholder="Analista">
          </div>
          <div class="col-lg-6">
            <input type="number" class="form-control" placeholder="Trabajador">
          </div>
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-lg-12">
        <h3>10 Repetitividad del trabajo</h3>
      </div>
      <div class="col-lg-12">
        <div class="row">
          <div class="col-lg-12">
            <textarea class="form-control" id="" placeholder="Observaciones"></textarea>
          </div>
          <div class="col-lg-6">
            <input type="number" class="form-control" placeholder="Analista">
          </div>
          <div class="col-lg-6">
            <input type="number" class="form-control" placeholder="Trabajador">
          </div>
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-lg-12">
        <button class="btn btn-primary" @click="sendEvaluation">Actualizar</button>
      </div>
    </div>
  </div>
</template>

<script>
import axios from 'axios';
import ENV from '../../env';
export default {
  mounted() {
    this.jobValoration.workspace_id = this.workspace.id
    console.log(this.workspace)
  },
  methods: {
    sendEvaluation() {
      console.log('hola')
      axios.post(ENV.urlApiBase + '/job_analysis', this.jobValoration).then(res => {
        alert('Tu evaluación ha sido realizada')
      })
    }
  },
  props: ['workspace'],
  data () {
    return {
      jobValoration: {
        workspace_id: null,
        patient: {
          name: null,
          surname: null,
          second_surname: null,
          sex: ''
        },
        valoration_job_analysis_empresa: [
          {
            name: 'empresa',
            cie10_id: null,
            section: 'valoration_job_analysis_empresa_empresa',
            json_values: null
          }
        ]
      }
    }
  }
}
</script>

<style>

</style>