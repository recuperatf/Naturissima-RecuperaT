<template>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h2>Programa fisioterapéutico en casa</h2>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <input type="text" :disabled="hfp.is_sealed" class="form-control" placeholder="Nombre" v-model="hfp.name">
                <button type="button" v-if="!hfp.is_sealed" class="btn btn-primary" @click="changeName()">Cambiar nombre</button>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <input type="text" :disabled="hfp.is_sealed" class="form-control" placeholder="Páginas" v-model="hfp.pages">
                <button type="button" v-if="!hfp.is_sealed" class="btn btn-primary" @click="changePages()">Cambiar páginas</button>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <input type="text" :disabled="hfp.is_sealed" class="form-control" placeholder="Clave" v-model="hfp.code">
                <button type="button" v-if="!hfp.is_sealed" class="btn btn-primary" @click="changeCode()">Cambiar clave</button>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <input type="text" :disabled="hfp.is_sealed" class="form-control" placeholder="Versión" v-model="hfp.version">
                <button type="button" v-if="!hfp.is_sealed" class="btn btn-primary" @click="changeVersion()">Cambiar versión</button>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <input type="text" :disabled="hfp.is_sealed" class="form-control" placeholder="Elaborado por" v-model="hfp.made_by">
                <button type="button" v-if="!hfp.is_sealed" class="btn btn-primary" @click="changeMadeBy()">Cambiar elaborado por</button>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <input type="text" :disabled="hfp.is_sealed" class="form-control" placeholder="Revisado por" v-model="hfp.revised_by">
                <button type="button" v-if="!hfp.is_sealed" class="btn btn-primary" @click="changeRevisedBy()">Cambiar revisado por</button>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <h4><strong>Categoría Anatomica/Fisiológica</strong></h4>
                <multiselect :disabled="hfp.is_sealed" class="mb-2" :multiple="false" v-model="hfp.glosary_ap" :options="glosary_ap" placeholder="Categoria anatomica/fisiológica" label="label" track-by="id"></multiselect>
                <a type="button" class="btn btn-primary" href="/anato_physiology_glosary_item/create" target="_blank"><i class="fas fa-plus"></i></a>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <h4><strong>Palabras clave</strong></h4>
                <multiselect :disabled="hfp.is_sealed" class="mb-2" :multiple="true" v-model="hfp.keywords" :options="keywords" placeholder="Palabras Clave" label="name" track-by="id"></multiselect>
                <a type="button" class="btn btn-primary" href="/keywords/create" target="_blank"><i class="fas fa-plus"></i></a>
            </div>
        </div>
            <exercise-form :isSealed="hfp.is_sealed" :key="updateExercise" @onExerciseCategoryAdded="onExerciseCategoryAdded" @onExerciseDeleted = "onExerciseDeleted" @onExerciseImageRemoved = "onExerciseImageRemoved" @onExerciseAdded = "addExercise" @onExerciseEditted = "onExerciseEditted" :exercises = "hfp.exercises" :exercise_divisions = "hfp.exercise_divisions"></exercise-form>
            <massage-form :isSealed="hfp.is_sealed" @onMassageDeleted = "onMassageDeleted" @onMassageRemoved = "onMassageRemoved" @onMassageAdded = "addMassage" @onMassageEditted = "onMassageEditted" :massages = "hfp.massages"></massage-form>
            <physical-agent-form :isSealed="hfp.is_sealed" @onPhysicalAgentDeleted = "onPhysicalAgentDeleted" @onPhysicalAgentRemoved = "onPhysicalAgentRemoved" @onPhysicalAgentAdded = "addPhysicalAgent" @onPhysicalAgentEditted = "onPhysicalAgentEditted" :physical_agents = "hfp.physical_agents"></physical-agent-form>
            <prescription-form :isSealed="hfp.is_sealed" @onPrescriptionDeleted = "onPrescriptionDeleted" @onPrescriptionRemoved = "onPrescriptionRemoved" @onPrescriptionAdded = "addPrescription" @onPrescriptionEditted = "onPrescriptionEditted" :prescriptions = "hfp.prescriptions"></prescription-form>
            <contraindication-form :isSealed="hfp.is_sealed" @onContraindicationDeleted = "onContraindicationDeleted" @onContraindicationAdded = "addContraindication" @onContraindicationEditted = "onContraindicationEditted" :contraindications = "hfp.contraindications"></contraindication-form>
            <hr>
        <div class="row">
            <div class="col-lg-12">
                <h5><strong>Bibliografía</strong></h5>
                <textarea :disabled="hfp.is_sealed"  rows=4 class="form-control" v-model="hfp.bibliography" placeholder="Bibliogafía"></textarea>
                <button type="button" v-if="!hfp.is_sealed" class="btn btn-primary" @click="changeBibliography()">Cambiar bibliografía</button>
            </div>
        </div>
        <v-row>
            <v-col>
                <h2>DUBLIN CORE</h2>
                <input type="text" class="mb-3 form-control" :disabled="hfp.is_sealed" v-model="hfp.abstract" placeholder="Resumen"/>
                <input type="text" class="mb-3 form-control" :disabled="hfp.is_sealed" v-model="hfp.description" placeholder="Descripción"/>

                <input type="text" class="mb-3 form-control" :disabled="hfp.is_sealed" v-model="hfp.source" placeholder="DC.Tema"/>
                <input type="text" class="mb-3 form-control" :disabled="hfp.is_sealed" v-model="hfp.language" placeholder="DC.Idioma"/>
                <input type="text" class="mb-3 form-control" :disabled="hfp.is_sealed" v-model="hfp.relation" placeholder="DC.Relación"/>
                <input type="text" class="mb-3 form-control" :disabled="hfp.is_sealed" v-model="hfp.coverage" placeholder="DC.Cobertura"/>
                <input type="text" class="mb-3 form-control" :disabled="hfp.is_sealed" v-model="hfp.publisher" placeholder="DC.Editor"/>
                <input type="text" class="mb-3 form-control" :disabled="hfp.is_sealed" v-model="hfp.contributor" placeholder="DC.Colaboradores"/>
                <input type="text" class="mb-3 form-control" :disabled="hfp.is_sealed" v-model="hfp.rights" placeholder="DC.Derechos"/>
                <input type="text" class="mb-3 form-control" :disabled="hfp.is_sealed" v-model="hfp.date" placeholder="DC.Fecha"/>
                <input type="text" class="mb-3 form-control" :disabled="hfp.is_sealed" v-model="hfp.type" placeholder="DC.Tipo"/>
                <input type="text" class="mb-3 form-control" :disabled="hfp.is_sealed" v-model="hfp.format" placeholder="DC.Formato"/>
                <input type="text" class="mb-3 form-control" :disabled="hfp.is_sealed" v-model="hfp.identifier" placeholder="DC.Identificador"/>

                <input type="text" class="mb-3 form-control" :disabled="hfp.is_sealed" v-model="hfp.creator" placeholder="Creador"/>
                <input type="text" class="mb-3 form-control" :disabled="hfp.is_sealed" v-model="hfp.date_issued" placeholder="Fecha de emisión"/>
                <input type="text" class="mb-3 form-control" :disabled="hfp.is_sealed" v-model="hfp.latest_version" placeholder="Última Versión"/>
                <input type="text" class="mb-3 form-control" :disabled="hfp.is_sealed" v-model="hfp.version_history" placeholder="Historial de versiones"/>
                <input type="text" class="mb-3 form-control" :disabled="hfp.is_sealed" v-model="hfp.document_status" placeholder="Estatus del documento"/>
                <input type="text" class="mb-3 form-control" :disabled="hfp.is_sealed" v-model="hfp.doi" placeholder="DOI"/>
            </v-col>
        </v-row>
        <div class="row">
            <div class="col-lg-12">
                <input type="checkbox" @click="changeSeal" :disabled="hfp.is_sealed" v-model="hfp.is_sealed"/>
                <label>Sellado</label>
            </div>
            <div class="col-lg-12" v-if="is_admin">
                <button class="btn btn-warning" @click="createNewVersion">Nueva version</button>
            </div>
        </div>
    </div>
