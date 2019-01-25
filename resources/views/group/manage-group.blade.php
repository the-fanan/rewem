@extends('layouts.pages')
@section('title', 'Meruem | Groups')
@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">

    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Groups
        <small>Manage Group</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="#">Groups</a></li>
      </ol>
    </section>
	
    <!-- Main content -->
    <section class="content" id="MainGroupContent">
	@include('includes.alert-frontend')
	<div class="row">
        <!-- left column -->
        <div class="col-md-12">
          <!-- general form elements -->
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Create New Group</h3>
			</div>
			
            <!-- /.box-header -->
            <!-- form start -->
            <form role="form">
              <div class="box-body">
				  
                <div class="form-group col-xs-4">
					<label>Group Name</label>
                 	<input type="text" v-model="groupName" class="form-control" id="groupName">
				</div>
				
                <!-- Group Country -->
                <div class="form-group col-xs-4">
                  	<label>Group Country</label>
                  	<select class="form-control" v-model="groupCountry">
						@foreach($countries as $country)
                   		<option value="{{ $country->id }}">{{ $country->name }}</option>
						@endforeach
                  </select>
				</div>
				
				<!-- Group type -->
                <div class="form-group col-xs-4">
                  	<label>Group Type</label>
                  	<select class="form-control" v-model="groupType">
                   		<option value="country">Country</option>
						<option value="company">Company</option>]
                  </select>
				</div>
				<div class="with-border col-xs-12">
					<h3 class="box-title">Admin</h3>
				</div>

				<div v-for="(admin, index) in groupAdmins">
					<div class="form-group col-xs-3" v-bind:key="index" id="index">
						<input type="email" v-model="admin.value" :placeholder="'Enter Admin ' + (index + 1) + ' email'" class="form-control">

						<button v-on:click="deleteAdmin($event, index)" class="btn btn-primary btn-small bg-red" v-if="index != 0">Remove</button>
					</div>
				</div>
				<div class="row">
					<div class="col-lg-12">
						<button v-on:click="addAdmin" class="btn btn-primary bg-blue btn-flat rounded">
							Add Admin
							<div class="ripple-container"></div>
						</button>
					</div>
				</div>
              </div>
              <!-- /.box-body -->

              <div class="box-footer">
                <button type="submit" v-on:click="createGroup" class="btn btn-primary bg-blue btn-flat rounded">
					Create Group
					<div class="ripple-container"></div>
				</button>
              </div>
            </form>
          </div>
          <!-- /.box -->
      </div>
      <!-- /.row -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
@endsection
@push('page-scripts')
<script type="text/javascript">
var vm = new Vue({
	delimiters: ['${', '}'],
	el: "#MainGroupContent",
	data: {
		erorr:null,
		groupName: null,
		groupType: null,
		groupCountry: null,
		groupAdmins: [{value: ''}],
		alert: { success: null, error: null, info: null, warning: null }
	},
	methods: {
		createGroup: function(e){
			e.preventDefault();

			
			axios.post("{{ route('group.create') }}", {
            group_name: this.groupName,
            group_type: this.groupType,
			group_country: this.groupCountry,
			group_admins: this.groupAdmins
       		 })
          	.then( response => {
             	switch (response.data.type) {
					case 'error':
						this.alert.error = response.data.message
						break;
					case 'success':
						this.alert.success = response.data.message
						//clear values
						this.groupName = null;
						this.groupType = null;
						this.groupCountry = null;
						this.groupAdmins = [{value: ''}];
				 }
         	 })
         	 .catch(function (error) {
				console.log(error);
       		 });
			//receive response and create alert
			//clear fields
		},
		addAdmin: function(e){
			e.preventDefault();
			this.groupAdmins.push({ value: '' });
		},
		deleteAdmin: function(e,index) {
			e.preventDefault();
			this.groupAdmins.splice(index, 1);
		},
		clearAlert: function(name){
			this.alert[name] = null;
		}
	}
});
</script>
@endpush