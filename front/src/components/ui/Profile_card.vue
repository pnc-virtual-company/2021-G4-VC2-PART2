<template>
    <v-card
        class="mx-auto mt-12"
        max-width="344"
    >
        <v-img
            src=""
        ></v-img>

        <v-card-title>
            Name
        </v-card-title>

        <v-card-subtitle>
            Email
        </v-card-subtitle>

        <v-card-actions style="margin-left: 80%">
            <v-btn
                class="mx-2"
                fab
                dark
                small
                color="blue"
            >
                <v-icon dark>
                    mdi-plus
                </v-icon>
            </v-btn>
        </v-card-actions>
    </v-card>
    <!-- <v-card
        class="mx-auto rounded-lg mt-6"
        max-width="850"
        dense
        elevation="5"
    >   
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
        
        <v-card-actions>
        <v-btn
            text
            color="blue accent-4"
            @click="reveal = true"
        >
            Explore
        </v-btn>
        </v-card-actions>

        <v-expand-transition>
        <v-card
            v-if="reveal"
            class="transition-fast-in-fast-out v-card--reveal"
            style="height: 100%;"
        >
            <v-card-text class="pb-0">
                <div class="d-flex">
                    <v-avatar size="120">
                        <img src="../../assets/mangobyte.png" alt="">
                    </v-avatar>
                    <p class="text-h4 text--primary mt-3" style="margin-left: 22%">
                        Mango Byte Cambodia
                    </p>
                </div>
                <h5 class="ml-2 blue--text text-decoration-underline">www.mangobyte.com</h5>
                <p class="text-h4 blue--text mb-7" style="margin-left: 41%; margin-top: -43px">WEP DEVELOPER</p>
                <div class="mb-6 mt-12 d-flex justify-space-between">
                    <div class="d-flex" style="width: 63%">
                        <v-icon dark color="blue" class="mr-1"> mdi-map-marker </v-icon>
                        <h3 class="mr-12">Address: Aquation, #540 Koh Pich St, Koh Pich.</h3>
                    </div>
                    <div class="d-flex" style="width: 36%">
                        <v-icon dark color="blue"> mdi-comment-account </v-icon>
                        <h3 class="ml-2">HR's name: Sophavatey Pich</h3>
                    </div>
                </div>
                <div class="d-flex justify-space-between">
                    <div class="d-flex" style="width: 63%">
                        <v-icon dark color="blue" class="mr-1"> mdi-email </v-icon>
                        <h3 class="mr-12">Email: sophavatey@gmail.com</h3>
                    </div>
                    <div class="d-flex" style="width: 36%">
                        <v-icon dark color="blue"> mdi-phone </v-icon>
                        <h3 class="ml-2">Tel: +855 81 327 344</h3>
                    </div>
                </div>
            </v-card-text>
            <v-card-actions class="pt-0 float-end">
                <v-btn
                    text
                    color="red accent-4"
                    @click="reveal = false"
                    style="margin-top: 30px"
                >
                    Close
                </v-btn>
            </v-card-actions>
        </v-card>
        </v-expand-transition>
    </v-card> -->
</template>

<script>
export default {
    data: () => ({
        reveal: false,
    }),
}
</script>

<style>
    .v-card--reveal {
        bottom: 0;
        opacity: 1 !important;
        position: absolute;
        width: 100%;
    }
</style>