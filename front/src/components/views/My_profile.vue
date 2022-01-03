<template>
    <section>
        <signin-profile-card v-if="!isSignUp" class="mt-3"></signin-profile-card>
        <signup-profile-card v-else class="mt-3"></signup-profile-card>
    </section>
</template>

<script>
import SignUp_card from "../ui/Signup_profile_card.vue";
import SignIn_card from "../ui/Signin_profile_card.vue";
export default {
    components: {
        'signup-profile-card': SignUp_card,
        'signin-profile-card': SignIn_card,
    },
    data() {
        return {
            isSignUp:JSON.parse(localStorage.getItem('isSignUp'))
        }
    },
}
</script>