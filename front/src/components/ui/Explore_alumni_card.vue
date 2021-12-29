<template>
<section>
    <!-- Sear and Sort -->
    <div class="search">
        <input type="search" class="search_input" placeholder="Search ...">
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
        <v-card class="ml-11 mr-5 mt-5 mb-5 rounded-lg" max-width="370" outlined dense elevation="6">
            <div>
                <v-list-item three-line>
                    <v-list-item-content>
                        <div>
                            <div class="text-overline mb-8 d-flex">
                                <img src="../../assets/pn-logo.png" alt="" width="35px" height="35px" class="rounded-circle mr-1">
                                <h5 class="mt-1">BATCH: 2021-WEP</h5>
                            </div>
                        </div>
                        <v-list-item-title class="text--h6 ml-1 blue--text" style="margin-right: -10px">
                            Current Employment
                        </v-list-item-title>
                        <div class="d-flex">
                            <img src="../../assets/mangobyte.png" alt="" width="40px" height="40px" class="rounded-circle mr-1">
                            <h5 class="mt-4">Mango Byte Cambodia</h5>
                        </div>
                    </v-list-item-content>
                    <div style="margin-top: -40px">
                        <v-list-item-avatar tile size="80" color="grey" class="rounded-circle mr-0">
                            <img src="../../assets/jennie.jpg" />
                        </v-list-item-avatar>
                        <v-list-item-title class="text-h6 mb-1 mt-0">
                            Jennie
                        </v-list-item-title>
                    </div>
                </v-list-item>
                <div class="text-caption ml-5 mr-5 pa-2 rounded-lg" style="border: 1px solid #2196F3">
                    <p>Position: WEP Developer</p>
                    <p style="margin-top: -10px">HR: Sophavatey</p>
                    <p style="margin-top: -10px">Email: sophavatey@gmail.com</p>
                    <p style="margin-top: -10px" class="mb-0">Tel: +855 81 327 344</p>
                </div>
                <v-card-actions class="float-end">
                    <v-btn outlined rounded text color="blue" darken-2>
                        Detail
                    </v-btn>
                </v-card-actions>
            </div>
        </v-card>
        <!--  -->
        <v-card class="ml-11 mr-5 mt-5 mb-5 rounded-lg" max-width="370" outlined dense elevation="6">
            <div>
                <v-list-item three-line>
                    <v-list-item-content>
                        <div>
                            <div class="text-overline mb-8 d-flex">
                                <img src="../../assets/pn-logo.png" alt="" width="35px" height="35px" class="rounded-circle mr-1">
                                <h5 class="mt-1">BATCH: 2021-WEP</h5>
                            </div>
                        </div>
                        <v-list-item-title class="text--h6 ml-1 blue--text" style="margin-right: -10px">
                            Current Employment
                        </v-list-item-title>
                        <div class="d-flex">
                            <img src="../../assets/mangobyte.png" alt="" width="40px" height="40px" class="rounded-circle mr-1">
                            <h5 class="mt-4">Mango Byte Cambodia</h5>
                        </div>
                    </v-list-item-content>
                    <div style="margin-top: -40px">
                        <v-list-item-avatar tile size="80" color="grey" class="rounded-circle mr-0">
                            <img src="../../assets/jennie.jpg" />
                        </v-list-item-avatar>
                        <v-list-item-title class="text-h6 mb-1 mt-0">
                            Jennie
                        </v-list-item-title>
                    </div>
                </v-list-item>
                <div class="text-caption ml-5 mr-5 pa-2 rounded-lg" style="border: 1px solid #2196F3">
                    <p>Position: WEP Developer</p>
                    <p style="margin-top: -10px">HR: Sophavatey</p>
                    <p style="margin-top: -10px">Email: sophavatey@gmail.com</p>
                    <p style="margin-top: -10px" class="mb-0">Tel: +855 81 327 344</p>
                </div>
                <v-card-actions class="float-end">
                    <v-btn outlined rounded text color="blue" darken-2>
                        Detail
                    </v-btn>
                </v-card-actions>
            </div>
        </v-card>
        <!--  -->
        <v-card class="ml-11 mr-5 mt-5 mb-5 rounded-lg" max-width="370" outlined dense elevation="6">
            <div>
                <v-list-item three-line>
                    <v-list-item-content>
                        <div>
                            <div class="text-overline mb-8 d-flex">
                                <img src="../../assets/pn-logo.png" alt="" width="35px" height="35px" class="rounded-circle mr-1">
                                <h5 class="mt-1">BATCH: 2021-WEP</h5>
                            </div>
                        </div>
                        <v-list-item-title class="text--h6 ml-1 blue--text" style="margin-right: -10px">
                            Current Employment
                        </v-list-item-title>
                        <div class="d-flex">
                            <img src="../../assets/mangobyte.png" alt="" width="40px" height="40px" class="rounded-circle mr-1">
                            <h5 class="mt-4">Mango Byte Cambodia</h5>
                        </div>
                    </v-list-item-content>
                    <div style="margin-top: -40px">
                        <v-list-item-avatar tile size="80" color="grey" class="rounded-circle mr-0">
                            <img src="../../assets/jennie.jpg" />
                        </v-list-item-avatar>
                        <v-list-item-title class="text-h6 mb-1 mt-0">
                            Jennie
                        </v-list-item-title>
                    </div>
                </v-list-item>
                <div class="text-caption ml-5 mr-5 pa-2 rounded-lg" style="border: 1px solid #2196F3">
                    <p>Position: WEP Developer</p>
                    <p style="margin-top: -10px">HR: Sophavatey</p>
                    <p style="margin-top: -10px">Email: sophavatey@gmail.com</p>
                    <p style="margin-top: -10px" class="mb-0">Tel: +855 81 327 344</p>
                </div>
                <v-card-actions class="float-end">
                    <v-btn outlined rounded text color="blue" darken-2 @click="getAlumniDetails">
                        Detail
                    </v-btn>
                </v-card-actions>
            </div>
        </v-card>
        <!--  -->
    </div>
</section>
</template>

<script>
import axios from '../../axios-http';
export default {
    data: () => ({
        items: ['Explore as much as you like !'],
    }),
    methods: {
        // _______________GET ALUMNI DETAILS________________ //
        getAlumniDetails(){
            axios.get('usersDetail')
                .then(res => {
                    console.log(res.data);
                })
                .catch(error => {
                    console.log(error.data);
                });
        }
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

i {
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

i:hover {
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
</style>
