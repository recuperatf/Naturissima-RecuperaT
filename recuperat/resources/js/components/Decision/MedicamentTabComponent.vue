<template>
    <div>
        <div>
            <div class="text-center container">
                <div class="row">
                    <div class="col-lg-12">
                        <div v-if="prescriptions">
                            <div class="d-flex flex-row justify-content-center">
                                <span class=""><strong class="tab-changer" @click="previousPrescription"><</strong></span>
                                <h1 class="w-100">{{prescriptions[index].description}}</h1>
                                <span class=""><strong class="tab-changer" @click="nextPrescription">></strong></span>
                            </div>
                            <h3 v-if="prescriptions[index].pivot.indication && prescriptions[index].pivot.indication.length > 0">Indicacion</h3>
                            <p>{{prescriptions[index].pivot.indication}}</p>
                            <h3 v-if="prescriptions[index].pivot.precautions && prescriptions[index].pivot.precautions.length > 0">Precauciones</h3>
                            <p>{{prescriptions[index].pivot.precautions}}</p>
                            <img class="img-fluid" v-for="image in prescriptions[index].image_resources" :key = "image.id" :src="'/storage/'+image.url" alt="Imagen">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        props: ['prescriptions'],
        methods: {
            previousPrescription : function () {
                if(this.index > 0){
                    this.index = this.index - 1 ;
                }
            },
            nextPrescription : function () {
                if(this.index < this.prescriptions.length - 1){
                    this.index = this.index + 1 ;
                }
            }
        },
        data: function () {
            return {index : 0};
        }
    }
</script>

<style>
.VueCarousel-navigation > .VueCarousel-navigation-button {
    position: absolute;
}
strong.tab-changer {
    padding-left: 20px;
    padding-right: 20px;
    font-size: 2em;
    cursor: pointer;
}
</style>