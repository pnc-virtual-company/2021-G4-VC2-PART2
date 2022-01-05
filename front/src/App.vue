<template>
<v-app>
    <v-navigation-drawer app v-model="showNavigation" absolute bottom temporary>
        <app-nav @logout="logOut"> </app-nav>
    </v-navigation-drawer>
    <v-app-bar app dark color="blue" v-if="user != null">
        <v-app-bar-nav-icon @click.prevent="showNavigation = !showNavigation"></v-app-bar-nav-icon>
        <v-toolbar-title>ALUMNI - BOOK</v-toolbar-title>
        <v-spacer></v-spacer>
        <v-btn v-show="userRole === 'Alumni'" :to="{ path: '/my_profile' }" class="mr-3" color="blue darken-2">
            <v-icon left>mdi-account-multiple</v-icon>
            My Profile
        </v-btn>
        <v-btn v-show="userRole === 'ERO'" :to="{ path: '/explore_alumni' }" class="mr-3" color="blue darken-2">
            <v-icon left>mdi-school</v-icon>
            Explore Alumni
        </v-btn>
        <v-btn v-show="userRole === 'ERO'" :to="{ path: '/host_event' }" class="mr-3" color="blue darken-2">
            <v-icon left>mdi-calendar-star</v-icon>
            Host Event
        </v-btn>
        <v-btn v-show="userRole === 'Admin'" :to="{ path: '/manage_user' }" class="mr-3" color="blue darken-2">
            <v-icon left>mdi-database-lock</v-icon>
            Data management
        </v-btn>
        <v-avatar v-show="userRole === 'Admin' || userRole === 'ERO'" size="50" class="profile" color="white">
            <img @click="profileDialog = true" :src="userImage" alt="" />
        </v-avatar>
    </v-app-bar>
    <v-main>
        <v-container fluid>
            <router-view @signin="logIn" @signup="signUp" :error="message_error" :errorEmail="email_error" :errorPassword="password_error"></router-view>
        </v-container>
    </v-main>
    <v-footer app> </v-footer>
    <v-dialog style="" v-model="profileDialog" max-width="320">
        <v-card>
            <v-card-title class="blue white--text">
                <v-icon v-show="userRole === 'Admin'" large class="ml-2 mr-4">mdi-account-cog</v-icon>
                <v-icon v-show="userRole === 'ERO'" large class="ml-6 mr-4">mdi-account-group</v-icon>
                <h2 align="center">{{ userRole }} Profile.</h2>
            </v-card-title>

            <v-card-text>
                <div>
                    <div class="edit-btn d-flex justify-end ma-2">
                        <v-btn small fab color="#2196F3" class="white--text">
                            <v-icon @click="profileImgDialog = true">mdi-pencil</v-icon>
                        </v-btn>
                    </div>
                    <div align="center">
                        <v-avatar size="100" class="profile mt-4">
                            <img :src="userImage" alt="" />
                        </v-avatar>
                    </div>
                </div>
            </v-card-text>

            <v-card-actions>
                <v-spacer></v-spacer>

                <v-btn color="red darken-1" text @click="profileDialog = false">
                    close
                </v-btn>
            </v-card-actions>
        </v-card>
    </v-dialog>
    <v-dialog v-model="profileImgDialog" persistent max-width="300px">
        <v-card>
            <v-card-title class="blue white--text text-h5">Set Image</v-card-title>

            <v-card-text>
                <div>
                    <div class="mt-4">
                        <div class="choose-file d-flex ml-2">
                            <label for="profile">
                                <img id="pro_img" :src="imageView" aria-hidden="true" alt="profile" />
                            </label>
                            <input id="profile" class="d-none" accept="image/*" type="file" prepend-icon="mdi-camera" style="margin-bottom: -45px" @change="addImg" label="Select Your Image here" filled />
                        </div>
                    </div>
                </div>
            </v-card-text>
            <v-card-actions>
                <v-spacer></v-spacer>
                <v-btn color="red darken-1" text @click="profileImgDialog = false">
                    Cancle
                </v-btn>
                <v-btn color="blue darken-1" text @click="
              profileImgDialog = false;
              setProfileImage();
            ">
                    Save
                </v-btn>
            </v-card-actions>
        </v-card>
    </v-dialog>
</v-app>
</template>

