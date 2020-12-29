<template>
    <modal
            :adaptive="true"
            :draggable="true"
            :resizable="false"
            :scrollable="true"
            @before-open="beforeOpen"
            height='auto'
            name="show-event-modal"
            width='300'
    >

        <div class="card m-0 text-right">
            <div class="card-header bg-info">
                <h4 class="m-b-0 text-white">{{ start}}<a @click="hide()" class="pull-left text-white" href="#">X</a></h4>
            </div>
            <div class="card-body">
                <div class="card-text text-left">
                    <h4  v-if="!patient.isNew"><span class="fa  fa-folder-open-o"></span> &nbsp {{ patientId }}</h4>
                    <h4 ><span class="fa fa-address-card"></span>&nbsp {{ patientName }}</h4>
                    <h4  v-if="patient.isNew"><span class="fa  fa-phone-square"></span> &nbsp{{ phone }}</h4>
                    <h4 ><span class="fa fa-user-md"></span>&nbsp {{ doctor.name }}</h4>
                </div>
                <div class="text-center">
                    <a @click.prevent="editEvent" class="text-success" href="#"><span class="fa fa-pencil-square "></span> {{$__('general.edit')}}</a>
                    <a @click.prevent="deleteEvent" class="text-danger m-l-10" href="#"><span class="fa fa-trash"></span> {{$__('general.delete')}}</a>
                </div>
            </div>
        </div>


    </modal>
</template>

<script>
    import * as moment from 'moment';
    import {trans} from "matice";

    export default {

        // /////////////////////

        data() {
            return {
                start: '',
                doctor: '',
                patient: '',
                patientId: '',
                patientName: '',
                phone: '',
                title: '',
                rawEvent: {}
            }
        },

        // //////////////////////

        methods: {

            show() {
                this.$modal.show('show-event-modal');
            },
            hide() {
                this.$modal.hide('show-event-modal');
            },

            beforeOpen(event) {
                this.rawEvent = event.params.event;
                let obj = event.params.event;
                let patient = obj.extendedProps.patient;
                this.start = moment(obj.start).format('llll');
                this.phone = patient.isNew ? patient.phone : 'Patient File';
                this.patientName = patient.isNew ? patient.patient : patient.patient.name;
                this.doctor = obj.extendedProps.doctor;
                this.title = obj.title;
                this.patient = obj.extendedProps.patient;
                this.patientId = obj.extendedProps.patient.patient.id
            },

            editEvent() {
                Bus.$emit('event-edit', {event: this.rawEvent});
                this.hide()
            },

            removeEvent(id) {
                Bus.$emit('event-removed',id);
            },
            deleteEvent() {
                swal.fire({
                    titleText: trans('messages.are_you_sure'),
                    text: trans('messages.confirm_delete'),
                    icon: "warning",
                    showCancelButton: true
                }).then((response) => {
                    if (response.isConfirmed) {
                        this.removeEvent(this.rawEvent.id);
                        this.hide();
                        swal.fire({
                            titleText: trans("messages.appointment_deleted"),
                            icon: "success",
                            iconColor: '#A84343',
                        });
                    } else {
                        this.hide();
                        swal.fire({
                            titleText: trans("messages.appointment_not_deleted"),
                            icon: 'success'
                        });
                    }
                });
            },
        },

        // //////////////////////

        computed: {

            event() {
                return {
                    start: this.start,
                    doctor: this.doctor,
                    patient: this.patient,
                    phone: this.phone,
                    title: this.title
                }
            }

        },

        // /////////////////////


    }
</script>