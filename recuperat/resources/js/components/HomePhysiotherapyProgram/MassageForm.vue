<template>
    <div class="row">
        <div class="col-md-12">
            <h4><strong>Masajes</strong></h4>
        </div>
        <div class="col-md-12">
            <div class="row">
                <div class="col-md-12">
                    <h5><strong>Nombre del masaje</strong></h5>
                    <div class="input-group">
                        <input type="text" class="form-control" v-model="current_massage.name">
                        <div class="input-group-append">
                            <button type="button" class="btn btn-primary" @click="addMassage">Añadir</button>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <h5><strong>Imagenes del masaje</strong></h5>
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
                            :data-images="current_massage.images"
                            idUpload="uploadCurrentMassage"
                            :editUpload="'editCurrentImagesMassage'"
                            ></vue-upload-multiple-image>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12"><h4 class="d-inline">Masajes Guardados</h4><span v-if="massages.length != 0" class="btn btn-default" @click = "toggleCollapse"><i :class="collapsed ? 'fas fa-angle-down' : 'fas fa-angle-up'"></i></span></div>
                <div class="col-md-12" v-if="massages.length == 0"><h5 class="d-inline">No tienes masajes en este programa</h5></div>
            </div>
            <div class="row" v-if = "!collapsed">
                <div class="col-md-12">
                    <div class="row" v-for="(massage, index) in massages" :key="index">
                        <div class="col-md-5" v-if= "editting !== index">
                            <input type="text" class="form-control" disabled v-model="massage.name">
                        </div>
                        <div class="col-md-5" v-if= "editting === index">
                            <input type="text" class="form-control"  v-model="edditingMassage.name">
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
                                    massage.image_resources ? massage.image_resources.map( (resource) => {
                                            return {
                                                path : '/storage/'+resource.url
                                            };
                                        }
                                    ) : []"
                                :idUpload="'uploadImageMassage'+index"
                                :editUpload="'editImagesMassage'+index"
                                ></vue-upload-multiple-image>
                            <button type="button" v-if="editting !== index" class="btn btn-warning" @click="enableEditting(index)">Editar</button>
                            <button type="button" v-if="editting !== index" class="btn btn-danger" @click="deleteMassage(massage.id)">Borrar</button>
                            <button type="button" v-else class="btn btn-primary" @click="editMassage(false)">Aceptar</button>
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
            deleteMassage (index) {
                if (confirm('¿Estás seguro que deseas eliminar este registro?')) {
                    this.$emit('onMassageDeleted', index);
                }
            },
            toggleCollapse : function () {
                this.collapsed = !this.collapsed;
            },
            editMassage : function (event) {
                console.log(this.edditingMassage);
                this.$emit('onMassageEditted', event, this.edditingMassage, this.editting);
                this.enableEditting(false);
            },
            addMassage : function(event) {
                this.$emit('onMassageAdded', event, this.current_massage);
                this.collapsed = false;
            },
            uploadImageSuccess(formData, index, fileList) {
                // Upload image api
                if (this.editting !== false){
                    this.edditingMassage.imageFiles = fileList;
                } else {
                    this.current_massage.imageFiles = fileList;
                }
            },
            beforeRemove (index, done, fileList) {
                if (this.editting === false){
                    alert('Activa la edición antes de borrar esta imagen.');
                    return;
                }
                var r = confirm("¿Estás seguro de que deseas eliminar esta imagen?");
                if (r == true) {
                    const massageId = this.massages[this.editting].id;
                    const imageResourceId = this.massages[this.editting].image_resources[index].id;
                    this.$emit('onMassageRemoved', event, massageId, imageResourceId, this.editting);
                    done()
                } else {
                }
            },
            editImage (formData, index, fileList){
                ;
            },
            enableEditting : function (index) {
                if (index !== false){
                    this.edditingMassage = JSON.parse(JSON.stringify(this.massages[index]));
                }
                this.editting = index;
            }
        },
        data : function () {
            return {
                collapsed : true,
                editting : false,
                edditingMassage : {
                    description: '',
                    pivot: {
                        series: '',
                        repetitions: '',
                    },
                    images: [
                    ],
                    image_resources : []
                },
                current_massage : {
                    description: '',
                    pivot: {
                        series: '',
                        repetitions: '',
                    },
                    images: [
                    ],
                    image_resources : []
                },
            };
        },
        props : ['massages', 'id']
    }
</script>
