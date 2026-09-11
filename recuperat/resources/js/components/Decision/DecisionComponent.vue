<template>
  <div class="container">
    <div class="row" v-if="!prepareToPrint">
      <div class="col-md-12">
        <button type="button" class="btn btn-primary sm" @click="preview">Vista Previa</button>
      </div>
    </div>
    <div class="row" id="print_view" v-if="prepareToPrint">
      <div class="col-md-12">
        <button type="button" class="btn btn-primary sm no-print" @click="createDivPrint">Imprimir</button>
      </div>
      <div class="col-lg-12" style="display: block">
        <div class="row text-center" v-if="prepareToPrint" style="display: block">
          <div class="col-lg-12 text-center">
            <table class="table table-bordered ml-1 rubric_table" style="width:100%;" v-if="hasUser">
              <tr>
                <td class="text-center">
                  <img src="/medilab/assets/img/logo.png" style="height: auto; width: 250px;" alt="recuperaT">
                </td>
                <td>Recupera-T fisioterapia, rehabilitación y nutrición</td>
                <td>Clave: {{ hpp.code }}</td>
              </tr>
              <tr>
                <td class="text-center" colspan="1">Programa fisioterapéutico en casa</td>
                <td class="text-center" colspan="1">Versión {{ hpp.version }}</td>
                <td class="text-center" colspan="1"></td>
              </tr>
              <tr>
                <td>{{ hpp.updated_at }}</td>
                <td>{{ hpp.name }}</td>
                <td>Páginas {{ hpp.pages }}</td>
              </tr>
              <tr>
                <td></td>
                <td>Elaboró: {{ hpp.made_by }}</td>
                <td>Revisó: {{ hpp.revised_by }}</td>
              </tr>
            </table>
          </div>
        </div>
        <div class="row" style="flex: column;">
          <div class="col-lg-12 text-center">
          </div>
        </div>
        <div class="row" style="flex: column;">
          <table style="width: 100%;" class="noborder">
            <td style="width:50%;" class="noborder" v-if="decision && decision.clinic">
              <h4>Clínica</h4>
              <p>{{ `${decision.clinic.name}` }}</p>
              <p>Dirección: {{ `${decision.clinic.street} ${decision.clinic.number}, Col. ${decision.clinic.street}` }}
              </p>
            </td>
            <td style="width:50%;" class="noborder" v-if="decision && decision.patient">
              <h4>Paciente</h4>
              <p>{{ `${decision.patient.name} ${decision.patient.surname} ${decision.patient.second_surname}` }}</p>
              <p>Fecha de Nacimiento: {{ decision.patient.birth_date }}</p>
              <p>Ocupación: {{ decision.patient.occupation }}</p>
              <p>Sexo: {{ decision.patient.sex == 0 ? 'Masculino' : 'Femenino' }}</p>
              <p>Teléfono: {{ decision.patient.telephone }}</p>
            </td>
          </table>
        </div>
      </div>
      <div class="col-lg-12">
        <div class="row pl-2" v-if="hpp && hpp.anato_physiology_glosary_item">
          <div class="col-lg-12">
            <h3>Categoría anatómica/fisiológica</h3>
            <p>{{ hpp.anato_physiology_glosary_item.name }}</p>
          </div>
        </div>
        <div class="row pl-2" v-if="hpp.keywords">
          <div class="col-lg-12">
            <h3>Palabras Clave</h3>
            <ul>
              <li v-for="keyword in hpp.keywords" :key="keyword.id">
                {{ keyword.name }}
              </li>
            </ul>
          </div>
        </div>
        <div class="row pl-2">
          <div class="col-lg-12">
            <h3>Ejercicios</h3>
          </div>
        </div>
        <div class="row">
          <div class="col-lg-12" v-for="exerciseKey in Object.keys(sortedExercises)" :key="exerciseKey.id">
            <div class="row">
              <div class="col-lg-12">
                <h4 class="pl-2">{{ exerciseKey }}</h4>
              </div>
            </div>
            <div class="row" v-for="exercise in sortedExercises[exerciseKey]" :key="exercise.id">
              <table style="width: 97%" class="table">
                <td width="30%">
                  <img v-for="resource in exercise.image_resources" width="100%" height="auto"
                    :src="`/storage/${resource.url}`" :key="resource.id" />
                </td>
                <td width="70%">
                  <p><strong>{{ exercise.name }}</strong></p>
                  <p style="white-space: pre-line;">{{ exercise.description }}</p>
                </td>
              </table>
            </div>
          </div>
        </div>
        <br>
        <br>
        <div class="row pl-2">
          <div class="col-lg-12">
            <h3>Videos</h3>
          </div>
        </div>
        <div class="row pl-2" v-for="massage in hpp.massage" :key="massage.id">
          <div class="col-lg-12">
            <p>{{ linkify(massage.name) }}</p>
            <div class="row" v-if="massage && massage.url">
              <div class="col-lg-12">
                <img width="auto" height="200px" :src="`/storage/${massage.url}`" />
              </div>
            </div>
          </div>
        </div>
        <br>
        <br>
        <div class="row pl-2">
          <div class="col-lg-12">
            <h3>Agentes físicos</h3>
          </div>
        </div>
        <div class="row pl-2" v-for="physical_agent in hpp.physical_agent" :key="physical_agent.id">
          <div class="col-lg-12">
            <p><strong>Descripción: </strong>{{ physical_agent.description }}</p>
            <p><strong>Indicación: </strong>{{ physical_agent.pivot.indication }}</p>
            <p><strong>Precauciones: </strong>{{ physical_agent.pivot.precautions }}</p>
          </div>
        </div>
        <br>
        <br>
        <div class="row pl-2">
          <div class="col-lg-12">
            <h3>Medicamentos</h3>
          </div>
        </div>
        <div class="row pl-2" v-for="prescription in hpp.prescription" :key="prescription.id">
          <div class="col-lg-12">
            <p><strong>Medicamento: </strong>{{ prescription.description }}</p>
            <p><strong>Indicación: </strong>{{ prescription.pivot.indication }}</p>
            <p><strong>Precauciones: </strong>{{ prescription.pivot.precautions }}</p>
          </div>
        </div>
        <br>
        <br>
        <div class="row pl-2">
          <div class="col-lg-12">
            <h3>Contraindicaciones</h3>
          </div>
        </div>
        <div class="row pl-2">
          <div class="col-lg-12">
            <div v-for="contraindication in hpp.contraindication" :key="contraindication.id">
              <p style="white-space: pre-wrap;">{{ contraindication.description }}</p>
            </div>
          </div>
        </div>
        <br>
        <br>
        <div class="row pl-2">
          <div class="col-lg-12">
            <h3>Bibliografía</h3>
          </div>
        </div>
        <div class="row pl-2">
          <div class="col-lg-12">
            <p style="white-space: pre-wrap;">{{ hpp.bibliography }}</p>
          </div>
        </div>
      </div>
    </div>
    <div class="row" v-if="!prepareToPrint">
      <div class="col-md-12">
        <div>
          <tabs :options="{ useUrlFragment: false }" @clicked="tabClicked" @changed="tabChanged">
            <tab name="Ejercicios" v-if="hpp.exercise && hpp.exercise.length > 0">
              <exercise-tab-component :exercises="hpp.exercise"></exercise-tab-component>
            </tab>
            <tab name="Videos" v-if="hpp.massage && hpp.massage.length > 0">
              <massage-tab-component :massages="hpp.massage"></massage-tab-component>
            </tab>
            <tab name="Medios Físicos" v-if="hpp.physical_agent && hpp.physical_agent.length > 0">
              <physical-method-tab-component :physical-methods="hpp.physical_agent"></physical-method-tab-component>
            </tab>
            <tab name="Medicamentos" v-if="hpp.prescription && hpp.prescription.length > 0">
              <medicament-tab-component :prescriptions="hpp.prescription"></medicament-tab-component>
            </tab>
            <tab name="Contraindicaciones" v-if="hpp.contraindication && hpp.contraindication.length > 0">
              <contraindication-tab-component
                :contraindications="hpp.contraindication"></contraindication-tab-component>
            </tab>
          </tabs>
        </div>
      </div>
    </div>
  </div>
