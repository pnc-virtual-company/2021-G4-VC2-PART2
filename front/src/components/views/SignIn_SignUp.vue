<template>
  <v-container style="margin-top: 0">
    <v-row align="center" justify="center">
      <v-col cols="12" sm="10">
        <v-card class="elevation-6 mt-10">
          <v-window v-model="step">
            <!-- Start Sign IN -->
            <v-window-item :value="1">
              <v-row>
                <v-col cols="12" md="6">
                  <v-card-text class="mt-4">
                    <h4 class="text-center">Sign in to Your Account</h4>
                    <h6 class="text-center grey--text">
                      Sign in to your account so you can continue viewing
                      <br />and editing your profile
                    </h6>
                    <v-row align="center" justify="center">
                      <v-col cols="12" sm="8">
                        <v-text-field
                          label="Email"
                          outlined
                          dense
                          color="blue"
                          autocomplete="false"
                          class="mt-16"
                          append-icon="mdi-email"
                          v-model="signInEmail"
                        />
                        <v-text-field
                          label="Password"
                          outlined
                          dense
                          color="blue"
                          autocomplete="false"
                          v-model="signInPassword"
                          :type="passwordShow ? 'text' : 'password'"
                          :append-icon="
                            passwordShow ? 'mdi-eye' : 'mdi-eye-off'
                          "
                          @click:append="passwordShow = !passwordShow"
                        />
                        <v-btn
                          color="blue"
                          dark
                          block
                          tile
                          cols="12"
                          sm="7"
                          @click="logInRequest"
                          >Sign in</v-btn
                        >

                        <h5 class="text-center grey--text mt-4 mb-3">
                          Or Sign in using
                        </h5>
                        <div
                          class="
                            d-flex
                            justify-space-between
                            align-center
                            mx-10
                            mb-16
                          "
                        >
                          <v-btn depressed outlined color="grey">
                            <v-icon color="red">fab fa-google</v-icon>
                          </v-btn>
                          <v-btn depressed outlined color="grey">
                            <v-icon color="blue">fab fa-facebook-f</v-icon>
                          </v-btn>
                          <v-btn depressed outlined color="grey">
                            <v-icon color="light-blue lighten-3"
                              >fab fa-twitter</v-icon
                            >
                          </v-btn>
                        </div>
                      </v-col>
                    </v-row>
                  </v-card-text>
                </v-col>
                <v-col cols="12" md="6" class="blue rounded-bl-xl">
                  <div style="text-align: center; padding: 180px 0">
                    <v-card-text class="white--text">
                      <h3 class="text-center">Don't Have an Account Yet?</h3>
                      <h6 class="text-center">
                        Let's get you all set up so you can start creating your
                        first<br />
                        profile of experience
                      </h6>
                    </v-card-text>
                    <div class="text-center">
                      <v-btn tile outlined dark @click="step++">SIGN UP</v-btn>
                    </div>
                  </div>
                </v-col>
              </v-row>
            </v-window-item>
            <!-- End Sign IN -->
            <!-- Start Sign UP -->
            <v-window-item :value="2">
              <div>
                <v-alert
                  class="alert"
                  v-if="alert"
                  dismissible
                  :color="dialogColor"
                  border="left"
                  elevation="2"
                  colored-border
                  icon="mdi-account-multiple-remove"
                >
                  {{ message }}
                </v-alert>
              </div>
              <v-row class="sign-up">
                <v-col cols="12" md="6" class="blue rounded-br-xl">
                  <div style="text-align: center; padding: 180px 0">
                    <v-card-text class="white--text">
                      <h3 class="text-center">Already Signed up?</h3>
                      <h6 class="text-center">
                        Sign in to your account so you can continue creating
                        and<br />
                        editing your profile of experiance
                      </h6>
                    </v-card-text>
                    <div class="text-center">
                      <v-btn tile outlined dark @click="step--">Sign in</v-btn>
                    </div>
                  </div>
                </v-col>
                <v-col cols="12" md="6">
                  <v-card-text class="mt-6">
                    <div class="sign-up-top">
                      <h4 class="text-center">Sign Up for an Account</h4>
                      <h6 class="text-center grey--text">
                        Let's get you all set up so you can start creating your
                        <br />
                        first profile of experiance
                      </h6>
                    </div>
                    <v-row align="center" justify="center">
                      <v-col cols="12" sm="8">
                        <div v-show="!namePart" class="sign-up-center mt-5">
                          <v-row>
                            <v-col cols="12" sm="12">
                              <v-select
                                :items="listbatches"
                                label="Batch"
                                dense
                                :rules="[
                                  (v) => !!v || 'Batch select is required',
                                ]"
                                outlined
                                @change="batchSelected"
                                style="margin-bottom: -40px"
                                v-model="batch"
                              ></v-select>
                            </v-col>
                            <v-col cols="12" sm="6">
                              <v-text-field
                                label="First Name"
                                outlined
                                dense
                                :rules="[(v) => !!v || 'Firstname required']"
                                required
                                color="blue"
                                autocomplete="false"
                                class="mt-4"
                                v-model="firstName"
                                @keyup="isvalid"
                              />
                            </v-col>
                            <v-col cols="12" sm="6">
                              <v-text-field
                                label="Last Name"
                                outlined
                                required
                                dense
                                :rules="[(v) => !!v || 'Lastname required']"
                                color="blue"
                                autocomplete="false"
                                class="mt-4"
                                @keyup="isvalid"
                                v-model="lastName"
                              />
                            </v-col>
                            <v-col
                              cols="auto"
                              align="center"
                              justify="center"
                              style="margin-top: -25px"
                            >
                              <v-dialog
                                transition="dialog-top-transition"
                                max-width="600"
                              >
                                <template v-slot:activator="{ on, attrs }">
                                  <v-btn
                                    style="width: 285px"
                                    v-show="signUpTimes === 0"
                                    color="primary"
                                    v-bind="attrs"
                                    v-on="on"
                                    >Want any help?</v-btn
                                  >
                                  <v-btn
                                    style="width: 285px"
                                    v-show="signUpTimes > 0"
                                    :disabled="!isNotNull"
                                    dark
                                    color="blue"
                                    @click="isAlumni()"
                                  >
                                    Next
                                  </v-btn>
                                </template>
                                <template v-slot:default="dialog">
                                  <v-card>
                                    <v-toolbar color="primary" dark>
                                      <v-avatar class="mr-4" size="50">
                                        <img
                                          src="../../assets/pn-logo.png"
                                          alt=""
                                        />
                                      </v-avatar>
                                      <h2 class="text-danger">
                                        Your name was not found!
                                      </h2>
                                      </v-toolbar>
                                    <v-card-text>
                                      <div class=" pa-2 mb-0 text-dark">
                                          <h3>Please Contact to Our Admin or Our
                                            Ero officer below:</h3>
                                        </div>
                                      <div class="pa-4">
                                        <div class="d-flex">
                                          <v-icon
                                            dark
                                            color="blue"
                                            class="mr-4"
                                          >
                                           mdi-shield-half-full
                                          </v-icon>
                                          <h2 class="mt-1 mr-12">Admin</h2>
                                        </div>
                                        <div class="ml-12">
                                          <div class="d-flex">
                                            <v-icon
                                              dark
                                              color="blue"
                                              class="mr-4"
                                            >
                                              mdi-account
                                            </v-icon>
                                            <h4 class="mt-1 ml-12">Hun Synich</h4>
                                          </div>
                                          <div class="d-flex">
                                            <v-icon
                                              dark
                                              color="blue"
                                              class="mr-4"
                                            >
                                              mdi-email-multiple
                                            </v-icon>
                                            <h4 class="mt-1 ml-12">synich.admin@gmail.com</h4>
                                          </div>
                                          <div class="d-flex">
                                            <v-icon
                                              dark
                                              color="blue"
                                              class="mr-4"
                                            >
                                              mdi-phone
                                            </v-icon>
                                            <h4 class="mt-1 ml-12">0123446789</h4>
                                          </div>
                                        </div>
                                        <div class="d-flex">
                                          <v-icon
                                            dark
                                            color="blue"
                                            class="mr-4"
                                          >
                                            mdi-account-group
                                          </v-icon>
                                          <h2 class="mt-1 mr-12">Ero Team</h2>
                                        </div>
                                        <div class="ml-12">
                                          <div class="d-flex">
                                            <v-icon
                                              dark
                                              color="blue"
                                              class="mr-4"
                                            >
                                              mdi-account
                                            </v-icon>
                                            <h4 class="mt-1 ml-12">Ero Officer</h4>
                                          </div>
                                          <div class="d-flex">
                                            <v-icon
                                              dark
                                              color="blue"
                                              class="mr-4"
                                            >
                                              mdi-email-multiple
                                            </v-icon>
                                            <h4 class="mt-1 ml-12">Ero.croCambodia@gmail.com</h4>
                                          </div>
                                          <div class="d-flex">
                                            <v-icon
                                              dark
                                              color="blue"
                                              class="mr-4"
                                            >
                                              mdi-phone
                                            </v-icon>
                                            <h4 class="mt-1 ml-12">0123446789</h4>
                                          </div>
                                        </div>
                                      </div>
                                    </v-card-text>
                                    <v-card-actions class="justify-end">
                                      <v-btn
                                        text
                                        color="primary"
                                        @click="dialog.value = false;refreshPage()"
                                        >Thank You!</v-btn
                                      >
                                    </v-card-actions>
                                  </v-card>
                                </template>
                              </v-dialog>
                            </v-col>
                          </v-row>
                        </div>
                        <div v-show="questionPart" class="mt-4">
                          <h3 align="center">Which one is the value of PNC?</h3>
                          <v-radio-group
                            v-model="valueSelected"
                            class="ml-12"
                            @change="toSignUp"
                          >
                            <v-radio
                              v-for="(index, value) of listValues"
                              :key="index"
                              :label="index"
                              :value="listValues[value]"
                            ></v-radio>
                          </v-radio-group>
                          <div class="ml-8">
                            <span id="mss" :style="{color:spanMssColor}" >{{ selectMessage }}</span>
                          </div>
                        </div>
                        <div v-show="singUpPart">
                          <v-row>
                            <v-col cols="12" sm="12">
                              <v-text-field
                                class="mt-5"
                                label="E-mail"
                                outlined
                                dense
                                :rules="[(v) => !!v || 'E-mail is required']"
                                color="blue"
                                autocomplete="false"
                                style="margin-bottom: -30px"
                                v-model="emailAddress"
                                append-icon="mdi-email"
                              />
                              <div align="center" class="mt-2" style="margin-bottom: -15px">
                                <span class="red--text">{{emailError[0]}}</span>
                              </div>
                            </v-col>
                            <v-col cols="12" sm="12">
                              <v-text-field
                                label="password"
                                :type="passwordShow ? 'text' : 'password'"
                                outlined
                                dense
                                :rules="[(v) => !!v || 'Password is required']"
                                color="blue"
                                autocomplete="false"
                                style="margin-bottom: -30px"
                                v-model="passWord"
                                :append-icon="
                                  passwordShow ? 'mdi-eye' : 'mdi-eye-off'
                                "
                                @click:append="passwordShow = !passwordShow"
                              />
                            </v-col>
                            <v-col cols="12" sm="12">
                              <v-text-field
                                label="Confirm password"
                                :type="
                                  confirmPasswordShow ? 'text' : 'password'
                                "
                                outlined
                                dense
                                :rules="[
                                  (v) => !!v || 'confirm Password is required',
                                ]"
                                color="blue"
                                autocomplete="false"
                                style="margin-bottom: -30px"
                                v-model="conFirmPassWord"
                                :append-icon="
                                  confirmPasswordShow
                                    ? 'mdi-eye'
                                    : 'mdi-eye-off'
                                "
                                @click:append="
                                  confirmPasswordShow = !confirmPasswordShow
                                "
                              />
                              <div align="center" class="mt-4" style="margin-bottom: -30px">
                                <span class="red--text">{{passwordError[0]}}</span>
                              </div>
                            </v-col>
                            <v-btn
                              class="mt-6"
                              color="blue"
                              dark
                              block
                              tile
                              @click="signUpRequest"
                              >Sign up</v-btn
                            >
                          </v-row>
                        </div>

                        <div class="sign-up-bottom">
                          <h5 class="text-center grey--text mt-5 mb-3">
                            Or Sign up using
                          </h5>
                          <div
                            class="
                              d-flex
                              justify-space-between
                              align-center
                              mx-10
                              mb-11
                            "
                          >
                            <v-btn depressed outlined color="grey">
                              <v-icon color="red">fab fa-google</v-icon>
                            </v-btn>
                            <v-btn depressed outlined color="grey">
                              <v-icon color="blue">fab fa-facebook-f</v-icon>
                            </v-btn>
                            <v-btn depressed outlined color="grey">
                              <v-icon color="light-blue lighten-3"
                                >fab fa-twitter</v-icon
                              >
                            </v-btn>
                          </div>
                        </div>
                      </v-col>
                    </v-row>
                  </v-card-text>
                </v-col>
              </v-row>
            </v-window-item>
          </v-window>
        </v-card>
      </v-col>
    </v-row>
  </v-container>
