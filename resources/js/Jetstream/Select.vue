<template>
    <select class="form-control" :value="modelValue" @change="$emit('update:modelValue', $event.target.value)" ref="select">
        <slot/>
    </select>
</template>

<script>
export default {
    props: ['modelValue'],
    emits: ['update:modelValue'],
    methods: {
        focus() {
            this.$refs.select.focus()
        }
    }
}
</script>
