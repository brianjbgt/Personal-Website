<template>
    <div class="container">
        <hr>
        <div class="d-flex flex-row">
         <transition name="custom-classes-transition" enter-active-class="animated slideInLeft" leave-active-class="animated slideOutRight" mode="out-in">
            <div v-if="!isCreate">
                <div class="row" v-for="(user, index) in users" v-bind:key="user.id">
                    <div class="container card form-group">
                        <div class="card-body">
                                <div class="col-12">
                                    <div class="row">
                                        <div v-show="!user.isEditable" class="col-12 card-text">
                                            <label for="username">Username: </label> 
                                            <div class = "float-right">
                                                {{user.username}}
                                            </div>
                                        </div>
                                        <div v-show="user.isEditable" class="form-group col-12">
                                            <label for="username">Username</label>
                                            <input v-model="user.username" type="text" class="form-control" id="username" v-bind:class="{ 'border-danger': user.error.username.hasError}">
                                            <div v-if="user.error.username.hasError" class="text-danger"><i class="fas fa-exclamation-triangle"></i> {{user.error.username.message}}</div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div v-show="!user.isEditable" class="col-12 card-text">
                                            <label for="email">Email: </label> 
                                            <div class = "float-right">
                                                {{user.email}}
                                            </div>
                                        </div>
                                        <div v-show="user.isEditable" class="form-group col-12">
                                            <label for="email">Email</label>
                                            <input v-model="user.email" type="text" class="form-control" id="email" v-bind:class="{ 'border-danger': user.error.email.hasError}">
                                            <div v-if="user.error.email.hasError" class="text-danger"><i class="fas fa-exclamation-triangle"></i> {{user.error.email.message}}</div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div v-show="!user.isEditable" class="col-12 card-text"><label for="acct_type">Admin: </label> 
                                            <div class = "float-right">
                                                {{user.acct_type}}
                                            </div>
                                        </div>
                                        <div v-show="user.isEditable" class="form-group col-12">
                                            <label for="acctType">Account Type</label>
                                            <div class="btn-group col-1" role="group">
                                                <div class="custom-control custom-radio custom-control-inline"  >
                                                    <input type="radio" v-model="user.acct_type" class="custom-control-input" id="defaultInline1" name="acctType" value="0" @click="disabled = true" checked="checked">
                                                    <label class="custom-control-label" for="defaultInline1">Regular</label>
                                                </div>
                                                <div class="custom-control custom-radio custom-control-inline">
                                                    <input type="radio" v-model="user.acct_type" class="custom-control-input" id="defaultInline2" name="acctType" value="1"  @click="disabled = false">
                                                    <label class="custom-control-label" for="defaultInline2">Admin</label>
                                                </div>
                                            </div>
                                            <input v-model="user.acct_type" type="text" class="form-control" id="acct_type" maxlength="1" v-bind:class="{ 'border-danger': user.error.acct_type.hasError}">
                                        </div>
                                    </div>
                                </div>

                            <error-message-box v-if="user.isEditable && user.error.hasOtherError" v-bind:message="user.error.message"></error-message-box>
                            <div v-show="!user.isEditable" class="float-right">
                                <button class="btn btn-outline-secondary" v-on:click="onEditUserClick(index, user)"><i class="far fa-edit"></i> Edit</button>
                                <button class="btn btn-outline-danger" v-on:click="onDeleteUserClick(user)"><i class="far fa-trash-alt"></i> Delete</button>
                            </div>
                            <div v-show="user.isEditable" class="float-right">
                                <button class="btn btn-outline-success" v-on:click="updateUser(index, user)"><i class="far fa-save"></i> Save Changes</button>
                                <button class="btn btn-outline-danger" v-on:click="onCancelUserClick(index, user)"><i class="fas fa-times"></i> Cancel</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </transition>
        </div>
   
        <modal v-bind="modalModel" v-if="showModal" @close="showModal = false"></modal>
        <notification-box v-bind="notificationBoxModel" v-if="showNotification" v-on:close-notification="closeNotification"></notification-box>
    </div>
</template>

<script>
import userService from '../services/userService'
import modal from './ModalComponent';
import notificationBox from './NotificationComponent';
import utils from '../utils';
import errorMessageBox from './SimpleErrorMessageBoxComponent';

