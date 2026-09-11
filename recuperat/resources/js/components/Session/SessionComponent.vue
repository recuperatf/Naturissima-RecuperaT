<template>
    <div class="container">
        <div class="row" id="print_view" v-if="prepareToPrint">
            <table class="table table-borderless">
                <tr>
                    <td colspan="3" style="text-align:center">
                        <img src="/medilab/assets/img/logo.png" alt="" style="height: auto; width: 50%;">
                    </td>
                <tr>
                <tr>
                    <td><strong>Fecha de emisión:</strong> {{new Date().toISOString().substring(0,10)}}</td>
                </tr>
                <tr>
                    <td>
                        <strong>Paciente:</strong>{{`${patient.name} ${patient.surname} ${patient.second_surname}`}}
                    </td>
                </tr>
                <tr>
                    <td>
                        <strong>Tratante:</strong> {{responsible.name}}
                    </td>
                </tr>
                <tr>
                    <td>
                        <strong>Cédula profesional:</strong> {{responsible.license}}
                    </td>
                </tr>
            </table>
            <div class="mt-n-5" v-for="objective in objectives.filter( e => objectiveToPrintIds.includes(e.id))" :key="objective.id">
                <table class="table table-borderless">
                    <tr>
                        <td colspan="3" style="text-align:left">
                            <h5>Objetivo: {{objective.name}}</h5>
                        </td>
                    </tr>
                </table>
                <table class="mt-n-5" style="margin-left: 30px;" width="95%">
                    <tr width="100%">
                        <td width="10%"><strong># de sesión</strong></td>
                        <td width="20%"><strong>Fecha</strong></td>
                        <td width="30%"><strong>Actividades</strong></td>
                        <td width="20%"><strong>Observaciones</strong></td>
                        <td width="20%"><strong>Fisioterapeuta</strong></td>
                    </tr>
                    <tr v-for="session in allSessions.filter(e => e.session_objective_id == objective.id)" :key="session.id">
                        <td width="10%">{{session.number_of_session}}</td>
                        <td width="20%">{{session.date}}</td>
                        <td width="30%">{{session.activities}}</td>
                        <td width="20%">{{session.observations}}</td>
                        <td width="20%">{{session.user_text}}</td>
                    </tr>
                </table>
            </div>
        </div>
        <!-- Button trigger modal -->
        <button v-if="!prepareToPrint" type="button" class="btn btn-primary" style="color: white" data-toggle="modal" data-target="#exampleModal">
        Ver sesiones pasadas
        </button>
        <multiselect :multiple="true" class="mb-2" v-model="objectivesToPrint" :options="objectives" placeholder="Objetivo" label="name" track-by="id"></multiselect>
        <button type="button" v-if="!prepareToPrint" @click="createDivPrint()" class="btn btn-primary">Imprimir</button>

        <!-- Modal -->
        <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                <button type="button" :disabled="this.activeSessionIndex == 0 || toggleEdit" @click="prev" class="btn btn-primary">Atras</button>
                <button type="button" v-if="!toggleEdit" @click="deleteSession(activeSession)" class="btn btn-danger">Borrar</button>
                <button type="button" v-if="!toggleEdit" @click="startEdition" class="btn btn-warning">Editar</button>
                <button type="button" v-else @click="updateSession" class="btn btn-primary">Guardar</button>
                <button type="button" :disabled="(this.activeSessionIndex == this.allSessions.length - 1) || toggleEdit" @click="next" class="btn btn-primary">Siguiente</button>
            </div>
            <div class="modal-body">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-12" v-if="!toggleEdit">
                            <ul v-if="activeSession">
                                <li>Número de sesión: {{activeSession.number_of_session}}</li>
                                <li>Fecha: {{activeSession.date.replace("T", ' ').replace("Z", "").split(".")[0]}}</li>
                                <li v-if="activeObjective">Objetivo: {{activeObjective.name}}</li>
                                <li>Actividades: {{activeSession.activities}}</li>
                                <li>Observaciones: {{activeSession.observations}}</li>
                                <li>Fisioterapeuta: {{activeSession.user_text}}</li>
                            </ul>
                        </div>
                        <div class="col-lg-12" v-else>
                            <ul v-if="activeSession">
                                <li>Número de sesión: <input type="text" class="form-control" v-model="edittingSession.number_of_session"></li>
                                {{edittingSession.date}}
                                <li>Fecha: <input type="datetime-local" class="form-control" v-model="edittingSession.date"></li>
                                <li>Objetivo: <multiselect class="mb-2" :multiple="false" v-model="editting_session_objective" :options="objectives" placeholder="Objetivo" label="name" track-by="id"></multiselect></li>
                                <li>Actividades: <input type="text" class="form-control" v-model="edittingSession.activities"></li>
                                <li>Observaciones: <input type="text" class="form-control" v-model="edittingSession.observations"></li>
                                <li>Fisioterapeuta: <input type="text" class="form-control" v-model="edittingSession.user_text"></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            </div>
        </div>
        </div>
        <div class="row" v-if="!prepareToPrint">
            <div class="col-6">
                <label for="numeroDeSession">Número de sesión</label>
                <input class="form-control" id="numeroDeSession" type="text" name="numeroDeSession" v-model="session.number_of_session"/>
            </div>
            <div class="col-6">
                <label for="date">Fecha</label>
                <input type="datetime-local" class="form-control" v-model="session.date">
                <button class="btn btn-primary" @click="addSessionObjective">+</button>
            </div>
            <div class="col-6">
                <label for="activities">Objetivo</label>
                <multiselect class="mb-2" :multiple="false" v-model="session_objective" :options="objectives" placeholder="Objetivo" label="name" track-by="id"></multiselect>
                <button class="btn btn-primary" @click="addSessionObjective">+</button>
            </div>
            <div class="col-6">
                <label for="activities">Actividades</label>
                <textarea class="form-control" id="activities" type="text" name="activities" v-model="session.activities"></textarea>
            </div>
            <div class="col-6">
                <label for="observations">Observaciones</label>
                <textarea class="form-control" id="observations" type="text" name="observations" v-model="session.observations"></textarea>
            </div>
            <div class="col-6">
                <label for="observations">Fisioterapeuta</label>
                <textarea class="form-control" id="observations" type="text" name="user_text" v-model="session.user_text"></textarea>
                <!-- <multiselect class="mb-2" :multiple="false" v-model="selectedUser" :options="users" placeholder="Terapeuta" label="name" track-by="name"></multiselect> -->
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <button class="btn btn-primary" @click="addSession">Agregar</button>
            </div>
        </div>
    </div>
