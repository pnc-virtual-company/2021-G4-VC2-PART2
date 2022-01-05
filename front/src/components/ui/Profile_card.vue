<template>
<section>
    <div v-show="isSignUp">
        <!-- Start Card -->
        <v-card class="mx-auto mt-8" max-width="344" dense elevation="4" v-show="!personalInfo">
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
                                        <v-autocomplete v-model="companyId" :items="listCompany" :filter="customFilter" color="blue" dense solo item-text="companyName" item-value="id" label="Select Your company" @change="hello">
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
                                        <div>
                                            <label for="company_logo">
                                                <v-icon class="mx-2 mt-4 camera" aria-hidden="true" fab dark color="#000000" style="font-size: 17px">
                                                    mdi-camera-plus-outline
                                                </v-icon>
                                            </label>
                                            <img id="company_img" :src="companyProfile" alt="profile" />

                                            <input id="company_logo" class="d-none" accept="image/*" type="file" prepend-icon="mdi-camera" style="margin-bottom: -45px" @change="setCompanyImg" filled />
                                        </div>
                                        <v-row>
                                            <v-col cols="12" style="margin-top: 10px">
                                                <v-text-field v-model="companyName" label="Company Name" required dense append-icon="mdi-briefcase-variant" outlined></v-text-field>
                                            </v-col>
                                        </v-row>
                                        <div class="d-flex" style="margin-top: -17px">
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
                            <v-spacer></v-spacer>
                            <v-btn color="blue darken-1" text @click="dialog = false" v-show="isCompanyDetailHidden">
                                cancel
                            </v-btn>
                            <v-btn color="blue darken-1" text @click="isCompanyDetailHidden = !isCompanyDetailHidden" v-show="!isCompanyDetailHidden">
                                Back
                            </v-btn>
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
            <!-- End Dialog -->
        </v-card>
        <!-- End Card -->
    </div>

    <!-- Start Card Information -->
    <v-card class="mx-auto rounded-lg" max-width="850" dense elevation="5" height="100%" v-if="personalInfo">
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
                            <v-btn color="blue" class="edit_profile" fab small dark v-bind="attrs" v-on="on">
                                <v-icon>mdi-pencil</v-icon>
                            </v-btn>
                        </template>
                        <v-card>
                            <v-card-title>
                                <span class="text-h5">Set Profile</span>
                            </v-card-title>
                            <v-card-text>
                                <div>
                                    <div class="choose-file d-flex ml-2">
                                        <label for="profile">
                                            <img id="pro_img" :src="imageView" aria-hidden="true" alt="profile" />
                                        </label>
                                        <input id="profile" class="d-none" accept="image/*" type="file" prepend-icon="mdi-camera" style="margin-bottom: -45px" @change="addImg" label="Select Your Image here" filled />
                                    </div>
                                </div>
                            </v-card-text>
                            <v-card-actions>
                                <v-spacer></v-spacer>
                                <v-btn color="blue darken-1" text @click="profileDialog = false">
                                    Cancel
                                </v-btn>
                                <v-btn color="blue darken-1" text @click="
                      profileDialog = false;
                      setProfileImage();
                    ">
                                    Save
                                </v-btn>
                            </v-card-actions>
                        </v-card>
                    </v-dialog>
                </v-row>
                <!-- end img dialog  -->
            </div>
        </div>
        <div class="d-flex justify-center" style="margin-left: 40px; margin-top: 30px">
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
                    <h5 class="ml-4 mt-2">Skills: {{ userSkill[0] }}</h5>
                </div>
                <div class="d-flex mt-5">
                    <v-icon dark color="blue"> mdi-email </v-icon>
                    <h5 class="ml-4">Email: {{ email }}</h5>
                </div>
            </div>
        </div>

        <v-card-actions>
            <v-btn class="explore-btn" text color="blue accent-4" @click="reveal = true">
                Explore
            </v-btn>
        </v-card-actions>
        <v-expand-transition>
            <v-card v-if="reveal" class="transition-fast-in-fast-out v-card--reveal" style="height: 100%">
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
                    <p class="text-h4 blue--text mb-7" style="margin-left: 41%; margin-top: -43px">
                        {{ position }}
                    </p>
                    <div class="d-flex mb-7 rounded" style="background: #2196f3; padding: 4px">
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
                    <v-btn class="close-btn" text color="red accent-4" @click="reveal = false">
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
        userImage: "https://www.portal.chat/img/avatar.svg",
        companyProfile: "https://png.pngtree.com/png-vector/20190418/ourlarge/pngtree-vector-office-building-icon-png-image_953174.jpg",
        imageView: "https://www.portal.chat/img/avatar.svg",
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
        isSignUp: localStorage.getItem("isSignUp"),
        reveal: false,
        dialog: false,
        profileDialog: false,
        activePicker: null,
        date: null,
        menu: false,
        profileImage: null,
        personalInfo: localStorage.getItem("personalInfo"),
        userRole: localStorage.getItem("role"),
        userId: localStorage.getItem("id"),
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
        // ____________ADD DETAIL____________ //
        detailInfo: [],
        dateofbirth: "",
        sex: "",
        userMajor: "",
        userMaritalStatus: "",
        userSkill: "",
        userPhoneNumber: "",
        userProvince: "",
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
            // console.log(this.user);
        },
        // ____________GET DETAIL__________ //
        getDetailInfo() {
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
            // console.log(this.isSignUp);
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
                .then(() => {
                    this.getDetailInfo();
                    localStorage.setItem("personalInfo", true);
                    localStorage.setItem("isSignUp", false);
                    this.getCompanyDetailInfo();
                })
                .catch((error) => {
                    console.log(error.response);
                });
        },

        // ____________GET COMPANY__________ //
        getCompanyDetailInfo() {
            axios.get("companies_detail/" + this.userId).then((res) => {
                this.companyInfo = res.data[0];
                console.log(res.data[0]);
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
                    this.getCompanyDetailInfo();
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
        },
        customFilter(item, queryText) {
            const textOne = item.name.toLowerCase();
            console.log(item.id);
            console.log("yes");
            const searchText = queryText.toLowerCase();
            return textOne.indexOf(searchText) > -1;
        },
        hello() {
            console.log(this.companyId);
        },
        isNotSignUp() {
            if (this.personalInfo && this.userRole == "Alumni") {
                this.getDetailInfo();
                this.getCompanyDetailInfo();
            }
        },
    },
    mounted() {
        this.username = localStorage.getItem("user");
        this.email = localStorage.getItem("email");
        this.batch = localStorage.getItem("batch");
        // this.getCompanyDetailInfo()
        this.isNotSignUp();
        this.getUser();
        this.getCompany();
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
