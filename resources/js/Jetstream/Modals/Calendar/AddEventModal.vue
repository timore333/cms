<template>
    <modal
            name="add-event-modal"
            :adaptive="true"
            :resizable="false"
            :draggable = 'true'
            :scrollable="true"
            height='auto'
            @before-open="beforeOpen"

    >
        <div class="card border-info" style="width:100%;height:100%;margin:0">
            <div class="card-header bg-info">
                <h4 class="m-b-0 text-white">{{ trans.get('general.new_appointment') }}<a href="#" class="pull-right text-white"
                                                                   @click="hide()">X</a></h4>
            </div>

            <div class="card-body">
                <div class="row m-t-20">
                    <div class="col-6">
                        <button :disabled="newPatient" class="btn btn-block btn-outline-success" @click="isNew(true)">
                            {{ trans.get('general.new_patient') }}
                        </button>
                    </div>
                    <div class="col-6">
                        <button :disabled="!newPatient" class="btn btn-block btn-outline-success" @click="isNew(false)">
                            {{ trans.get('general.old_patient') }}
                        </button>
                    </div>


                </div>
                <form class="form-material m-t-40 row">


                    <template v-if="!this.newPatient">
                        <div class="form-group col-md-6 m-t-20" :class="{'has-danger':this.errors.patient}">
                            <label>{{ trans.get('general.patient') }}</label>
                            <select class="form-control " name="" id="patient" v-model="patient"
                                    @change="reset('patient')">
                                <option :value="patient" v-for="patient in patients">{{patient.name}}</option>
                            </select>

                            <label class="form-control-label" for="patient" v-if="this.errors.patient"> {{ trans.get('messages.invalid_name') }}</label>
                        </div>

                    </template>
                    <template v-if="this.newPatient">
                        <div class="form-group col-md-6 m-t-20" :class="{'has-danger':this.errors.patient}">
                            <label> {{ trans.get('general.patient_name') }}</label>
                            <input
                                    id="patientName"
                                    type="text"
                                    class="form-control "
                                    :class="{'form-control-danger':this.errors.patient}"
                                    v-model="patient"
                                    @blur="validate('patient')"
                            >

                            <label class="form-control-label" for="patientName" v-if="this.errors.patient"> {{ trans.get('messages.invalid_name') }}</label>
                        </div>

                        <div class="form-group col-md-6 m-t-20" :class="{'has-danger':this.errors.phone}">
                            <label> {{ trans.get('general.phone') }}</label>
                            <input
                                    id="phone"
                                    type="text"
                                    class="form-control "
                                    :class="{'form-control-danger':this.errors.phone}"
                                    v-model="phone"
                                    @blur="validatePhone()"
                            >
                            <label class="form-control-label" for="phone" v-if="this.errors.phone"> {{ trans.get('messages.invalid_phone') }}</label>
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
                        <label class="form-control-label" for="doctor" v-if="this.errors.doctor"> {{ trans.get('messages.invalid_doctor') }}</label>
                    </div>

                    <div class="form-group col-md-6 m-t-20" :class="{'has-danger':this.errors.color}">
                        <label>{{ trans.get('general.color') }}</label>
                        <select id="color" class="form-control" v-model="color"
                                :class="{'form-control-danger':this.errors.phone}" @change="reset('color')">
                            <option v-for="color in colors" :value="color.value" :style="{color:color.value}">{{color.color}}</option>
                        </select>
                        <label class="form-control-label" for="color" v-if="this.errors.color">{{ trans.get('messages.invalid_color') }} </label>
                    </div>

                    <div class="form-group col-md-6 m-t-20">
                        <button class="btn btn-info" :disabled="!canSubmit" @click.prevent="saveEvent">{{ trans.get('general.save') }}</button>
                    </div>

                </form>
            </div>
        </div>
    </modal>
</template>

<script>
    import * as moment from 'moment';
    import {mapGetters, mapActions} from 'Vuex'

    export default {

        // /////////////////////

        data() {
            return {
                newPatient: true,
                start: '',
                end: '',
                doctor: '',
                patient: '',
                phone: '',
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
            ...mapActions(['addEvent']),

            show() {
                this.$modal.show('add-event-modal');
            },
            hide() {
                this.$modal.hide('add-event-modal');
            },

            validatePhone() {
                this.errors.phone = !this.phone.match(/^\d{11}$/);
                if (this.errors.phone) {
                    this.phone = '';
                }
            },

            validate(key) {
                this.errors[key] = !this[key];
            },

            beforeOpen(event) {
                this.reset();
                let obj = event.params.event;
                this.start = obj.startStr;
                this.end = obj.endStr;
                this.allDay = obj.allDay;
            },

            isNew($key) {
                this.newPatient = $key;
                this.doctor = '';
                this.patient = '';
                this.phone = '';
                this.color = '';
                this.errors = {
                    phone: false,
                    patient: false,
                    doctor: false,
                    color: false
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
                this.addEvent(this.event);
                this.hide();
                this.reset();
            },

            reset(key = null) {
                if (key !== null) {
                    this.errors[key] = false
                } else {
                    this.start = '';
                    this.end = '';
                    this.doctor = '';
                    this.patient = '';
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
            }

        },

        // //////////////////////

        computed: {
            ...mapGetters(['patients', 'doctors','colors']),
            event() {
                return {
                    start: this.start,
                    end: this.end,
                    doctor: this.doctor,
                    patient: {
                        patient: this.patient,
                        phone: this.phone,
                        isNew: this.newPatient,
                    },
                    color: this.color,
                    allDay: this.allDay
                }
            },

            canSubmit() {
                if (this.errors.phone) return false;
                if (this.newPatient && !this.phone) return false;
                if (!this.patient) return false;
                return true;
            },
        },

        // /////////////////////


    }
</script>