export default {
    props:{id:Number},
    components: {
        'modal': modal,
        'notificationBox': notificationBox,
        'errorMessageBox': errorMessageBox
    },
    data() {
        return {
                modalModel: null,
                showModal: false,
                users: [],
                isCreate: false,
                newUser: {},
                toBeDeletedUser: null,
                error: {
                    // title:{ hasError: false, message:undefined},
                    username:{ hasError: false, message:undefined},
                    email:{ hasError: false, message:undefined},
                    password:{ hasError: false, message:undefined},
                    acct_type:{ hasError: false, message:undefined},
                    hasOtherError: false,
                    message:""
                },
                showNotification: false,
                notificationBoxModel: null
            }
    },
    methods:{
        cleanError(){
                this.error = {
                    // title:{ hasError: false, message:undefined},
                    username:{ hasError: false, message:undefined},
                    email:{ hasError: false, message:undefined},
                    password:{ hasError: false, message:undefined},
                    acct_type:{ hasError: false, message:undefined},
                    hasOtherError: false,
                    message: ""
                }
        },
        populateData() {
            var vm = this;
            this.userService.getAllUser().then(function(response){
                var users = response.data;
                for(var i = 0; i < users.length; i++){
                    users[i].error = {
                        // title:{ hasError: false, message:undefined},
                        username:{ hasError: false, message:undefined},
                        email:{ hasError: false, message:undefined},
                        password:{ hasError: false, message:undefined},
                        acct_type:{ hasError: false, message:undefined},
                    }
                }

                vm.users = users;
            });
        },
        onEditUserClick(index, user){
            //Add a Cache
            user.editingCache = Object.assign({}, user);
            user.isEditable = true;
            
            Vue.set(this.users, index, user);
        },
        onCancelUserClick(index, user){
                //Revert then remove
                Object.assign(user, user.editingCache);
                user.editingCache = null;
                user.isEditable = false;

                Vue.set(this.users, index, user);
        },
        updateUser(index, user){
            var vm = this;
            vm.userService.updateUser(user.id, user)
            .then(function(response){
                user.editingCache = null;
                user.isEditable = false;

                vm.notificationBoxModel = {
                    notificationTitle: "Success!",
                    notificationDescription: "Successfully Edited User: "+user.username,
                    classObject : {'bg-success': true, 'text-light': true}
                };
                vm.showNotification = true;
            })
            .catch(function(error){
                var errors = error.response.data.errors;
                if(errors){
                    user.error = {};
                    // user.error.title = vm.utils.hasInputError("title", errors)
                    user.error.username = vm.utils.hasInputError("username", errors)
                    user.error.email = vm.utils.hasInputError("email", errors)
                    user.error.password = vm.utils.hasInputError("password", errors)
                    user.error.acct_type = vm.utils.hasInputError("acct_type", errors)
                } else{
                    user.error.hasOtherError = true;
                    user.error.message = "Something went wrong, please try again later or contact the administrator if problem persists"; 
                }
                
            }).finally(function(){
                Vue.set(vm.users, index, user);
            });
        },
        onDeleteUserClick(user){
           this.toBeDeletedUser = user.id;
           this.modalModel = {
                    sendRequestToServer: this.deleteUser,
                    messageToUser: "Are you sure you want to Delete this entry?",
                    primaryButtonMessage: "Yes",
                    secondaryButtonMessage: "No",
                    modalTitle: "Deleting: "+user.username,
                    modalAPIResponse: { message: "" , isSuccess: false , isAvailable: false}
                };
            this.showModal = true;
            
        },
        deleteUser(){
            if(this.toBeDeletedUser){
                var vm = this;

                vm.userService.deleteUser(vm.toBeDeletedUser)
                .then(function(response){
                    vm.modalModel.modalAPIResponse = {
                        message: response.data.message,
                        isSuccess: true,
                        isAvailable: true
                    };

                    vm.populateData(vm.id);
                })
                .catch(function(response){
                    vm.modalModel.modalAPIResponse = {
                        isSuccess: false,
                        isAvailable: true
                    };

                    switch(response.response.status){
                        case 404:
                        vm.modalModel.modalAPIResponse.message = "Entry not found";
                        break;
                        case 500:
                        vm.modalModel.modalAPIResponse.message = "Something went wrong, please try again later or contact the administrator if problem persists.";
                        break;
                        default:
                        vm.modalModel.modalAPIResponse.message = response.response.data.message;
                        break;
                    }
                });

                
            }
            
        },
        closeNotification() {
            this.showNotification = false;
            this.notificationBoxModel = {
                notificationTitle: "",
                notificationDescription: "",
                classObject : {}
            };
        }
    },
    created() {
        this.userService = userService();
        this.utils = utils();
        this.populateData()
    },
    cleanError(){
            this.error = {
                // title:{ hasError: false, message:undefined},
                username:{ hasError: false, message:undefined},
                email:{ hasError: false, message:undefined},
                password:{ hasError: false, message:undefined},
                acct_type:{ hasError: false, message:undefined},
            }
    }

}
</script>