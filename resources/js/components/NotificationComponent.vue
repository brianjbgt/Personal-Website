<template>
        <div class="card notification-box" v-on:click="$emit('close-notification')">
        <div class="card-body" v-bind:class="classObject">
            <h5 class="card-title">{{notificationTitle}}</h5>
            <p class="card-text">{{notificationDescription}}</p>
        </div>
        </div>
</template>


<script>
export default {
    props: {showNotification: Boolean, notificationTitle:String, notificationDescription:String, classObject: Object}
}
</script>