</template>
<script>
import json from "../json/PncValues.json";
export default {
emits: ['signin', 'signup'],
props: ['error', 'emailError', 'passwordError'],
  data: () => ({
    step: 1,
    defaultSignUpTimes: 2,
    signUpTimes: 0,
    randomIndex: 0,
    pncValues: json,
    realValues: [
      "Respect",
      "Responsible",
      "Trust",
      "Demading approach",
      "Solidarity",
    ],
    signInEmail: "",
    signInPassword: "",
    confirmPasswordShow: false,
    passwordShow: false,
    alert: false,
    isNotNull: false,
    isAnAlumni: false,
    isDialog: false,
    namePart: false,
    singUpPart: false,
    questionPart: false,
    message: null,
    selectMessage: null,
    btnText: null,
    spanMssColor:null,
    dialogColor: null,
    batch: null,
    firstName: null,
    lastName: null,
    emailAddress: null,
    passWord: null,
    conFirmPassWord: null,
    valueSelected: null,
    userRole: null,
    listValues: [],
    listAlumni: [],
    listbatches: [],
    listAllAlumni: [
      {
        batch: "Batch-2021",
        alumni: [
          { firstName: "a", lastName: "a" },
          { firstName: "mengheang", lastName: "pho" },
          { firstName: "menghour", lastName: "oeung" },
          { firstName: "bunsal", lastName: "hul" },
          { firstName: "sothean", lastName: "chhoun" },
          { firstName: "sreyaem", lastName: "hourn" },
        ],
      },
      {
        batch: "Batch-2020",
        alumni: [
          { firstName: "mengheang", lastName: "pho" },
          { firstName: "menghour", lastName: "oeung" },
          { firstName: "bunsal", lastName: "hul" },
          { firstName: "sothean", lastName: "chhoun" },
          { firstName: "sreyaem", lastName: "hourn" },
        ],
      },
      {
        batch: "Batch-2019",
        alumni: [
          { firstName: "mengheang", lastName: "pho" },
          { firstName: "menghour", lastName: "oeung" },
          { firstName: "bunsal", lastName: "hul" },
          { firstName: "sothean", lastName: "chhoun" },
          { firstName: "sreyaem", lastName: "hourn" },
        ],
      },
    ],
  }),
  methods: {
    refreshPage(){
      location.reload()
    },
    //   get value
    getValues() {
      let index = parseInt((this.randomIndex = Math.random() * 10));
      this.listValues = this.pncValues[index];
    },

    // __________________LOGIN_________________ //
    logInRequest(e){
        e.preventDefault();
        let users = {
            email: this.signInEmail,
            password: this.signInPassword
        }
        console.log(users.email + ' ' + users.password);
        this.$emit('signin', users);
    },
    // __________________SIGN UP___________________ //
    signUpRequest(e) {
        e.preventDefault();
        let newUsers = {
          firstName: this.firstName,
          lastName: this.lastName,
          email: this.emailAddress,
          password: this.passWord,
          password_confirmation: this.conFirmPassWord,
          role: 'Alumni',
        }
        // console.log(newUsers);
        this.$emit('signup', newUsers);
    },

    // __________________GET BATCH_________________ //
    getbatch() {
      for (let batchs of this.listAllAlumni) {
        this.listbatches.push(batchs.batch);
      }
    },
    // __________________BATCH SELECTED____________ //
    batchSelected() {
      for (let batchs of this.listAllAlumni) {
        if (batchs.batch === this.batch) {
          this.listAlumni = batchs.alumni;
        }
      }
    },
    // ___________________ENABLE NEXT BUTTON_______ //
    isvalid() {
      if (this.firstName != null && this.lastName != null) {
        this.isNotNull = true;
      }
    },
    // ___________________CHECK ALUMNI_____________ //
    isAlumni() {
      let signUpTimeout = (this.signUpTimes -= 1);
      this.isDialog = true;
      for (let alumni of this.listAlumni) {
        if (
          this.firstName === alumni.firstName &&
          this.lastName === alumni.lastName
        ) {
          this.isAnAlumni = true;
        }
      }
      if (!this.isAnAlumni) {
        if (signUpTimeout === 2) {
          this.message = "Are you sure that you fill your name correctly?";
        } else if (signUpTimeout === 1) {
          this.message = "Are you a PNC student?";
        } else {
          this.message = "Your time is up! Thanks for Joining us.";
        }
        this.dialogColor = "red";
        this.alert = !this.alert;
        setTimeout(() => {
          this.alert = !this.alert;
          this.batch = null;
          this.firstName = null;
          this.lastName = null;
        }, 4000);
      } else {
        this.message = "You are alumni at PNC.";
        this.dialogColor = "success";
        this.alert = !this.alert;
        setTimeout(() => {
          this.alert = !this.alert;
          this.getValues();
          this.namePart = !this.namePart;
          this.questionPart = !this.questionPart;
        }, 4000);
      }
    },
    // ________________TO SIGN UP___________________ //
    toSignUp() {
      let istrue = false;
      for (let value of this.realValues) {
        if (value === this.valueSelected) {
          istrue = true;
        }
      }
      if (istrue) {
        this.spanMssColor='green'
        this.selectMessage = "Your selection is the right answer!";
        setTimeout(() => {
          this.singUpPart = !this.singUpPart;
          this.questionPart = !this.questionPart;
        }, 3000);
      } else {
        this.spanMssColor='red'
        this.selectMessage = "Your selection is not the right answer!";
        setTimeout(() => {
          this.selectMessage = null;
          this.valueSelected = null;
        }, 3000);
        this.getValues();
      }
    },
  },
  mounted() {
    this.getbatch();
    this.signUpTimes = this.defaultSignUpTimes;
  },
};
</script>

<style scoped>
.v-application .rounded-bl-xl {
  border-bottom-left-radius: 300px !important;
}
.v-application .rounded-br-xl {
  border-bottom-right-radius: 300px !important;
}
.alert {
  margin: 10px;
  width: 98%;
  opacity: 1 !important;
  position: absolute;
}
.sign-up {
  height: 100%;
}
.sign-up-top {
  height: 20%;
}
.sign-up-center {
  padding: auto;
  height: 180px;
  padding-top: 20px;
}
.sign-up-bottom {
  height: 20%;
}
.-margin {
  margin-bottom: -40px;
}
#mss {
  position: absolute;
}

</style>
