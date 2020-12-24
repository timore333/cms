<template>
<modal 
name="add-image"
:adaptive="true"
:resizable="true"
:scrollable="true"

height='auto'
@before-open="beforeOpen"
>

<div class="card m-0">
    <div class="card-body">
        <h3 class="card-title">{{$__('general.add_image')}}<a href="#" class="pull-right" @click="hide()">X</a href="#"></h3>
        <p class="card-text">{{$__('messages.select_image')}}</p>

    <div class="form-group row">
            <label class="control-label text-right col-md-3">{{$__('general.image')}}</label>
            <div class="form-group col-md-9 ">
                <div class="fileinput fileinput-new input-group" data-provides="fileinput">
                    <div class="form-control m-r-5" data-trigger="fileinput"> <i class="glyphicon glyphicon-file fileinput-exists"></i> <span class="fileinput-filename"></span>
                    </div> <span class="input-group-addon btn btn-default btn-file"> <span class="fileinput-new">Select file s</span> <span class="fileinput-exists">Change</span>
                    <input type="hidden"><input type="file" @change="saveImage" > </span> <a href="javascript:void(0)" class="input-group-addon btn btn-default fileinput-exists" data-dismiss="fileinput">Remove</a>
                </div>
            </div>
        </div>

            <a href="" class="btn btn-primary btn-block" @click.prevent="addImage">{{$__('general.add')}}</a>

    </div>
</div>

</modal>
</template>

<!-- ************************************************************************************************ -->
<script>

export default {

  props:[],
///////////////////////////////////////////
  data() {
    return {

        image:'',
        flag:'', // define wich component request to add image 

    }
  },

///////////////////////////////////////////
    methods:{
        beforeOpen(data){
            this.flag = data.params.flag
        },

        show () {
            this.$modal.show('add-image');
        },

        hide () {
            this.$modal.hide('add-image');
        },

        saveImage(e){
            let files = e.target.files || e.dataTransfer.files;
            if (!files.length)
            return;
            this.createImage(files[0]);
        },

        createImage(file) {
             let reader = new FileReader();
             reader.readAsDataURL(file);
            reader.onload = (e) => {
                this.image = e.target.result;
            };
            
        },

        addImage(){
            Bus.$emit('image-added',{image:this.image, flag:this.flag});
            this.hide()
        },


    },

};

</script>

