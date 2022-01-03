<template>
<section>
    <div align="center"><img src="../../assets/pn-logo.png" alt="" width="35px" height="35px" class="rounded-circle mr-1" />
        <h6>Passerelles Numeriques</h6>
    </div>
    <!-- Search and Sort -->
    <div>
        <div class='alumni-top'>
            <div class="search">
                <input type="search" class="search_input" placeholder="Search ..." v-model="search_name" @keyup="search" />
                <i class="fas fa-search"></i>
            </div>
            <div class="select-group">
                <select class="filter_batch">
                    <option disabled value="">Batch</option>
                    <option>Batch</option>
                </select>
                <select class="filter_major">
                    <option disabled value="">Major</option>
                    <option>Major</option>
                </select>
                <select class="filter_position">
                    <option disabled value="">Position</option>
                    <option>Position</option>
                </select>
            </div>
        </div>
    </div>
    <!-- End Search and Sort -->

    <div class="d-flex flex-wrap pa-12">
        <!-- Start Card -->
        <v-row justify="center">
            <v-expansion-panels inset>
                <v-expansion-panel v-for="(user, index) in users" :key="index" class="mt-5 rounded-lg">
                    <v-expansion-panel-header>
                        <div class="text-overline mb-8">
                            <div style="margin-top: -10px" align="center">
                                <h5>BATCH: {{ user.batch }} - {{ user.major }}</h5>
                            </div>
                            <div class="d-flex">
                                <div class="user-profile">
                                    <v-avatar v-if="user.userImage === null" size="80" class="profile" style="margin-top: -20px">
                                        <img src="https://www.portal.chat/img/avatar.svg" alt="" />
                                    </v-avatar>
                                    <v-avatar v-else size="80" class="profile" style="margin-top: -20px">
                                        <img :src="
                          'http://127.0.0.1:8000/storage/images/users/' +
                          user.userImage
                        " alt="" />
                                    </v-avatar>
                                    <v-list-item-title class="text-h6" align="center" style="margin-bottom: -40px;color:#2196F3">
                                        {{ user.firstName }}
                                    </v-list-item-title>
                                </div>
                                <div class="d-flex user-company mt-4">
                                    <img :src="
                        'http://127.0.0.1:8000/storage/images/companies/' +
                        user.companyImage
                      " alt="" width="50px" height="50px" class="rounded-circle mr-1" />
                                    <div>
                                        <div class="d-flex">
                                            <v-icon x-small color="blue" dark style="margin-top: -1px">
                                                mdi-domain
                                            </v-icon>
                                            <h4 class="ml-2">{{ user.companyName }}</h4>
                                        </div>
                                        <div class="d-flex">
                                            <v-icon x-small color="blue" dark style="margin-top: -7px">
                                                mdi-briefcase-variant
                                            </v-icon>
                                            <h6 class="ml-2" style="margin-top: -10px">
                                                {{ user.alumniPosition }}
                                            </h6>
                                        </div>
                                    </div>
                                </div>
                                <div class="d-flex user-info">
                                    <div class="userSkill d-flex mt-4 mr-4">
                                        <v-icon small color="blue" style="margin-top: -8px" dark> mdi-lightbulb-on </v-icon>
                                        <h5 class="ml-2 mt-2" v-html="skill(user.skills)"></h5>
                                    </div>
                                    <div class="userTel d-flex mt-4 mr-4">
                                        <v-icon style="margin-top: -5px" small color="blue" class="ml-3 " dark>
                                            mdi-phone
                                        </v-icon>
                                        <h5 class="ml-2 mt-2"> +885 {{ user.phoneNumber }}</h5>
                                    </div>
                                    <div class=" UserEmail d-flex mt-4">
                                        <v-icon style="margin-top: -5px" small color="blue" dark> mdi-email </v-icon>
                                        <h5 class="ml-2 mt-2">
                                            {{ user.email }}
                                        </h5>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </v-expansion-panel-header>
                    <v-expansion-panel-content class="subtitle-2">
                        <div class="detail-info">
                            <h3>Detailed Information</h3>
                        </div>
                        <div class="alumni-first-column d-flex mt-3">
                            <div style="width: 45%">
                                <v-icon color="blue" class="ml-3 mr-2" dark> mdi-map-marker </v-icon>
                                {{ user.city }}
                            </div>
                            <div style="width: 30%" class="d-flex">
                                <span class="blue--text">Company <span class="ml-2 mr-3">:</span> </span> {{ user.companyName }}
                            </div>
                            <div style="width: 30%" class="d-flex">
                                <span class="blue--text">Position <span class="ml-7 mr-3">:</span> </span> {{ user.alumniPosition }}
                            </div>
                        </div>
                        <div class="alumni-second-column  d-flex mt-3">
                            <div style="width: 45%">
                                <v-icon color="blue" class="ml-3 mr-2" dark> mdi-cake-layered </v-icon>
                                {{ user.birthDate }}
                            </div>
                            <div style="width: 30%">
                                <span class="blue--text">Location <span class="ml-3 mr-2">:</span> </span> {{ user.companyLocation }}
                            </div>
                            <div style="width: 30%">
                                <span class="blue--text">HR's name <span class="ml-4 mr-2">:</span> </span> {{ user.companyHR }}
                            </div>
                        </div>
                        <div class="alumni-third-column  d-flex mt-3">
                            <div style="width: 45%">
                                <v-icon color="blue" class="ml-3 mr-2" dark> mdi-gender-transgender </v-icon>
                                {{ user.maritalStatus }}
                            </div>
                            <div style="width: 30%">
                                <span class="blue--text">Tel <span class="ml-12 mr-2">:</span> </span> +855 {{ user.companyContact }}
                            </div>
                            <div style="width: 30%">
                                <span class="blue--text">HR's mail <span class="ml-6 mr-2">:</span> </span> {{ user.companyEmail }}
                            </div>
                        </div>
                    </v-expansion-panel-content>
                </v-expansion-panel>
            </v-expansion-panels>
        </v-row>
    </div>

    <!-- Pagination Start -->
    <div class="text-center">
        <v-pagination v-model="pagination.current" :length="pagination.total" @input="onPageChange" :total-visible="7"></v-pagination>
    </div>
    <!-- Pagination End -->
