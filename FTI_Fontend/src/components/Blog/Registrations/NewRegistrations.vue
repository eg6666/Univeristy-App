<template>
    <preloader v-if="loading" />
    <ul class="list-unstyled m-8" v-else>
        <h2>Lista e regjistrimeve të reja</h2>
        <hr />
        <b-media class="mt-4 mb-7" tag="li" :key="user.id" v-for="user in users">
            <template #aside>
                <b-img blank blank-color="#abc" class="mr-5" width="64" alt="placeholder"></b-img>
            </template>
            <h5 class="mt-0 mb-1">{{`${user.fname} ${user.lname}`}}</h5>
            <p class="mb-0">{{`${user.email} në rolin e ${roles[user.user_type_id]}`}}</p>
            <b-button @click="() => registerUser(user.id)" block class="mt-2" variant="info">Aprovo</b-button>
            <b-button class="mt-2" block @click="() => deleteUser(user.id)">Fshi</b-button>
        </b-media>
        <p v-if="users.length == 0" class="mt-2">Nuk ka regjistrime të reja :)</p>
    </ul>
</template>

<script>
import Preloader from '../Preloader.vue'
export default {
  components: { Preloader },
    name: "NewRegistrations",
    data() {
        return {
            users: [],
            loading: false,
            roles: {
                1: 'Administrator',
                2: 'Drejtues',
                3: 'Pedagog',
                4: 'Student',
            }
        }
    },
    async created() {
        try {
            this.loading = true
            const res = await this.$api.blog.getNewRegistrations()
            this.users = res.data
            this.loading = false
        } catch (err) {
            console.log(err)
            this.$notify({
                    group: "error",
                    title: "Error",
                    text: `Pati një problem. Ju lutem provoni përsëri.`,
                    type: "error",
                })
        }
    },
    methods: {
        async registerUser(id) {
            try {
                await this.$api.blog.giveAccess(id)
                this.$notify({
                    group: "success",
                    title: "Sukses",
                    text: `Miratimi i kerkeses u krye me sukses`,
                    type: "success",
                })
                this.users = this.users.filter(u => u.id !== id)
            } catch(err) {
                console.log(err)
                this.$notify({
                    group: "error",
                    title: "Error",
                    text: `Pati një problem. Ju lutem provoni përsëri.`,
                    type: "error",
                })
            }
        },
        async deleteUser(id) {
            try {
                await this.$api.blog.deleteUser(id)
                this.$notify({
                    group: "success",
                    title: "Sukses",
                    text: `Perdoruesi u fshi me sukses`,
                    type: "success",
                })
                this.users = this.users.filter(u => u.id !== id)
            } catch(err) {
                console.log(err)
                this.$notify({
                    group: "error",
                    title: "Error",
                    text: `Pati një problem. Ju lutem provoni përsëri.`,
                    type: "error",
                })
            }
        }
    }
}
</script>