<template>
    <section>
        <div class="mt-6" style="width: 70%; margin-left: 15%;">
            <v-autocomplete
                dense
                chips
                :items="items"
                small-chips
                label="Search"
                color="blue"
                class="text-align-center"
            ></v-autocomplete>
        </div>

        <div class="d-flex flex-wrap">
            <v-card
                class="ml-11 mr-5 mt-5 mb-5 rounded-lg"
                max-width="370"
                outlined
                dense elevation="6"
                >
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
                            <v-list-item-avatar
                                tile
                                size="80"
                                color="grey"
                                class="rounded-circle mr-0"
                            >
                                <img src="../../assets/jennie.jpg"/>
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
                        <v-btn
                            outlined
                            rounded
                            text
                            color="blue"
                            darken-2
                        >
                            Detail
                        </v-btn>
                    </v-card-actions>
                </div>
            </v-card>
        <!--  -->
            <v-card
                class="ml-11 mr-5 mt-5 mb-5 rounded-lg"
                max-width="370"
                outlined
                dense elevation="6"
                >
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
                            <v-list-item-avatar
                                tile
                                size="80"
                                color="grey"
                                class="rounded-circle mr-0"
                            >
                                <img src="../../assets/jennie.jpg"/>
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
                        <v-btn
                            outlined
                            rounded
                            text
                            color="blue"
                            darken-2
                        >
                            Detail
                        </v-btn>
                    </v-card-actions>
                </div>
            </v-card>
        <!--  -->
            <v-card
                class="ml-11 mr-5 mt-5 mb-5 rounded-lg"
                max-width="370"
                outlined
                dense elevation="6"
                >
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
                            <v-list-item-avatar
                                tile
                                size="80"
                                color="grey"
                                class="rounded-circle mr-0"
                            >
                                <img src="../../assets/jennie.jpg"/>
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
                        <v-btn
                            outlined
                            rounded
                            text
                            color="blue"
                            darken-2
                        >
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
    export default {
        data: () => ({
            items: ['Explore as much as you like !'],
        })
    }
</script>