<template>
<v-app>
    <v-navigation-drawer app v-model="showNavigation" absolute bottom temporary>
        <app-nav @logout="logOut">
        </app-nav>
    </v-navigation-drawer>
    <v-app-bar app dark color="blue" v-if="user != null">
        <v-app-bar-nav-icon @click.prevent="showNavigation = !showNavigation"></v-app-bar-nav-icon>
        <v-toolbar-title>ALUMNI - BOOK</v-toolbar-title>
        <v-spacer></v-spacer>
        <v-btn v-show="userRole==='Alumni'" :to="{ path: '/my_profile' }" class="mr-3" color="blue darken-2">
            <v-icon left>mdi-account-multiple</v-icon>
            My Profile
        </v-btn>
        <v-btn v-show="userRole==='ERO'" :to="{ path: '/explore_alumni' }" class="mr-3" color="blue darken-2">
            <v-icon left>mdi-school</v-icon>
            Explore Alumni
        </v-btn>
        <v-btn v-show="userRole==='ERO'" :to="{ path: '/host_event' }" class="mr-3" color="blue darken-2">
            <v-icon left>mdi-calendar-star</v-icon>
            Host Event
        </v-btn>
        <v-btn v-show="userRole==='Admin'" :to="{ path: '/manage_user' }" class="mr-3" color="blue darken-2">
            <v-icon left>mdi-account-star</v-icon>
            Manage User
        </v-btn>
    </v-app-bar>
    <v-main>
        <v-container fluid>
            <router-view @signin="logIn" @signup="signUp" :error="message_error" :errorEmail="email_error" :errorPassword="password_error"></router-view>
        </v-container>
    </v-main>
    <v-footer app> </v-footer>
</v-app>
</template>

<script>
import Navigation from './components/nav/Navigation.vue';
import axios from './axios-http';
export default {
    name: 'App',
    components: {
        'app-nav': Navigation,
    },
    data() {
        return {
            userRole : localStorage.getItem("role"),
            showNavigation: false,
            // _____SIGN IN AND SIGN UP______ //
            user: null,
            role: '',
            email: '',
            batch: '',

            // _____MANAGE ERROR______ //
            message_error: '',
            email_error: '',
            password_error: '',

            // _____USER DETAIL______ //
            gender: '',
            DOB: '',
            maritalStatus: '',
            city: '',
            major: '',
            skill: '',
            phoneNumber: ''
        };
    },
    methods: {
        // ______________________LOGIN________________________ //
        logIn(users) {
            console.log(users)
            axios.post('login', users)
                .then(res => {
                    console.log(res.data.user)
                    this.user = res.data.user.firstName;
                    this.email = res.data.user.email;
                    localStorage.setItem('user', this.user);
                    localStorage.setItem('email', this.email);
                    localStorage.setItem('batch', res.data.user.batch);
                    localStorage.setItem('id', res.data.user.id);
                    localStorage.setItem('personalInfo', true);
                    localStorage.setItem('isSignUp', false);
                    localStorage.setItem('role', res.data.user.role);
                    this.$router.push('/My_profile');
                    location.reload();
                })
                .catch(error => {
                    this.message_error = error.response.data.message;
                    console.log(this.user + ' ' + this.email);
                    console.log(error.response)
                });
        },
        // ______________________LOGOUT_______________________ //
        logOut() {
            this.user = null;
            localStorage.clear();
            this.$router.push('/');
        },
        // ______________________SIGN UP______________________ //
        signUp(newUsers) {
            axios.post('signup', newUsers)
                .then(res => {
                    console.log(res.data);
                    this.user = res.data.user.firstName + ' ' + res.data.user.lastName;
                    this.email = res.data.user.email;
                    this.password = res.data.user.password;
                    this.role = res.data.user.role;
                    this.batch = res.data.user.batch;
                    this.$router.push('/my_profile');
                    localStorage.setItem('user', this.user);
                    localStorage.setItem('email', this.email);
                    localStorage.setItem('batch', this.batch);
                    localStorage.setItem('id', res.data.user.id);
                    localStorage.setItem('isSignUp', true);
                    localStorage.setItem('role', this.role);
                    location.reload();
                })
                .catch(error => {
                    if (error.response.data.errors.email) {
                        this.email_error = error.response.data.errors.email[0];
                    } 
                    if (error.response.data.errors.password) {
                        this.password_error = error.response.data.errors.password[0];
                    }
                    localStorage.setItem('isSignUp', false);
                });
        },
    },
    mounted() {
        if (localStorage.user) {
            this.user = localStorage.getItem('user');
        }
    }
};
</script>
