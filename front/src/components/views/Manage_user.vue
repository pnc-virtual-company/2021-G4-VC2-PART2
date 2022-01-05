<template>
<section class="manage_data">
    <v-select v-model="select" :items="itemSelect" color="white" item-text="name" dense solo label="Select Data" class='select'></v-select>
    <manage-user-page v-show="select === 'User' || select === ''"></manage-user-page>
    <manage-company-page v-show="select === 'Company'"></manage-company-page>
</section>
</template>

<script>
import Manage_user_page from "../ui/Manage_user_page.vue";
import Manage_company_page from "../ui/Manage_company_page.vue";
export default {
    components: {
        "manage-user-page": Manage_user_page,
        "manage-company-page": Manage_company_page,
    },
    data() {
        return {
            select: "",
            itemSelect: ["User", "Company"],
        };
    },
};
</script>

<style scoped>
.manage_data {
    margin-top: 25px;
}

.select {
    position: absolute;
    margin-top: 10px;
    width: 200px;
    margin-left: 50px;
}
</style>
