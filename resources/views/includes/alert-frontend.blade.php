{{-- error --}}
    <div class="alert alert-danger" v-if="alert.error != null">
        <button type="button" class="close" v-on:click="clearAlert('error')" aria-hidden="true">×</button>
        <i class="glyphicon glyphicon-ban-circle alert-icon "></i>
        <strong>Error Occurred!</strong> ${ alert.error }
    </div>
{{-- sucess --}}

    <div class="alert alert-success" v-if="alert.success != null">
        <button type="button" class="close" v-on:click="clearAlert('success')" aria-hidden="true">×</button>
        <strong>Success!</strong> ${ alert.success }
    </div>
{{-- info --}}
    <div class="alert alert-info" v-if="alert.info != null">
        <button type="button" class="close" dv-on:click="clearAlert('info')" aria-hidden="true">×</button>
        <i class="glyphicon glyphicon-exclamation-sign alert-icon "></i>
        ${ alert.info }
    </div>
{{-- warning --}}
    <div class="alert alert-warning" v-if="alert.warning != null">
        <button type="button" class="close" v-on:click="clearAlert('warning')" aria-hidden="true">×</button>
        <i class="glyphicon glyphicon-question-sign alert-icon "></i>
        <strong>Notice!</strong> ${ alert.warning }
    </div>
{{-- many errors --}}
    <!--div class="alert alert-danger  ">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
        <i class="glyphicon glyphicon-ban-circle alert-icon "></i>
        <strong>Error Occurred!</strong>
        <ul>
            
           
        </ul>
    </div-->