</template>
<script>
import ENV from '../../env'
import { Tabs, Tab } from 'vue-tabs-component';
Vue.component('exercise-tab-component', require('./ExerciseTabComponent.vue').default);
Vue.component('massage-tab-component', require('./MassageTabComponent.vue').default);
Vue.component('physical-method-tab-component', require('./PhysicalMethodTabComponent.vue').default);
Vue.component('medicament-tab-component', require('./MedicamentTabComponent.vue').default);
Vue.component('contraindication-tab-component', require('./ContraindicationTabComponent.vue').default);
export default {
  components: {
    Tabs, Tab
  },
  created: function () {
    axios.get(ENV.urlApiHFPBase + '/' + this.hppId).then(this.setHpp);
  },
  methods: {
    linkify(inputText) {
      var replacedText, replacePattern1, replacePattern2, replacePattern3;

      //URLs starting with http://, https://, or ftp://
      replacePattern1 = /(\b(https?|ftp):\/\/[-A-Z0-9+&@#\/%?=~_|!:,.;]*[-A-Z0-9+&@#\/%=~_|])/gim;
      replacedText = inputText.replace(replacePattern1, '<a href="$1" target="_blank">$1</a>');

      //URLs starting with "www." (without // before it, or it'd re-link the ones done above).
      replacePattern2 = /(^|[^\/])(www\.[\S]+(\b|$))/gim;
      replacedText = replacedText.replace(replacePattern2, '$1<a href="http://$2" target="_blank">$2</a>');

      //Change email addresses to mailto:: links.
      replacePattern3 = /(([a-zA-Z0-9\-\_\.])+@[a-zA-Z\_]+?(\.[a-zA-Z]{2,6})+)/gim;
      replacedText = replacedText.replace(replacePattern3, '<a href="mailto:$1">$1</a>');

      return replacedText;
    },
    preview() {
      this.prepareToPrint = true
    },
    createDivPrint() {
      setTimeout(() => {
        window.print()
        this.prepareToPrint = false
      }, 500)
    },
    setHpp: function (response) {
      this.hpp = response.data;
      let sortedExercises = { 'Sin categoría': [] }
      this.hpp.exercise.map(exercise => {
        if (exercise.exercise_division && !sortedExercises[exercise.exercise_division['name']]) {
          sortedExercises[exercise.exercise_division['name']] = []
        }
        if (!exercise.exercise_division) {
          sortedExercises['Sin categoría'].push(exercise)
        } else {
          sortedExercises[exercise.exercise_division['name']].push(exercise)
        }
      })
      if (sortedExercises['Sin categoría'].length == 0) {
        delete sortedExercises['Sin categoría']
      }
      this.sortedExercises = sortedExercises
    },
    tabClicked(selectedTab) {
      console.log('Current tab re-clicked:' + selectedTab.tab.name);
    },
    tabChanged(selectedTab) {
      console.log('Tab changed to:' + selectedTab.tab.name);
    },
  },
  data: function () {
    return {
      prepareToPrint: false,
      sortedExercises: {},
      hpp: {}
    }
  },
  props: ['hppId', 'decision', 'hasUser']
}
</script>

<style scoped>
.pl-2 {
  padding-left: 2px;
}

#printable h4,
h5 {
  font-size: 12.5pt;
  font-weight: bold;
}

#printable strong {
  font-size: 12pt;
}

#printable p {
  font-size: 11pt;
}

