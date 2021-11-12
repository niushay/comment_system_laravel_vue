<template>
    <div class="container" style="margin-top: 3%">
        <div class="row justify-content-center">
            <div class="col-md-7 commentBox">
                <div v-for="comment in comments" :key="comment.commentId">
                    <div v-if="comment.reply_id == 0">
                        <div class="commentBody" :id="comment.commentId">
                            <div style=" padding: 3%;">
                                <div class="name">{{comment.name}}</div>
                                <div class="commentText">
                                    <div>{{comment.comment}}</div>
                                    <div class="reply-btn">
                                        <button class="btn btn-outline-info" @click="showReplyForm(comment.commentId)">Reply</button>
                                    </div>
                                </div>
                            </div>

                            <div :id="'form_' + comment.commentId" style="display:none">
                                <replyform-component :replyId="comment.commentId" @fetchCom="fetchComments"></replyform-component>
                            </div>

                            <div v-for="replyComment in comment.replies" :key="replyComment.commentId">
                                <div class="commentBody replyBody col-md-11 ml-auto" :id="replyComment.commentId" style="border-bottom: none">
                                    <div style="padding: 3%; border-top: 1px solid #bdbdbd ">
                                        <div class="name">{{replyComment.name}}</div>
                                        <div class="commentText">
                                            <div>{{replyComment.comment}}</div>
                                            <div class="reply-btn">
                                                <button class="btn btn-outline-info" @click="showReplyForm(replyComment.commentId)">Reply</button>
                                            </div>
                                        </div>
                                    </div>

                                    <div :id="'form_' + replyComment.commentId" style="display:none">
                                        <replyform-component :replyId="replyComment.commentId" @fetchCom="fetchComments"></replyform-component>
                                    </div>

                                    <div v-for="replyComment2 in replyComment.replies" :key="replyComment2.commentId">
                                        <div class="commentBody replyBody2 col-md-11 ml-auto" :id="replyComment2.commentId" style="border-bottom: none">
                                            <div style="padding: 3%; border-top: 1px solid #bdbdbd">
                                                <div class="name">{{replyComment2.name}}</div>
                                                <div class="commentText">
                                                    <div>{{replyComment2.comment}}</div>
                                                </div>
                                            </div>

                                            <div :id="'form_' + replyComment2.commentId" style="display:none">
                                                <replyform-component @fetchCom="fetchComments" :replyId="replyComment2.commentId"></replyform-component>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        </div>
</template>

<script>
export default {
    data() {
        return {
            replyClicked : false
        }
    },
    props: [
        'comments'
    ],

    methods: {
        showReplyForm(commentId) {
            let formElement = document.getElementById("form_" + commentId);
            let form = document.getElementById("reply_id_" + commentId);
            formElement.style.display = 'block';
            form.style.display = 'block';
        },
        fetchComments() {
            this.$emit("fetch")
        },
    },

    mounted() {

    }
}
</script>

<style>

    .commentBox{
        /*border: 1px solid #bdbdbd;*/
        background: white;
        display: flex;
        flex-direction: column;
        justify-content: space-between;
        padding: 0;
    }
    .commentBody{
        padding: 0;
        border-bottom: 1px solid #bdbdbd;
        /*padding-bottom: 3%;*/
    }
    .commentText{
        display: flex;
        flex-direction: column;
        justify-content: space-between;
    }
    .reply-btn{
        display: flex;
        justify-content: flex-end;
    }
    .name{
        font-size: 1rem;
        font-weight: bold;
        color: #1b4b72;
        text-shadow: 0.2px 0.2px  #888;
    }

    .replyBody2{
        border-radius: 10px;
        /*background: yellow;*/
        margin: 3%;
    }

    .replyBody{
        border-radius: 10px;
        /*background: pink;*/
        /*margin: 3%;*/
        border-bottom: 1px solid #bdbdbd;
    }
</style>