<script>
import Navigation from "./components/nav/Navigation.vue";
import axios from "./axios-http";
export default {
    name: "App",
    components: {
        "app-nav": Navigation,
    },
    data() {
        return {
            userImage: "https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSYkqvYG5-sMQG1Wm2gY_1ncjxEaI4D3HfDPwO9c0i13sf2zgQV12rCz1BTXwL3vd-D7p4&usqp=CAU",
            imageView: "https://www.portal.chat/img/avatar.svg",
            userRole: localStorage.getItem("role"),
            userId: localStorage.getItem("id"),
            showNavigation: false,
            profileDialog: false,
            profileImgDialog: false,
            oneUser: [],
            // ____SIGN IN AND SIGN UP_____ //
            user: null,
            role: "",
            email: "",
            batch: "",

            // ____MANAGE ERROR_____ //
            message_error: "",
            email_error: "",
            password_error: "",

            // ____USER DETAIL_____ //
            gender: "",
            DOB: "",
            maritalStatus: "",
            city: "",
            major: "",
            skill: "",
            phoneNumber: "",
        };
    },
    methods: {
        // _____________________LOGIN_______________________ //
        logIn(users) {
            axios
                .post("login", users)
                .then((res) => {
                    console.log(res.data.user);
                    this.user = res.data.user.firstName;
                    this.email = res.data.user.email;
                    localStorage.setItem("user", this.user);
                    localStorage.setItem("email", this.email);
                    localStorage.setItem("batch", res.data.user.batch);
                    localStorage.setItem("id", res.data.user.id);
                    localStorage.setItem("personalInfo", true);
                    localStorage.setItem("isSignUp", false);
                    localStorage.setItem("role", res.data.user.role);
                    if (res.data.user.isComplete === 0) {
                        localStorage.setItem("isUSerComplete", false);
                    } else {
                        localStorage.setItem("isUSerComplete", true);
                    }

                    if (res.data.user.role === "ERO") {
                        this.$router.push("/explore_alumni");
                    } else if (res.data.user.role === "Admin") {
                        this.$router.push("/manage_user");
                    } else {
                        this.$router.push("/My_profile");
                    }

                    location.reload();
                })
                .catch((error) => {
                    this.message_error = error.response.data.message;
                    console.log(this.user + " " + this.email);
                    console.log(error.response);
                });
        },
        // _____________________LOGOUT______________________ //
        logOut() {
            this.user = null;
            localStorage.clear();
            this.$router.push("/");
        },
        // _____________________SIGN UP_____________________ //
        signUp(newUsers) {
            axios
                .post("signup", newUsers)
                .then((res) => {
                    console.log(res.data);
                    this.user = res.data.user.firstName + " " + res.data.user.lastName;
                    this.email = res.data.user.email;
                    this.password = res.data.user.password;
                    this.role = res.data.user.role;
                    this.batch = res.data.user.batch;
                    this.$router.push("/my_profile");
                    localStorage.setItem("user", this.user);
                    localStorage.setItem("email", this.email);
                    localStorage.setItem("batch", this.batch);
                    localStorage.setItem("id", res.data.user.id);
                    localStorage.setItem("isSignUp", true);
                    localStorage.setItem("role", this.role);
                    if (res.data.user.isComplete === 0) {
                        localStorage.setItem("isUSerComplete", false);
                    } else {
                        localStorage.setItem("isUSerComplete", true);
                    }
                    location.reload();
                })
                .catch((error) => {
                    console.log(error);
                    this.email_error = error.response.data.message;
                    this.password_error = error.response.data.errors.password;
                    console.log(this.email_error);
                    localStorage.setItem("isSignUp", false);
                });
        },
        getUser() {
            axios.get("users/" + this.userId).then((res) => {
                this.oneUser = res.data;
                if (this.oneUser.userImage != null) {
                    this.userImage =
                        "http://127.0.0.1:8000/storage/images/users/" + this.oneUser.userImage;
                }
            });
        },
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
                .then((res) => {
                    this.getUser();
                    console.log(res.data)
                    location.reload();
                })
                .catch((error) => {
                    console.log(error.response.data.message);
                });
            this.imageView = "https://www.portal.chat/img/avatar.svg";
        },
    },
    mounted() {
        if (localStorage.user) {
            this.user = localStorage.getItem("user");
        }
        if (this.userId != null) {
            this.getUser()
        }
    },
};
</script>

<style scoped>
.edit-btn {
    position: absolute;
    z-index: 1;
    top: 135px;
    right: 90px;
}
</style>
