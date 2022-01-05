<template>
<section>
    <v-card v-show='isSignUp' class="mx-auto mt-16" max-width="344" dense elevation="4">
        <h1 class="white--text">Hello</h1>
        <div align="center" style="margin-top: -15px">
            <v-avatar size="100">
                <img src="https://www.portal.chat/img/avatar.svg" alt="" />
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
                    <v-btn fab dark small color="blue" v-bind="attrs" v-on="on" class="mb-3 mr-3">
                        <v-icon dark> mdi-plus </v-icon>
                    </v-btn>
                </template>
                <v-card>
                    <!-- Personal Information -->
                    <v-card-title class="d-flex justify-center" style="background: #2196f3" v-if="isCompanyDetailHidden">
                        <h3 dark class="white--text">Personal information</h3>
                    </v-card-title>
                    <!-- End Personal Information -->

                    <!-- Company Information -->
                    <v-card-title class="d-flex justify-center" style="background: #2196f3" v-else>
                        <h3 dark class="white--text">Company information</h3>
                    </v-card-title>
                    <!-- End Personal Information -->

                    <v-card-text>
                        <v-container>
                            <!-- Add Personal Information -->
                            <v-row v-if="isCompanyDetailHidden">
                                <v-col cols="12" sm="6" md="4" style="margin-top: 10px">
                                    <!-- Date of Birth Start -->
                                    <div>
                                        <!-- <div class="mb-6">Active picker: <code>{{ activePicker || 'null' }}</code></div> -->
                                        <v-menu ref="menu" v-model="menu" :close-on-content-click="false" transition="scale-transition" offset-y min-width="auto">
                                            <template v-slot:activator="{ on, attrs }">
                                                <v-text-field v-model="date" label="Birthday date" outlined readonly dense v-bind="attrs" v-on="on" :rules="[(v) => !!v || 'Date is required']"></v-text-field>
                                            </template>
                                            <v-date-picker v-model="date" :active-picker.sync="activePicker" :max="
                            new Date(
                              Date.now() -
                                new Date().getTimezoneOffset() * 60000
                            )
                              .toISOString()
                              .substr(0, 10)
                          " min="1950-01-01" @change="save" :rules="[(v) => !!v || 'Date is required']"></v-date-picker>
                                        </v-menu>
                                    </div>
                                    <!-- Date of Birth End  -->
                                </v-col>
                                <v-col cols="12" sm="6" md="4" style="margin-top: 10px">
                                    <v-select :items="gender" label="Gender" outlined dense required v-model="selectedGender" :rules="[(v) => !!v || 'Gender is required']"></v-select>
                                </v-col>
                                <v-col cols="12" sm="6" md="4" style="margin-top: 10px">
                                    <v-select :items="status" label="Marital Status" outlined dense required v-model="selectedStatus" :rules="[(v) => !!v || 'Status is required']"></v-select>
                                </v-col>
                                <v-col cols="12" sm="6" style="margin-top: -30px">
                                    <v-select :items="provinces" label="Province" dense outlined required v-model="selectedProvince" :rules="[(v) => !!v || 'Province is required']"></v-select>
                                </v-col>
                                <v-col cols="12" sm="6" style="margin-top: -30px">
                                    <v-select :items="majors" dense label="Major" outlined required @change="selectMajor" v-model="selectedMajor" :rules="[(v) => !!v || 'Major is required']"></v-select>
                                </v-col>
                                <v-col cols="12" style="margin-top: -30px">
                                    <v-autocomplete v-model="skills" dense :items="existSkill" label="Skill" multiple outlined :rules="[(v) => !!v || 'Skill is required']"></v-autocomplete>
                                </v-col>
                                <v-col cols="12" style="margin-top: -30px">
                                    <v-text-field label="Tel: 87 XXX XXX" type="phone" outlined dense required v-model="phone" :rules="[(v) => !!v || 'Tel is required']"></v-text-field>
                                </v-col>
                            </v-row>
                            <!-- End Add Personal Information -->

                            <!-- Add Company Information -->
                            <v-row v-else>
                                <v-col cols="12" md="10" style="margin-top: 10px; width: 400px">
                                    <v-autocomplete v-model="companyId" :items="listCompany" :filter="customFilter" color="blue" dense solo item-text="companyName" item-value="id" label="Select Your company">
                                        <template v-slot:selection="data">
                                            <v-chip>
                                                <v-avatar left>
                                                    <v-img :src="
                                'http://127.0.0.1:8000/storage/images/companies/' +
                                data.item.companyImage
                              "></v-img>
                                                </v-avatar>
                                                {{ data.item.companyName }}
                                            </v-chip>
                                        </template>
                                    </v-autocomplete>
                                </v-col>
                                <v-col cols="6" md="2" style="margin-top: 7px">
                                    <v-btn @click="showCompanyForm" class="mx-2" fab dark dense outlined color="#2196F3">
                                        +
                                        <v-icon dark> mdi-domain </v-icon>
                                    </v-btn>
                                </v-col>

                                <!-- add company   -->
                                <div v-show="isAddCompany" class="addCompanyForm">
                                    <v-card-title style="background: #2196F3; color: white; padding: 10px">
                                        <div style="margin-left: 45px">
                                            <h4>
                                                Add Company
                                            </h4>
                                        </div>
                                    </v-card-title>
                                    <div style="margin-top: -40px; padding: 20px">
                                        <label for="company_logo">
                                            <v-icon class="mx-2 mt-4 camera" aria-hidden="true" fab dark color="#000000" style="font-size: 17px">
                                                mdi-camera-plus-outline
                                            </v-icon>
                                        </label>
                                        <img id="company_img" :src="companyProfile" alt="profile" />
                                        <input id="company_logo" class="d-none" accept="image/*" type="file" prepend-icon="mdi-camera" style="margin-bottom: -45px" @change="setCompanyImg" filled />
                                    </div>
                                    <div style="padding: 20px; margin-top: -35px">
                                        <v-row>
                                            <v-col cols="12">
                                                <v-text-field v-model="companyName" label="Company Name" required dense append-icon="mdi-briefcase-variant" outlined></v-text-field>
                                            </v-col>
                                        </v-row>
                                    </div>
                                    <div style="padding: 20px; margin-top: -50px">
                                        <div class="d-flex">
                                            <div class="mr-2">
                                                <v-btn @click="showCompanyForm" x-small color="red" dark>
                                                    Cancel
                                                    <v-icon right dark> mdi-close-circle </v-icon>
                                                </v-btn>
                                            </div>
                                            <div>
                                                <v-btn @click="addCompany" x-small color="primary" dark>
                                                    Add Company
                                                    <v-icon right dark> mdi-arrow-right-circle </v-icon>
                                                </v-btn>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- ___ -->

                                <v-col cols="12" sm="6" style="margin-top: -30px">
                                    <v-text-field label="Company Website:" dense outlined required v-model="website" :rules="[(v) => !!v || 'Website is required']"></v-text-field>
                                </v-col>
                                <v-col cols="12" sm="6" style="margin-top: -30px">
                                    <v-text-field label="Address:" dense outlined required v-model="address" :rules="[(v) => !!v || 'Address is required']"></v-text-field>
                                </v-col>
                                <v-col cols="12" sm="6" style="margin-top: -30px">
                                    <v-text-field label="Position:" dense outlined required v-model="position" :rules="[(v) => !!v || 'Position is required']"></v-text-field>
                                </v-col>
                                <v-col cols="12" sm="6" style="margin-top: -30px">
                                    <v-text-field label="HR's name:" dense outlined required v-model="HR_name" :rules="[(v) => !!v || 'Name is required']"></v-text-field>
                                </v-col>
                                <v-col cols="12" sm="6" style="margin-top: -30px">
                                    <v-text-field label="Email: example@gmail.com" type="email" dense outlined required v-model="company_email" :rules="[(v) => !!v || 'Email is required']"></v-text-field>
                                </v-col>
                                <v-col cols="12" sm="6" style="margin-top: -30px">
                                    <v-text-field label="Tel: 87 XXX XXX" type="Tel" dense outlined required v-model="company_tel" :rules="[(v) => !!v || 'Tel is required']"></v-text-field>
                                </v-col>
                            </v-row>
                            <!-- End Add Company Information -->
                        </v-container>
                    </v-card-text>
                    <v-card-actions style="margin-top: -40px">
                        <v-btn color="red darken-1" text @click="dialog = false" v-show="isCompanyDetailHidden">
                            Cancel
                        </v-btn>
                        <v-btn color="red darken-1" text @click="isCompanyDetailHidden = !isCompanyDetailHidden" v-show="!isCompanyDetailHidden">
                            Back
                        </v-btn>
                        <v-spacer></v-spacer>
                        <v-btn color="blue darken-1" text @click="isCompanyDetailHidden = !isCompanyDetailHidden" v-show="isCompanyDetailHidden">
                            Next
                        </v-btn>
                        <v-btn color="blue darken-1" text @click="
                  dialog = false;
                  personalInfo = true;
                  addDetailInfo();
                  addCompanyDetailInfo();
                " v-show="!isCompanyDetailHidden">
                            Save
                        </v-btn>
                    </v-card-actions>
                </v-card>
            </v-dialog>
        </v-row>
    </v-card>
    <signin-profile-card v-if='!isSignUp'></signin-profile-card>