</template>
<style src="vue-multiselect/dist/vue-multiselect.min.css"></style>
<style>
    td{
        word-wrap:break-word
    }
    table{
        table-layout: fixed;
    }
</style>
<script>
    import {Tabs, Tab} from 'vue-tabs-component';
    import Multiselect from 'vue-multiselect'
    import ENV from '../../env'
    export default {
        components: {
            Tabs, Tab, Multiselect
        },
        mounted () {
            this.getUsers()
            this.getObjectives()
            this.getSessions()
        },
        computed: {
            objectiveToPrintIds() {
                return this.objectivesToPrint.map( e => e.id)
            },
            activeSession () {
                return this?.allSessions?.[this.activeSessionIndex]
            },
            activePhisiotherapist () {
                const pid = this.activeSession?.user_id
                return this.users?.filter( user => user.id == pid)?.[0]
            },
            activeObjective () {
                const oid = this.activeSession?.session_objective_id
                return this.objectives?.filter( objective => objective.id == oid)?.[0]
            }
        },
        methods : {
            getPhysiotherapistName(id) {
                return this.users.filter(e => e.id == id)?.[0]?.name
            },
            createDivPrint () {
              this.prepareToPrint = true
              setTimeout(()=> {
                window.print()
                // this.prepareToPrint = false
              }, 1500)

            },
            deleteSession(item) {
                axios.delete(ENV.urlBase + `/sessions/${item.id}`).then(res => {
                    alert('Sesión eliminada')
                   this.allSessions = this.allSessions.filter( session => {
                        return session.id != res.data
                    } )
                })
            },
            startEdition() {
                this.toggleEdit = !this.toggleEdit
                this.edittingSession = this.activeSession
                this.editting_session_objective = this.objectives.filter((e) => e.id == this.activeSession.session_objective_id)
                this.edittingSelectedUser = this.users.filter((e) => e.id == this.activeSession.user_id)
            },
            prev() {
                if (this.activeSessionIndex != 0)
                    this.activeSessionIndex = this.activeSessionIndex - 1
            },
            next() {
                if (this.activeSessionIndex != this.allSessions.length - 1)
                    this.activeSessionIndex = this.activeSessionIndex + 1
            },
            getUsers() {
                axios.get(ENV.urlBase + '/users/ajaxAll').then((res) => {
                    this.users = res.data
                })
            },
            getObjectives() {
                axios.get(ENV.urlBase + `/session_objectives?clinical_history_id=${this.ch_id}`).then((res) => {
                    this.objectives = res.data
                })
            },
            getSessions() {
                axios.get(ENV.urlBase + `/sessions?clinical_history_id=${this.ch_id}`).then((res) => {
                    this.allSessions = res.data
                    this.activeSessionIndex = this.allSessions.length - 1
                })
            },
            addSession() {
                axios.post(ENV.urlBase + '/sessions', {
                    session: {...this.session,
                        session_objective_id: this.session_objective.id,
                        user_id: this?.selectedUser?.id,
                        clinical_history_id: this.ch_id
                    }
                }).then(res => {
                    alert('Sesión guardada con éxito.')
                    this.allSessions.push(res.data)
                    this.activeSessionIndex = this.allSessions.length - 1
                    this.initialize()
                })
            },
            updateSession() {
                axios.put(ENV.urlBase + `/sessions/${this.activeSession.id}`, {
                    session: {...this.edittingSession,
                        session_objective_id: this.editting_session_objective.id,
                        user_id: this.edittingSelectedUser?.id,
                        clinical_history_id: this.ch_id
                    }
                }).then(res => {
                    alert('Sesión guardada con éxito.')
                    this.allSessions = this.allSessions.map( session => {
                        if (session.id == this.activeSession.id)
                            return res.data
                        return session
                    })
                    this.toggleEdit = false
                })
            },
            addSessionObjective() {
                const name = prompt('Ingresa el nombre del objetivo')
                axios.post(ENV.urlBase + '/session_objectives', {
                    sessionObjective: {
                        name,
                        clinical_history_id: this.ch_id
                    }
                }).then(res => {
                    alert('Objetivo agregado')
                    this.objectives.push(res.data)
                })
            },
            initialize() {
                this.selectedUser = null
                this.session_objective = null
                this.session = {
                    session_objective_id: null,
                    number_of_session: null,
                    activities: null,
                    observations: null,
                    user_id: null,
                }
            },
        },
        props: ['ch_id', 'patient', 'responsible'],
        data () {
            return {
                objectivesToPrint: [],
                prepareToPrint: false,
                edittingSession: {
                    session_objective_id: null,
                    date: null,
                    number_of_session: null,
                    activities: null,
                    observations: null,
                    user_id: null,
                    user_text: null,
                    date: null
                },
                editting_session_objective: null,
                edittingSelectedUser: null,
                toggleEdit: false,
                allSessions: [],
                activeSessionIndex: 0,
                session_objective: null,
                selectedUser: null,
                session: {
                    session_objective_id: null,
                    number_of_session: null,
                    activities: null,
                    observations: null,
                    user_id: null,
                    user_text: null,
                },
                users: [],
                objectives: [],
            }
        },
    }
</script>

<style scoped>
.table-borderless,.table-borderless tr td {
    border: 0px !important;
}
#printable h4,h5{
  font-size: 12.5pt;
  font-weight: bold;
}
#printable strong{
  font-size: 12pt;
}
#printable p{
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

@media print{
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
    page-break-inside: avoid; /* or 'auto' */
  }
  #print_view h4,h5 {
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
    border:none !important;
    outline:none !important;
  }
  table {
    border: 2px solid black;
    margin-left: 20px;
    table-layout: fixed;
  }
  td{
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
.btn-primary {
    color: white
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
