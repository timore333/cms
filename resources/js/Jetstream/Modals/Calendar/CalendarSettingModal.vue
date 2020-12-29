<template>
    <modal
            :adaptive="true"
            :resizable="false"
            :scrollable="true"
            @before-open="beforeOpen"
            height='auto'
            name="calendar-setting-modal"
            width='450px'

    >
        <div class="card border-warning" style="width:100%;height:100%;margin:0">
            <div class="card-header bg-warning">
                <h4 class="m-b-0 text-white">{{ $__('general.calendar_setting') }} <a @click="hide()" class="pull-right text-white" href="#">X</a></h4>
            </div>

            <div class="card-body">
                <!-- duration-->
                <form-group>
                    <div class="col-md-7">
                        <label for="slot-duration">{{$__('general.slot_duration')}}</label>
                    </div>
                    <div class="col-md-5">
                        <select class="form-control" id="slot-duration" v-model="setting.slotDuration">
                            <option value="00:15">15</option>
                            <option value="00:30">30</option>
                            <option value="00:45">45</option>
                            <option value="01:00">60</option>
                            <option value="01:15">75</option>
                            <option value="01:30">90</option>
                            <option value="01:45">105</option>
                            <option value="02:00">120</option>
                        </select>
                    </div>
                </form-group>

                <!-- start-->
                <form-group>
                    <div class="col-md-7">
                        <label for="slot-slotMinTime">{{$__('general.slot_start')}}</label>
                    </div>
                    <div class="col-md-5">
                        <input class="form-control" id="slot-slotMinTime" type="time" v-model="setting.slotMinTime">
                    </div>
                </form-group>
                <!--end-->
                <form-group :has-error="message">
                    <div class="col-md-7">
                        <label for="slot-slotMaxTime">{{$__('general.slot_end')}}</label>
                    </div>
                    <div class="col-md-5">
                        <input @blur="validate" class="form-control" id="slot-slotMaxTime" type="time" v-model="setting.slotMaxTime">
                        <input-error :message="message"></input-error>
                    </div>
                </form-group>

                <!-- buttons-->
                <div class="text-center">
                    <button :disabled="!canSubmit" @click="save" class="btn btn-success m-r-5">{{$__("general.save")}}</button>
                    <button @click="hide()" class="btn btn-danger m-r-5">{{$__("general.cancel")}}</button>
                </div>


            </div>
        </div>
    </modal>
</template>

<script>
    import * as moment from 'moment';
    import FormGroup from "@/Jetstream/Form/FormGroup";
    import InputText from "@/Jetstream/Form/Input/InputText";
    import FormLabel from "@/Jetstream/Form/FormLabel";
    import InputError from "@/Jetstream/Form/Input/InputError";
    import {trans} from 'matice'

    export default {
        components: {InputError, FormLabel, InputText, FormGroup},
        // /////////////////////
        data() {
            return {
                setting: {
                    slotDuration: '',
                    slotMinTime: '',
                    slotMaxTime: '',
                },

                canSubmit: true,
            }
        },

        // //////////////////////

        methods: {

            show() {
                this.$modal.show('calendar-setting-modal');
            },
            hide() {
                this.$modal.hide('calendar-setting-modal');
            },

            beforeOpen(event) {
                this.setting = event.params.setting;
            },

            save() {
                this.setting.slotMaxTime = this.lastSlotTime();
                Bus.$emit('setting-updated', this.setting);
                this.hide();
            },

            lastSlotTime() {
                let time = moment(this.setting.slotMaxTime, 'HH').add(1, 'h').format('HH:00');
                if (time === '00:00') {
                    time = '24:00'
                }
                return time;
            },

            validate() {
                let end = moment(this.setting.slotMaxTime, 'HH');
                let start = (moment(this.setting.slotMinTime, 'HH'));
                this.canSubmit = !!start.isBefore(end);
            },

        },

        // //////////////////////

        computed: {
            message() {
                let end = moment(this.setting.slotMaxTime, 'HH');
                let start = (moment(this.setting.slotMinTime, 'HH'));
                return start.isBefore(end) ? false : trans('messages.invalid_max_slot_time') + this.setting.slotDuration;
            }
        },

        // /////////////////////


    }
</script>