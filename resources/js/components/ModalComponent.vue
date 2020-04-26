<template>
    <transition name="modal">
        <div class="modal-mask">
            <div class="modal-wrapper">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                    <div class="modal-header" v-bind:class="{ 'bg-danger': modalAPIResponse.isAvailable && !modalAPIResponse.isSuccess, 'bg-success':modalAPIResponse.isAvailable && modalAPIResponse.isSuccess}">
                        <h5 v-if="modalAPIResponse.isAvailable" class="text-light">
                           <span v-if="modalAPIResponse.isSuccess">Success</span>
                           <span v-else> Error</span> 
                        </h5>
                        <h5 v-else class="modal-title">{{modalTitle}}</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close" @click="$emit('close')">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <p v-if="modalAPIResponse.isAvailable && modalAPIResponse.message">{{modalAPIResponse.message}}</p>
                        <p v-else>{{messageToUser}}</p>
                    </div>
                    <div class="modal-footer">
                        <div class="container">
                        <div class="row" v-if="modalAPIResponse.isAvailable">
                                <div class="col-12 text-right">
                                    <button type="button" class="btn text-right" v-bind:class="{'btn-danger':'!modalAPIResponse.isSuccess', 'btn-success':'modalAPIResponse.isSuccess'}" @click="$emit('close')">Close</button>
                                </div>
                        </div>
                        <div class="row" v-else>
                            <div class="col-12 text-right">
                                <button type="button" v-on:click = "sendRequestToServer()" class="btn btn-primary">{{primaryButtonMessage}}</button>
                                <button type="button" class="btn btn-secondary" @click="$emit('close')">{{secondaryButtonMessage}}</button>
                            </div>
                        </div>
                        </div>
                        
                    </div>
                    </div>
                </div>
            </div>
        </div>
    </transition>
</template>


<script>
export default {
    props: {sendRequestToServer:Function, messageToUser: String, primaryButtonMessage: String, secondaryButtonMessage: String, modalTitle: String, modalAPIResponse: Object, showModal: Boolean}
}
</script>