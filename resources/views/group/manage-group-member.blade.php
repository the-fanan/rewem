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
			<!-- column -->
			<div class="col-md-12">
				<!-- add new members -->
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
		</div>
			<!-- /.row -->

			<div class="row">
          <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="box">
              <div class="box-header">
                <h3 class="box-title">Members</h3>

                <div class="box-tools">
                  <div class="input-group col-lg-12 col-md-12 col-sm-12 col-xs-10 pull-right" >
                    <input type="text" v-model="memberSearch" name="table_search" class="form-control pull-right" placeholder="Search">

                    <div class="input-group-btn">
                      <button type="submit" class="btn btn-default"><i class="fa fa-search"></i></button>
                    </div>
                  </div>
                </div>
              </div>
              <!-- /.box-header -->
              <div class="box-body table-responsive no-padding">
                <table class="table table-hover">
                  <tr>
										<th>S/N</th>
										<th>Name</th>
                    <th>Email</th>
                    <th>Status</th>
                    <th>Remove</th>
									</tr>
									
                  <tr v-for="(member, index) in groupMembers">
                    <td>${ (index + 1) }</td>
                    <td>${ member.fullname }</td>
                    <td>${ member.email }</td>
                    <td><span class="label label-primary">${ member.status }</span></td>
                    <td><button class="btn btn-primary bg-red" v-on:click="deleteMember($event, member.id, index)">Remove</button></td>
									</tr>
							
                </table>
              </div>
              <!-- /.box-body -->
            </div>
            <!-- /.box -->
          </div>
        </div>
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
			memberSearch: null,
			groupMembers: JSON.parse('{!! addslashes(json_encode($auth->group->users->all())) !!}'),
			alert: { success: null, error: null, info: null, warning: null }
		},
		watch: {
			memberSearch: function() {
				this.searchMembers()
			}
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
			searchMembers: _.debounce(function() {
				//send axios post quesry
				axios.post("{{ route('group-member.search') }}",{
						search: this.memberSearch
				}).then(response => {
						this.groupMembers = response.data;
				}).catch(function(error){
						console.log(error)
				});
			},
			 500),
			deleteMember: function (e, memberId, index) {
				e.preventDefault();
				//send axios post quesry
				axios.post("{{ route('group-member.delete') }}",{
						member_id: memberId
				}).then(response => {
							//receive response and create alert
							switch (response.data.type) {
							case 'error':
								this.alert.error = response.data.message
								break;
							case 'success':
								this.alert.success = response.data.message
								break;
						}
				}).catch(function(error){
						console.log(error)
				});

				this.groupMembers.splice(index, 1);
			},
			clearAlert: function (name) {
				this.alert[name] = null;
			}
		}
	});
</script>
@endpush
