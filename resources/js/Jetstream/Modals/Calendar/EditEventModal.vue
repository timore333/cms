<template>
    <modal
            :adaptive="true"
            :resizable="false"
            :scrollable="true"
            @before-open="beforeOpen"
            height='auto'
            name="edit-event-modal"

    >
        <div class="card border-info" style="width:100%;height:100%;margin:0">
            <div class="card-header bg-info">
                <h4 class="m-b-0 text-white">{{$__('general.edit')}} {{$__('general.appointment')}}<a @click="hide()" class="pull-right text-white" href="#">X</a></h4>
            </div>

            <div class="card-body">
                <div class="row m-t-20">
                    <div class="col-6">
                        <button :disabled="newPatient" @click="isNew(true)" class="btn btn-block btn-outline-success">
                            {{$__('general.new_patient')}}
                        </button>
                    </div>
                    <div class="col-6">
                        <button :disabled="!newPatient" @click="isNew(false)" class="btn btn-block btn-outline-success">
                            {{$__('general.old_patient')}}
                        </button>
                    </div>


                </div>
                <form class="form-material m-t-40 row">

                    <template v-if="!this.newPatient">
                        <div :class="{'has-danger':this.errors.patient}" class="form-group col-md-6 m-t-20">
                            <label>{{$__('general.select')}} {{$__('general.patient')}}</label>
                            <select @change="reset('patient')" class="form-control " id="patient" name=""
                                    v-model="patient.patient">
                                <option :value="{id:index, name:val}" v-for="(val, index)  in patients">{{val}}</option>
                            </select>

                            <label class="form-control-label" for="patient" v-if="this.errors.patient">{{$__('messages.invalid_name')}}</label>
                        </div>

                    </template>
                    <template v-if="this.newPatient">
                        <div :class="{'has-danger':this.errors.patient}" class="form-group col-md-6 m-t-20">
                            <label>{{$__('general.patient_name')}} </label>
                            <input
                                    :class="{'form-control-danger':this.errors.patient}"
                                    @blur="validate('patient')"
                                    class="form-control "
                                    id="patientName"
                                    type="text"
                                    v-model="patient.patient"
                            >

                            <label class="form-control-label" for="patientName" v-if="this.errors.patient">{{$__('messages.invalid_name')}}</label>
                        </div>

                        <div :class="{'has-danger':this.errors.phone}" class="form-group col-md-6 m-t-20">
                            <label>{{$__('general.patient')}} {{$__('general.phone')}}</label>
                            <input
                                    :class="{'form-control-danger':this.errors.phone}"
                                    @blur="validatePhone()"
                                    class="form-control "
                                    id="phone"
                                    type="text"
                                    v-model="patient.phone"
                            >
                            <label class="form-control-label" for="phone" v-if="this.errors.phone">{{$__('messages.invalid_phone')}}</label>
                        </div>

                    </template>
                    <div :class="{'has-danger':this.errors.doctor}" class="form-group col-md-6 m-t-20">
                        <label>Doctor</label>
                        <select
                                :class="{'form-control-danger':this.errors.doctor}"
                                @change="reset('doctor')"
                                class="form-control"
                                id="doctor"
                                v-model="doctor"
                        >
                            <template v-for="(val, index)  in doctors">
                                <option :value="{id:index,name:val}" v-if="val">{{val}}</option>
                            </template>

                        </select>
                        <label class="form-control-label" for="doctor" v-if="this.errors.doctor">{{$__('general.select')}} {{$__('general.doctor')}}</label>
                    </div>

                    <div :class="{'has-danger':this.errors.color}" class="form-group col-md-6 m-t-20">
                        <label>{{$__('general.color')}}</label>
                        <select :class="{'form-control-danger':this.errors.phone}" @change="reset('color')" class="form-control"
                                id="color" v-model="color">
                            <option :style="{color:color.value}" :value="color.value" v-for="color in colors">{{color.color}}</option>

                        </select>
                        <label class="form-control-label" for="color" v-if="this.errors.color">{{$__('general.select')}} {{$__('general.color')}}</label>
                    </div>

                    <div class="form-group col-md-6 m-t-20">
                        <button :disabled="!canSubmit" @click.prevent="saveEvent" class="btn btn-info">{{$__('general.save')}}</button>
                    </div>

                </form>
            </div>
        </div>

    </modal>
</template>

<script>

    export default {

        // /////////////////////

        data() {
            return {
                eventId: '',
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
                },

                colors: [
                    {color: 'yellow', value: '#BCD132'},
                    {color: 'red', value: '#9d3133'},
                    {color: 'violet', value: '#800080'},
                    {color: 'teal', value: '#468499'},
                    {color: 'blue', value: '#00ddff'},
                    {color: 'green', value: '#00a86b'},
                ],
                patients: '',
                doctors: [],
            }
        },

        // //////////////////////

        methods: {

            show() {
                this.$modal.show('edit-event-modal');
            },
            hide() {
                this.$modal.hide('edit-event-modal');
            },

            beforeOpen(event) {
                this.reset();
                let obj = event.params.event.event;
                this.eventId = obj.id;
                this.start = obj.start.toString();
                this.end = obj.end.toString();
                this.doctor = obj.extendedProps.doctor;
                this.patient = obj.extendedProps.patient;
                this.color = obj.backgroundColor;
                this.allDay = obj.allDay;
                this.newPatient = this.patient.isNew;
                _.forEach(event.params.doctors, (value) => {
                    this.doctors.push(value);
                });
                this.patients= event.params.patients;
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

            updateEvent() {
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
                    this.doctors = [];
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
            event() {
                return {
                    id: this.eventId,
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