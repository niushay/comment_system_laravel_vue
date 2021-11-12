<template>
    <div class="container" style="margin-top: 3%">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="row">
                    <div class="col-md-10">


                        <div class="comments" v-if="" v-for="(comment,index) in commentsData">
                            <!-- Comment -->
                            <div v-if="!spamComments[index] || !comment.spam" class="comment">
                                <!-- Comment Avatar -->
                                <div class="comment-avatar">
                                    <img src="storage/comment.png">
                                </div>
                                <!-- Comment Box -->
                                <div class="comment-box">
                                    <div class="comment-text">{{comment.comment}}</div>
                                    <div class="comment-footer">
                                        <div class="comment-info">
                       <span class="comment-author">
                               <em>{{ comment.name}}</em>
                           </span>
                                            <span class="comment-date">{{ comment.date}}</span>
                                        </div>
                                        <div class="comment-actions">
                                            <ul class="list">
                                                <li>Votes: {{comment.votes}}
                                                    <a v-if="!comment.votedByUser" v-on:click="voteComment(comment.commentid,'directcomment',index,0,'up')">Up Votes</a>
                                                    <a v-if="!comment.votedByUser" v-on:click="voteComment(comment.commentid,'directcomment',index,0,'down')">Down Votes</a>
                                                </li>
                                                <li>
                                                    <a v-on:click="spamComment(comment.commentId,'directcomment',index,0)">Spam</a>
                                                </li>
                                                <li>
                                                    <a v-on:click="openComment(index)">Reply</a>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                                <!-- From -->
                                <div class="comment-form comment-v" v-if="commentBoxs[index]">
                                    <!-- Comment Avatar -->
                                    <div class="comment-avatar">
                                        <img src="storage/comment.png">
                                    </div>
                                    <form class="form" name="form">
                                        <div class="form-row">
                                            <textarea class="input" placeholder="Add comment..." required v-model="message"></textarea>
                                            <span class="input" v-if="errorReply" style="color:red">{{errorReply}}</span>
                                        </div>
                                        <div class="form-row">
                                            <input class="input" placeholder="Email" type="text" :value="user.name">
                                        </div>
                                        <div class="form-row">
                                            <input type="button" class="btn btn-success" v-on:click="replyComment(comment.commentid,index)" value="Add Comment">
                                        </div>
                                    </form>
                                </div>
                                <!-- Comment - Reply -->
                                <div v-if="comment.replies">
                                    <div class="comments" v-for="(replies,index2) in comment.replies">
                                        <div v-if="!spamCommentsReply[index2] || !replies.spam" class="comment reply">
                                            <!-- Comment Avatar -->
                                            <div class="comment-avatar">
                                                <img src="storage/comment.png">
                                            </div>
                                            <!-- Comment Box -->
                                            <div class="comment-box" style="background: grey;">
                                                <div class="comment-text" style="color: white">{{replies.comment}}</div>
                                                <div class="comment-footer">
                                                    <div class="comment-info">
                                   <span class="comment-author">
                                           {{replies.name}}
                                       </span>
                                                        <span class="comment-date">{{replies.date}}</span>
                                                    </div>
                                                    <div class="comment-actions">
                                                        <ul class="list">
                                                            <li>Total votes: {{replies.votes}}
                                                                <a v-if="!replies.votedByUser" v-on:click="voteComment(replies.commentid,'replycomment',index,index2,'up')">Up Votes</a>
                                                                <a v-if="!replies.votedByUser" v-on:click="voteComment(comment.commentid,'replycomment',index,index2,'down')">Down Votes</a>
                                                                </a>
                                                            </li>
                                                            <li>
                                                                <a v-on:click="spamComment(replies.commentid,'replycomment',index,index2)">Spam</a>
                                                            </li>
                                                            <li>
                                                                <a v-on:click="replyCommentBox(index2)">Reply</a>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- From -->
                                            <div class="comment-form reply" v-if="replyCommentBoxs[index2]">
                                                <!-- Comment Avatar -->
                                                <div class="comment-avatar">
                                                    <img src="storage/comment.png">
                                                </div>
                                                <form class="form" name="form">
                                                    <div class="form-row">
                                                        <textarea class="input" placeholder="Add comment..." required v-model="message"></textarea>
                                                        <span class="input" v-if="errorReply" style="color:red">{{errorReply}}</span>
                                                    </div>
                                                    <div class="form-row">
                                                        <input class="input" placeholder="Email" type="text" :value="user.name">
                                                    </div>
                                                    <div class="form-row">
                                                        <input type="button" class="btn btn-success" v-on:click="replyComment(comment.commentid,index)" value="Add Comment">
                                                    </div>
                                                </form>
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
            comments : []
        }
    },
    props: [

    ],

    methods: {

    }
}
</script>
