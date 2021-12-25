<template>
  <section>
    <!-- Start Card -->
    <v-card
      class="mx-auto mt-8"
      max-width="344"
      dense
      elevation="4"
      v-show="noPersonalInfo"
    >
      <h1 class="white--text">Hello</h1>
      <div align="center" style="margin-top: -15px">
        <v-avatar size="100">
          <img src="../../assets/avatar_profile.png" alt="" />
        </v-avatar>
      </div>

      <v-card-title class="d-flex justify-center">
        <h3 dark class="blue--text">{{ username }}</h3>
      </v-card-title>

      <v-card-subtitle class="mt-2">
        <div class="d-flex justify-center mb-4">
          <v-icon dark color="blue">mdi-school</v-icon>
          <h4 class="ml-2">Batch : {{ batch }}</h4>
        </div>
        <div class="d-flex justify-center">
          <v-icon dark color="blue">mdi-email</v-icon>
          <h4 class="ml-2">Email : {{ email }}</h4>
        </div>
      </v-card-subtitle>

      <!-- Start Dialog -->
      <v-row justify="center" style="margin-left: 83%; margin-top: -15px">
        <v-dialog v-model="dialog" persistent max-width="600px">
          <template v-slot:activator="{ on, attrs }">
            <v-btn
              fab
              dark
              small
              color="blue"
              v-bind="attrs"
              v-on="on"
              class="mb-3 mr-3"
            >
              <v-icon dark> mdi-plus </v-icon>
            </v-btn>
          </template>
          <v-card>
            <v-card-title
              class="d-flex justify-center"
              style="background: #2196f3"
            >
              <h3 dark class="white--text">Personal information</h3>
            </v-card-title>
            <v-card-text>
              <v-container>
                <v-row>
                  <v-col cols="12" sm="6" md="4" style="margin-top: 10px">
                    <!-- Date of Birth Start -->
                    <div>
                      <!-- <div class="mb-6">Active picker: <code>{{ activePicker || 'null' }}</code></div> -->
                      <v-menu
                        ref="menu"
                        v-model="menu"
                        :close-on-content-click="false"
                        transition="scale-transition"
                        offset-y
                        min-width="auto"
                      >
                        <template v-slot:activator="{ on, attrs }">
                          <v-text-field
                            v-model="date"
                            label="Birthday date"
                            solo
                            readonly
                            v-bind="attrs"
                            v-on="on"
                          ></v-text-field>
                        </template>
                        <v-date-picker
                          v-model="date"
                          :active-picker.sync="activePicker"
                          :max="
                            new Date(
                              Date.now() -
                                new Date().getTimezoneOffset() * 60000
                            )
                              .toISOString()
                              .substr(0, 10)
                          "
                          min="1950-01-01"
                          @change="save"
                        ></v-date-picker>
                      </v-menu>
                    </div>
                    <!-- Date of Birth End  -->
                  </v-col>
                  <v-col cols="12" sm="6" md="4" style="margin-top: 10px">
                    <v-select
                      :items="gender"
                      label="Gender"
                      solo
                      required
                      v-model="selectedGender"
                    ></v-select>
                  </v-col>
                  <v-col cols="12" sm="6" md="4" style="margin-top: 10px">
                    <v-select
                      :items="status"
                      label="Marital Status"
                      solo
                      required
                      v-model="selectedStatus"
                    ></v-select>
                  </v-col>
                  <v-col cols="12" sm="6" style="margin-top: -30px">
                    <v-select
                      :items="provinces"
                      label="Province"
                      solo
                      required
                      v-model="selectedProvince"
                    ></v-select>
                  </v-col>
                  <v-col cols="12" sm="6" style="margin-top: -30px">
                    <v-select
                      :items="majors"
                      label="Major"
                      solo
                      required
                      v-model="selectedMajor"
                    ></v-select>
                  </v-col>
                  <v-col cols="12" style="margin-top: -30px">
                    <v-autocomplete
                      v-model="skills"
                      :items="items"
                      dense
                      chips
                      small-chips
                      label="Alumni Skill"
                      multiple
                      solo
                    ></v-autocomplete>
                  </v-col>
                  <v-col cols="12" style="margin-top: -30px">
                    <v-text-field
                      label="Tel: +855"
                      type="phone"
                      solo
                      required
                      v-model="phone"
                    ></v-text-field>
                  </v-col>
                </v-row>
              </v-container>
            </v-card-text>
            <v-card-actions style="margin-top: -40px">
              <v-spacer></v-spacer>
              <v-btn color="blue darken-1" text @click="dialog = false">
                Close
              </v-btn>
              <v-btn
                color="blue darken-1"
                text
                @click="
                  dialog = false;
                  saveInfo();
                  addDetailInfo();
                "
              >
                Save
              </v-btn>
            </v-card-actions>
          </v-card>
        </v-dialog>
      </v-row>
      <!-- End Dialog -->
    </v-card>
    <!-- End Card -->

    <!-- Start Card Information -->
    <v-card
      class="mx-auto rounded-lg mt-6"
      max-width="850"
      dense
      elevation="5"
      height="100%"
      v-show="personalInfo"
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
        <v-icon dark color="blue"> mdi-gender-male </v-icon>
        <h2 class="mt-1 mr-12">{{ username }}</h2>
      </div>
      <div class="d-flex ma-1 mt-3">
        <div class="alumni-info-left">
          <div class="d-flex">
            <v-avatar size="50">
              <img src="../../assets/pn-logo.png" alt="" />
            </v-avatar>
            <h4 class="mt-4 ml-2">BATCH : {{ batch }}</h4>
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
            <h5 class="ml-4">Email: {{ email }}</h5>
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
    <!-- End Card Information -->
  </section>
