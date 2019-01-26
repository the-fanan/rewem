@extends('layouts.pages')
@section('title', 'Meruem | Group Members')
@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
	<!-- Content Header (Page header) -->
	<section class="content-header">
		<h1>
			Group {{ $auth->group->name }}
			<small>Manage {{ $auth->group->name }}'s Members</small>
		</h1>
		<ol class="breadcrumb">
			<li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
			<li><a href="#">Group Members</a></li>
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
						<h3 class="box-title">Add New Member</h3>
					</div>

					<!-- /.box-header -->
					<!-- form start -->
					<form role="form">
						<div class="box-body">

							<div class="form-group col-xs-4">
								<label>Name</label>
								<input type="text" v-model="memberName" class="form-control" id="memberName">
							</div>

							<div class="form-group col-xs-4">
								<label>Email</label>
								<input type="email" v-model="memberEmail" class="form-control" id="memberEmail">
							</div>
							<!-- Group type -->
							<div class="form-group col-xs-4">
								<label>Member Role</label>
								<select class="form-control" v-model="memberRole">
									@foreach($roles as $role)
									<option value="{{ $role->name }}">{{ ucfirst(str_replace('-',' ',$role->name)) }}</option>
									@endforeach
								</select>
							</div>
						</div>
						<!-- /.box-body -->

						<div class="box-footer">
							<button type="submit" v-on:click="createGroupMember" class="btn btn-primary bg-blue btn-flat rounded">
								Create Group Member
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
			erorr: null,
			memberName: null,
			memberEmail: null,
			memberRole: null,
			alert: { success: null, error: null, info: null, warning: null }
		},
		methods: {
			createGroupMember: function (e) {
				e.preventDefault();

				axios.post("{{ route('group-member.create') }}", {
						member_name: this.memberName,
						member_email: this.memberEmail,
						member_role: this.memberRole
				})
					.then(response => {
						//receive response and create alert
						switch (response.data.type) {
							case 'error':
								this.alert.error = response.data.message
								break;
							case 'success':
								this.alert.success = response.data.message
								//clear fields
								this.memberName = null;
								this.memberEmail= null;
								this.memberRole = null;
								break;
						}
					})
					.catch(function (error) {
						console.log(error);
					});
			},
			addAdmin: function (e) {
				e.preventDefault();

			},
			deleteAdmin: function (e, index) {
				e.preventDefault();

			},
			clearAlert: function (name) {
				this.alert[name] = null;
			}
		}
	});
</script>
@endpush