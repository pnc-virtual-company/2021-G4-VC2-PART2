<template>
<section>
    <!-- Search and Sort -->
    <div class="search">
        <input type="search" class="search_input" placeholder="Search ..." v-model="search_name" @keyup="search">
        <i class="fas fa-search"></i>
    </div>
    <div class="select-group">
        <select class="filter_batch">
            <option disabled value="">Batch</option>
            <option>
                Batch
            </option>
        </select>
        <select class="filter_major">
            <option disabled value="">Major</option>
            <option>
                Major
            </option>
        </select>
        <select class="filter_position">
            <option disabled value="">Position</option>
            <option>
                Position
            </option>
        </select>
    </div>
    <!-- End Search and Sort -->

    <div class="d-flex flex-wrap">
        <!-- Start Card -->
        <v-card class="ml-11 mr-5 mt-5 mb-5 rounded-lg" max-width="370" outlined dense elevation="6" v-for="(user, index) in users" :key="index">
            <div>
                <v-list-item three-line>
                    <v-list-item-content>
                        <div>
                            <div class="text-overline mb-8 d-flex">
                                <img src="../../assets/pn-logo.png" alt="" width="35px" height="35px" class="rounded-circle mr-1">
                                <h5 class="mt-1">BATCH: {{ user.batch }} - {{ user.major }}</h5>
                            </div>
                        </div>
                        <v-list-item-title class="text--h6 ml-1 blue--text" style="margin-right: -10px">
                            Current Employment
                        </v-list-item-title>
                        <div class="d-flex">
                            <img :src=" 'http://127.0.0.1:8000/storage/images/companies/' + user.companyImage " alt="" width="40px" height="40px" class="rounded-circle mr-1">
                            <h5 class="mt-4">{{ user.companyName }}</h5>
                        </div>
                    </v-list-item-content>
                    <div style="margin-top: -40px">
                        

                         <v-avatar v-if="user.userImage === null" size="80" class="profile ml-4 mt-4">
                                    <img src="https://www.portal.chat/img/avatar.svg" alt="" />
                                </v-avatar>
                                <v-avatar v-else size="80" class="profile ml-4 mt-4">
                                    <img :src="'http://127.0.0.1:8000/storage/images/users/' + user.userImage" alt="" />
                                </v-avatar>
                        <v-list-item-title class="text-h6 mb-1 mt-0" align="center">
                            {{ user.firstName }}
                        </v-list-item-title>
                    </div>
                </v-list-item>
                <div class="text-caption ml-5 mr-5 pa-2 rounded-lg" style="border: 1px solid #2196F3">
                    <p>Position: {{ user.alumniPosition }}</p>
                    <p style="margin-top: -10px">HR: {{ user.companyHR }}</p>
                    <p style="margin-top: -10px">Email: {{ user.companyEmail }}</p>
                    <p style="margin-top: -10px" class="mb-0">Tel: +855 {{ user.companyContact }}</p>
                </div>
                <!-- Dialog -->
                <v-row class="float-end mt-1 mb-1 mr-2">
                    <v-dialog v-model="dialog" ftransition="dialog-bottom-transition" max-width="850" max-height="600">
                        <template v-slot:activator="{ on, attrs }">
                            <v-card-actions>
                                <v-btn outlined text color="orange" darken-2 v-bind="attrs" v-on="on" @click="getOneAlumniDetails(user.user_id)">
                                    Detail
                                </v-btn>
                            </v-card-actions>
                        </template>
                        <!-- Start Card -->
                        <v-card class="mx-auto rounded-lg" max-width="850" dense elevation="5" height="100%">
                            <div align="center">
                                <v-avatar v-if="eachUserDetails.userImage === null" size="120" class="profile ml-4 mt-4">
                                    <img src="https://www.portal.chat/img/avatar.svg" alt="" />
                                </v-avatar>
                                <v-avatar v-else size="120" class="profile ml-4 mt-4">
                                    <img :src="'http://127.0.0.1:8000/storage/images/users/' + eachUserDetails.userImage" alt="" />
                                </v-avatar>

                            </div>
                            <div class="d-flex justify-center" style="margin-left: 40px; margin-top: 30px">
                                <v-icon dark color="pink" class="mr-2" v-if="eachUserDetails.gender === 'Female'"> mdi-gender-female </v-icon>
                                <v-icon dark color="blue" class="mr-2" v-else> mdi-gender-male </v-icon>
                                <h2 class="mt-1 mr-12"> {{ eachUserDetails.firstName }} </h2>
                            </div>
                            <div class="d-flex ma-1 mt-3">
                                <div class="alumni-info-left">
                                    <div class="d-flex">
                                        <v-avatar size="50">
                                            <img src="../../assets/pn-logo.png" alt="" />
                                        </v-avatar>
                                        <h4 class="mt-4 ml-2">BATCH : {{ eachUserDetails.batch }}</h4>
                                    </div>
                                    <div class="d-flex mt-2">
                                        <v-icon color="blue" class="ml-3" dark> mdi-map-marker </v-icon>
                                        <h5 class="ml-5 mt-2">City: {{ eachUserDetails.city }}</h5>
                                    </div>
                                </div>
                                <div class="alumni-info-center">
                                    <div class="d-flex mt-2">
                                        <v-icon color="blue" dark> mdi-cake-layered </v-icon>
                                        <h5 class="mt-2 ml-4">DOB: {{ eachUserDetails.birthDate }}</h5>
                                    </div>
                                    <div class="d-flex mt-7">
                                        <v-icon color="blue" dark> mdi-gender-transgender </v-icon>
                                        <h5 class="mt-0 ml-4">Marital Status: {{ eachUserDetails.maritalStatus }}</h5>
                                    </div>
                                    <div class="d-flex mt-4">
                                        <v-icon dark color="blue"> mdi-phone </v-icon>
                                        <h5 class="ml-4 mt-1">Tel: +885 {{ eachUserDetails.phoneNumber }}</h5>
                                    </div>
                                </div>
                                <div class="alumni-info-right">
                                    <div class="d-flex mt-4">
                                        <v-icon color="blue" dark> mdi-marker-check </v-icon>
                                        <h5 class="ml-4">Major: {{ eachUserDetails.major }}</h5>
                                    </div>
                                    <div class="d-flex mt-4">
                                        <v-icon color="blue" dark> mdi-lightbulb-on </v-icon>
                                        <h5 class="ml-4 mt-2">Skills: {{ eachUserDetails.skills }}</h5>
                                    </div>
                                    <div class="d-flex mt-5">
                                        <v-icon dark color="blue"> mdi-email </v-icon>
                                        <h5 class="ml-4">Email: {{ eachUserDetails.email }}</h5>
                                    </div>
                                </div>
                            </div>

                            <v-card-actions>
                                <v-btn class="explore-btn" text color="blue accent-4" @click="showCompany">
                                    Explore
                                </v-btn>
                            </v-card-actions>
                            <v-expand-transition>
                                <v-card v-if="reveal" class="transition-fast-in-fast-out v-card--reveal" style="height: 100%">
                                    <v-card-text class="pb-0">
                                        <div class="d-flex">
                                            
                                            <v-avatar size="120">
                                                <img :src="'http://127.0.0.1:8000/storage/images/companies/' + eachUserDetails.companyImage" alt="" />
                                            </v-avatar>
                                            <p class="text-h4 orange--text mt-5" style="margin-left: 20%">
                                                {{ eachUserDetails.companyName }}
                                            </p>
                                        </div>
                                        <h5 class="ml-2 blue--text text-decoration-underline">
                                            {{ eachUserDetails.companyWebsite }}
                                        </h5>
                                        <p class="text-h4 blue--text mb-7" style="margin-left: 41%; margin-top: -43px">
                                            {{ eachUserDetails.alumniPosition }}
                                        </p>
                                        <div class="d-flex mb-7 rounded" style="background: #2196f3; padding: 4px">
                                            <v-icon class="ml-1" light color="white">mdi-city</v-icon>
                                            <h3 class="ml-4 mt-1 white--text">Company's Info</h3>
                                        </div>
                                        <div class="mb-6 mt-3 d-flex justify-space-between">
                                            <div class="d-flex" style="width: 63%">
                                                <v-icon dark color="blue" class="mr-1"> mdi-map-marker </v-icon>
                                                <h3 class="mr-12 ml-3">Address: {{ eachUserDetails.companyLocation }}.</h3>
                                            </div>
                                            <div class="d-flex" style="width: 36%">
                                                <v-icon dark color="blue"> mdi-comment-account </v-icon>
                                                <h3 class="ml-2 ml-3">HR's name: {{ eachUserDetails.companyHR }}</h3>
                                            </div>
                                        </div>
                                        <div class="d-flex justify-space-between">
                                            <div class="d-flex" style="width: 63%">
                                                <v-icon dark color="blue" class="mr-1"> mdi-email </v-icon>
                                                <h3 class="mr-12 ml-3">Email: {{ eachUserDetails.companyEmail }} </h3>
                                            </div>
                                            <div class="d-flex" style="width: 36%">
                                                <v-icon dark color="blue"> mdi-phone </v-icon>
                                                <h3 class="ml-2 ml-3">Tel: +855 {{ eachUserDetails.companyContact }}</h3>
                                            </div>
                                        </div>
                                    </v-card-text>
                                    <v-card-actions class="pt-0 float-end">
                                        <v-btn class="close-btn" text color="red accent-4" @click="showCompany">
                                            Close
                                        </v-btn>
                                    </v-card-actions>
                                </v-card>
                            </v-expand-transition>
                        </v-card>
                        <!-- End Card -->
                    </v-dialog>
                </v-row>
                <!-- End Dialog -->
            </div>
        </v-card>
        <!-- End Card -->
    </div>
