<template>
    <div>
        <div>
            <div class="text-center container">
                <div class="row">
                    <div class="col-lg-12">
                        <div v-if="physicalMethods">
                            <div class="d-flex flex-row justify-content-center">
                                <span class=""><strong class="tab-changer" @click="previousPhysicalMethod"><</strong></span>
                                <h1 class="w-100">{{physicalMethods[index].description}}</h1>
                                <span class=""><strong class="tab-changer" @click="nextPhysicalMethod">></strong></span>
                            </div>
                            <h3>Indicacion</h3>
                            <p>{{physicalMethods[index].pivot.indication}}</p>
                            <h3>Precauciones</h3>
                            <p>{{physicalMethods[index].pivot.precautions}}</p>
                            <img class="img-fluid" v-for="image in physicalMethods[index].image_resources" :key = "image.id" :src="'/storage/'+image.url" alt="Imagen">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        props: ['physicalMethods'],
        methods: {
            previousPhysicalMethod : function () {
                if(this.index > 0){
                    this.index = this.index - 1 ;
                }
            },
            nextPhysicalMethod : function () {
                if(this.index < this.physicalMethods.length - 1){
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