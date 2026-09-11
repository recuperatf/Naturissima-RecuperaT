<template>
    <div class="row">
        <div class="col-md-12">
            <h4><strong>Agentes físicos</strong></h4>
        </div>
        <div class="col-md-12">
            <div class="row">
                <div class="col-md-4">
                    <h5><strong>Descripción</strong></h5>
                    <input type="text" class="form-control" v-model="current_physical_agent.description">
                </div>
                <div class="col-md-4">
                    <h5><strong>Indicación</strong></h5>
                    <input type="text" class="form-control" v-model="current_physical_agent.indication">
                </div>
                <div class="col-md-4">
                    <h5><strong>Precauciones</strong></h5>
                    <div class="input-group">
                        <input type="text" class="form-control" v-model="current_physical_agent.precautions">
                        <div class="input-group-append">
                            <button type="button" class="btn btn-primary" @click="addPhysicalAgent">Añadir</button>
                        </div>
                    </div>
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
                            :data-images="current_physical_agent.images"
                            idUpload="uploadCurrentPhysicalAgent"
                            :editUpload="'editCurrentImagesPhysicalAgent'"
                            ></vue-upload-multiple-image>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12"><h4 class="d-inline">Agentes Físicos Guardados</h4><span v-if="physical_agents.length != 0" class="btn btn-default" @click = "toggleCollapse"><i :class="collapsed ? 'fas fa-angle-down' : 'fas fa-angle-up'"></i></span></div>
                <div class="col-md-12" v-if="physical_agents.length == 0"><h5 class="d-inline">No tienes agentes físicos en este programa</h5></div>
            </div>
                        <div class="row" v-if = "!collapsed">
                <div class="col-md-12">
                    <div class="row" v-for="(physical_agent, index) in physical_agents" :key="index">
                        <div class="col-md-5" v-if= "editting !== index">
                            <input type="text" class="form-control" disabled v-model="physical_agent.description">
                        </div>
                        <div class="col-md-2" v-if= "editting !== index">
                            <input type="text" class="form-control" disabled  v-model="physical_agent.pivot.indication">
                        </div>
                        <div class="col-md-2" v-if= "editting !== index">
                            <input type="text" class="form-control" disabled  v-model="physical_agent.pivot.precautions">
                        </div>
                        <div class="col-md-5" v-if= "editting === index">
                            <input type="text" class="form-control"  v-model="edditingPhysicalAgent.description">
                        </div>
                        <div class="col-md-2" v-if= "editting === index">
                            <input type="text" class="form-control"  v-model="edditingPhysicalAgent.pivot.indication">
                        </div>
                        <div class="col-md-2" v-if= "editting === index">
                            <input type="text" class="form-control" v-model="edditingPhysicalAgent.pivot.precautions">
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
                                    physical_agent.image_resources ? physical_agent.image_resources.map( (resource) => {
                                            return {
                                                path : '/storage/'+resource.url
                                            };
                                        }
                                    ) : []"
                                :idUpload="'uploadImagePhysicalAgent'+index"
                                :editUpload="'editImagesPhysicalAgent'+index"
                                ></vue-upload-multiple-image>
                            <button type="button" v-if="editting !== index" class="btn btn-warning" @click="enableEditting(index)">Editar</button>
                            <button type="button" v-if="editting !== index" class="btn btn-danger" @click="deletePhysicalAgent(physical_agent.id)">Eliminar</button>
                            <button type="button" v-else class="btn btn-primary" @click="editPhysicalAgent(false)">Aceptar</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import VueUploadMultipleImage from 'vue-upload-multiple-image'
    export default {
        mounted() {
            console.log('Component mounted.')
        },
        components : {
            VueUploadMultipleImage
        },
        methods : {
            toggleCollapse : function () {
                this.collapsed = !this.collapsed;
            },
            editPhysicalAgent : function (event) {
                console.log(this.edditingPhysicalAgent);
                this.$emit('onPhysicalAgentEditted', event, this.edditingPhysicalAgent, this.editting);
                this.enableEditting(false);
            },
            deletePhysicalAgent (index) {
                if (confirm('¿Estás seguro que deseas eliminar este registro?')) {
                    this.$emit('onPhysicalAgentDeleted', index);
                }
            },
            addPhysicalAgent : function(event) {
                this.$emit('onPhysicalAgentAdded', event, this.current_physical_agent);
                this.collapsed = false;
            },
            uploadImageSuccess(formData, index, fileList) {
                // Upload image api
                if (this.editting !== false){
                    this.edditingPhysicalAgent.imageFiles = fileList;
                } else {
                    this.current_physical_agent.imageFiles = fileList;
                }
            },
            beforeRemove (index, done, fileList) {
                if (this.editting === false){
                    alert('Activa la edición antes de borrar esta imagen.');
                    return;
                }
                var r = confirm("¿Estás seguro de que deseas eliminar esta imagen?");
                if (r == true) {
                    const physicalAgentId = this.physical_agents[this.editting].id;
                    const imageResourceId = this.physical_agents[this.editting].image_resources[index].id;
                    this.$emit('onPhysicalAgentRemoved', event, physicalAgentId, imageResourceId, this.editting);
                    done()
                } else {
                }
            },
            editImage (formData, index, fileList){
                ;
            },
            enableEditting : function (index) {
                if (index !== false){
                    this.edditingPhysicalAgent = JSON.parse(JSON.stringify(this.physical_agents[index]));
                }
                this.editting = index;
            }
        },
        data : function () {
            return {
                collapsed : true,
                editting : false,
                edditingPhysicalAgent : {
                    description: '',
                    pivot: {
                        indication: '',
                        precautions: '',
                    },
                    images: [
                    ],
                    image_resources : []
                },
                current_physical_agent : {
                    description: '',
                    pivot: {
                        indication: '',
                        precautions: '',
                    },
                    images: [
                    ],
                    image_resources : []
                },
            };
        },
        props : ['physical_agents', 'id']
    }
</script>
