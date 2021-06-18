<template>
    <nav>
        <ul class="pagination justify-content-center">
            <li v-for="link in links" class="page-item" :class="{'active': link.active, 'disabled': link.url === null}">
                <inertia-link class="page-link" :href="link.url" v-html="link.label"></inertia-link>
            </li>
        </ul>
    </nav>
</template>

<script>
export default {
    props: {
        links: Array,
    },
}
</script>
