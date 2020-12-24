<template>
    <modal
            name="show-event-modal"
            :adaptive="true"
            :resizable="false"
            :scrollable="true"
            :draggable="true"
            height='auto'
            width='300'
            @before-open="beforeOpen"

    >

        <div class="card text-white bg-inverse m-0 text-right">
            <div class="card-header bg-info">
                <h4 class="m-b-0 text-white">{{ start}}<a href="#" class="pull-left text-white"
                                                          @click="hide()">X</a href="#"></h4>
            </div>
            <div class="card-body">
                <!--         <h3 class="card-title">{{ title }}</h3> -->

                <div class="card-text text-success">
                <h4 class="text-muted">{{ patientName }} &nbsp &nbsp &nbsp<span class="fa fa-address-card"></span></h4>
                <h4 class="text-muted" v-if="patient.isNew">{{ phone }} &nbsp &nbsp &nbsp<span
                        class="fa  fa-phone-square"></span></h4>
                <h4 class="text-muted" v-if="!patient.isNew">{{ patientId }} &nbsp &nbsp &nbsp<span
                        class="fa  fa-folder-open-o"></span></h4>
                <h4 class="text-muted">{{ doctor.name }} &nbsp &nbsp &nbsp<span class="fa fa-user-md"></span></h4>
                </div>
                <a href="#" class="text-success pull-left" @click.prevent="editEvent">
                    <span class="fa fa-pencil-square "></span> Edit
                </a>
                <a href="#" class="text-danger  pull-left m-l-10" @click.prevent="deleteEvent">
                    <span class="fa fa-trash"></span> Delete
                </a>


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

            ...mapActions(['removeEvent']),

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
                this.phone = patient.isNew? patient.phone: 'Patient File';
                this.patientName = patient.isNew? patient.patient: patient.patient.name;
                this.doctor = obj.extendedProps.doctor;
                this.title = obj.title;
                this.patient = obj.extendedProps.patient;
                this.patientId = obj.extendedProps.patient.patient.id
            },

            editEvent() {
                Bus.$emit('event-edit', {event: this.rawEvent});
                this.hide()
            },

            deleteEvent() {
                swal({
                    title: "Are you sure?",
                    text: "Once deleted, you will not be able to recover !",
                    icon: "warning",
                    buttons: true,
                    dangerMode: true,
                }).then((willDelete) => {
                    if (willDelete) {
                        this.removeEvent(this.rawEvent.id);
                        this.hide();
                        swal("Poof! Your appointment has been deleted!", {
                            icon: "success",
                        });
                    } else {
                        swal("Your appointment is safe!");
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