<template>
    <div class="flex w-full justify-between flex-row">
        <jet-nav-link class="h-8 flex" :href="route('post',{post_slug: post.slug})" :active="$page.currentRouteName == 'post'">
            {{post.title}} ({{post.city.name}})
        </jet-nav-link>
        <div class="flex flex-row">
            <p classe="flex">{{configDateTime(post.created_at)}}</p>
            <button @click="Modify()" classe="flex">modifier</button>
            <button @click="Delete()" classe="flex">supprimer</button>
        </div>
        <jet-dialog-modal :show="this.ConfirmDeletion" @close="ConfirmDeletion = false">
                <template #title>
                    Delete post
                </template>

                <template #content>
                    Are you sure you want to delete this post? Once it is deleted, all of its resources and data will be permanently deleted.
                </template>

                <template #footer>
                    <jet-secondary-button @click.native="ConfirmDeletion = false">
                        Nevermind
                    </jet-secondary-button>

                    <jet-danger-button class="ml-2" @click.native="deletePost" :class="{ 'opacity-25': delPost.processing }" :disabled="delPost.processing">
                        Delete Post
                    </jet-danger-button>
                </template>
            </jet-dialog-modal>
    </div>
</template>

<script>
    import JetNavLink from './../Jetstream/NavLink'
    import JetDialogModal from './../Jetstream/DialogModal'
    import JetDangerButton from './../Jetstream/DangerButton'
    import JetSecondaryButton from './../Jetstream/SecondaryButton'


    export default {
        components: {
            JetNavLink,
            JetDialogModal,
            JetSecondaryButton,
            JetDangerButton
        },
        props: ['post'],

        data () {
            return {
                ConfirmDeletion:false,

                delPost: this.$inertia.form({
                    '_method': 'DELETE',
                    target_post: this.post,
                },{
                    bag: 'deletePost'
                })
            }
        },

        methods:{
            Modify(){
                this.$inertia.visit(route('updatepost',{post_slug : this.post.slug}))
            },
            Delete(){
                this.ConfirmDeletion = true
            },
            deletePost(){
                this.delPost.post(route('destroy_post'), {
                    preserveScroll: true
                }).then(response => {
                    if (! this.delPost.hasErrors()) {
                        this.ConfirmDeletion = false;
                    }
                })
            },
            configDateTime(date) {
                return this.$moment(date).startOf('second').locale('fr').fromNow()
            },
        },
    }
</script>
