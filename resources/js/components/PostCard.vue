<template>
    <div class="flex w-full justify-between flex-row">
        <jet-nav-link class="h-8 flex" :href="route('post',{city_slug : post.city.slug, category_slug : post.category.slug, subcategory_slug : post.subcategory.slug, post_slug : post.slug})" :active="$page.currentRouteName == 'post'">
            {{post.title}}
        </jet-nav-link>
        <p classe="flex">{{configDateTime(post.created_at)}}</p>
    </div>
</template>

<script>
    import JetNavLink from './../Jetstream/NavLink'

    export default {
        components: {
            JetNavLink,
        },
        props: ['post'],
        methods:{
            configDateTime(date) {
                return this.$moment(date).startOf('second').locale('fr').fromNow()
            },
        },

        computed: {

        },

        watch:{

        },

        created:function(){

        }

    }
</script>