</template>

<script>
import axios from "../../axios-http";
export default {
  data: () => ({
    username: "",
    email: "",
    batch: "",
    selectedGender: "",
    selectedMajor: "",
    selectedProvince: "",
    selectedStatus: "",
    skill: "",
    phone: "",
    reveal: false,
    dialog: false,
    activePicker: null,
    date: '2001-12-20',
    menu: false,
    personalInfo: false,
    noPersonalInfo: true,
    gender: ["Male", "Female"],
    status: [
      "Single",
      "Registered partnership",
      "Married",
      "Widowed",
      "Divorced",
      "Separated",
    ],
    majors: ["WEP", "SNA"],
    provinces: [
      "Phnom Penh",
      "Banteay Meanchey",
      "Battambang",
      "Kampong Cham",
      "Kampong Chhnang",
      "Kampong Speu",
      "Kampong Thom",
      "Kampot",
      "Kandal",
      "Koh Kong",
      "Kep",
      "Kratie",
      "Mondulkiri",
      "Oddar Meanchey",
      "Pailin",
      "Preah Sihanouk",
      "Preah Vihear",
      "Pursat",
      "Prey Veng",
      "Ratanakiri",
      "Siem Reap",
      "Stung Treng",
      "Svay Rieng",
      "Takeo",
      "Tbong Khmum",
    ],
    items: ['HTML', 'CSS', 'C++', 'C#','PHP','Python','JavaScript','Java','VueJs','Vuetify'],
    skills: [],
  }),
  watch: {
    menu(val) {
      val && setTimeout(() => (this.activePicker = "YEAR"));
    },
  },
  methods: {
    // _____________SAVE DATE_______________ //
    save(date) {
      this.$refs.menu.save(date);
    },

    // _____________SAVE INFO_______________ //
    saveInfo() {
      this.personalInfo = true;
      this.noPersonalInfo = false;
    },

    // _____________ADD DETAIL___________ //
    addDetailInfo() {
      let userInfo = {
        DOB: this.date,
        major: this.selectedMajor,
        gender: this.selectedGender,
        maritalStatus: this.selectedStatus,
        city: this.selectedProvince,
        skill: this.skill,
        phoneNumber: this.phone,
      };
      console.log(this.skills)
      axios
        .post("usersDetail", userInfo)
        .then((res) => {
          console.log(res.data);
        })
        .catch((error) => {
          console.log(error.response.data);
        });
    },
  },
  mounted() {
    this.username = localStorage.getItem("user");
    this.email = localStorage.getItem("email");
    this.batch = localStorage.getItem("batch");
    
  },
};
</script>

<style>
.v-card--reveal {
  bottom: 0;
  opacity: 1 !important;
  position: absolute;
  width: 100%;
}

/* Profile Card */
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

.alumni-info-left {
  width: 32%;
}

.alumni-info-center {
  width: 30%;
}

.alumni-info-right {
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
