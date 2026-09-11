<template>
    <div>
        <div>
            <div class="text-center container">
                <div class="row">
                    <div class="col-lg-12">
                        <div v-if="contraindications">
                            <div class="d-flex flex-row justify-content-center">
                                <span class=""><strong class="tab-changer" @click="previousContraindication"><</strong></span>
                                <h1 class="w-100">{{contraindications[index].description}}</h1>
                                <span class=""><strong class="tab-changer" @click="nextContraindication">></strong></span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        props: ['contraindications'],
        methods: {
            previousContraindication : function () {
                if(this.index > 0){
                    this.index = this.index - 1 ;
                }
            },
            nextContraindication : function () {
                if(this.index < this.contraindications.length - 1){
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