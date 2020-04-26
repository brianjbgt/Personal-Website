<template>
    <div style="height: 50px" class="col-12 bg-danger mb-2">
        <div class="text-center text-light pt-2">{{message}}</div>
    </div>
</template>

<script>
export default {
    props: {message: String}
}
</script>