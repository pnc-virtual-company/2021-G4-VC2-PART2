<template>
<v-card>
    <v-avatar size="120" class="ml-4 mt-4">
            <img src="../../assets/jennie.jpg" alt="">
        </v-avatar>
        <v-btn
            color="blue"
            fab
            small
            dark
            style="margin-top: 85px"
        >
            <v-icon>mdi-pencil</v-icon>
        </v-btn>
        <v-card-text >
            <div class="mb-6 d-flex justify-space-between">
                <div class="d-flex">
                    <v-icon dark color="pink"> mdi-gender-female </v-icon>
                    <h2 class="mt-1 mr-12">Jennie</h2>
                </div>
                <div class="d-flex" style="margin-top: -6%;margin-right: -12%; margin-left: 7%; width: 30%;">
                    <v-icon dark color="blue" style="margin-top: -23%"> mdi-phone </v-icon>
                    <h3 class="ml-1">Tel: +885 81 327 344</h3>
                </div>
                <div class="d-flex" style="margin-top: -6%; margin-left: 5%; margin-right: -2%; width: 42%;">
                    <v-icon dark color="blue" style="margin-top: -16%"> mdi-email </v-icon>
                    <h3 class="ml-1">Email: jennie.blink@gmail.com</h3>
                </div>
            </div>
            <div class="ml-1 d-flex justify-space-between">
                <div class="d-flex">
                    <v-avatar size="50">
                        <img src="../../assets/pn-logo.png" alt="">
                    </v-avatar>
                    <h4 class="mt-4 ml-2">BATCH : 2021 - WEP</h4>
                </div>
                <div class="d-flex" style="margin-left: -6%">
                    <v-icon color="blue" dark> mdi-cake-layered </v-icon>
                    <h4 class="mr-12 mt-4 ml-1">DOB: 07/12/1995</h4>
                </div>
                <div class="d-flex" style="margin-right: 14%; margin-left: -5%">
                    <v-icon color="blue" dark> mdi-gender-transgender </v-icon>
                    <h4 class="mr-12 mt-4 ml-1">Marital Status: Single</h4>
                </div>
            </div>
            <div class="ml-2 mt-5 d-flex justify-space-between">
                <div class="d-flex">
                    <v-icon color="blue" dark> mdi-map-marker </v-icon>
                    <h4 class="ml-1 mt-2">City: Phnom Penh</h4>
                </div>
                <div class="d-flex" style="margin-left: -11%">
                    <v-icon color="blue" dark> mdi-marker-check </v-icon>
                    <h4 class="ml-1 mt-2">Major: WEP</h4>
                </div>
                <div class="d-flex" style="margin-right: 12%; margin-left: -5%">
                    <v-icon color="blue" dark> mdi-lightbulb-on </v-icon>
                    <h4 class="ml-1 mt-2">Skill: JavaScript, VueJS, Vuetify</h4>
                </div>
            </div>
        </v-card-text>

        <v-btn color="blue" dark class="float-end mt-2 mr-3">
            EDIT
        </v-btn>
</v-card>
</template>

<script>
export default {

}
</script>

<style>

</style>