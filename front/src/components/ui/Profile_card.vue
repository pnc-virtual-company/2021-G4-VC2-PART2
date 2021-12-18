<template>
    <v-card dense elevation="9" class="mx-auto mb-4 rounded-lg" max-width="800">
        <div class="profile d-flex justify-center">
            <h3 class="mt-3" style="border-bottom: 3px solid #2196F3;">My Profile</h3>
        </div>
        <v-container class="d-flex justify-space-between">
            <div class="avatar">
                <v-avatar width="120px" height="120px" class="m-4" style="margin: 10px">
                <img
                    src="../../assets/jennie.jpg"
                >
                </v-avatar>
            </div>
            <div class="bio rounded-lg mt-6 mr-12 pa-3" style="border: 2px solid #2196F3; width: 70%; height: 100px">
                <p>I am full of vitality. My confidence, positive attitude and self-belief are my biggest assets to take me a step closer to my success.</p>
            </div>
        </v-container>

        <v-container class="d-flex justify-space-between">
            <div>
                <div class="user d-flex ml-2" style="margin-top: -20px">
                    <v-icon color="pink">mdi-gender-female</v-icon>
                    <v-card-title class="ml-2"> Malita </v-card-title>
                </div>
                <div class="d-flex ml-2" style="margin-top: -20px">
                    <img src="../../assets/pn-logo.png" alt="" height="30px" width="30px" class="mt-2">
                    <v-card-subtitle > <h3> BATCH : 2021 - WEB </h3> </v-card-subtitle>
                </div>
            </div>

            <div class="date mr-4">
                <h4>DOB:  07 / 12 / 2001</h4>
                <h4 class="mt-4">Marital Status: Single</h4>
            </div>

            <div class="detail" style="margin-right: 80px">
                <h4> Tel: +855 81 327 344 </h4>
                <h4 class="mt-4"> Email: jennie@gmail.com </h4>
            </div>
        </v-container>

        <v-card-actions style="margin-top: -20px">
            <v-btn
                color="blue darken-2"
                text
                @click="show = !show"
            >
                Explore
            </v-btn>
            <v-spacer></v-spacer>
            <v-btn
                icon
                @click="show = !show"
            >
                <v-icon>{{ show ? 'mdi-chevron-up' : 'mdi-chevron-down' }}</v-icon>
            </v-btn>
        </v-card-actions>

        <v-expand-transition>
        <div v-show="show">
            <v-divider></v-divider>
            <v-btn color="blue darkent-2" class="mb-0" text> Current Employment </v-btn>
            <v-card-text>
                <div class="d-flex rounded-lg" style="border: 2px solid #2196F3;">
                    <img src="../../assets/mangobyte.png" alt="" width="100px" height="100px" class="rounded-circle">
                    <h2 style="margin-top: 40px; margin-left: 15px">Mango Byte Cambodia</h2>
                    <h4 style="margin-top: 43px; margin-left: 210px">FULLSTACK DEVELOPER</h4>
                </div>
            </v-card-text>
        </div>
        </v-expand-transition>
    </v-card>
</template>

<script>
export default {
    data: () => ({
        show: false,
    }),
}
</script>

<style>
    body{
        font-family: Arial, Helvetica, sans-serif;
    }
</style>