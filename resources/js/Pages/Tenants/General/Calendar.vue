<template>
    <div class="card-body">
        <FullCalendar :options="calendarOptions"/>
        <add-event-modal></add-event-modal>
        <show-event-modal></show-event-modal>
        <edit-event-modal></edit-event-modal>
        <calendar-setting-modal></calendar-setting-modal>
    </div>
</template>


<script>
    import FullCalendar from '@fullcalendar/vue'
    import dayGridPlugin from '@fullcalendar/daygrid'
    import timeGridPlugin from '@fullcalendar/timegrid';
    import interactionPlugin from '@fullcalendar/interaction';
    import bootstrapPlugin from '@fullcalendar/bootstrap';
    import arLocale from '@fullcalendar/core/locales/ar';
    import enLocale from '@fullcalendar/core/locales/en-au';
    import AddEventModal from '@/Jetstream/Modals/Calendar/AddEventModal'
    import ShowEventModal from '@/Jetstream/Modals/Calendar/ShowEventModal'
    import EditEventModal from '@/Jetstream/Modals/Calendar/EditEventModal'
    import CalendarSettingModal from '@/Jetstream/Modals/Calendar/CalendarSettingModal'


    export default {
        props: ['events', 'doctors', 'patients', 'locale', 'slotDuration', 'slotMinTime', 'slotMaxTime'],
        components: {
            FullCalendar,
            AddEventModal,
            ShowEventModal,
            EditEventModal,
            CalendarSettingModal,
        },

        // /////////////////////

        data() {
            return {
                calendarOptions: {
                    plugins: [dayGridPlugin, timeGridPlugin, interactionPlugin, bootstrapPlugin],
                    themeSystem: 'bootstrap',
                    initialView: 'timeGridWeek',
                    locale: this.locale === 'ar' ? arLocale : enLocale,
                    allDaySlot: false,
                    editable: true,
                    displayEventTime: true,
                    events: this.events,
                    firstDay: "6",
                    selectable: true,
                    expandRows: true,
                    dateClick: this.addEvent,
                    eventClick: this.handleEventClick,
                    eventDrop: this.handleEventResize,
                    eventResize: this.handleEventResize,
                    select: this.addEvent,
                    eventContent: this.eventRender,
                    slotDuration: this.slotDuration,
                    slotMinTime: this.slotMinTime,
                    slotMaxTime: this.slotMaxTime,
                    headerToolbar: {
                        start: 'title',
                        center: 'dayGridMonth timeGridWeek timeGridDay',
                        end: 'prev today next setting'
                    },
                    customButtons: {
                        setting: {
                            click:  () => {
                                  this.$modal.show('calendar-setting-modal', {setting:{slotDuration:this.slotDuration, slotMinTime:this.slotMinTime, slotMaxTime:this.slotMaxTime}})
                            }
                        }
                    },
                    bootstrapFontAwesome:{
                        setting:'fa-cog'
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
                let patientPhone = patientData.isNew ? patientData.phone : ' ';

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

                let arrayOfDomNodes = [file, patient, doctor];

                if (patientData.isNew) {
                    arrayOfDomNodes.push(phone);
                }
                ;

                return {domNodes: arrayOfDomNodes}
            },

            addEvent(args) {
                this.$modal.show('add-event-modal', {event: args, doctors: this.doctors, patients: this.patients})
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
                let event = this.events.findIndex((event) => {
                    return parseInt(event.id) === parseInt(id)
                });
                this.events.splice(event, 1);
                let url = '/calendar/' + id;
                axios.delete(url);
            },

            saveEvent(event) {
                this.events.push(event);
                axios.post('/calendar', event);
            },

            updateEvent(data) {
                let url = '/calendar/' + data.id;
                axios.put(url, data).then(resp => Window.location.reload());
            },
            updateSetting(data){
                axios.post('setting',data).then(resp=>{ window.location.reload()})
            },
        },

        // //////////////////////


        // /////////////////////

        mounted() {
            Bus.$on('event-edit', (data) => {
                this.$modal.show('edit-event-modal', {event: data, doctors: this.doctors, patients: this.patients})
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

            Bus.$on('setting-updated', (data) => {
                this.updateSetting(data);
            });
        },

        created() {

        },

    }
</script>

<style>

    .fc .fc-timegrid-slot {
        height: 4.5em;
    }

    .fc-event-main {
        overflow: hidden;
    }

    :root {
        /*--fc-non-business-color: rgba(215, 215, 215, 0.3);*/
        /*--fc-bg-event-color: rgb(143, 223, 130);*/
        /*--fc-bg-event-opacity: 0.3;*/
        /*--fc-highlight-color: rgba(188, 232, 241, 0.3);*/
        --fc-today-bg-color: '#D55353';

    }
</style>







