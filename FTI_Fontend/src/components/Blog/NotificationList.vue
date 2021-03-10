<!-- eslint-disable vue/no-parsing-error -->
<template>
    <preloader v-if="loading"/>
    <div class="m-5" v-else>
        <h3><strong>Njoftimet</strong></h3>
        <hr/>
        <div class="my-posts">
            <b-card
                v-for="info in notifications"
                :key="info.id"
                :title="info.title"
                :img-src="info.file_path"
                img-top
                tag="article"
                style="max-width: 20rem;"
                class="mb-2"
            >
                <b-card-text style="min-height: 110px">{{`${info.content.replace(/<[^>]*>/g, " ").substring(0, 100)}...`}}</b-card-text>

                <b-button block @click="() => modifyNotification(info.id)" variant="info">Modifiko</b-button>
                <b-button block @click="() => deleteNotification(info.id)">Fshi</b-button>
            </b-card>
        </div>
    </div>
</template>

<script>
import Preloader from './Preloader.vue'
export default {
  components: { Preloader },
    name: "NotificationList",
    data() {
        return {
            loading: false,
            notifications: [],
        }
    },
    async created() {
        try {
                this.loading = true
                const res = await this.$api.blog.getNotifications()
                this.notifications = res.data
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
        modifyNotification(id) {
            this.$router.push(`/blog/modifiko/${id}`)
        },
        async deleteNotification(id) {
            try {
                await this.$api.blog.deleteNotification(id)
                this.notifications = this.notifications.filter(p => p.id !== id)
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

<style lang="scss">
.my-posts {
    display: grid;
    grid-template-columns: repeat(3, 1fr);
    grid-column-gap: 1em;
    grid-row-gap: 2em;
}
</style>