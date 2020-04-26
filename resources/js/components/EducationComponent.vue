<template>
    <div class="container">
        <h1>Educational Background</h1>
        <hr>
        
        <div class="d-flex flex-row"><div class="p-2"><button v-on:click="onAddEducationClick" class="btn btn-primary"><i class="fas fa-plus"></i> New Educational Background</button></div></div>
         <transition name="custom-classes-transition" enter-active-class="animated slideInLeft" leave-active-class="animated slideOutRight" mode="out-in">
            <div key=1 v-if="!isCreate">
                <div class="row" v-for="(educationalBackground, index) in educationalBackgrounds" v-bind:key="educationalBackground.id">
                    <div class="container card form-group">
                        <div class="card-body">
                            <div class="row mb-2">
                                <h5 class="col-4">Educational Institution:</h5>
                                <div v-show="!educationalBackground.isEditable" class="col-6 card-text">{{educationalBackground.institution}}</div>
                                <div v-show="educationalBackground.isEditable" class="form-group col-6">
                                    <input v-model="educationalBackground.institution" type="text" class="form-control" id="Institution" v-bind:class="{ 'border-danger': educationalBackground.error.institution.hasError}">
                                    <div v-if="educationalBackground.error.institution.hasError" class="text-danger"><i class="fas fa-exclamation-triangle"></i> {{educationalBackground.error.institution.message}}</div>
                                </div>
                            </div>
                            <div class="row mb-2">
                                <h5 class="col-4">Address:</h5>
                                <div v-show="!educationalBackground.isEditable" class="col-6 card-text">{{educationalBackground.address}}</div>
                                <div v-show="educationalBackground.isEditable" class="form-group col-6">
                                    <input v-model="educationalBackground.address" type="text" class="form-control" id="Address" v-bind:class="{ 'border-danger': educationalBackground.error.address.hasError}">
                                    <div v-if="educationalBackground.error.address.hasError" class="text-danger"><i class="fas fa-exclamation-triangle"></i> {{educationalBackground.error.address.message}}</div>
                                </div>
                            </div>
                            <div class="row mb-2">
                                <h5 class="col-4">Program:</h5>
                                <div v-show="!educationalBackground.isEditable" class="col-6 card-text">{{educationalBackground.program}}</div>
                                <div v-show="educationalBackground.isEditable" class="form-group col-6">
                                    <input v-model="educationalBackground.program" type="text" class="form-control" id="Program" v-bind:class="{ 'border-danger': educationalBackground.error.program.hasError}">
                                    <div v-if="educationalBackground.error.program.hasError" class="text-danger"><i class="fas fa-exclamation-triangle"></i> {{educationalBackground.error.program.message}}</div>
                                </div>
                            </div>
                            <div class="row mb-2">
                                <h5 class="col-4">Period:</h5>
                                <div v-show="!educationalBackground.isEditable" class="col-6 card-text">{{educationalBackground.period}}</div>
                                <div v-show="educationalBackground.isEditable" class="form-group col-6">
                                    <input v-model="educationalBackground.period" type="text" class="form-control" id="Period" v-bind:class="{ 'border-danger': educationalBackground.error.period.hasError}">
                                    <div v-if="educationalBackground.error.period.hasError" class="text-danger"><i class="fas fa-exclamation-triangle"></i> {{educationalBackground.error.period.message}}</div>
                                </div>
                            </div>
                            <div class="row mb-2">
                                <h5 class="col-4">Achievements:</h5>
                                <div v-show="!educationalBackground.isEditable" class="col-6 card-text">{{educationalBackground.achievement}}</div>
                                <textarea class="col-6" v-show="educationalBackground.isEditable" v-model="educationalBackground.achievement" id="Achiements" rows="3" v-bind:class="{ 'border-danger': educationalBackground.error.achievement.hasError}"></textarea>
                                <div v-if="educationalBackground.error.achievement.hasError" class="text-danger"><i class="fas fa-exclamation-triangle"></i> {{educationalBackground.error.achievement.message}}</div>
                            </div>

                            <error-message-box v-if="educationalBackground.isEditable && educationalBackground.error.hasOtherError" v-bind:message="educationalBackground.error.message"></error-message-box>
                            <div v-show="!educationalBackground.isEditable" class="float-right">
                                <button class="btn btn-outline-secondary" v-on:click="onEditEducationClick(index, educationalBackground)"><i class="far fa-edit"></i> Edit</button>
                                <button class="btn btn-outline-danger" v-on:click="onDeleteEducationClick(educationalBackground)"><i class="far fa-trash-alt"></i> Delete</button>
                            </div>
                            <div v-show="educationalBackground.isEditable" class="float-right">
                                <button class="btn btn-outline-success" v-on:click="updateEducation(index, educationalBackground)"><i class="far fa-save"></i> Save Changes</button>
                                <button class="btn btn-outline-danger" v-on:click="onCancelEducationClick(index, educationalBackground)"><i class="fas fa-times"></i> Cancel</button>
                            </div>
                        </div>
                        
                    </div>
                </div>
            </div>
         
            <div key=2 v-else class="row">
                <form onsubmit="return false">
                    <div class="container card form-group">
                        <div class="card-body">
                            <div class="form-row">
                                    <!-- <div class="form-group col-6">
                                        <label for="Title">Title</label>
                                        <input v-model="newEducation.title" type="text" class="form-control" v-bind:class="{ 'border-danger': error.title.hasError}" id="Title">
                                        <div v-if="error.title.hasError" class="text-danger"><i class="fas fa-exclamation-triangle"></i> {{error.title.message}}</div>
                                    </div> -->

                                    <div class="col-6 form-group">
                                        <label for="Institution">Institution</label>
                                        <input v-model="newEducation.institution" type="text" class="form-control" id="Institution" v-bind:class="{ 'border-danger': error.institution.hasError}">
                                        <div v-if="error.institution.hasError" class="text-danger"><i class="fas fa-exclamation-triangle"></i> {{error.institution.message}}</div>
                                    </div>

                                    <div class="col-6 form-group">
                                        <label for="Address">Address</label>
                                        <input v-model="newEducation.address" type="text" class="form-control" id="Program" v-bind:class="{ 'border-danger': error.address.hasError}">
                                        <div v-if="error.address.hasError" class="text-danger"><i class="fas fa-exclamation-triangle"></i> {{error.address.message}}</div>
                                    </div>

                                    <div class="col-6 form-group">
                                        <label for="Program">Program</label>
                                        <input v-model="newEducation.program" type="text" class="form-control" id="Program" v-bind:class="{ 'border-danger': error.program.hasError}">
                                        <div v-if="error.program.hasError" class="text-danger"><i class="fas fa-exclamation-triangle"></i> {{error.program.message}}</div>
                                    </div>

                                    <div class="col-6 form-group">
                                        <label for="Period">Period</label>
                                        <input v-model="newEducation.period" type="text" class="form-control" id="Period" v-bind:class="{ 'border-danger': error.period.hasError}">
                                        <div v-if="error.period.hasError" class="text-danger"><i class="fas fa-exclamation-triangle"></i> {{error.period.message}}</div>
                                    </div>

                                <div class="col-12 form-group">
                                    <label for="Achievements">Achievements</label>
                                   <textarea v-model="newEducation.achievement" class="form-control" id="Achievement" rows="3" v-bind:class="{ 'border-danger ': error.achievement.hasError}"></textarea>
                                   <div v-if="error.achievement.hasError" class="text-danger"><i class="fas fa-exclamation-triangle"></i> {{error.achievement.message}}</div>
                                </div>
                                
                               
                            </div>
                            <error-message-box v-if="error.hasOtherError" v-bind:message="error.message"></error-message-box>
                            <div class="float-right">
                                <button v-on:click="saveEducationClick" class="btn btn-outline-success">Save</button>
                                <button v-on:click="isCreate = false" class="btn btn-outline-danger">Cancel</button>
                            </div>
                        </div>
                    </div>
                </form>
                </div>
         </transition>
   
        <modal v-bind="modalModel" v-if="showModal" @close="showModal = false"></modal>
        <notification-box v-bind="notificationBoxModel" v-if="showNotification" v-on:close-notification="closeNotification"></notification-box>
    </div>
