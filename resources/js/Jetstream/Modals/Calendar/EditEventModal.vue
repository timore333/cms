<template>
    <modal
            name="edit-event-modal"
            :adaptive="true"
            :resizable="false"
            :scrollable="true"
            height='auto'
            @before-open="beforeOpen"

    >
        <div class="card border-info" style="width:100%;height:100%;margin:0">
            <div class="card-header bg-info">
                <h4 class="m-b-0 text-white">Edit New Appointment<a href="#" class="pull-right text-white"
                                                                   @click="hide()">X</a></h4>
            </div>

            <div class="card-body">
                <div class="row m-t-20">
                    <div class="col-6">
                        <button :disabled="newPatient" class="btn btn-block btn-outline-success" @click="isNew(true)">
                            New Patient
                        </button>
                    </div>
                    <div class="col-6">
                        <button :disabled="!newPatient" class="btn btn-block btn-outline-success" @click="isNew(false)">
                            Old Patient
                        </button>
                    </div>


                </div>
                <form class="form-material m-t-40 row">

                    <template v-if="!this.newPatient">
                        <div class="form-group col-md-6 m-t-20" :class="{'has-danger':this.errors.patient}">
                            <label>Select Patient</label>
                            <select class="form-control " name="" id="patient" v-model="patient.patient"
                                    @change="reset('patient')">
                                <option :value="patient" v-for="patient in patients">{{patient.name}}</option>
                            </select>

                            <label class="form-control-label" for="patient" v-if="this.errors.patient">patient name is
                                required</label>
                        </div>

                    </template>
                    <template v-if="this.newPatient">
                        <div class="form-group col-md-6 m-t-20" :class="{'has-danger':this.errors.patient}">
                            <label>Patient Name</label>
                            <input
                                    id="patientName"
                                    type="text"
                                    class="form-control "
                                    :class="{'form-control-danger':this.errors.patient}"
                                    v-model="patient.patient"
                                    @blur="validate('patient')"
                            >

                            <label class="form-control-label" for="patientName" v-if="this.errors.patient">patient name
                                is
                                required</label>
                        </div>

                        <div class="form-group col-md-6 m-t-20" :class="{'has-danger':this.errors.phone}">
                            <label>Patient Phone</label>
                            <input
                                    id="phone"
                                    type="text"
                                    class="form-control "
                                    :class="{'form-control-danger':this.errors.phone}"
                                    v-model="patient.phone"
                                    @blur="validatePhone()"
                            >
                            <label class="form-control-label" for="phone" v-if="this.errors.phone">phone number is
                                invalid</label>
                        </div>

                    </template>
                    <div class="form-group col-md-6 m-t-20" :class="{'has-danger':this.errors.doctor}">
                        <label>Doctor</label>
                        <select
                                class="form-control"
                                :class="{'form-control-danger':this.errors.doctor}"
                                v-model="doctor"
                                id="doctor"
                                @change="reset('doctor')"
                        >
                            <template v-for="doctor in doctors">
                                <option v-if="doctor.name" :value="doctor">{{doctor.name}}</option>
                            </template>

                        </select>
                        <label class="form-control-label" for="doctor" v-if="this.errors.doctor">Please Slect
                            doctor </label>
                    </div>

                    <div class="form-group col-md-6 m-t-20" :class="{'has-danger':this.errors.color}">
                        <label>Color</label>
                        <select id="color" class="form-control" v-model="color"
                                :class="{'form-control-danger':this.errors.phone}" @change="reset('color')">
                            <option v-for="color in colors" :value="color.value" :style="{color:color.value}">{{color.color}}</option>

                        </select>
                        <label class="form-control-label" for="color" v-if="this.errors.color">Please Slect
                            color </label>
                    </div>

                    <div class="form-group col-md-6 m-t-20">
                        <button class="btn btn-info" :disabled="!canSubmit" @click.prevent="saveEvent">Save</button>
                    </div>

                </form>
            </div>
        </div>

    </modal>
</template>

<script>
    import {mapGetters, mapActions} from 'Vuex'

    export default {

        // /////////////////////

        data() {
            return {
                eventId:'',
                newPatient: true,
                start: '',
                end: '',
                doctor: '',
                patient: {
                    patient: '',
                    phone: '',
                    isNew: '',
                },
                color: '',
                allDay: '',
                errors: {
                    phone: false,
                    patient: false,
                    doctor: false,
                    color: false
                }
            }
        },

        // //////////////////////

        methods: {
            ...mapActions(['updateEvent']),

            show() {
                this.$modal.show('edit-event-modal');
            },
            hide() {
                this.$modal.hide('edit-event-modal');
            },

            beforeOpen(event) {
                let obj = event.params.event;
                this.eventId = obj.id;
                this.start = obj.start.toString();
                this.end = obj.end.toString();
                this.doctor = obj.extendedProps.doctor;
                this.patient = obj.extendedProps.patient;
                this.color = obj.backgroundColor;
                this.allDay = obj.allDay;
                this.newPatient = this.patient.isNew;
            },

            validatePhone() {
                this.errors.phone = !this.patient.phone.match(/^\d{11}$/);
                if (this.errors.phone) {
                    this.patient.phone = '';
                }
            },

            validate(key) {
                this.errors[key] = !this.patient[key];
            },

            isNew(key) {
                this.newPatient = key;
                this.doctor = '';
                this.patient = {
                    patient: '',
                    phone: '',
                    isNew: this.newPatient,
                };
                this.phone = '';
                this.color = '';
                this.errors = {
                    phone: false,
                    patient: false,
                    doctor: false,
                    color: false
                }
            },

            reset(key = null) {
                if (key !== null) {
                    this.errors[key] = false
                } else {
                    this.start = '';
                    this.end = '';
                    this.doctor = '';
                    this.patient = {
                        patient: '',
                        phone: '',
                        isNew: '',
                    };
                    this.phone = '';
                    this.color = '';
                    this.allDay = '';
                    this.errors = {
                        phone: false,
                        patient: false,
                        doctor: false,
                        color: false
                    }
                }
            },

            saveEvent() {
                if (!this.doctor) {
                    this.errors.doctor = true;
                    return false
                }

                if (!this.color) {
                    this.errors.color = true;
                    return false
                }
                if (!this.patient.patient) {
                    this.errors.patient = true;
                    return false
                }
                this.updateEvent(this.event);
                this.hide();
                // window.location.reload()
            },
        },

        // //////////////////////

        computed: {
            ...mapGetters(['doctors', 'patients','colors']),
            event() {
                return {
                    id:this.eventId,
                    start: this.start,
                    end: this.end,
                    doctor: this.doctor,
                    patient: this.patient,
                    color: this.color,
                    allDay: this.allDay
                }
            },

            canSubmit() {
                if (this.errors.phone) return false;
                if (this.newPatient && !this.patient.phone) return false;
                if (this.newPatient && !this.patient.patient) return false;
                if (!this.patient) return false;
                return true;
            },

        },

        // /////////////////////
        mounted() {

        }


    }
</script>