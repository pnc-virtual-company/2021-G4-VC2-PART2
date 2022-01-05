<template>
<div>
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
                <v-icon v-if="item.role==='Admin'" small color="red" disabled > mdi-delete-off </v-icon>
                <v-icon v-else @click="showDialog(item)" small color="red"> mdi-delete </v-icon>
            </template>
        </v-data-table>
    </div>

    <!-- Delete Dialog -->
    <v-dialog v-model="deleteDialog" max-width="320">
        <v-card>
            <v-card-title class="text-h5"> Delete this user ? </v-card-title>

            <v-card-text> Are you sure you want to delete this user ? </v-card-text>

            <v-card-actions>
                <v-spacer></v-spacer>

                <v-btn color="red darken-1" text @click="deleteDialog = false">
                    Discard
                </v-btn>

                <v-btn color="blue darken-1" text @click="deleteDialog = false;deleteUser();">
                    Yes, Sure !
                </v-btn>
            </v-card-actions>
        </v-card>
    </v-dialog>
    <!-- End Delete Dialog -->
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
        showDialog(user) {
            this.userDelete = user
            this.deleteDialog = true
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
                isComplete: 0
            };
            // this.dialog = false;
            axios.post("signup", eroUser)
                .then(() => {
                    this.getUser();
                    // ___CLEAR INPUT___ //
                    this.firstName = '',
                    this.lastName = '',
                    this.email = '',
                    this.password = '',
                    this.password_confirmation = ''
                    this.dialog = false;
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
        deleteUser() {
            axios.delete("users/" + this.userDelete.id)
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
        // ________________________DELETE USER______________________ //
        // deleteUser() {
        //     console.log(this.userDelete.id);
        //     let userId = this.userDelete.id;
        //     let companyDetailId = this.userDelete.company_detail_id;
        //     let userDetailId = this.userDelete.user_detail_id;
        //     if (this.userDelete.role === "ERO" || this.userDelete.role === "Admin") {
        //         axios.delete("users/" + userId).then(() => {});
        //         axios.delete("usersDetail/" + userDetailId).then(() => {});
        //         axios.delete("companies_detail/" + companyDetailId).then(() => {
        //             this.getUser();
        //         });
        //     } else {
        //         axios.delete("users/" + userId).then(() => {
        //             this.getUser()
        //         })
        //     }
        // },
    },
    mounted() {
        this.getUser();
        // this.getCompany();
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
