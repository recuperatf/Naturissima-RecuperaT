<template>
    <div class="row">
        <div class="col-md-12">
            <h4><strong>Medicamentos</strong></h4>
        </div>
        <div class="col-md-12">
            <div class="row">
                <div class="col-md-4">
                    <h5><strong>Medicamento</strong></h5>
                    <input type="text" class="form-control" v-model="current_prescription.description">
                </div>
                <div class="col-md-4">
                    <h5><strong>Indicación</strong></h5>
                    <input type="text" class="form-control" v-model="current_prescription.indication">
                </div>
                <div class="col-md-4">
                    <h5><strong>Precauciones</strong></h5>
                    <div class="input-group">
                        <input type="text" class="form-control" v-model="current_prescription.precautions">
                        <div class="input-group-append">
                            <button type="button" class="btn btn-primary" @click="addPrescription">Añadir</button>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <h5><strong>Imagenes del Medicamentos</strong></h5>
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
                            :data-images="current_prescription.images"
                            idUpload="uploadCurrentPrescription"
                            :editUpload="'editCurrentImagesPrescription'"
                            ></vue-upload-multiple-image>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12"><h4 class="d-inline">Medicamentos Guardados</h4><span v-if="prescriptions.length != 0" class="btn btn-default" @click = "toggleCollapse"><i :class="collapsed ? 'fas fa-angle-down' : 'fas fa-angle-up'"></i></span></div>
                <div class="col-md-12" v-if="prescriptions.length == 0"><h5 class="d-inline">No tienes medicamentos físicos en este programa</h5></div>
            </div>
                        <div class="row" v-if = "!collapsed">
                <div class="col-md-12">
                    <div class="row" v-for="(prescription, index) in prescriptions" :key="index">
                        <div class="col-md-5" v-if= "editting !== index">
                            <input type="text" class="form-control" disabled v-model="prescription.description">
                        </div>
                        <div class="col-md-2" v-if= "editting !== index">
                            <input type="text" class="form-control" disabled  v-model="prescription.pivot.indication">
                        </div>
                        <div class="col-md-2" v-if= "editting !== index">
                            <input type="text" class="form-control" disabled  v-model="prescription.pivot.precautions">
                        </div>
                        <div class="col-md-5" v-if= "editting === index">
                            <input type="text" class="form-control"  v-model="edditingPrescription.description">
                        </div>
                        <div class="col-md-2" v-if= "editting === index">
                            <input type="text" class="form-control"  v-model="edditingPrescription.pivot.indication">
                        </div>
                        <div class="col-md-2" v-if= "editting === index">
                            <input type="text" class="form-control" v-model="edditingPrescription.pivot.precautions">
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
                                    prescription.image_resources ? prescription.image_resources.map( (resource) => {
                                            return {
                                                path : '/storage/'+resource.url
                                            };
                                        }
                                    ) : []"
                                :idUpload="'uploadImagePrescription'+index"
                                :editUpload="'editImagesPrescription'+index"
                                ></vue-upload-multiple-image>
                            <button type="button" v-if="editting !== index" class="btn btn-warning" @click="enableEditting(index)">Editar</button>
                            <button type="button" v-if="editting !== index" class="btn btn-danger" @click="deletePrescription(prescription.id)">Eliminar</button>
                            <button type="button" v-else class="btn btn-primary" @click="editPrescription(false)">Aceptar</button>
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
            deletePrescription (index) {
                if (confirm('¿Estás seguro que deseas eliminar este registro?')) {
                    this.$emit('onPrescriptionDeleted', index);
                }
            },
            editPrescription : function (event) {
                this.edditingPrescription.description = this.edditingPrescription.description ? this.edditingPrescription.description : " "  
                this.$emit('onPrescriptionEditted', event, this.edditingPrescription, this.editting);
                this.enableEditting(false);
            },
            addPrescription : function(event) {
                console.log(this.current_prescription);
                this.current_prescription.description = this.current_prescription.description ? this.current_prescription.description : " "  
                this.$emit('onPrescriptionAdded', event, this.current_prescription);
                this.collapsed = false;
            },
            uploadImageSuccess(formData, index, fileList) {
                // Upload image api
                if (this.editting !== false){
                    this.edditingPrescription.imageFiles = fileList;
                } else {
                    this.current_prescription.imageFiles = fileList;
                }
            },
            beforeRemove (index, done, fileList) {
                if (this.editting === false){
                    alert('Activa la edición antes de borrar esta imagen.');
                    return;
                }
                var r = confirm("¿Estás seguro de que deseas eliminar esta imagen?");
                if (r == true) {
                    const prescriptionId = this.prescriptions[this.editting].id;
                    const imageResourceId = this.prescriptions[this.editting].image_resources[index].id;
                    this.$emit('onPrescriptionRemoved', event, prescriptionId, imageResourceId, this.editting);
                    done()
                } else {
                }
            },
            editImage (formData, index, fileList){
                ;
            },
            enableEditting : function (index) {
                if (index !== false){
                    this.edditingPrescription = JSON.parse(JSON.stringify(this.prescriptions[index]));
                }
                this.editting = index;
            }
        },
        data : function () {
            return {
                collapsed : true,
                editting : false,
                edditingPrescription : {
                    description: '',
                    pivot: {
                        indication: '',
                        precautions: '',
                    },
                    images: [
                    ],
                    image_resources : []
                },
                current_prescription : {
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
        props : ['prescriptions', 'id']
    }
</script>
