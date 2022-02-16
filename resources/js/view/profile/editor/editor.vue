<template>
    <v-main>
        <tip-tap v-model="content"></tip-tap>
    </v-main>
</template>

<script>
import TipTap from "../../../components/tiptap/tipTap";
export default {
    name: "editor",
    data(){
        return{
            content:''
        }
    },
    methods:{
        setContent(event){
            this.content=event;
        }
    },
    components: {TipTap},
}
</script>

<style scoped>

</style>