</template>

<script>
import educationService from '../services/educationService'
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
                educationalBackgrounds: [],
                isCreate: false,
                newEducation: {},
                toBeDeletedEducation: null,
                error: {
                    // title:{ hasError: false, message:undefined},
                    institution:{ hasError: false, message:undefined},
                    address:{ hasError: false, message:undefined},
                    program:{ hasError: false, message:undefined},
                    period:{ hasError: false, message:undefined},
                    achievement:{ hasError: false, message:undefined},
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
                    institution:{ hasError: false, message:undefined},
                    address:{ hasError: false, message:undefined},
                    program:{ hasError: false, message:undefined},
                    period:{ hasError: false, message:undefined},
                    achievement:{ hasError: false, message:undefined},
                    hasOtherError: false,
                    message: ""
                }
        },
        populateData(id) {
            var vm = this;
            this.educationService.getAllEducation(id).then(function(response){
                var educationalBackgrounds = response.data;
                for(var i = 0; i < educationalBackgrounds.length; i++){
                    educationalBackgrounds[i].error = {
                        // title:{ hasError: false, message:undefined},
                        institution:{ hasError: false, message:undefined},
                        address:{ hasError: false, message:undefined},
                        program:{ hasError: false, message:undefined},
                        period:{ hasError: false, message:undefined},
                        achievement:{ hasError: false, message:undefined},
                    }
                }

                vm.educationalBackgrounds = educationalBackgrounds;
            });
        },
        onAddEducationClick(){
            this.isCreate = true;
            this.newEducation = {
                // title: "",
                institution:"",
                address: "",
                program: "",
                period: "",
                achievement: ""
            }
            this.cleanError();
        },
        saveEducationClick(){
            var vm = this;
            vm.educationService.saveEducation(vm.id, vm.newEducation)
            .then(function(){
                vm.cleanError();
                vm.populateData(vm.id);
                vm.isCreate = false;
                vm.notificationBoxModel = {
                    notificationTitle: "Success!",
                    notificationDescription: "Successfully Added a New Educational Background",
                    classObject : {'bg-success': true, 'text-light': true}
                };
                vm.showNotification = true;

            })
            .catch(function(error){
                if(error.response.data.errors){
                    var errors = error.response.data.errors;
                    // vm.error.title = vm.utils.hasInputError("title", errors)
                    vm.error.institution = vm.utils.hasInputError("institution", errors)
                    vm.error.address = vm.utils.hasInputError("address", errors)
                    vm.error.program = vm.utils.hasInputError("program", errors)
                    vm.error.period = vm.utils.hasInputError("period", errors)
                    vm.error.achievement = vm.utils.hasInputError("achievement", errors)
                } else{
                   vm.error.hasOtherError = true;
                   vm.error.message = "Something went wrong, please try again later or contact the administrator if problem persists.";
                }
                
            });

        },
        onEditEducationClick(index, educationalBackground){
            //Add a Cache
            educationalBackground.editingCache = Object.assign({}, educationalBackground);
            educationalBackground.isEditable = true;
            
            Vue.set(this.educationalBackgrounds, index, educationalBackground);
        },
        onCancelEducationClick(index, educationalBackground){
                //Revert then remove
                Object.assign(educationalBackground, educationalBackground.editingCache);
                educationalBackground.editingCache = null;
                educationalBackground.isEditable = false;

                Vue.set(this.educationalBackgrounds, index, educationalBackground);
        },
        updateEducation(index, educationalBackground){
            var vm = this;
            vm.educationService.updateEducation(educationalBackground.id, educationalBackground)
            .then(function(response){
                educationalBackground.editingCache = null;
                educationalBackground.isEditable = false;

                vm.notificationBoxModel = {
                    notificationTitle: "Success!",
                    notificationDescription: "Successfully Edited Educational Background: "+educationalBackground.institution,
                    classObject : {'bg-success': true, 'text-light': true}
                };
                vm.showNotification = true;
            })
            .catch(function(error){
                var errors = error.response.data.errors;
                if(errors){
                    educationalBackground.error = {};
                    // educationalBackground.error.title = vm.utils.hasInputError("title", errors)
                    educationalBackground.error.institution = vm.utils.hasInputError("institution", errors)
                    educationalBackground.error.address = vm.utils.hasInputError("address", errors)
                    educationalBackground.error.program = vm.utils.hasInputError("program", errors)
                    educationalBackground.error.period = vm.utils.hasInputError("period", errors)
                    educationalBackground.error.achievement = vm.utils.hasInputError("achievement", errors)
                } else{
                    educationalBackground.error.hasOtherError = true;
                    educationalBackground.error.message = "Something went wrong, please try again later or contact the administrator if problem persists"; 
                }


                
            }).finally(function(){
                Vue.set(vm.educationalBackgrounds, index, educationalBackground);
            });
        },
        onDeleteEducationClick(educationalBackground){
           this.toBeDeletedEducation = educationalBackground.id;
           this.modalModel = {
                    sendRequestToServer: this.deleteEducation,
                    messageToUser: "Are you sure you want to Delete this entry?",
                    primaryButtonMessage: "Yes",
                    secondaryButtonMessage: "No",
                    modalTitle: "Deleting: "+educationalBackground.institution,
                    modalAPIResponse: { message: "" , isSuccess: false , isAvailable: false}
                };
            this.showModal = true;
            
        },
        deleteEducation(){
            if(this.toBeDeletedEducation){
                var vm = this;

                vm.educationService.deleteEducation(vm.toBeDeletedEducation)
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
        this.educationService = educationService();
        this.utils = utils();
        this.populateData(this.id)
    },
    cleanError(){
            this.error = {
                // title:{ hasError: false, message:undefined},
                institution:{ hasError: false, message:undefined},
                address:{ hasError: false, message:undefined},
                program:{ hasError: false, message:undefined},
                period:{ hasError: false, message:undefined},
                achievement:{ hasError: false, message:undefined},
            }
    }

}
</script>