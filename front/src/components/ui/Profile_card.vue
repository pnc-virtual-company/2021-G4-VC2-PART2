<template>
  <v-card
    class="mx-auto rounded-lg mt-6"
    max-width="850"
    dense
    elevation="5"
    height="100%"
  >
    <div class="edit-btn d-flex justify-end ma-2">
      <v-btn outlined small fab color="indigo">
        <v-icon>mdi-pencil</v-icon>
      </v-btn>
    </div>
    <div align="center">
      <v-avatar size="120" class="ml-4 mt-4">
        <img src="../../assets/jennie.jpg" alt="" />
      </v-avatar>

      <v-btn color=" edit_profile blue" fab small dark>
        <v-icon>mdi-pencil</v-icon>
      </v-btn>
    </div>
    <div class="d-flex justify-center" style="margin-left: 40px">
      <v-icon dark color="pink"> mdi-gender-female </v-icon>
      <h2 class="mt-1 mr-12">Mengheang</h2>
    </div>
    <div class="d-flex ma-1 mt-3">
      <div class="alumni-info-left">
        <div class="d-flex">
          <v-avatar size="50">
            <img src="../../assets/pn-logo.png" alt="" />
          </v-avatar>
          <h4 class="mt-4 ml-2">BATCH : 2021 - WEP</h4>
        </div>
        <div class="d-flex mt-2">
          <v-icon color="blue" class="ml-3" dark> mdi-map-marker </v-icon>
          <h5 class="ml-5 mt-2">City: Phnom Penh</h5>
        </div>
      </div>
      <div class="alumni-info-center">
        <div class="d-flex mt-2">
          <v-icon color="blue" dark> mdi-cake-layered </v-icon>
          <h5 class="mt-2 ml-4">DOB: 07/12/1995</h5>
        </div>
        <div class="d-flex mt-7">
          <v-icon color="blue" dark> mdi-gender-transgender </v-icon>
          <h5 class="mt-0 ml-4">Marital Status: Single</h5>
        </div>
        <div class="d-flex mt-4">
          <v-icon dark color="blue"> mdi-phone </v-icon>
          <h5 class="ml-4 mt-1">Tel: +885 81 327 344</h5>
        </div>
      </div>
      <div class="alumni-info-right">
        <div class="d-flex mt-4">
          <v-icon color="blue" dark> mdi-marker-check </v-icon>
          <h5 class="ml-4">Major: WEP</h5>
        </div>
        <div class="d-flex mt-4">
          <v-icon color="blue" dark> mdi-lightbulb-on </v-icon>
          <h5 class="ml-4 mt-2">Skill: JavaScript, VueJS, Vuetify</h5>
        </div>
        <div class="d-flex mt-5">
          <v-icon dark color="blue"> mdi-email </v-icon>
          <h5 class="ml-4">Email: jennie.blink@gmail.com</h5>
        </div>
      </div>
    </div>

    <v-card-actions>
      <v-btn
        class="explore-btn"
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
        style="height: 100%"
      >
        <v-card-text class="pb-0">
          <div class="d-flex">
            <v-avatar size="120">
              <img src="../../assets/mangobyte.png" alt="" />
            </v-avatar>
            <p class="text-h4 text--primary mt-3" style="margin-left: 22%">
              Mango Byte Cambodia
            </p>
          </div>
          <h5 class="ml-2 blue--text text-decoration-underline">
            www.mangobyte.com
          </h5>
          <p
            class="text-h4 blue--text mb-7"
            style="margin-left: 41%; margin-top: -43px"
          >
            WEP DEVELOPER
          </p>
          <div
            class="d-flex mb-7 rounded"
            style="background: #2196f3; padding: 4px"
          >
            <v-icon class="ml-1" light color="white">mdi-city</v-icon>
            <h3 class="ml-4 mt-1 white--text">Company's Info</h3>
          </div>
          <div class="mb-6 mt-3 d-flex justify-space-between">
            <div class="d-flex" style="width: 63%">
              <v-icon dark color="blue" class="mr-1"> mdi-map-marker </v-icon>
              <h3 class="mr-12 ml-3">
                Address: Aquation, #540 Koh Pich St, Koh Pich.
              </h3>
            </div>
            <div class="d-flex" style="width: 36%">
              <v-icon dark color="blue"> mdi-comment-account </v-icon>
              <h3 class="ml-2 ml-3">HR's name: Sophavatey Pich</h3>
            </div>
          </div>
          <div class="d-flex justify-space-between">
            <div class="d-flex" style="width: 63%">
              <v-icon dark color="blue" class="mr-1"> mdi-email </v-icon>
              <h3 class="mr-12 ml-3">Email: sophavatey@gmail.com</h3>
            </div>
            <div class="d-flex" style="width: 36%">
              <v-icon dark color="blue"> mdi-phone </v-icon>
              <h3 class="ml-2 ml-3">Tel: +855 81 327 344</h3>
            </div>
          </div>
        </v-card-text>
        <v-card-actions class="pt-0 float-end">
          <v-btn
            class="close-btn"
            text
            color="red accent-4"
            @click="reveal = false"
          >
            Close
          </v-btn>
        </v-card-actions>
      </v-card>
    </v-expand-transition>
  </v-card>
</template>

<script>
export default {
  data: () => ({
    reveal: false,
  }),
};
</script>

<style>
.v-card--reveal {
  bottom: 0;
  opacity: 1 !important;
  position: absolute;
  width: 100%;
}
.edit-btn {
  position: absolute;
  top: 5px;
  right: 5px;
}
.edit_profile {
  position: absolute;
  top: 95px;
  width: 100%;
  text-align: center;
  margin-left: -30px;
  font-size: 18px;
}
.alumni-info-left,
.alumni-info-center,
.alumni-info-right {
  padding: 5px;
  margin: 10px;
}
.alumni-info-left{
    width: 32%;
}
.alumni-info-center{
    width: 30%;
}
.alumni-info-right{
    width: 38%;
}
.explore-btn {
  border-bottom: 4px solid rgb(105, 167, 248);
  border-radius: 0px;
  padding: 0px;
  margin-left: 17px;
  margin-top: -60px;
  position: absolute;
}
.close-btn {
    margin-right: 20px;
  margin-top: -10px;
  border-bottom: 4px solid red;
  border-radius: 0px;
}
</style>