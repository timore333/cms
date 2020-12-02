<template>
    <div class="m-t-30">
        <h5 class="box-title">Phones</h5>
        <hr class="m-t-0 m-b-20">
        <!-- form -->
        <div class="row">
            <div class="col-md-4">
                <div :class="{'has-danger': errors.type}" class="form-group">
                    <select @change="clearError('type')" class="form-control-sm form-control custom-select" v-model="phone.type">
                        <option selected value="mobile">Mobile</option>
                        <option value="home">Home</option>
                        <option value="work">Work</option>
                        <option value="fax">Fax</option>
                    </select>
                </div>
            </div>
            <!--/span-->
            <div class="col-md-4">
                <div :class="{'has-danger': errors.number}" class="form-group">
                    <input
                            :class="{'form-control-danger': errors.number}"
                            @blur="validate('number')"
                            @keyup="clearError('number')"
                            class="form-control form-control-sm"
                            placeholder="Number"
                            type="text"
                            v-model="phone.number"
                    >
                </div>
            </div>

            <div class="col-md-2">
                <button :disabled="!canAddPhone" @click.prevent="addPhone()" class="btn btn-outline-primary waves-effect waves-light btn-xs">
                    <span class="btn-label"><i class="fa fa-check"></i></span>Add
                </button>
            </div>
        </div>

    </div>
</template>

<script>
    export default {
        data() {
            return {
                phone: {
                    type: 'mobile',
                    number: ''
                },
                errors: {
                    number: false,
                    type: false,
                },
            }
        },

        methods: {
            addPhone() {
                Bus.$emit('phone-added', this.phone);
                this.phone = {
                    type: 'mobile',
                    number: ''
                };
            },

            validate(key) {
                if (isNaN(this.phone[key]) || parseInt(this.phone[key]) <= 0) {
                    this.errors[key] = true;
                    return false;
                }
                return true
            },

            clearError(error) {
                this.errors[error] = false
            },

        },
        computed: {
            canAddPhone() {
                return !this.errors.number && this.phone.number && this.phone.type;
            },


        }
    }
</script>
