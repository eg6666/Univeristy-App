<template>
    <div class="content">
        <div class="container" style="max-width: 90%; margin: 50px auto 0px;">
            <template v-for="(component, id) in data.head">
                <component :key="id" :is="component.type" :data="component.data"/>
            </template>
        </div>
        <div v-if="data.body=='NewsArchive'" class="container" style="max-width: 90%; margin: 0px auto 50px;">
            <news-archive :data="DBdata" />
        </div>
    </div>
</template>

<script>
import NewsArchive from '@/components/NewsArchive/NewsArchive.vue'
import Title from '@/components/Title/Title.vue'
import Subtitle from '@/components/Subtitle/Subtitle'
import moment from "moment"

export default {
  components: { NewsArchive, Title, Subtitle },
    name: "PageTemplate6",
    props: {
        data: Object
    },
    data(){
        return {DBdata:{items:[]}}
    },
    async created() {
    try {
        const res = await this.$api.blog.getNotifications()
        this.DBdata.items = res.data.map(p => {
            let linkPath=`njoftime/${p.id}`
            if(p.is_public==1) linkPath=`blog/postime/${p.id}`
            return {
                ...p,
                extract: `${p.content.replace(/<[^>]*>/g, " ").substring(0, 100)}...`,
                date: moment(p.created_at).format("DD/MM/YYYY"),
                link: linkPath,
                img: p.file_path,
            }
        })
    } catch (err) { console.log(err); }
    }
}
</script>
// img: "https://image.freepik.com/free-photo/3d-abstract-background-with-low-poly-lines_1048-12367.jpg",
                    // title: "Sed interdum augue",
                    // date: "23.01.2020",
                    // extract: "Duis eu elit fermentum tortor fringilla lobortis sit amet in quam. Vivamus consequat mollis elit, ut rutrum justo. Praesent gravida sit amet leo ut facilisis. Suspendisse potenti.",
                    // link: "a"