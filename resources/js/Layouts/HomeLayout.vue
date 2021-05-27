<template>
    <div class="home-layout">
        <div class="layout-grid">
            <div class="header">
                <div class="row m-0">
                    <div class="col text-center d-none d-lg-block">
                        <img class="header-dragon" src="/pictures/dragon-small.png" alt="Golden Dragon">
                        <span class="header-title">De Gouden Draak</span>
                        <img class="header-dragon transform-vert" src="/pictures/dragon-small.png" alt="Golden Dragon">
                    </div>
                    <div class="col col-lg-4 col-xl-5">
                        <inertia-link :href="route('home.discounts')" class="h-100">
                            <div class="marquee">
                                <span class="track">{{ $t('layout.discount') }}</span>
                            </div>
                        </inertia-link>
                    </div>
                    <div class="col text-center d-none d-lg-block">
                        <img class="header-dragon" src="/pictures/dragon-small.png" alt="Golden Dragon">
                        <span class="header-title">De Gouden Draak</span>
                        <img class="header-dragon transform-vert" src="/pictures/dragon-small.png" alt="Golden Dragon">
                    </div>
                </div>
            </div>

            <div class="cell left top"/>
            <div class="cell right top"/>
            <div class="cell right"/>
            <div class="cell top"/>
            <div class="cell left"/>
            <div class="cell left top"/>
            <div class="cell right top"/>

            <div class="cell left bottom"/>
            <div class="cell all"/>
            <div class="cell top bottom right"/>
            <div class="cell top"/>
            <div class="cell top bottom left"/>
            <div class="cell all"/>
            <div class="cell right bottom"/>

            <div class="cell bottom"/>
            <div class="cell right bottom left"/>
            <div class="cell"/>
            <div class="cell"/>
            <div class="cell"/>
            <div class="cell right bottom left"/>
            <div class="cell bottom"/>

            <div class="cell left"/>
            <div class="cell left"/>
            <div class="cell"/>
            <div class="cell page-content">
                <div class="row content-header">
                    <img class="content-dragon float-left d-none d-md-block" src="/pictures/dragon-small.png" alt="GoudenDraak"/>
                    <div class="col">
                        <div class="my-4 text-center">
                            <h2>Chinees Indische Specialiteiten</h2>
                            <h1>De Gouden Draak</h1>
                            <inertia-link class="btn gd-navigation" :href="route('home.menu')">Menu</inertia-link>
                            <inertia-link class="btn gd-navigation" :href="route('home.news')">News</inertia-link>
                            <inertia-link class="btn gd-navigation" :href="route('home.contact')">Contact</inertia-link>
                            <inertia-link class="btn gd-navigation" :href="route('order.index')">Order</inertia-link>
                        </div>
                    </div>
                    <img class="content-dragon float-right d-none d-md-block transform-vert" src="/pictures/dragon-small.png" alt="GoudenDraak"/>
                </div>
                <slot></slot>
                <div class="content-footer">
                    <div class="languages text-center">
                        <span class="c-pointer mx-2" v-for="locale in $i18n.availableLocales" @click="changeLocale(locale)">{{ $t(`locale.${locale}`) }}</span>
                    </div>
                </div>
            </div>
            <div class="cell"/>
            <div class="cell right"/>
            <div class="cell right"/>

            <div class="cell top"/>
            <div class="cell right top left"/>
            <div class="cell"/>
            <div class="cell"/>
            <div class="cell"/>
            <div class="cell right top left"/>
            <div class="cell top"/>

            <div class="cell left top"/>
            <div class="cell all"/>
            <div class="cell top bottom right"/>
            <div class="cell bottom"/>
            <div class="cell top bottom left"/>
            <div class="cell all"/>
            <div class="cell right top"/>

            <div class="cell left bottom"/>
            <div class="cell right bottom"/>
            <div class="cell right"/>
            <div class="cell bottom"/>
            <div class="cell left"/>
            <div class="cell left bottom"/>
            <div class="cell right bottom"/>
        </div>
    </div>
</template>

<script>
import {setI18nLanguage} from '../i18n';

export default {
    name: "HomeLayout",
    methods: {
        changeLocale(locale) {
            setI18nLanguage(this.$i18n, locale);
        }
    }
}
</script>

<style scoped>

</style>
