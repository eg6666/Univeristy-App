<template>
    <div v-if="data" class="cardContainer">
        <CardComponent class="col" :key="card.title" v-for="card in data" :data="card" />
    </div>
    <div v-else class="cardContainer">
        <CardComponent class="col" :key="card.title" v-for="card in DBdata" :data="card" />
    </div>
</template>
<script>
import CardComponent from "@/components/CardComponent/CardComponent.vue";
import moment from "moment"

export default {
    name: "Card",
    components:{
        CardComponent
    },
    props: {
        data:Array
    },
    data(){
        return {DBdata:[]}
    },
    async created() {
    try {
        const res = await this.$api.blog.getNotifications()
        this.DBdata = res.data.map(p => {
            return {
                ...p,
                content: `${p.content.replace(/<[^>]*>/g, " ").substring(0, 100)}...`,
                date: moment(p.created_at).format("DD/MM/YYYY"),
                to: `postime/${p.id}`,
                url: p.file_path,
            }
        }).splice(0,4)
    } catch (err) { console.log(err); }
    }
}

</script>
<style scoped>
.cardContainer{
    display: flex;
    flex-direction: row;
    justify-content: space-around;
    margin: 20px;
}
</style>