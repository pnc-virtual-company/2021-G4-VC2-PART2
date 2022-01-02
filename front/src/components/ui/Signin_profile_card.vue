<template>
  <section>
    <v-card
      class="mx-auto rounded-lg"
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
        <v-avatar size="120" class="profile ml-4 mt-4">
          <img :src="userImage" alt="" />
        </v-avatar>
        <!-- img dialog  -->
        <div>
          <v-row justify="center">
            <v-dialog v-model="profileDialog" persistent max-width="300px">
              <template v-slot:activator="{ on, attrs }">
                <v-btn
                  color="blue"
                  class="edit_profile"
                  fab
                  small
                  dark
                  v-bind="attrs"
                  v-on="on"
                >
                  <v-icon>mdi-pencil</v-icon>
                </v-btn>
              </template>
              <v-card>
                <v-card-title>
                  <span class="text-h5">Set Image</span>
                </v-card-title>
                <v-card-text>
                  <div>
                    <div class="choose-file d-flex ml-2">
                      <label for="profile">
                        <img
                          id="pro_img"
                          :src="imageView"
                          aria-hidden="true"
                          alt="profile"
                        />
                      </label>
                      <input
                        id="profile"
                        class="d-none"
                        accept="image/*"
                        type="file"
                        prepend-icon="mdi-camera"
                        style="margin-bottom: -45px"
                        @change="addImg"
                        label="Select Your Image here"
                        filled
                      />
                    </div>
                  </div>
                </v-card-text>
                <v-card-actions>
                  <v-spacer></v-spacer>
                  <v-btn
                    color="blue darken-1"
                    text
                    @click="profileDialog = false"
                  >
                    Cancle
                  </v-btn>
                  <v-btn
                    color="blue darken-1"
                    text
                    @click="
                      profileDialog = false;
                      setProfileImage();
                    "
                  >
                    Save
                  </v-btn>
                </v-card-actions>
              </v-card>
            </v-dialog>
          </v-row>
          <!-- end img dialog  -->
        </div>
      </div>
      <div
        class="d-flex justify-center"
        style="margin-left: 40px; margin-top: 30px"
      >
        <v-icon dark color="pink" class="mr-2" v-if="gender[1] === sex">
          mdi-gender-female
        </v-icon>
        <v-icon dark color="blue" class="mr-2" v-else> mdi-gender-male </v-icon>
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
            <h5 class="ml-5 mt-2">City: {{ userProvince }}</h5>
          </div>
        </div>
        <div class="alumni-info-center">
          <div class="d-flex mt-2">
            <v-icon color="blue" dark> mdi-cake-layered </v-icon>
            <h5 class="mt-2 ml-4">DOB: {{ dateofbirth }}</h5>
          </div>
          <div class="d-flex mt-7">
            <v-icon color="blue" dark> mdi-gender-transgender </v-icon>
            <h5 class="mt-0 ml-4">Marital Status: {{ userMaritalStatus }}</h5>
          </div>
          <div class="d-flex mt-4">
            <v-icon dark color="blue"> mdi-phone </v-icon>
            <h5 class="ml-4 mt-1">Tel: +885 {{ userPhoneNumber }}</h5>
          </div>
        </div>
        <div class="alumni-info-right">
          <div class="d-flex mt-4">
            <v-icon color="blue" dark> mdi-marker-check </v-icon>
            <h5 class="ml-4">Major: {{ userMajor }}</h5>
          </div>
          <div class="d-flex mt-4">
            <v-icon color="blue" dark> mdi-lightbulb-on </v-icon>
            <h5 class="ml-2 mt-2" v-html="skillConvert(userSkill)"></h5>
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
                <img :src="companyProfile" alt="" />
              </v-avatar>
              <p class="text-h4 orange--text mt-5" style="margin-left: 20%">
                {{ companyName }}
              </p>
            </div>
            <h5 class="ml-2 blue--text text-decoration-underline">
              {{ website }}
            </h5>
            <p
              class="text-h4 blue--text mb-7"
              style="margin-left: 41%; margin-top: -43px"
            >
              {{ position }}
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
                <h3 class="mr-12 ml-3">Address: {{ address }}.</h3>
              </div>
              <div class="d-flex" style="width: 36%">
                <v-icon dark color="blue"> mdi-comment-account </v-icon>
                <h3 class="ml-2 ml-3">HR's name: {{ HR_name }}</h3>
              </div>
            </div>
            <div class="d-flex justify-space-between">
              <div class="d-flex" style="width: 63%">
                <v-icon dark color="blue" class="mr-1"> mdi-email </v-icon>
                <h3 class="mr-12 ml-3">Email: {{ company_email }}</h3>
              </div>
              <div class="d-flex" style="width: 36%">
                <v-icon dark color="blue"> mdi-phone </v-icon>
                <h3 class="ml-2 ml-3">Tel: +855 {{ company_tel }}</h3>
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
  </section>
