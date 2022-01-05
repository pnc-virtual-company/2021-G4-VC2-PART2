<template>
<div>
    <!-- Search and Sort -->
    <div>
        <div class="alumni-top">
            <div class="search">
                <input type="search" class="search_input" placeholder="Search ..." v-model="search_name" @keyup="search" />
                <i class="fas fa-search"></i>
            </div>
            <v-row class="ml-12 mr-12 filter">
                <v-col>
                    <v-select class="filter_batch" v-model="batch" @change="sort('batch', batch)" :items="listBatch" label="Batch" dense solo></v-select>
                </v-col>
                <v-col>
                    <v-select class="filter_city" v-model="city" :items="ListCity" @change="sort('city', city)" label="City" dense solo></v-select>
                </v-col>
                <v-col>
                    <v-select class="filter_company" v-model="companyName" @change="sort('company_id', companyName)" :items="listCompany" item-text="companyName" item-value="companyName" label="Company" dense solo></v-select>
                </v-col>
                <v-col>
                    <v-select class="filter_major" v-model="major" @change="sort('major', major)" :items="listMajor" label="Major" dense solo></v-select>
                </v-col>
            </v-row>
        </div>
    </div>
    <!-- End Search and Sort -->

    <div v-if="!isDataAvailable" align="center" class="mt-12">
        <h2>No Data Available</h2>
    </div>
    
    <div>
        <v-row justify="space-around">
            <v-col cols="auto">
                <v-dialog transition="dialog-top-transition" max-width="600" v-model="dialog">
                    <template v-slot:activator="{ on, attrs }">
                        <v-btn style="margin-left:500%;" color="primary" dark class="mb-2" v-bind="attrs" v-on="on">
                            New ERO
                        </v-btn>
                    </template>
                    <template>
                        <v-card>
                            <v-toolbar color="primary" dark>Define ERO Account</v-toolbar>
                            <div class="pa-6">
                                <v-row>
                                    <v-col cols="6">
                                        <v-text-field class="rounded-lg" label="First name" v-model="first_name" :rules="Rules" hide-details="auto" solo @keyup="accountValidation"></v-text-field>
                                    </v-col>
                                    <v-col cols="6">
                                        <v-text-field class="rounded-lg" label="Last name" v-model="last_name" :rules="Rules" hide-details="auto" solo @keyup="accountValidation"></v-text-field>
                                    </v-col>

                                    <v-col cols="12">
                                        <v-text-field class="rounded-lg" v-model="email" solo :rules="emailRules" hide-details="auto" label="E-mail" @keyup="accountValidation"></v-text-field>
                                    </v-col>

                                    <v-col cols="12">
                                        <v-text-field class="rounded-lg" v-model="password" type="password" solo :rules="passwordrules" hide-details="auto" label="Password" @keyup="accountValidation"></v-text-field>
                                    </v-col>

                                    <v-col cols="12">
                                        <v-text-field class="rounded-lg" type="password" v-model="confirm_password" solo :rules="passwordrules" hide-details="auto" label="Confirm Password" @keyup="accountValidation"></v-text-field>
                                    </v-col>
                                </v-row>
                            </div>
                            <v-card-actions class="justify-end">
                                <v-btn color="error" text @click="close">Close</v-btn>
                                <v-btn color="primary" text @click.prevent="createEro" v-if="hiddenBtn">Create</v-btn>
                            </v-card-actions>
                        </v-card>
                    </template>
                </v-dialog>
            </v-col>
        </v-row>
        <v-data-table :headers="headers" :items="users" sort-by="calories" class="elevation-1 ma-12">
            <template v-slot:[`item.profile`]="{ item }">
                <img v-if="item.userImage===null" class="profileImg" width="40px" height="40px" src="https://www.portal.chat/img/avatar.svg" alt="Profile Imag">
                <img v-else class="profileImg" width="40px" height="40px" :src="'http://127.0.0.1:8000/storage/images/users/'+item.userImage" alt="Profile Imag">
            </template>
            <template v-slot:[`item.actions`]="{ item }">
                <v-icon small @click="deleteUser(item.id)" color="red">
                    mdi-delete
                </v-icon>
            </template>
        </v-data-table>
    </div>
</div>
</template>

