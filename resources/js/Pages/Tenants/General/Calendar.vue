<template>
    <div class="card-body">
        <FullCalendar :options="calendarOptions"/>
        <add-event-modal></add-event-modal>
        <show-event-modal></show-event-modal>
    </div>
</template>


<script>
    import FullCalendar from '@fullcalendar/vue'
    import dayGridPlugin from '@fullcalendar/daygrid'
    import timeGridPlugin from '@fullcalendar/timegrid';
    import interactionPlugin from '@fullcalendar/interaction';
    import bootstrapPlugin from '@fullcalendar/bootstrap';
    import AddEventModal from '@/Jetstream/Modals/Calendar/AddEventModal'
    import ShowEventModal from '@/Jetstream/Modals/Calendar/ShowEventModal'


    export default {
        props: ['events', 'doctors'],
        components: {
            FullCalendar,
            AddEventModal,
            ShowEventModal,
        },

        // /////////////////////

        data() {
            return {
                calendarOptions: {
                    plugins: [dayGridPlugin, timeGridPlugin, interactionPlugin, bootstrapPlugin],
                    themeSystem: 'bootstrap',
                    initialView: 'timeGridWeek',
                    allDaySlot: false,
                    editable: true,
                    // displayEventTime: true,
                    events: this.events,
                    firstDay: "6",
                    selectable: true,
                    // expandRows: true,
                    dateClick: this.addEvent,
                    eventClick: this.handleEventClick,
                    // eventDrop: this.handleEventResize,
                    // eventResize: this.handleEventResize,
                    select: this.addEvent,
                    eventContent: this.eventRender,
                    slotDuration: '00:30',
                    slotMinTime: '12:00:00',
                    slotMaxTime: '24:00:00',
                    headerToolbar: {
                        start: 'title',
                        center: 'dayGridMonth timeGridWeek timeGridDay',
                        end: 'prev today next'
                    },
                },
            }
        },

        // //////////////////////

        methods: {
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
                patient.setAttribute('style', "width:100%; overflow:hidden");
                patient.appendChild(patientName);
                phone.setAttribute('class', 'fa fa-phone-square  text-left');
                phone.setAttribute('style', "width:100%; overflow:hidden");
                phone.appendChild(phoneNumbr);
                doctor.setAttribute('class', 'fa fa-user-md  text-left');
                doctor.setAttribute('style', "width:100%; overflow:hidden");
                doctor.appendChild(doctorName);

                file.setAttribute('class', 'fa fa-folder-open-o  text-left');
                file.setAttribute('style', "width:100%; overflow:hidden");
                file.appendChild(fileNumber);

                let arrayOfDomNodes = [file, patient, phone, doctor];
                return {domNodes: arrayOfDomNodes}

            },

            addEvent(args) {
                this.$modal.show('add-event-modal', {event: args, doctors: this.doctors})
            },

            handleEventClick(args) {
                this.$modal.show('show-event-modal', {event: args.event})
            },

            handleEventResize(args) {
                let newStart = args.event.start.toString().substring(0, 34);
                let newEnd = args.event.end.toString().substring(0, 34);
                let id = args.event.id;
                this.updateEvent({id: id, key: 'resize', start: newStart, end: newEnd});
            },

            removeEvent(id) {
                let event = this.events.findIndex((event)=>{ return parseInt(event.id )=== parseInt(id)});
                this.events.splice(event,1);
                let url = '/calendar/' + id ;
                axios.delete(url);
            },

            saveEvent(event) {
                this.events.push(event);
                axios.post('/calendar', event);
            },
        },

        // //////////////////////


        // /////////////////////

        mounted() {
            Bus.$on('event-edit', (data) => {
                // this.$modal.show('edit-event-modal', data)
            });

            Bus.$on('lab-order-clicked', (data) => {
                // this.$modal.show('show-lab-order', data)
            });
            Bus.$on('event-added', (data) => {
                this.saveEvent(data);
            });

            Bus.$on('event-removed', (data) => {
                this.removeEvent(data);
            });
        },

        created() {

        },

    }
</script>

<style>

    .fc .fc-timegrid-slot {
        height: 5.5em;
    }

    .fc-event-main {
        overflow: hidden;
    }


</style>







