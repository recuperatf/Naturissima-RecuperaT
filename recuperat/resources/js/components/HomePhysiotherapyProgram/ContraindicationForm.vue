<template>
    <div class="row">
        <div class="col-md-12">
            <h4><strong>Contraindicaciones</strong></h4>
        </div>
        <div class="col-md-12">
            <div class="row">
                <div class="col-md-12">
                    <h5><strong>Nombre de la contraindicación</strong></h5>
                    <div class="input-group">
                        <input type="text" class="form-control" v-model="current_contraindication.description">
                        <div class="input-group-append">
                            <button type="button" class="btn btn-primary" @click="addContraindication">Añadir</button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12"><h4 class="d-inline">Contraindicaciónes Guardadas</h4><span v-if="contraindications.length != 0" class="btn btn-default" @click = "toggleCollapse"><i :class="collapsed ? 'fas fa-angle-down' : 'fas fa-angle-up'"></i></span></div>
                <div class="col-md-12" v-if="contraindications.length == 0"><h5 class="d-inline">No tienes contraindicaciones en este programa</h5></div>
            </div>
            <div class="row" v-if = "!collapsed">
                <div class="col-md-12">
                    <div class="row" v-for="(contraindication, index) in contraindications" :key="index">
                        <div class="col-md-5" v-if= "editting !== index">
                            <input type="text" class="form-control" disabled v-model="contraindication.description">
                        </div>
                        <div class="col-md-5" v-if= "editting === index">
                            <input type="text" class="form-control"  v-model="edditingContraindication.description">
                        </div>
                        <div class="col-md-1">
                            <button type="button" v-if="editting !== index" class="btn btn-warning" @click="enableEditting(index)">Editar</button>
                            <button type="button" v-else class="btn btn-primary" @click="editContraindication(false)">Aceptar</button>
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
            editContraindication : function (event) {
                console.log(this.edditingContraindication);
                delete this.edditingContraindication.pivot
                this.$emit('onContraindicationEditted', event, this.edditingContraindication, this.editting);
                this.enableEditting(false);
            },
            addContraindication : function(event) {
                this.$emit('onContraindicationAdded', event, this.current_contraindication);
                this.collapsed = false;
            },
            uploadImageSuccess(formData, index, fileList) {
                // Upload image api
                if (this.editting !== false){
                    this.edditingContraindication.imageFiles = fileList;
                } else {
                    this.current_contraindication.imageFiles = fileList;
                }
            },
            beforeRemove (index, done, fileList) {
                var r = confirm("remove image")
                if (r == true) {
                    done()
                } else {
                }
            },
            editImage (formData, index, fileList){
                ;
            },
            enableEditting : function (index) {
                if (index !== false){
                    this.edditingContraindication = JSON.parse(JSON.stringify(this.contraindications[index]));
                }
                this.editting = index;
            }
        },
        data : function () {
            return {
                collapsed : true,
                editting : false,
                edditingContraindication : {
                    description: '',
                    images: [
                    ],
                    image_resources : []
                },
                current_contraindication : {
                    description: '',
                    images: [
                    ],
                    image_resources : []
                },
            };
        },
        props : ['contraindications', 'id']
    }
</script>
