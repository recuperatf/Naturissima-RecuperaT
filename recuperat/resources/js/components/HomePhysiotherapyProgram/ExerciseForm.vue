<template>
    <div class="row">
        <div class="col-md-12">
            <h4><strong>Ejercicios</strong></h4>
        </div>
        <div class="col-md-12">
            <div class="row">
                <div class="col-md-4">
                    <h5><strong>Categoría</strong></h5>
                    <multiselect class="mb-2" :multiple="false" v-model="selectedExerciseDivision" :options="exercise_divisions ? exercise_divisions : []" placeholder="Categoría de ejercicio" label="name" track-by="id"></multiselect>
                    <button type="button" class="btn btn-primary" @click="showCategoryCreation = true" v-if="!showCategoryCreation">Añadir nueva categoría</button>
                    <div class="row">
                        <div class="col-lg-12" v-if="showCategoryCreation">
                            <h5><strong>Categoría de ejercicio</strong></h5>
                            <input type="text" class="form-control" v-model="current_exercise_category.name">
                            <button type="button" class="btn btn-primary" @click="addExerciseCategory">Añadir</button>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <h5><strong>Nombre</strong></h5>
                    <input class="form-control" v-model="current_exercise.name"/>
                </div>
                <div class="col-md-4">
                    <h5><strong>Instrucciones</strong></h5>
                    <textarea rows=4 class="form-control" v-model="current_exercise.description" placeholder="Instrucciones"></textarea>
                </div>
                <div class="col-md-4">
                    <h5><strong>Imagenes del ejercicio</strong></h5>
                        <vue-upload-multiple-image
                            :dragText = "'Arrastre aquí'"
                            :browseText=  "'O explore'"
                            :markIsPrimaryText = "''"
                            :popupText = "''"
                            :maxImage = 10
                            :showEdit = "false"
                            @upload-success="uploadImageSuccess"
                            @before-remove="beforeRemove"
                            @edit-image="editImage"
                            idUpload="uploadCurrent"
                            :editUpload="'editCurrentImages'"
                            ></vue-upload-multiple-image>
                </div>
                <div class="col-md-4">
                    <h5><strong>Videos (Links)</strong></h5>
                    <div class="input-group">
                        <input type="text" class="form-control" v-model="input_video_link"/>
                        <div class="input-group-append">
                            <button type="button" @click.stop="addVideo" class="btn btn-primary"><i class="fas fa-plus"></i></button>
                        </div>
                    </div>
                    <div class="input-group" v-for="(videoLink, index) in current_exercise.video_links" :key="index">
                        <input type="text" class="form-control" disabled :value="videoLink">
                        <div class="input-group-append">
                            <button class="btn btn-danger" @click.stop="removeVideoLink(index)"><i class="fas fa-close"></i></button>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <button type="button" class="btn btn-primary" @click="addExercise">AÑADIR EJERCICIO</button>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12"><h4 class="d-inline">Guardados</h4><span v-if="exercises.length > 0" class="btn btn-default" @click = "toggleCollapse"><i :class="collapsed ? 'fas fa-angle-down' : 'fas fa-angle-up'"></i></span></div>
                <div class="col-md-12" v-if="exercises.length == 0"><h5 class="d-inline">No tienes ejercicios en este programa</h5></div>
            </div>
            <div class="row" v-if = "!collapsed">
                <div class="col-md-12">
                    <div class="row" v-for="(exercise, index) in exercises" :key="index">
                        <div class="col-md-5" v-if= "editting !== index">
                            <select type="text" disabled class="form-control" v-model="exercise.exercise_division_id">
                                <option v-for="exerciseDivision in exercise_divisions" :key="exerciseDivision.id" :value="exerciseDivision.id">{{exerciseDivision.name}}</option>
                            </select>
                        </div>
                        <div class="col-md-5" v-if= "editting !== index">
                            <input class="form-control" disabled v-model="exercise.name"/>
                        </div>
                        <div class="col-md-5" v-if= "editting !== index">
                            <textarea class="form-control" disabled v-model="exercise.description"/>
                        </div>
                        <div class="col-md-5" v-if= "editting === index">
                            <select type="text" class="form-control" v-model="edditingExercise.exercise_division_id">
                                <option v-for="exerciseDivision in exercise_divisions" :key="exerciseDivision.id" :value="exerciseDivision.id">{{exerciseDivision.name}}</option>
                            </select>
                        </div>
                        <div class="col-md-5" v-if= "editting === index">
                            <textarea class="form-control"  v-model="edditingExercise.description" />
                        </div>
                        <div class="col-md-4">
                            <h5><strong>Videos (Links)</strong></h5>
                            <div class="input-group">
                                <input type="text" :disabled="editting !== index" class="form-control" v-model="edditing_input_video_link"/>
                                <div class="input-group-append">
                                    <!-- <button type="button" :disabled="editting !== index" @click.stop="addVideo(true)" class="btn btn-primary"><i class="fas fa-plus"></i></button> -->
                                </div>
                            </div>
                            <div v-if= "editting !== index">
                                <div class="input-group" v-for="(videoLink, index) in exercise.video_links" :key="index">
                                    <input type="text" class="form-control" disabled :value="videoLink.name">
                                    <div class="input-group-append">
                                        <!-- <button class="btn btn-danger" @click.stop="removeVideoLink(index, true)"><i class="fas fa-close"></i></button> -->
                                    </div>
                                </div>
                            </div>
                            <div v-else>
                                <div class="input-group" v-for="(videoLink, index) in edditingExercise.video_links" :key="index">
                                    <input type="text" class="form-control" disabled :value="videoLink.name">
                                    <div class="input-group-append">
                                        <!-- <button class="btn btn-danger" @click.stop="removeVideoLink(index, true)"><i class="fas fa-close"></i></button> -->
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <vue-upload-multiple-image
                                :dragText = "'Arrastre aquí'"
                                :browseText=  "'O explore'"
                                :markIsPrimaryText = "''"
                                :popupText = "''"
                                :maxImage = 10
                            :showEdit = "false"
                                @upload-success="uploadImageSuccess"
                                @before-remove="beforeRemove"
                                @edit-image="editImage"
                                :disabled = "editting !== index"
                                :data-images = "
                                    exercise.image_resources ? exercise.image_resources.map( (resource) => {
                                            return {
                                                path : '/storage/'+resource.url
                                            };
                                        }
                                    ) : []"
                                :idUpload="'uploadExerciseImage'+index"
                                :editUpload="'editExerciseImages'+index"
                                ></vue-upload-multiple-image>
                            <button type="button" v-if="editting !== index" class="btn btn-warning" @click="enableEditting(index)">Editar</button>
                            <button type="button" v-if="editting !== index" class="btn btn-danger" @click="deleteExercise(exercise.id)">Eliminar</button>
                            <button type="button" v-else class="btn btn-primary" @click="editExercise(false)">Aceptar</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
