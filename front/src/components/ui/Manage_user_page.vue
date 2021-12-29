<template>
<div>
    <div style=" display: block; margin-left:45.6%; width:40px;">
        <img width="90" src="../../assets/pnc.png" alt="logoImage" />
    </div>
    <h2 style="text-align:center; font-family:dense; font-size:20px">Passerelles Numeriques Cambodia</h2>
    
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
                                        <v-text-field class="rounded-lg" label="First name" v-model="first_name" :rules="Rules" hide-details="auto" solo  @keyup="accountValidation"></v-text-field>
                                    </v-col>
                                    <v-col cols="6">
                                        <v-text-field class="rounded-lg" label="Last name" v-model="last_name" :rules="Rules" hide-details="auto" solo  @keyup="accountValidation"></v-text-field>
                                    </v-col>

                                    <v-col cols="12">
                                        <v-text-field class="rounded-lg" v-model="email" solo :rules="emailRules" hide-details="auto" label="E-mail" @keyup="accountValidation"></v-text-field>
                                    </v-col>

                                    <v-col cols="12">
                                        <v-text-field class="rounded-lg" v-model="password" type="password" solo  :rules="passwordrules" hide-details="auto" label="Password" @keyup="accountValidation"></v-text-field>
                                    </v-col>

                                    <v-col cols="12">
                                        <v-text-field class="rounded-lg" type="password" v-model="confirm_password" solo  :rules="passwordrules" hide-details="auto" label="Confirm Password" @keyup="accountValidation"></v-text-field>
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
        <v-simple-table>
            <template v-slot:default>
                <thead>
                    <tr class="text-center">
                        <th>Profile</th>
                        <th>First name</th>
                        <th>Last name</th>
                        <th>Role</th>
                        <th>Email</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="user in users" :key="user.type">
                        <td>
                            
                        </td>
                        <td>{{ user.firstName }}</td>
                        <td>{{ user.lastName }}</td>
                        <td>{{ user.role }}</td>
                        <td>{{ user.email }}</td>
                        <td>
                            <v-icon color="red" style="font-size:20px" small @click.prevent="deleteDialog = true">
                                mdi-delete
                            </v-icon>

                            <v-dialog v-model="deleteDialog" max-width="320">
                                <v-card>
                                    <v-card-title class="text-h5">
                                        Delete this user ?
                                    </v-card-title>

                                    <v-card-text>
                                        Are you sure you want to delete this user ?
                                    </v-card-text>

                                    <v-card-actions>
                                        <v-spacer></v-spacer>

                                        <v-btn color="red darken-1" text @click="deleteDialog = false">
                                            Discard
                                        </v-btn>

                                        <v-btn color="blue darken-1" text @click="deleteDialog = false; deleteUser(user.id); ">
                                            Yes, Sure !
                                        </v-btn>
                                    </v-card-actions>
                                </v-card>
                            </v-dialog>
                        </td>
                    </tr>
                </tbody>
            </template>
        </v-simple-table>
    </div>
</div>
</template>

<script>
import axios from "../../axios-http";
export default {
    data() {
        return {
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
            hiddenBtn: 0
        };
    },
    methods: {
        close() {
            this.dialog = false;
        },
        // _____________________VALIDATION_______________________ //
        accountValidation(){
            let user = {
                firstName: this.first_name,
                lastName: this.last_name,
                email: this.email,
                password: this.password,
                password_confirmation: this.confirm_password,
            };
            if (user.firstName !== '' && user.lastName !== '' && user.email !== '' && user.password !== '' && user.password_confirmation !== ''){
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
                })
                .catch((err) => {
                    console.log(err.response.data.message);
                });
                // ____CLEAR INPUT____ //
            eroUser.firstName = '',
            eroUser.lastName = '',
            eroUser.email = '',
            eroUser.password = '',
            eroUser.password_confirmation = ''
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
                .then((res) => {
                    this.getUser();
                    this.users = res.data;
                })
        },
    },
    mounted() {
        this.getUser();
    },
};
</script>

<style scoped>
</style>
