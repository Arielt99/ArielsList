<template>
    <div class="flex w-full justify-between flex-row">
        <jet-nav-link class="h-8 flex" :href="route('post',{city_slug : post.city.slug, category_slug : post.category.slug, subcategory_slug : post.subcategory.slug, post_slug: post.slug})" :active="$page.currentRouteName == 'post'">
            {{post.title}} ({{post.city.name}}) ({{ post.isActive ?  'Active':'Innactive'}})
        </jet-nav-link>
        <div class="flex flex-row">
            <p id="date" classe="flex content-center self-center">{{configDateTime(post.created_at)}}</p>
            <button id="modify" @click="Modify()" class="inline-flex items-center px-3 py-1 my-2 mx-1 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:shadow-outline-gray transition ease-in-out duration-150">modifier</button>
            <button @click="Delete()" class="inline-flex items-center px-3 py-1 my-2 mx-1 bg-red-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-red-500 focus:outline-none focus:border-red-700 focus:shadow-outline-red active:bg-red-600 transition ease-in-out duration-150">supprimer</button>
        </div>
        <jet-dialog-modal :show="this.ConfirmDeletion" @close="this.ConfirmDeletion = false">
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
<style>
#date{
    padding-top: 8px;
}
</style>
