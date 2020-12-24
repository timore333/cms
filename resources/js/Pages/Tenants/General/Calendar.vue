<template>
    <div>
        <FullCalendar
                defaultView="timeGridWeek"
                timeFormat='H:mm'
                axisFormat='H:mm'
                minTime='15:00'
                maxTime='23:00'
                slotLabelInterval="00:30"
                :defaultDate="defaultDate"
                timeZone='local'
                :plugins="calendarPlugins"
                :header="header"
                :events="events"
                :selectable="true"
                :editable="true"
                :firstDay="6"
                :eventTimeFormat="eventTimeFormat"
                :eventRender="eventRender"
                :displayEventTime='false'
                :eventLimitText="eventLimitText"
                :slotMinutes="30"
                :slots="slots"
                :eventLimit=true
                :allDaySlot="false"
                @select="addEvent"
                @dateClick="addEvent"
                @eventClick="handleEventClick"
                @eventDrop="handleEventResize"
                @eventResize="handleEventResize"

        />

        <edit-event-modal/>
        <add-event-modal/>
        <show-event-modal/>
        <show-lab-order></show-lab-order>

    </div>
</template>


<script>
    import * as moment from 'moment';
    import EditEventModal from './modals/EditEventModal'
    import AddEventModal from './modals/AddEventModal'
    import ShowEventModal from './modals/ShowEventModal'
    import FullCalendar from '@fullcalendar/vue'
    import dayGridPlugin from '@fullcalendar/daygrid'
    import timeGridPlugin from '@fullcalendar/timegrid';
    import listPlugin from '@fullcalendar/list';
    import interactionPlugin from '@fullcalendar/interaction';
    import {mapGetters, mapActions} from 'Vuex'

    export default {

        components: {
            FullCalendar,
            EditEventModal,
            AddEventModal
        },

        // /////////////////////

        data() {
            return {

                calendarPlugins: [dayGridPlugin, timeGridPlugin, listPlugin, interactionPlugin],
                header: {
                    'left': 'title',
                    'center': 'timeGridDay timeGridWeek dayGridMonth listWeek',
                    'right': 'prev today next'
                },
                url: '/api/calendar/',

                eventTimeFormat: [
                    {
                        hour: 'numeric',
                        minute: '2-digit',
                        meridiem: false
                    },

                    {
                        hour: 'numeric',
                        minute: '2-digit',
                        omitZeroMinute: true,
                        meridiem: 'narrow'
                    },

                    // List views. '7pm'
                    {
                        hour: 'numeric',
                        minute: '2-digit',
                        meridiem: 'short'
                    }
                ],

                slots: [
                    {start: '15:00', end: '15:30'},
                    {start: '15:30', end: '16:00'},
                    {start: '16:00', end: '16:30'},
                    {start: '16:30', end: '17:00'},
                    {start: '17:00', end: '18:00'},
                    {start: '18:00', end: '18:30'},
                    {start: '18:30', end: '19:00'},
                    {start: '19:00', end: '19:30'},
                    {start: '19:30', end: '20:00'},
                    {start: '20:00', end: '20:30'},
                    {start: '20:30', end: '21:00'},
                    {start: '21:00', end: '21:30'},
                    {start: '21:30', end: '22:00'},
                    {start: '22:00', end: '22:30'},
                    {start: '22:30', end: '23:00'}
                ],

                defaultDate: new Date(),
                hiddenDays: [5]
            }
        },

        // //////////////////////

        methods: {
            ...mapActions(['fetchEvents', 'updateEvent', 'fetchPatients', 'fetchUsers']),

            eventRender(args) {
                let data = args.event.extendedProps;
                let patientData = data.patient;
                let patientFile = patientData.isNew ? 'New Patient' : patientData.patient.id;
                let name = patientData.isNew ? patientData.patient : patientData.patient.name;
                let patientPhone = patientData.isNew ? patientData.phone : 'Patient File';


                let phone = document.createElement('span');
                let patient = document.createElement('span');
                let file = document.createElement('span');
                let doctor = document.createElement('span');


                let phoneNumbr = document.createTextNode(' ' + patientPhone);
                let patientName = document.createTextNode(' ' + name);
                let doctorName = document.createTextNode(' ' + data.doctor.name);
                let fileNumber = document.createTextNode(' ' + patientFile);

                patient.setAttribute('class', 'fa fa-address-card  text-left');
                patient.setAttribute('style', "font-size :1.3em; width:100%; margin:5px 0 0 0; overflow:hidden");
                patient.appendChild(patientName);
                phone.setAttribute('class', 'fa fa-phone-square  text-left');
                phone.setAttribute('style', "font-size :1.3em; width:100%; padding:3px;  margin:5px 0 0 0; overflow:hidden")
                phone.appendChild(phoneNumbr);
                doctor.setAttribute('class', 'fa fa-user-md  text-left');
                doctor.setAttribute('style', "font-size :1.3em; width:100%; padding:3px;  margin:5px 0 0 0; overflow:hidden")
                doctor.appendChild(doctorName);

                file.setAttribute('class', 'fa fa-folder-open-o  text-left');
                file.setAttribute('style', "font-size :1.3em; width:100%; padding:3px;  margin:5px 0 0 0; overflow:hidden")
                file.appendChild(fileNumber);

                args.el.style.marginTop = '10px';
                args.el.style.overflow = "hidden";
                args.el.appendChild(patient);
                args.el.appendChild(file);
                if (patientData.isNew) {
                    args.el.appendChild(phone);
                }
                args.el.appendChild(doctor);

            },

            addEvent(args) {

                this.$modal.show('add-event-modal', {event: args})
            },

            handleEventClick(args) {

                this.$modal.show('show-event-modal', {event: args.event})
            },

            handleEventResize(args) {
                let newStart = args.event.start.toString().substring(0, 34)
                let newEnd = args.event.end.toString().substring(0, 34)
                let id = args.event.id
                this.updateEvent({id: id, key: 'resize', start: newStart, end: newEnd});
            },

            eventLimitText(num) {
                return '++' + num + " Appointments"
            },
        },

        // //////////////////////

        computed: mapGetters(['events']),

        // /////////////////////

        mounted() {
            Bus.$on('event-edit', (data) => {
                this.$modal.show('edit-event-modal', data)
            });

            Bus.$on('lab-order-clicked', (data) => {
                this.$modal.show('show-lab-order', data)
            });
        },

        created() {
            this.fetchEvents();
            this.fetchPatients();
            this.fetchUsers();
        },

    }
</script>

<style>
    @import '~@fullcalendar/core/main.css';
    @import '~@fullcalendar/daygrid/main.css';
    @import '~@fullcalendar/timegrid/main.css';

    .fc-time-grid .fc-slats td {
        height: 5em;
        border-bottom: 0;
        /* each cell is responsible for its top border */
    }


    .fc-time-grid {
        min-height: 100%;
        /* so if height setting is 'auto', .fc-bg stretches to fill height */
    }


    .fc-time-grid-event .fc-content {
        overflow: hidden;
        max-height: 100%;
    }


    .fc-time-grid-event .fc-time {
        font-size: 0.85em;
        white-space: nowrap;
        /*/ shange the time size */
    }

    .fc-time-grid-event.fc-short .fc-title {
        font-size: 0.85em;
        /* make the title text the same size as the time */
        padding: 0;
        /* undo padding from above */
    }


    .fc-time-grid-event.fc-short .fc-time:before {
        content: attr(data-start);
        /* ...instead, display only the start time */
    }

    a.fc-more {
        margin: 1px 3px;
        font-size: 2em;
        cursor: pointer;
        text-decoration: none;
    }


</style>


<!-- :timeGridEventMinHeight="175" -->