</template>

<script>
import axios from "../../axios-http";
export default {
  data: () => ({
    userImage: "https://www.portal.chat/img/avatar.svg",
    profileDialog: false,
    imageView: "https://www.portal.chat/img/avatar.svg",
    gender: ["Male", "Female"],
    sex: "",
    username: "",
    userId: localStorage.getItem("id"),
    userMajor: "",
    userMaritalStatus: "",
    userSkill: "",
    userPhoneNumber: "",
    userProvince: "",
    batch: "",
    dateofbirth: "",
    reveal: false,
    email: "",
    companyProfile:
      "https://png.pngtree.com/png-vector/20190418/ourlarge/pngtree-vector-office-building-icon-png-image_953174.jpg",
  }),
  watch: {
    menu(val) {
      val && setTimeout(() => (this.activePicker = "YEAR"));
    },
  },
  methods: {
    // ________________CONVERT SKILL TO STRING  _____________________
    skillConvert(skills) {
      let skillLength = skills.length;
      let listSkill = skills[0] + " | " + skills[1];
      if (skillLength > 2) {
        return listSkill + " and " + (skillLength - 2) + " other.";
      } else {
        return listSkill;
      }
    },
    // ____________SAVE DATE______________ //
    save(date) {
      this.$refs.menu.save(date);
    },
    // _______________Get User ____________________///
    getUser() {
      axios.get("users/" + this.userId).then((res) => {
        this.user = res.data;
        if (this.user.userImage != null) {
          this.userImage =
            "http://127.0.0.1:8000/storage/images/users/" + this.user.userImage;
        }
      });
    },
    // ____________GET USER DETAIL__________ //
    getuserDetailInfo() {
      axios.get("usersDetail/" + this.userId).then((res) => {
        this.detailInfo = res.data[0];
        this.dateofbirth = this.detailInfo.birthDate;
        this.sex = this.detailInfo.gender;
        this.userMajor = this.detailInfo.major;
        this.userSkill = this.detailInfo.skills;
        this.userMaritalStatus = this.detailInfo.maritalStatus;
        this.userProvince = this.detailInfo.city;
        this.userPhoneNumber = this.detailInfo.phoneNumber;
      });
    },
    // ____________GET COMPANY__________ //

    getCompanyDetailInfo() {
      axios.get("companies_detail/" + this.userId).then((res) => {
        this.companyInfo = res.data[0];
        this.companyId = this.companyInfo.id;
        this.website = this.companyInfo.companyWebsite;
        this.address = this.companyInfo.companyLocation;
        this.position = this.companyInfo.alumniPosition;
        this.HR_name = this.companyInfo.companyHR;
        this.company_email = this.companyInfo.companyEmail;
        this.company_tel = this.companyInfo.companyContact;
        this.companyName = this.companyInfo.companyName;
        this.companyProfile =
          "http://127.0.0.1:8000/storage/images/companies/" +
          this.companyInfo.companyImage;
      });
    },
    // ____________Set Image Profile_____________//
    addImg(event) {
      this.profileImage = event.target.files[0];
      this.imageView = window.URL.createObjectURL(this.profileImage);
    },
    setProfileImage() {
      let UserDetail = new FormData();
      UserDetail.append("userImage", this.profileImage);
      UserDetail.append("_method", "PUT");
      axios
        .post("users/images/" + this.userId, UserDetail)
        .then(() => {
          this.getUser();
          location.reload();
        })
        .catch((error) => {
          console.log(error.response.data.message);
        });
      this.imageView = "https://www.portal.chat/img/avatar.svg";
    },
  },
  mounted() {
    this.username = localStorage.getItem("user");
    this.email = localStorage.getItem("email");
    this.batch = localStorage.getItem("batch");
    this.getUser();
    this.getCompanyDetailInfo();
    this.getuserDetailInfo();
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
  margin-right: -100px;
}

.edit_profile:hover {
  color: gray;
  top: 95px;
  width: 45px;
  height: 45px;
}

.alumni-info-left,
.alumni-info-center,
.alumni-info-right {
  padding: 5px;
  margin: 10px;
}

.alumni-info-left {
  width: 28%;
}

.alumni-info-center {
  width: 34%;
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
