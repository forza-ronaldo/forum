import axios from "axios";
const state={
    channels:[],
    discussions:[],
    replies:[],
    discussion:{},
    discussionsinChannelspecific:[]
};
const getters={
    channels:state=>state.channels,
    discussions:state=>state.discussions,
    discussion:state=>state.discussion,
    discussionsinChannelspecific:state=>state.discussionsinChannelspecific,
    replies:state=>state.replies
};
const mutations={
    fetchChannelsSuccess(state,data)
    {
        state.channels=data;
    },
    fetchDiscussionsSuccess(state,data)
    {
        state.discussions=data;
    },
    fetchDiscussionSuccess(state,data)
    {
        state.discussion=data;
    } ,
    fetchdiscussionsinChannelspecificSuccess(state,data)
    {
        state.discussionsinChannelspecific=data;
    } ,
    fetchRepliesSuccess(state,data)
    {
        state.replies=data;
    }
};
const actions={
    async fetchChannel({commit})
    {
        try
        {
            const {data}=await axios.get('/api/v1/channels');
            commit('fetchChannelsSuccess',data)
        }
        catch (e) {
            console.log(e)
        }
    },
    async discussionsinChannelspecific({commit},channelName)
    {
        const {data}=await axios.get('/api/v1/channels/'+channelName);
        commit('fetchdiscussionsinChannelspecificSuccess',data.data);
    },
    async fetchDiscussions(context)
    {
        try
        {
            const {data}= await axios.get('/api/v1/discussions');
            context.commit('fetchDiscussionsSuccess',data);
        }catch (e) {
            console.log(e);
        }
    },
    async fetchDiscussion(context,slug)
    {
        try
        {
            const {data}= await axios.get('/api/v1/discussions/'+slug);
            context.commit('fetchDiscussionSuccess',data.data);
        }catch (e) {
            console.log(e);
        }
    },
    async storeDiscussion({commit}, data) {
        try {
            await axios.post("/api/v1/discussions", data);
            console.log("well done");
        } catch (err) {
            console.log(err);
        }
    },
    async fetchReplies(context)
    {
        try
        {
            const {data}= await axios.get('/api/v1/replies');
            context.commit('fetchDiscussionSuccess',data.data);
        }catch (e) {
            console.log(e);
        }
    },
    async storeReplay({commit},data)
    {
        try{
            await axios.post("/api/v1/replies", data);
            console.log("replay send")
        }catch (e) {
            console.log(e)
        }
    }
};
export default {
    namespace:true,
    state,
    getters,
    mutations,
    actions
}
