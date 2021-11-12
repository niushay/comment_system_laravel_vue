<template>
    <div class="container" style="margin-top: 3%">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="row">
                    <div class="col-md-2">
                        <img src="images/comment-avatar.png" class="img-rounded" alt="Cinque Terre" style="width: 50%; height: auto;">
                    </div>
                    <div class="col-md-10">
                        <form @submit.prevent="store" @keydown="form.onKeydown($event)">
                            <div class="form-group">
                                <input class="form-control" v-model="form.name" type="text" name="name" placeholder="name">
                                <div v-if="form.errors.has('username')" v-html="form.errors.get('name')"/>
                            </div>

                            <div class="form-group">
                                <textarea class="form-control"  v-model="form.comment" type="text" name="comment" placeholder="Comment"></textarea>
                                <div v-if="form.errors.has('password')" v-html="form.errors.get('password')"/>
                            </div>

                            <button type="submit" :disabled="form.busy" class="btn btn-primary">
                                Save Comment
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    data: () => ({
        form: new Form({
            name: '',
            comment: ''
        }),

    }),

    methods: {
         store(){
            axios.post("/api/store", this.form)
                .then(response => {
                    const toastContainer = document.querySelector('.toast-container')
                    }
                )
                .catch(error => {
                    this.errorMessage = error.message;
                    console.error("There was an error!", error);
                });
        },
        fetchComments() {
            axios.get("/api/fetch_comments").then(res => {
                console.log('this is res', res)
            });

        },

    },
    mounted() {
        this.fetchComments();
    }
}
</script>