<style src="vue-multiselect/dist/vue-multiselect.min.css"></style>
<script>
    import VueUploadMultipleImage from 'vue-upload-multiple-image'
    import Multiselect from 'vue-multiselect'
    export default {
        watch: {
            selectedExerciseDivision : function () {
                this.current_exercise.exercise_division_id = this.selectedExerciseDivision.id
            }
        },
        mounted() {
            console.log('Component mounted.')
        },
        components : {
            VueUploadMultipleImage,
            Multiselect
        },
        methods : {
            addExerciseCategory () {
                this.$emit('onExerciseCategoryAdded', this.current_exercise_category);
                showCategoryCreation = false
            },
            deleteExercise (index) {
                if (confirm('¿Estás seguro que deseas eliminar este registro?')) {
                    this.$emit('onExerciseDeleted', index);
                }
            },
            addVideo: function(event, edditing = false) {
                if (edditing) {
                    const string = this.edditing_input_video_link
                    this.edditingExercise.video_links.push(string)
                }
                else {
                    const string = this.input_video_link
                    this.current_exercise.video_links.push(string)
                }
            },
            removeVideoLink: function(event, index, edditing = false) {
                if (edditing){
                    this.edditingExercise.video_links.splice(index, 1)
                } else {
                    this.current_exercise.video_links.splice(index, 1)
                }
            },
            toggleCollapse : function () {
                this.collapsed = !this.collapsed;
            },
            editExercise : function (event) {
                console.log(this.edditingExercise);
                this.$emit('onExerciseEditted', event, this.edditingExercise, this.editting);
                this.enableEditting(false);
            },
            addExercise : function(event) {
                this.$emit('onExerciseAdded', event, this.current_exercise);
                this.collapsed = false;
            },
            uploadImageSuccess(formData, index, fileList) {
                // Upload image api
                if (this.editting !== false){
                    this.edditingExercise.imageFiles = fileList;
                } else {
                    this.current_exercise.imageFiles = fileList;
                }
            },
            beforeRemove (index, done, fileList) {
                if (this.editting === false){
                    alert('Activa la edición antes de borrar esta imagen.');
                    return;
                }
                var r = confirm("¿Estás seguro de que deseas eliminar esta imagen?");
                if (r == true) {
                    const exerciseId = this.exercises[this.editting].id;
                    const imageResourceId = this.exercises[this.editting].image_resources[index].id;
                    this.$emit('onExerciseImageRemoved', event, exerciseId, imageResourceId, this.editting);
                    done()
                } else {
                }
            },
            editImage (formData, index, fileList){
                ;
            },
            enableEditting : function (index) {
                if (index !== false){
                    this.edditingExercise = JSON.parse(JSON.stringify(this.exercises[index]));
                }
                this.editting = index;
            }
        },
        data : function () {
            return {
                selectedExerciseDivision: {},
                showCategoryCreation: false,
                current_exercise_category: {
                    exercise_division_id: null,
                    name:null,
                    keywords: [],
                },
                input_video_link: '',
                edditing_input_video_link: '',
                collapsed : true,
                editting : null,
                edditingExercise : {
                    description: '',
                    pivot: {
                        series: '',
                        repetitions: '',
                    },
                    images: [
                        // {
                        //     path : exercise.image_resources,
                        //     deafault : 1,
                        //     highlight : 1,
                        //     caption : 1,
                        // }
                    ],
                    image_resources : [],
                    video_links: []
                },
                current_exercise : {
                    description: '',
                    pivot: {
                        series: '',
                        repetitions: '',
                    },
                    images: [
                        // {
                        //     path : exercise.image_resources,
                        //     deafault : 1,
                        //     highlight : 1,
                        //     caption : 1,
                        // }
                    ],
                    image_resources : [],
                    video_links: []
                },
            };
        },
        props : ['exercises', 'id', 'exercise_divisions']
    }
</script>