</section>
</template>

<script>
import axios from '../../axios-http';
export default {
    data: () => ({
        items: ['Explore as much as you like !'],
        users: [],
        eachUserDetails: [],
        search_name: '',
        // __________Dialog__________ // 
        reveal: false,
        dialog: false,
        notifications: false,
        sound: true,
        widgets: false,
    }),
    methods: {
        // _______________GET ALUMNI DETAILS________________ //
        getAlumniDetails() {
            axios.get('companies_detail')
                .then(res => {
                    this.users = res.data;
                    console.log(this.users)
                })
                .catch(error => {
                    console.log(error.data);
                });
        },
        // _______________GET ONE ALUMNI DETAILS________________ //
        getOneAlumniDetails(id) {
          console.log(id);
            axios.get('companies_user_detail/' + id)
                .then(res => {
                    this.eachUserDetails = res.data[0];
                    console.log(this.eachUserDetails);
                    // console.log(this.eachUserDetails.userImage);/ 
                })
                .catch(error => {
                    console.log(error);
                });
        },
        // _______________SEARCH USER________________ //
        search(){
            if (this.search_name != ''){
                axios.get('users/search/' + this.search_name)
                    .then(res => {
                        this.users = res.data;
                        console.log(this.users);
                    })
                    .catch(error => {
                        console.log(error);
                    });
            } else {
                axios.get('companies_detail')
                    .then(res => {
                        this.users = res.data;
                        console.log(this.users);
                    })
                    .catch(error => {
                        console.log(error);
                    });
            }
        },
        showCompany() {
            this.reveal = !this.reveal;
            return;
        }
    },
    mounted() {
        this.getAlumniDetails();
    }
}
</script>

