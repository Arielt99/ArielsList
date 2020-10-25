<template>
    <div>
        <jet-nav-link :href="route('post',{post_slug: post.slug})" :active="$page.currentRouteName == 'post'">
            {{post.title}}
        </jet-nav-link>
    </div>
</template>

<script>
    import JetNavLink from './../Jetstream/NavLink'

    export default {
        components: {
            JetNavLink,
        },
        props: ['post'],

        data() {
            return {
            }
        },

        methods: {

        },

        computed: {

        },

        watch:{

        },

        created:function(){

        }

    }
</script>