.tabs-component {
  margin: 4em 0;
}

.tabs-component-tabs {
  border: solid 1px #ddd;
  border-radius: 6px;
  margin-bottom: 5px;
}

@media print {
  .no-print {
    display: none;
  }

  .col-lg-12,
  .col-md-12,
  .row,
  .container {
    display: block;
    float: none;
  }

  div {
    overflow: hidden;
  }

  #print_view {
    background-color: white;
    width: 100%;
    position: absolute;
    top: 0;
    left: 0;
    margin: 0;
    padding: 15px;
    font-size: 14px;
    line-height: 18px;
    z-index: 100000;
    page-break-after: always;
  }

  img {
    page-break-inside: avoid;
    /* or 'auto' */
  }

  #print_view h4,
  h5 {
    font-size: 12.5pt;
    font-weight: bold;
  }

  #print_view h3 {
    font-size: 15pt;
    font-weight: bold;
  }

  table {
    border: 2px solid black;
    margin-left: 20px;
    table-layout: fixed;
  }

  td tr {
    border: 2px solid black;
  }
}

div {
  overflow: hidden;
}

#print_view {
  background-color: white;
  width: 100%;
  position: absolute;
  top: 0;
  left: 0;
  margin: 0;
  padding: 15px;
  font-size: 14px;
  line-height: 18px;
  z-index: 100000;
  page-break-after: always;
}

.noborder {
  border: 0px !important;
  border-collapse: collapse !important;
  border: none !important;
  outline: none !important;
}

table {
  border: 2px solid black;
  margin-left: 20px;
  table-layout: fixed;
}

td {
  border: 2px solid black !important;
}

@media (min-width: 700px) {

  .tabs-component-tabs {
    border: 0;
    align-items: stretch;
    display: flex;
    justify-content: flex-start;
    margin-bottom: -1px;
  }
}

.tabs-component-tab {
  color: #999;
  font-size: 14px;
  font-weight: 600;
  margin-right: 0;
  list-style: none;
}

.tabs-component-tab:not(:last-child) {
  border-bottom: dotted 1px #ddd;
}

.tabs-component-tab:hover {
  color: #666;
}

.tabs-component-tab.is-active {
  color: #000;
}

.tabs-component-tab.is-disabled * {
  color: #cdcdcd;
  cursor: not-allowed !important;
}

@media (min-width: 700px) {
  .tabs-component-tab {
    background-color: #fff;
    border: solid 1px #ddd;
    border-radius: 3px 3px 0 0;
    margin-right: .5em;
    transform: translateY(2px);
    transition: transform .3s ease;
  }

  .tabs-component-tab.is-active {
    border-bottom: solid 1px #fff;
    z-index: 2;
    transform: translateY(0);
  }
}

.tabs-component-tab-a {
  align-items: center;
  color: inherit;
  display: flex;
  padding: .75em 1em;
  text-decoration: none;
}

.tabs-component-panels {
  padding: 4em 0;
}

@media (min-width: 700px) {
  .tabs-component-panels {
    border-top-left-radius: 0;
    background-color: #fff;
    border: solid 1px #ddd;
    border-radius: 0 6px 6px 6px;
    box-shadow: 0 0 10px rgba(0, 0, 0, .05);
    padding: 4em 2em;
  }
}
</style>
