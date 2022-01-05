<template>
<section>
    <h1 style="font-size: 17px;margin-bottom:25px;color:white">hello</h1>
    <v-data-table style="width:50%;margin-left:25%" :headers="headers" :items="companies" sort-by="calories" class="elevation-1">
        <template v-slot:[`item.profile`]="{ item }">
            <img class="companyImg" width="40px" height="40px" :src="
            'http://127.0.0.1:8000/storage/images/companies/' +
            item.companyImage
          " alt="Profile Imag" />
        </template>

        <template v-slot:[`item.actions`]="{ item }">
            <v-icon v-if="item.company_detail[0]==undefined" small @click="showDialog(item)"> mdi-delete </v-icon>
            <v-icon v-else small disabled> mdi-delete-off </v-icon>
        </template>
    </v-data-table>
    <v-dialog v-model="deleteDialog" max-width="380">
        <v-card>
            <v-card-title class="text-h5"> Delete this company ? </v-card-title>

            <v-card-text> Are you sure that you want to delete this company ? </v-card-text>

            <v-card-actions>
                <v-spacer></v-spacer>

                <v-btn @click="deleteDialog = false" color="red darken-1" text>

                    Discard
                </v-btn>

                <v-btn @click="
                    deleteDialog = false;
                    deleteCompany()
                  " color="blue darken-1" text>

                    Yes, I'm Sure !
                </v-btn>
            </v-card-actions>
        </v-card>
    </v-dialog>
</section>
</template>

<script>
import axios from "../../axios-http";
export default {
    data() {
        return {
            headers: [{
                    text: "Company Profile",
                    align: "start",
                    sortable: false,
                    value: "profile",
                },
                {
                    text: "CompanyName",
                    align: 'center',
                    value: "companyName"
                },
                {
                    text: "Actions",
                    value: "actions",
                    align: "end",
                    sortable: false
                },
            ],
            deleteDialog: false,
            companies: [],
            companyDelete: []
        };
    },
    methods: {
        getCompanies() {
            axios.get("/companies").then((res) => {
                this.companies = res.data;
                console.log(res.data);
            });
        },
        showDialog(company) {
            this.deleteDialog = true
            this.companyDelete = company
            console.log(this.deleteDialog)
        },
        deleteCompany() {
            axios.delete("/companies/" + this.companyDelete.id).then((res) => {
                console.log(res.data);
                this.getCompanies()
            })
        }
    },
    mounted() {
        this.getCompanies();
    },
};
</script>

<style>
.companyImg {
    margin-top: 6px;
    border-radius: 40px;
}
</style>
