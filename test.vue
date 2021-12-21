<template>
  <v-window-item :value="2">
                <v-row>
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
                    <v-card-text class="mt-12">
                        <h4 class="text-center">Sign Up for an Account</h4>
                        <h6 class="text-center grey--text">
                        Let's get you all set up so you can start creating your
                        <br />
                        first profile of experiance
                        </h6>
                        <v-row align="center" justify="center">
                        <v-col cols="12" sm="8">

                            <v-row>
                            <v-col cols="12" sm="6">
                                <v-text-field
                                label="First Name"
                                outlined
                                dense
                                color="blue"
                                autocomplete="false"
                                class="mt-4"
                                v-model="firstName"
                                />
                            </v-col>
                            <v-col cols="12" sm="6">
                                <v-text-field
                                label="Last Name"
                                outlined
                                dense
                                color="blue"
                                autocomplete="false"
                                class="mt-4"
                                v-model="lastName"
                                />
                            </v-col>
                            </v-row>
                            <v-text-field
                            label="Email"
                            outlined
                            dense
                            color="blue"
                            autocomplete="false"
                            v-model="emailAddress"
                            />
                            <v-text-field
                            label="Password"
                            outlined
                            dense
                            color="blue"
                            autocomplete="false"
                            type="password"
                            v-model="passWord"
                            />
                            <v-text-field
                            label="Confirm Password"
                            outlined
                            dense
                            color="blue"
                            autocomplete="false"
                            type="password"
                            v-model="conFirmPassWord"
                            />
                            <v-row>
                            <v-col cols="12" sm="7">
                            </v-col>
                            <v-col cols="12" sm="5">
                                <span class="caption blue--text ml-n4"
                                >Terms &Conditions</span
                                >
                            </v-col>
                            </v-row>
                            <v-btn color="blue" dark block tile @click="userSignUp">Sign up</v-btn>

                            <h5 class="text-center grey--text mt-4 mb-3">
                            Or Sign up using
                            </h5> --> -->
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
                        </v-col>
                        </v-row>
                    </v-card-text>
                    </v-col>
                </v-row>
                </v-window-item>
                <!-- End Sign UP -->
</template>

<script>
export default {

}
</script>

<style>

</style>