</template>
<style src="vue-multiselect/dist/vue-multiselect.min.css"></style>
<script>
    import Multiselect from 'vue-multiselect'
    import ENV from '../../env'
    // register globally
    Vue.component('exercise-form', require('./ExerciseForm.vue').default);
    Vue.component('massage-form', require('./MassageForm.vue').default);
    Vue.component('physical-agent-form', require('./PhysicalAgentForm.vue').default);
    Vue.component('prescription-form', require('./PrescriptionForm.vue').default);
    Vue.component('contraindication-form', require('./ContraindicationForm.vue').default);
    export default {
        components: { Multiselect },
        props: ['id', 'is_admin', 'new_version_path'],
        mounted() {
            console.log('ENV.urlApiHFPBase', ENV.urlApiHFPBase)
        },
        created : function () {
            if (!this.id) {
                const name = prompt("Introduce el nombre del nuevo ejercicio");
                const data = {
                    name : name
                };
                axios.post(ENV.urlApiHFPBase, data).then(
                    this.setHfp
                );
            } else {
                axios.get(ENV.urlApiHFPBase + '/' + this.id).then(this.setHfp);
            }
            axios.get(ENV.urlBase + '/keywords/ajaxGet/').then(
                (keywords) => {
                    this.keywords = keywords.data.map(keyword => {
                        keyword.name = keyword.label
                        return keyword
                    })
                }
            );
            axios.get(ENV.urlBase + '/anato_physiology_glosary_item/ajaxGet/').then(
                (res) => {
                    this.glosary_ap.label = res.data.name
                    this.glosary_ap = res.data
                }
            );
        },
        watch: {
            'hfp.keywords' : function () {
                const url = `${ENV.urlApiHFPBase}/${this.hfp.id}/keywords`
                axios.post(url, {keywords: this.hfp.keywords})
            },
            'hfp.glosary_ap' : function () {
                const url = `${ENV.urlApiHFPBase}/${this.hfp.id}/glosary_ap`
                axios.post(url, {glosary_ap: this.hfp.glosary_ap})
            }
        },
        methods : {
            createNewVersion() {
                window.open(this.new_version_path, '_blank')
            },
            changeSeal() {
                const url = `${ENV.urlApiHFPBase}/${this.id}`
                if (confirm('¿Estás seguro de que deseas sellar este programa?')) {
                    this.hfp.is_sealed = true
                    axios.put(url, {is_sealed: this.hfp.is_sealed}).then(() => {
                        alert ('Programa sellado con éxito')
                        window.location.href('/home_physiotherapy_program')
                    })
                }
            },
            changeBibliography () {
                const url = `${ENV.urlApiHFPBase}/${this.id}`
                if (this.hfp.name.length > 0) {
                    axios.put(url, {bibliography: this.hfp.bibliography}).then(() => {
                        alert ('Bibliografía cambiada con éxito')
                    })
                }
            },
            changeName : function () {
                const url = `${ENV.urlApiHFPBase}/${this.id}`
                if (this.hfp.name.length > 0) {
                    axios.put(url, {name: this.hfp.name}).then(() => {
                        alert ('Nombre cambiado con éxito')
                    })
                }
            },
            changePages () {
                const url = `${ENV.urlApiHFPBase}/${this.id}`
                if (this.hfp.pages.length > 0) {
                    axios.put(url, {pages: this.hfp.pages}).then(() => {
                        alert ('Número de páginas ha cambiado con éxito')
                    })
                }
            },
            changeCode () {
                const url = `${ENV.urlApiHFPBase}/${this.id}`
                if (this.hfp.code.length > 0) {
                    axios.put(url, {code: this.hfp.code}).then(() => {
                        alert ('Clave cambiada con éxito')
                    })
                }
            },
            changeVersion () {
                const url = `${ENV.urlApiHFPBase}/${this.id}`
                if (this.hfp.version.length > 0) {
                    axios.put(url, {version: this.hfp.version}).then(() => {
                        alert ('Nombre cambiado con éxito')
                    })
                }
            },
            changeMadeBy () {
                const url = `${ENV.urlApiHFPBase}/${this.id}`
                if (this.hfp.made_by.length > 0) {
                    axios.put(url, {made_by: this.hfp.made_by}).then(() => {
                        alert ('Elaborado por ha cambiado con éxito')
                    })
                }
            },
            changeRevisedBy () {
                const url = `${ENV.urlApiHFPBase}/${this.id}`
                if (this.hfp.revised_by.length > 0) {
                    axios.put(url, {revised_by: this.hfp.revised_by}).then(() => {
                        alert ('Revisor cambiado con éxito')
                    })
                }
            },
            onExerciseCategoryAdded (exercise_category) {
                axios.post(ENV.urlApiHFPBase + '/'+this.hfp.id+'/exercise_category', exercise_category).then(_addExerciseCategory.bind(this));
                function _addExerciseCategory(response) {
                    Vue.set(this.hfp, 'exercise_divisions', response.data);
                    this.updateExercise = Math.random()
                    alert('Categoría de ejercicio agregado con éxito');
                }
            },
            addExercise : function(event, exercise) {
                axios.post(ENV.urlApiHFPBase + '/'+this.hfp.id+'/exercise', exercise).then(_addExercise.bind(this));
                function _addExercise(response) {
                    this.hfp.exercises.push(response.data);
                    alert('Ejercicio agregado con éxito');
                }
            },
            onExerciseDeleted (exerciseId) {
                axios.delete(ENV.urlApiHFPBase + '/'+this.hfp.id+'/exercise/' + exerciseId).then(_removeExercise.bind(this));
                function _removeExercise(response) {
                    Vue.set(this.hfp, 'exercises', response.data);
                }
            },
            onExerciseImageRemoved : function(event, exerciseId, imageResourceId, index) {
                axios.delete(ENV.urlApiHFPBase + '/'+this.hfp.id+'/exercise/' + exerciseId + '/image_resource/' + imageResourceId).then(_removeExercise.bind(this));
                function _removeExercise(response) {
                    Vue.set(this.hfp.exercises, index, response.data);
                }
            },
            onExerciseEditted : function (event, exercise, index) {
                ;
                axios.put(ENV.urlApiHFPBase + '/'+this.hfp.id+'/exercise', exercise).then(_putExercise.bind(this));
                function _putExercise(response) {
                    Vue.set(this.hfp.exercises, index, response.data);
                }
            },
            addMassage : function(event, massage) {
                axios.post(ENV.urlApiHFPBase + '/'+this.hfp.id+'/massage', massage).then(_addMassage.bind(this));
                function _addMassage(response) {
                    if(!this.hfp.massages) this.hfp.massages = []
                    this.hfp.massages.push(response.data);
                    alert('Masaje agregado con éxito');
                }
            },
            onMassageDeleted (massageId) {
                axios.delete(ENV.urlApiHFPBase + '/'+this.hfp.id+'/massage/' + massageId).then(_removeExercise.bind(this));
                function _removeExercise(response) {
                    Vue.set(this.hfp, 'massages', response.data);
                }
            },
            onMassageEditted : function (event, massage, index) {
                axios.put(ENV.urlApiHFPBase + '/'+this.hfp.id+'/massage', massage).then(_putMassage.bind(this));
                function _putMassage(response) {
                    Vue.set(this.hfp.massages, index, response.data);
                }
            },
            onMassageRemoved : function(event, exerciseId, imageResourceId, index) {
                axios.delete(ENV.urlApiHFPBase + '/'+this.hfp.id+'/massage/' + exerciseId + '/image_resource/' + imageResourceId).then(_removeMassage.bind(this));
                function _removeMassage(response) {
                    Vue.set(this.hfp.massages, index, response.data);
                }
            },
            addPhysicalAgent : function(event, physicalAgent) {
                axios.post(ENV.urlApiHFPBase + '/'+this.hfp.id+'/physical_agent', physicalAgent).then(_addPhysicalAgent.bind(this));
                function _addPhysicalAgent(response) {
                    this.hfp.physical_agents.push(response.data);
                    alert('Agente físico agregado con éxito');
                }
            },
            onPhysicalAgentDeleted (physicalAgentId) {
                axios.delete(ENV.urlApiHFPBase + '/'+this.hfp.id+'/physical_agent/' + physicalAgentId).then(_removeExercise.bind(this));
                function _removeExercise(response) {
                    Vue.set(this.hfp, 'physical_agents', response.data);
                }
            },
            onPhysicalAgentEditted : function (event, physicalAgent, index) {
                ;
                axios.put(ENV.urlApiHFPBase + '/'+this.hfp.id+'/physical_agent', physicalAgent).then(_putPhysicalAgent.bind(this));
                function _putPhysicalAgent(response) {
                    Vue.set(this.hfp.physical_agents, index, response.data);
                }
            },
            onPhysicalAgentRemoved : function(event, exerciseId, imageResourceId, index) {
                axios.delete(ENV.urlApiHFPBase + '/'+this.hfp.id+'/physical_agent/' + exerciseId + '/image_resource/' + imageResourceId).then(_removePhysicalAgent.bind(this));
                function _removePhysicalAgent(response) {
                    Vue.set(this.hfp.physical_agents, index, response.data);
                }
            },
            addPrescription : function(event, prescription) {
                axios.post(ENV.urlApiHFPBase + '/'+this.hfp.id+'/prescription', prescription).then(_addPrescription.bind(this));
                function _addPrescription(response) {
                    this.hfp.prescriptions.push(response.data);
                    alert('Medicamento agregado con éxito');
                }
            },
            onPrescriptionDeleted (prescriptionId) {
                axios.delete(ENV.urlApiHFPBase + '/'+this.hfp.id+'/prescription/' + prescriptionId).then(_removeExercise.bind(this));
                function _removeExercise(response) {
                    Vue.set(this.hfp, 'prescriptions', response.data);
                }
            },
            onPrescriptionEditted : function (event, prescription, index) {
                ;
                axios.put(ENV.urlApiHFPBase + '/'+this.hfp.id+'/prescription', prescription).then(_putPrescription.bind(this));
                function _putPrescription(response) {
                    Vue.set(this.hfp.prescriptions, index, response.data);
                }
            },
            onPrescriptionRemoved : function(event, exerciseId, imageResourceId, index) {
                axios.delete(ENV.urlApiHFPBase + '/'+this.hfp.id+'/prescription/' + exerciseId + '/image_resource/' + imageResourceId).then(_removePrescription.bind(this));
                function _removePrescription(response) {
                    Vue.set(this.hfp.prescriptions, index, response.data);
                }
            },
            addContraindication : function(event, contraindication) {
                axios.post(ENV.urlApiHFPBase + '/'+this.hfp.id+'/contraindication', contraindication).then(_addContraindication.bind(this));
                function _addContraindication(response) {
                    this.hfp.contraindications.push(response.data);
                    alert('Contraindicación agregada con éxito');
                }
            },
            onContraindicationDeleted (contraindicationId) {
                axios.delete(ENV.urlApiHFPBase + '/'+this.hfp.id+'/contraindication/' + contraindicationId).then(_removeExercise.bind(this));
                function _removeExercise(response) {
                    Vue.set(this.hfp, 'contraindications', response.data);
                }
            },
            onContraindicationEditted : function (event, contraindication, index) {
                ;
                axios.put(ENV.urlApiHFPBase + '/'+this.hfp.id+'/contraindication', contraindication).then(_putContraindication.bind(this));
                function _putContraindication(response) {
                    Vue.set(this.hfp.contraindications, index, response.data);
                }
            },
            setHfp: function(response) {
                this.id = response.data.id;
                this.hfp.name = response.data.name;
                this.hfp.pages = response.data.pages;
                this.hfp.code = response.data.code;
                this.hfp.version = response.data.version;
                this.hfp.made_by = response.data.made_by;
                this.hfp.bibliography = response.data.bibliography;
                this.hfp.revised_by = response.data.revised_by;
                this.hfp.id = response.data.id;
                this.hfp.is_sealed = response.data.is_sealed ? true : false;
                this.hfp.glosary_ap = (response.data.anato_physiology_glosary_item) ? response.data.anato_physiology_glosary_item : this.hfp.anato_physiology_glosary_item;
                if(this.hfp.glosary_ap){
                    this.hfp.glosary_ap.label = (response.data.anato_physiology_glosary_item) ? response.data.anato_physiology_glosary_item.name : this.hfp.anato_physiology_glosary_item.name;
                }
                this.hfp.keywords = (response.data.keywords) ? response.data.keywords : this.hfp.keywords;
                this.hfp.exercises = (response.data.exercise) ? response.data.exercise : this.hfp.exercises;
                this.hfp.massages = (response.data.massage) ? response.data.massage : this.hfp.massage;
                this.hfp.massages = this.hfp.massages ? this.hfp.massages : []
                this.hfp.physical_agents = (response.data.physical_agent) ? response.data.physical_agent : this.hfp.physical_agents;
                this.hfp.prescriptions = (response.data.prescription) ? response.data.prescription : this.hfp.prescriptions;
                this.hfp.contraindications = (response.data.contraindication) ? response.data.contraindication : this.hfp.contraindications;
                this.hfp.exercise_divisions = (response.data.exercise_divisions) ? response.data.exercise_divisions : this.hfp.exercise_divisions;

                this.hfp.source = (response.data.source) ? response.data.source : this.hfp?.source;
                this.hfp.language = (response.data.language) ? response.data.language : this.hfp?.language;
                this.hfp.relation = (response.data.relation) ? response.data.relation : this.hfp?.relation;
                this.hfp.coverage = (response.data.coverage) ? response.data.coverage : this.hfp?.coverage;
                this.hfp.publisher = (response.data.publisher) ? response.data.publisher : this.hfp?.publisher;
                this.hfp.contributor = (response.data.contributor) ? response.data.contributor : this.hfp?.contributor;
                this.hfp.rights = (response.data.rights) ? response.data.rights : this.hfp?.rights;
                this.hfp.date = (response.data.date) ? response.data.date : this.hfp?.date;
                this.hfp.type = (response.data.type) ? response.data.type : this.hfp?.type;
                this.hfp.format = (response.data.format) ? response.data.format : this.hfp?.format;
                this.hfp.identifier = (response.data.identifier) ? response.data.identifier : this.hfp?.identifier;

            }
        },
        data : function () {
            return {
                updateExercise: 1,
                keywords: [],
                glosary_ap: [],
                hfp : {
                    id: '',
                    is_sealed: false,
                    name: '',
                    pages: null,
                    code: null,
                    version: null,
                    made_by: null,
                    revised_by: null,
                    glosary_ap: {},
                    keywords: [],
                    exercises : [],
                    massages : [],
                    physical_agents : [],
                    prescriptions : [],
                    contraindications : [],
                    adverse_effects : [],
                }
            };
        }
    }
</script>
