<template>
    <div>
        <span class="px-2 py-1 bg-red-500 text-white font-bold text-xs rounded-full">
            {{discussionsinChannelspecific.title}}
        </span>
        <ul>
        <li v-for="discussion in discussionsinChannelspecific.discussions" :key="discussion.id">
            <router-link :to="{name:'showDiscussion',params:{channel:discussion.channel.title,discussion:discussion.slug}}">
                <div class="container mx-auto bg-white flex mb-1 p-3">
                    <div class="bg-white w-1/12 self-center">
                        <img
                            src="https://randomuser.me/api/portraits/men/17.jpg"
                            alt="avatar"
                            class="rounded-full h-16"
                        />
                    </div>
                    <div class="bg-white flex-grow">
                        <h3 class="font-bold text-lg mt-2">
                            {{ discussion.title }}
                            <span class="px-2 py-1 bg-red-500 text-white font-bold text-xs rounded-full">{{discussion.channel.title}}</span>
                        </h3>
                        <span class="text-xs font-light text-gray-800">
                          Posted By:
                          <span class="underline font-normal">{{ discussion.user.name }}</span>
                          {{ discussion.published_at }}
                        </span>
                        <p class="text-gray-600 text-sm" v-html="discussion.content"></p>
                    </div>
                    <div class="bg-white w-1/12 self-center text-center">
                        <i class="fa fa-comments-o" aria-hidden="true"></i>
                        <span>{{ discussion.replies_count }}</span>
                    </div>
                </div>
            </router-link>
        </li>
    </ul></div>
</template>
<script>
    import {mapGetters} from "vuex";
    export default {
        mounted() {
            this.$store.dispatch('discussionsinChannelspecific',this.$route.params.channel)
        },
        computed:{
            ...mapGetters({
                discussionsinChannelspecific:'discussionsinChannelspecific'
            })
        },
        watch: {
            "$route.params.channel":function (val) {
                this.$store.dispatch('discussionsinChannelspecific',this.$route.params.channel)
            },
        }
    }
</script>
