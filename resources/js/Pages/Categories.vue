<template>
    <app-layout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                <jet-nav-link :href="route('home')" :active="$page.currentRouteName == 'home'">
                    Cities
                </jet-nav-link>
                <p v-if="current_city">{{current_city.name}}</p>
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl x-auto sm:px-6 lg:px-8">
                <div class="flex flex-col p-6 bg-white overflow-hidden shadow-xl sm:rounded-lg">
                    <div v-for="category in categories" v-bind:key="category.id">
                        <h3 class="h-15 flex text-center justify-center items-center w-max-content text-2xl cursor-pointer font-bold">{{category.name}}</h3>
                        <div class="grid grid-cols-2 ">
                            <div v-for="subcategory in category.subcategories" v-bind:key="subcategory.id" >
                                <p class="h-8 flex justify-center items-center w-auto cursor-pointer">{{subcategory.name}}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </app-layout>
</template>

<script>
    import AppLayout from './../Layouts/AppLayout'
    import JetNavLink from './../Jetstream/NavLink'

    export default {
        components: {
            AppLayout,
            JetNavLink,
        },

        props: ['categories','current_city'],
    }
</script>
