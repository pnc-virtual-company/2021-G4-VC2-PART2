<template>
  <section>
    <div style="display: block; margin-left: 45.6%; width: 40px">
      <img width="90" src="../../assets/pnc.png" alt="logoImage" />
    </div>
    <h2 style="text-align: center; font-family: dense; font-size: 20px">
      Passerelles Numeriques Cambodia
    </h2>
    <v-select
      v-model="select"
      :items="itemSelect"
      color="white"
      item-text="name"
      dense
      solo
      label="Select"
      style="width: 200px; margin-left: 50px"
    ></v-select>
    <manage-user-page
      v-show="select === 'User' || select === ''"
    ></manage-user-page>
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
      itemSelect: ["User", "Company", "User_Detail", "Company_Detail"],
    };
  },
};
</script>