<script>
import axios from "../../axios-http";
import City from "../json/City.json";
export default {
    data() {
        return {
            headers: [{
                    text: 'Profile',
                    align: 'start',
                    sortable: false,
                    value: 'profile',
                },
                {
                    text: 'First Name',
                    value: 'firstName'
                },
                {
                    text: 'Last Name',
                    value: 'lastName'
                },
                {
                    text: 'Role',
                    value: 'role'
                },
                {
                    text: 'Email',
                    value: 'email'
                },
                {
                    text: 'Actions',
                    value: 'actions',
                    sortable: false
                },
            ],
            dialog: false,
            deleteDialog: false,
            todos: [],
            first_name: "",
            last_name: "",
            province: "",
            email: "",
            password: "",
            confirm_password: "",
            deleteId: '',
            show1: false,
            valid: false,
            Rules: [(value) => !!value || "Required."],
            passwordrules: [
                v => !!v || 'Password is required',
                v => v.length >= 8 || 'Password is must be equal or more than 8 characters',
                v => v.length <= 20 || 'Password is to long',
            ],
            emailRules: [
                (v) => !!v || "E-mail is required",
                (v) => /.+@.+/.test(v) || "E-mail must be valid",
            ],
            picker: new Date(Date.now() - new Date().getTimezoneOffset() * 60000)
                .toISOString()
                .substr(0, 10),
            users: [],
            hiddenBtn: 0,
            // new ____
            dialogDelete: false,
            // ______________
            search_name: "",
            listMajor: ["WEP", "SNA"],
            listBatch: [2018, 2019, 2020, 2021],
            listUser: [],
            major: "",
            batch: "",
            companyName: "",
            city: "",
            listCompany: [],
            ListCity: City,
            isDataAvailable: true,
        };
    },
    methods: {
        close() {
            this.dialog = false;
        },
        // _____________________VALIDATION_______________________ //
        accountValidation() {
            let user = {
                firstName: this.first_name,
                lastName: this.last_name,
                email: this.email,
                password: this.password,
                password_confirmation: this.confirm_password,
            };
            if (user.firstName !== '' && user.lastName !== '' && user.email !== '' && user.password !== '' && user.password_confirmation !== '') {
                this.hiddenBtn = 1;
            } else {
                this.hiddenBtn = 0;
            }
        },
        // _____________________CREATE ERO_______________________ //
        createEro() {
            let eroUser = {
                firstName: this.first_name,
                lastName: this.last_name,
                email: this.email,
                password: this.password,
                password_confirmation: this.confirm_password,
                role: "ERO",
            };
            this.dialog = false;
            axios.post("signup", eroUser)
                .then(() => {
                    this.getUser();
                    // ____CLEAR INPUT____ //
                    eroUser.firstName = '',
                        eroUser.lastName = '',
                        eroUser.email = '',
                        eroUser.password = '',
                        eroUser.password_confirmation = ''
                })
                .catch((err) => {
                    console.log(err.response.data.message);
                });
        },
        // ________________________GET USER_______________________ //
        getUser() {
            axios.get("users")
                .then((res) => {
                    this.users = res.data;
                })
                .catch((err) => {
                    console.log(err.response.data.message);
                });
        },
        // _________________________DELETE USER_______________________ //
        deleteUser(id) {
            axios.delete("users/" + id)
                .then(() => {
                    this.getUser();
                })
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
        // _______________________GET COMPANY____________________ //
        getCompany() {
            axios.get("/companies").then((res) => {
                this.listCompany = res.data;
            });
        },
        // _________________________SORT________________________ //
        sort(typeOfSort, key) {
            this.users = [];
            this.isDataAvailable = true
            let isHasData = false
            for (let user of this.listUser) {
                if (typeOfSort === "batch") {
                    if (user.batch == key) {
                        this.users.push(user);
                        isHasData = true
                    }
                    this.city = "";
                    this.companyName = "";
                    this.major = "";
                } else if (typeOfSort === "city") {
                    if (user.city == key) {
                        this.users.push(user);
                        isHasData = true
                    }
                    this.batch = "";
                    this.companyName = "";
                    this.major = "";
                } else if (typeOfSort === "major") {
                    if (user.major == key) {
                        this.users.push(user);
                        isHasData = true
                    }
                    this.batch = "";
                    this.companyName = "";
                    this.city = "";
                } else {
                    if (user.companyName == key) {
                        this.users.push(user);
                        isHasData = true
                    }
                    this.batch = "";
                    this.major = "";
                    this.city = "";
                }

            }
            if (!isHasData) {
                this.isDataAvailable = false
            }
        },
    },
    mounted() {
        this.getUser();
        this.getCompany();
    },
};
</script>

<style scoped>
.profileImg {
    margin-top: 6px;
    border-radius: 40px;
}

/* ____ */
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
</style>
