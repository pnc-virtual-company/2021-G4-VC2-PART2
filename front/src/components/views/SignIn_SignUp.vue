<template>
    <v-container class="container">
        <v-row align="center" justify="center">
        <v-col cols="12" sm="10">
            <v-card class="elevation-6 mt-10">
            <v-window v-model="step">
                <!-- Start Sign IN -->
                <v-window-item :value="1">
                <v-row>
                    <v-col cols="12" md="6">
                    <v-card-text class="mt-12">
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
                            v-model="email"
                            />
                            <v-text-field
                            label="Password"
                            outlined
                            dense
                            color="blue"
                            autocomplete="false"
                            type="password"
                            v-model="password"
                            />
                            <div class="message-error"> 
                                <span> {{error}} </span>
                            </div>
                            <v-row class="mt-1">
                                <v-col cols="12" sm="7">
                                    <v-checkbox
                                    label="Remember Me"
                                    class="mt-n1"
                                    color="blue"
                                    >
                                    </v-checkbox>
                                </v-col>
                                <v-col cols="12" sm="5">
                                    <span class="caption blue--text"
                                    >Forgot password</span
                                    >
                                </v-col>
                            </v-row>
                            <v-btn color="blue" dark block tile @click="logInRequest">Sign in</v-btn>
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
            </v-window>
            </v-card>
        </v-col>
        </v-row>
    </v-container>
</template>

<script>
export default {
    emits: ['signin'],
    props: ['error'],
    data: () => ({
        step: 1,
        email: '',
        password: ''
    }),
    methods: {
        // __________________LOGIN_________________ //
        logInRequest(e){
            e.preventDefault();
            let users = {
                email: this.email,
                password: this.password
            }
            this.$emit('signin', users);
        }
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
    
    .container{
        margin-top: -20px;
    }

    .message-error{
        color: red;
        text-align: center;
        margin-top: -15px;
    }
</style>
