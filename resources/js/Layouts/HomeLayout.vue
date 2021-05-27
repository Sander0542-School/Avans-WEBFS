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
                                <span class="track">
                                    Welkom bij De Gouden Draak. Klik op deze tekst om de aanbiedingen van deze week te zien!
                                </span>
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
                        </div>
                    </div>
                    <img class="content-dragon float-right d-none d-md-block transform-vert" src="/pictures/dragon-small.png" alt="GoudenDraak"/>
                </div>
                <slot></slot>
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
export default {
    name: "HomeLayout"
}
</script>

<style scoped>

</style>
