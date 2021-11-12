<template>
    <div class="replyBox" :id="'reply_id_' + replyId">

        <form @submit.prevent="add_reply(replyId)" @keydown="form.onKeydown($event)">
            <div class="form-group">
                <input class="form-control replyName" v-model="form.replyName" type="text" name="replyName" placeholder="Your Name" >
                <div v-if="form.errors.has('replyName')" v-html="form.errors.get('replyName')"/>
            </div>

            <input type="hidden" :ref="'replyInput_'+replyId" name="replyId" :value="replyId">

            <div class="form-group">
                <textarea class="form-control replyText"  v-model="form.replyComment" type="text" name="replyComment" placeholder="Add Comment..." ></textarea>
                <div v-if="form.errors.has('replyComment')" v-html="form.errors.get('replyComment')"/>
            </div>

            <div class="replyButtons">
                <button type="submit" class="btn btn-primary">Post reply</button>
                <button type="button" class="btn btn-outline-info" @click="cancelReply(replyId)">Cancel</button>
            </div>
        </form>

<!--        <input type="text" >-->
<!--        <textarea class="replyText">-->
<!--        </textarea>-->

    </div>
</template>

<script>
export default {
    data: () => ({
        form: new Form({
            replyName: '',
            replyComment: '',
        }),
        comments: []
    }),
    props: [
        'replyId'
    ],
    methods: {
        add_reply(repId){
            axios.post("/api/add_reply",[ this.form, repId])
                .then(response => {
                        this.form.replyName= ''
                        this.form.replyComment= ''

                        //Hide the Form
                        let formElement = document.getElementById("reply_id_" + repId);
                        formElement.style.display = 'none';

                        //fetch comments
                        this.fetchComments();
                    }
                )
                .catch(error => {
                    this.errorMessage = error.message;
                    console.error("There was an error!", error);
                });
        },
        fetchComments() {
            this.$emit("fetchCom");
        },
        cancelReply(commentId) {
            console.log(commentId)
            let formElement = document.getElementById("reply_id_" + commentId);
            formElement.style.display = 'none';
        }
    },
}
</script>

<style>
    .replyBox{
        /*background-color: #f0efeb;*/
        display: flex;
        flex-direction: column;
        justify-content: space-between;
        padding-top: 2%;
    }
    .replyText{
        border-radius: 3%;
        height: 100px;
        width:80%;
        background-color: #fff;
        outline: none;
    }
    .replyButtons{
        display: flex;
        justify-content: flex-end;
        padding: 5px;
    }
    .btn-primary{
        margin-right: 6px;
    }
    .replyName{
       width: 80%;
    }
    .form-control{
        margin: 5%;
        margin-top: 0;
    }
    .replyBody{
        border-bottom: 1px solid #bdbdbd
    }
</style>