</section>
</template>

<script>
import axios from "../../axios-http";
import SignIn_card from "../ui/Signin_profile_card.vue";
import City from "../json/City.json";
import Status from "../json/Status.json";
export default {
    components: {
        'signin-profile-card': SignIn_card,
    },
    data: () => ({
        companyProfile: "https://png.pngtree.com/png-vector/20190418/ourlarge/pngtree-vector-office-building-icon-png-image_953174.jpg",
        imgCompany: null,
        user: null,
        username: "",
        email: "",
        batch: "",
        selectedGender: "",
        selectedMajor: "",
        selectedProvince: "",
        selectedStatus: "",
        existSkill: [],
        webSkill: [
            "HTML",
            "CSS",
            "C++",
            "C#",
            "PHP",
            "Python",
            "JavaScript",
            "Java",
            "VueJs",
            "Vuetify",
        ],
        SNASkill: [
            "Basic System Administration",
            "Switching & Routing CCNA2",
            "Basic Cloud Computing",
            "IT HelpDesk",
            "Switching & Routing CCNA3",
            "Advance System Administration Part 1",
            "Advance Cloud computing",
            "Advance System Administration Part 2",
            "Virtualization and Containerization",
            "Cybersecurity",
            "MikroTik",
            "Network Infrastructure",
        ],
        skills: [],
        phone: "",
        isSignUp: JSON.parse(localStorage.getItem('isSignUp')),
        dialog: false,
        profileDialog: false,
        activePicker: null,
        date: null,
        menu: false,
        profileImage: null,
        userId: localStorage.getItem("id"),
        gender: ["Male", "Female"],
        status: Status,
        majors: ["WEP", "SNA"],
        provinces: City,
        // ____________ADD COMPANY____________ //
        isAddCompany: false,
        companyName: null,
        isCompanyDetailHidden: true,
        isNotCancellled: true,
        companyInfo: [],
        website: "",
        address: "",
        position: "",
        HR_name: "",
        company_email: "",
        company_tel: "",
        companyId: null,
        listCompany: null,
    }),
    watch: {
        menu(val) {
            val && setTimeout(() => (this.activePicker = "YEAR"));
        },
    },
    methods: {
        // ____________SAVE DATE______________ //
        save(date) {
            this.$refs.menu.save(date);
        },

        // ____________ADD USER DETAIL__________ //
        selectMajor() {
            console.log(this.selectedMajor);
            if (this.selectedMajor === "WEP") {
                this.existSkill = this.webSkill;
            } else {
                this.existSkill = this.SNASkill;
            }
        },
        addDetailInfo() {
            let userInfo = {
                user_id: localStorage.getItem("id"),
                birthDate: this.date,
                major: this.selectedMajor,
                gender: this.selectedGender,
                maritalStatus: this.selectedStatus,
                city: this.selectedProvince,
                skills: this.skills,
                phoneNumber: this.phone,
            };
            axios
                .post("usersDetail", userInfo)
                .then((res) => {
                    console.log(res.data)
                    this.getDetailInfo();
                    localStorage.setItem("personalInfo", true);
                    this.getCompanyDetailInfo();
                })
                .catch((error) => {
                    console.log(error.response);
                });
        },
        // ____________ADD COMPANY DETAIL__________ //

        addCompanyDetailInfo() {
            let companyInfo = {
                user_id: localStorage.getItem("id"),
                company_id: this.companyId,
                alumniPosition: this.position,
                companyHR: this.HR_name,
                companyEmail: this.company_email,
                companyContact: this.company_tel,
                companyLocation: this.address,
                companyWebsite: this.website,
            };
            axios
                .post("companies_detail", companyInfo)
                .then((res) => {
                    console.log(res.data);
                    localStorage.setItem("isSignUp", false)
                    this.isSignUp = JSON.parse(localStorage.getItem('isSignUp'));
                    console.log('add company detail info')
                })
                .catch((error) => {
                    console.log(error);
                });
        },
        // __________________Add company___________________
        getCompany() {
            axios.get("companies/").then((res) => {
                this.listCompany = res.data;
            });
        },
        setCompanyImg(event) {
            this.imgCompany = event.target.files[0];
            this.companyProfile = URL.createObjectURL(this.imgCompany);
        },
        showCompanyForm() {
            this.isAddCompany = !this.isAddCompany;
        },
        addCompany() {
            let NewCompany = new FormData();
            NewCompany.append("companyImage", this.imgCompany);
            NewCompany.append("companyName", this.companyName.toUpperCase());
            NewCompany.append("user_id", this.userId);
            axios
                .post("companies", NewCompany)
                .then((res) => {
                    console.log(res.data);
                    this.isAddCompany = !this.isAddCompany;
                    this.getCompany();
                })
                .catch((error) => {
                    console.log(error.response.data.message);
                });
            console.log(NewCompany);
        },
        customFilter(item, queryText) {
            const textOne = item.name.toLowerCase();
            console.log(item.id);
            const searchText = queryText.toLowerCase();

            return textOne.indexOf(searchText) > -1;
        },
    },
    mounted() {
        this.username = localStorage.getItem("user");
        this.email = localStorage.getItem("email");
        this.batch = localStorage.getItem("batch");
        this.getCompany();
    },
};
</script>

<style>
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

.addCompanyForm {
    box-shadow: 0px 0px 14px 11px rgba(0, 0, 0, 0.42);
    -webkit-box-shadow: 0px 0px 14px 11px rgba(0, 0, 0, 0.42);
    -moz-box-shadow: 0px 0px 14px 11px rgba(0, 0, 0, 0.42);
    z-index: 1;
    margin-top: 30px;
    margin-left: 155px;
    width: 250px;
    background: rgb(255, 255, 255);
    border-radius: 5px;
    /* padding: 20px; */
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
