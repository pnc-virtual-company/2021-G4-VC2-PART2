<template>
<div>
    <div style=" display: block; margin-left:45%; width:40px;">
        <img width="90" src="../../assets/pnc.png" alt="logoImage" />
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
                                        <v-text-field class="rounded-pill" label="firstName ..." v-model="first_name" :rules="Rules"  hide-details="auto" outlined dense></v-text-field>
                                    </v-col>
                                    <v-col cols="6">
                                        <v-text-field class="rounded-pill" label="LastName ..." v-model="last_name" :rules="Rules" hide-details="auto" outlined  dense></v-text-field>
                                    </v-col>

                                    <v-col cols="12">
                                        <v-text-field class="rounded-pill" v-model="email" outlined dense :rules="emailRules" hide-details="auto" label="E-mail" ></v-text-field>
                                    </v-col>

                                    <v-col cols="12">
                                        <v-text-field class="rounded-pill" v-model="password" type="password" outlined dense :rules="Rules" required="Min 6 characters" hide-details="auto" label="Password" ></v-text-field>
                                    </v-col>

                                    <v-col cols="12">
                                        <v-text-field class="rounded-pill" type="password" v-model="confirm_password" outlined dense :rules="Rules" required="Min 6 characters" hide-details="auto" label="Confirm Password" ></v-text-field>
                                    </v-col>
                                </v-row>
                            </div>
                            <v-card-actions class="justify-end">
                                <v-btn color="error" text @click="close">Close</v-btn>
                                <v-btn color="primary" text @click.prevent="createEro">Create</v-btn>
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
                        <th>Gmail</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="user in users" :key="user.type">
                        <td>
                            <!-- <img :src="user.profile" alt="" width="50" class="ma-2" /> -->
                            <!-- <img
                  src="../../assets/remove.png"
                  alt=""
                  width="50"
                  class="ma-2"
                /> -->
                        </td>
                        <td>{{ user.firstName }}</td>
                        <td>{{ user.lastName }}</td>
                        <td>{{ user.role }}</td>
                        <td>{{ user.email }}</td>
                        <td>
                            <v-icon color="red" small @click.prevent="deleteDialog = true">
                                mdi-delete
                            </v-icon>
                            <!-- <v-btn color="primary" dark @click.stop="dialog = true">
                                    Open Dialog
                                </v-btn> -->

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
                                            Yes, I am !
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
            // pwdRules: {
            //     required: (value) => !!value || "Required.",
            //     min: (v) => v.length >= 6 || "Min 6 characters",
            // },
            emailRules: [
                (v) => !!v || "E-mail is required",
                (v) => /.+@.+/.test(v) || "E-mail must be valid",
            ],
            picker: new Date(Date.now() - new Date().getTimezoneOffset() * 60000)
                .toISOString()
                .substr(0, 10),
            users: [],
        };
    },
    methods: {
        close() {
            this.dialog = false;
        },
        // ______________________CREATE ERO________________________ //
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
            axios
                .post("signup", eroUser)
                .then(() => {
                    this.getUser();
                })
                .catch((err) => {
                    console.log(err.response.data.message);
                });
        },
        // _________________________GET USER________________________ //
        getUser() {
            axios
                .get("users")
                .then((res) => {
                    this.users = res.data;
                    console.log(this.users);
                })
                .catch((err) => {
                    console.log(err.response.data.message);
                });
        },
        // __________________________DELETE USER________________________ //
        deleteUser(id) {
            axios.delete("users/" + id)
                .then((res) => {
                    this.users = res.data;
                    this.getUser();
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