<style scoped>
.search {
    display: flex;
    margin-top: 15px;
    margin-bottom: 20px;
    justify-content: center;
    color: white;
}

.search_input {
    height: 40px;
    width: 50%;
    border-radius: 7px;
    text-align: center;
    border: 2px solid #2196F3;
    outline: #2196F3;
    color: #2196F3;
}

.search_input::placeholder {
    color: #2196F3;
}

.fas{
    display: flex;
    justify-content: center;
    align-items: center;
    background: #2196F3;
    height: 40px;
    width: 50px;
    color: white;
    border-radius: 7px;
    margin-left: 5px;
}

.fas:hover {
    cursor: pointer;
    color: black;
}

.select-group {
    display: flex;
    justify-content: space-evenly;
    margin-top: 20px;
    margin-bottom: 15px;
    margin-right: 5%;
    margin-left: 5%;
}

.filter_batch,
.filter_major,
.filter_position {
    width: 7%;
    height: 40px;
    border-radius: 5px;
    background: #2196F3;
    border: 1px solid white;
}

select {
    text-align: center;
    color: white;
    font-size: 15px;
    font-weight: bold;
}

option {
    background: rgb(214, 214, 214);
    color: black
}

/* Card */
.v-card--reveal {
    bottom: 0;
    opacity: 1 !important;
    position: absolute;
    width: 100%;
}

/* /Profile Card /  */
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

#pro_img {
    border: 2px solid rgb(255, 255, 255);
    width: 80px;
    height: 80px;
    margin-left: 80px;
    border-radius: 50px;
}

#company_img {
    width: 80px;
    height: 80px;
    margin-left: 65px;
    border-radius: 50px;
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

.addCompanyForm {
    box-shadow: 0px 0px 14px 11px rgba(0, 0, 0, 0.42);
    -webkit-box-shadow: 0px 0px 14px 11px rgba(0, 0, 0, 0.42);
    -moz-box-shadow: 0px 0px 14px 11px rgba(0, 0, 0, 0.42);
    z-index: 1;
    margin-top: 30px;
    margin-left: 155px;
    width: 250px;
    background: rgb(255, 255, 255);
    padding: 20px;
    border-radius: 5px;
    position: absolute;
}

.camera {
    position: absolute;
    top: 80px;
    width: 100%;
    margin-right: -20px;
    padding-right: -20px;
}
</style>
