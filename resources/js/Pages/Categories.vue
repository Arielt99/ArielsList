<template>
    <app-layout :current_city="current_city">
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                <jet-nav-link :href="route('home')">
                    Home
                </jet-nav-link>
                <span class="inline-flex items-center" v-if="current_city">
                    >
                </span>
                <jet-nav-link :href="route('city', {city_slug : current_city.slug})">
                    {{ current_city ?  ''+current_city.name : 'Cities'}}
                </jet-nav-link>
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div id="categories" class="flex flex-col flex-wrap p-6 bg-white overflow-hidden shadow-xl sm:rounded-lg">
                    <div id="list" v-for="category in categories" v-bind:key="category.id">
                        <category-display :category="category" :current_city="current_city"/>
                    </div>
                </div>
            </div>
        </div>
    </app-layout>
</template>

<script>
    import CategoryDisplay from "./../components/CategoryDisplay"
    import AppLayout from './../Layouts/AppLayout'
    import JetNavLink from './../Jetstream/NavLink'

    export default {
        components: {
            AppLayout,
            JetNavLink,
            CategoryDisplay,
        },

        data() {
            return {
            }
        },

        props: ['categories','current_city'],

        methods: {
        }
    }
</script>
<style>
#categories{
    height: 200vh;
}
#list{
    margin: 0 20px;
}
</style>
