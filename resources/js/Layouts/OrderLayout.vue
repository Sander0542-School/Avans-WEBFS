<template>
    <home-layout>
        <div class="row">
            <div class="col">
                <slot/>
            </div>
            <div class="col col-md-4 col-lg-3">

            </div>
        </div>
    </home-layout>
</template>

<script>
import HomeLayout from '@/Layouts/HomeLayout';

export default {
    components: {
        HomeLayout
    }
}
</script>
