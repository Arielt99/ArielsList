<template>
    <app-layout :current_city="current_city">
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                <jet-nav-link :href="route('home')">
                    {{ current_city ?  ''+current_city.name : 'Cities'}}
                </jet-nav-link>
                <span v-if="current_city">
                    >
                </span>
                <jet-nav-link :href="'#'">
                    Categories
                </jet-nav-link>
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div id="categories" class="flex flex-col flex-wrap p-6 bg-white overflow-hidden shadow-xl sm:rounded-lg">
                    <div id="list" v-for="category in categories" v-bind:key="category.id">
                        <h3 class="h-15 flex text-center flex-wrap justify-center items-center w-max-content text-2xl cursor-pointer font-bold">
                            <jet-nav-link class="h-15 text-2xl cursor-pointer font-bold" :href="route('category',{city_slug : current_city.slug, category_slug : category.slug} )">
                            {{category.name}}
                            </jet-nav-link>
                        </h3>
                        <div id="subcat" class="flex flex-col flex-wrap">
                            <div v-for="subcategory in category.subcategories" v-bind:key="subcategory.id" >
                                <p class="h-8 flex justify-center items-center w-auto cursor-pointer">
                                    <jet-nav-link class="h-8 cursor-pointer" :href="route('subcategory',{city_slug : current_city.slug, category_slug : category.slug, subcategory_slug : subcategory.slug} )">
                                    {{subcategory.name}}
                                    </jet-nav-link>
                                </p>
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
<style>
#categories{
    height: 160vh;
}
#list{
    width: 25vw;
}
#subcat{
    min-height: 0vh;
    max-height: 50vh;
}
</style>
