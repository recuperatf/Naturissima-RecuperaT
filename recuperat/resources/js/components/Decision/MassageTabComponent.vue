<template>
    <div>
        <div>
            <div class="text-center container">
                <div class="row">
                    <div class="col-lg-12">
                        <div v-if="massages">
                            <div class="d-flex flex-row justify-content-center">
                                <span class=""><strong class="tab-changer" @click="previousMassage"><</strong></span>
                                <h1 class="w-100"><div v-html="linkify(massages[index].name)"></div></h1>
                                <span class=""><strong class="tab-changer" @click="nextMassage">></strong></span>
                            </div>
                            <img class="img-fluid" v-for="image in massages[index].image_resources" :key = "image.id" :src="'/storage/'+image.url" alt="Imagen">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        props: ['massages'],
        methods: {
            linkify(inputText) {
                var replacedText, replacePattern1, replacePattern2, replacePattern3;

                //URLs starting with http://, https://, or ftp://
                replacePattern1 = /(\b(https?|ftp):\/\/[-A-Z0-9+&@#\/%?=~_|!:,.;]*[-A-Z0-9+&@#\/%=~_|])/gim;
                replacedText = inputText.replace(replacePattern1, '<a href="$1" target="_blank">$1</a>');

                //URLs starting with "www." (without // before it, or it'd re-link the ones done above).
                replacePattern2 = /(^|[^\/])(www\.[\S]+(\b|$))/gim;
                replacedText = replacedText.replace(replacePattern2, '$1<a href="http://$2" target="_blank">$2</a>');

                //Change email addresses to mailto:: links.
                replacePattern3 = /(([a-zA-Z0-9\-\_\.])+@[a-zA-Z\_]+?(\.[a-zA-Z]{2,6})+)/gim;
                replacedText = replacedText.replace(replacePattern3, '<a href="mailto:$1">$1</a>');

                return replacedText;
            },
            previousMassage : function () {
                if(this.index > 0){
                    this.index = this.index - 1 ;
                }
            },
            nextMassage : function () {
                if(this.index < this.massages.length - 1){
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