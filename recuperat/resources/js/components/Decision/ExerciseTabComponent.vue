<template>
    <div>
        <div>
            <div class="text-center container">
                <div class="row">
                    <div class="col-lg-12">
                        <div v-if="exercises">
                            <div class="d-flex flex-row justify-content-center">
                                <span class=""><strong class="tab-changer" @click="previousExercise"><</strong></span>
                                <div>
                                    <h1 class="w-100 d-block">{{exercises[index].name}}</h1>
                                    <br>
                                    <h3 class="w-100 d-block">{{exercises[index].description}}</h3>
                                </div>
                                <span class=""><strong class="tab-changer" @click="nextExercise">></strong></span>
                            </div>
                            <img class="img-fluid" v-for="image in exercises[index].image_resources" :key = "image.id" :src="'/storage/'+image.url" alt="Imagen">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        props: ['exercises'],
        methods: {
            previousExercise : function () {
                if(this.index > 0){
                    this.index = this.index - 1 ;
                }
            },
            nextExercise : function () {
                if(this.index < this.exercises.length - 1){
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