</section>
</template>

<script>
import axios from "../../axios-http";
export default {
    data: () => ({
        items: ["Explore as much as you like !"],
        users: [],
        eachUserDetails: [],
        search_name: "",
        // __________Dialog__________ //
        reveal: false,
        dialog: false,
        notifications: false,
        sound: true,
        widgets: false,
        // ________Pagination________ //
        pagination: {
            current: 1,
            total: 0
        }
    }),
    methods: {
        // _______________PAGINATION________________ //
        getAlumni() {
            axios.get('companies_detail?page=' + this.pagination.current)
                .then(response => {
                    this.users = response.data.data;
                    this.pagination.current = response.data.current_page;
                    this.pagination.total = response.data.last_page;
                });
        },
        // _______________ON PAGE CHANGE______________ //
        onPageChange() {
            this.getAlumni();
        },
        // _______________SEARCH USER________________ //
        search() {
            if (this.search_name != "") {
                axios
                    .get("users/search/" + this.search_name)
                    .then((res) => {
                        this.users = res.data;
                        console.log(this.users);
                    })
                    .catch((error) => {
                        console.log(error);
                    });
            } else {
                axios
                    .get("companies_detail")
                    .then((res) => {
                        this.users = res.data;
                        console.log(this.users);
                    })
                    .catch((error) => {
                        console.log(error);
                    });
            }
        },
        // _______________SHOW COMPANY_________________ //
        showCompany() {
            this.reveal = !this.reveal;
            return;
        },
        // _______________ALUMNI SKILL_________________ //
        skill(skills) {
            let stringArray = "";
            for (let n of skills) {
                if (n !== "[" && n !== '"' && n !== "]") {
                    stringArray += n;
                }
            }
            let skill = stringArray.split(",");
            let skillLength = skill.length - 2;
            if (skill.length > 2) {
                return skill[0] + "|" + skill[1] + " and " + skillLength + ' other.'
            } else {
                return skill[0] + "|" + skill[1]
            }
        },
    },
    mounted() {
        this.getAlumni();
    },
};
</script>

<style scoped>
.search {
    display: flex;
    margin-top: 15px;
    margin-bottom: 20px;
    justify-content: center;
    color: white;
}

.search-and-sort {
    position: sticky;
    top: 64px;
    z-index: 99;
    background: white;
}

.search_input {
    height: 40px;
    width: 50%;
    border-radius: 7px;
    text-align: center;
    border: 2px solid #2196f3;
    outline: #2196f3;
    color: #2196f3;
}

.search_input::placeholder {
    color: #2196f3;
}

.fas {
    display: flex;
    justify-content: center;
    align-items: center;
    background: #2196f3;
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
    background: #2196f3;
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
    color: black;
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

/* ________ new style _____________  */
/* .alumni-top{
  position: -webkit-sticky;
  position: fixed;
  top: 100;
  z-index: 0;
  width: 100%;
} */
.user-profile {
    width: 15%;
    /* background: #000; */
    align-items: center;
    margin: 0px 20px;
    margin-left: 0px;
}

.profile {
    margin-left: 26%;
}

.user-info {
    width: 65%;
    /* background: rgb(133, 16, 16); */
    padding: 0px 0px;
}

.user-company {
    width: 30%;
    /* background: red; */
    padding: 0px 30px;
}

.userSkill {
    width: 30%;
}

.userTel {
    width: 26%;
}

.detail-info {
    background: #2196f3;
    border-radius: 5px;
    text-align: center;
    padding: 3px;
}

.detail-info h3 {
    color: white;
}
</style>
