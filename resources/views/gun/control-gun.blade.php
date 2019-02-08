@extends('layouts.pages')
@section('title', 'Meruem | Gun')

@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">

	<!-- Content Header (Page header) -->
	<section class="content-header">
		<h1>
			Guns
			<small>Control Gun</small>
		</h1>
		<ol class="breadcrumb">
			<li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
			<li><a href="#">Guns</a></li>
		</ol>
	</section>

	<!-- Main content -->
	<section class="content" id="MainGunContent">
		@include('includes.alert-frontend')

		<div class="row">
			<div class="col-md-12">
				<!-- general form elements -->
				<div class="box box-primary">
				<div class="box-header">
					<h3 class="box-title">Guns</h3>

					<div class="box-tools">
						<div class="input-group col-lg-12 col-md-12 col-sm-12 col-xs-10 pull-right" >
							<input type="text" v-model="gunSearch" name="table_search" class="form-control pull-right" placeholder="Search">

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
							<th>Serial Code</th>
							<th>Model</th>
							<th>Type</th>
							<th>Action</th>
						</tr>
						
						<tr v-cloak v-for="(gun, index) in groupGuns">
							<td>${ (index + 1) }</td>
							<td>${ gun.serial_code }</td>
							<td>${ gun.model }</td>
							<td>${ gun.type }</td>
							<td><button class="btn btn-primary bg-blue" v-on:click="editGun($event, gun)">Edit</button></td>
						</tr>
				
					</table>
				</div>
				<!-- /.box-body -->
				</div>
				<!-- /.box -->
			</div>
		</div>

		<div class="modal show" v-cloak data-backdrop="false" id="modal-default" v-if="showModal">
			<div class="modal-dialog">
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" v-on:click="closeModal">
							<span aria-hidden="true">&times;</span></button>
						<h4 class="modal-title">Update Gun Parameters</h4>
					</div>
					<div class="modal-body">
						
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-default pull-left bg-red" v-on:click="deleteGun">Delete Gun</button>
						<button type="button" class="btn btn-primary bg-blue" v-on:click="updateGunParameters">Update Gun</button>
					</div>
				</div>
				<!-- /.modal-content -->
			</div>
			<!-- /.modal-dialog -->
		</div>
		<!-- /.modal -->
				
	</section>
	<!-- /.content -->
		
</div>
@endsection

@push('page-scripts')
<script type="text/javascript">
var vm = new Vue({
		delimiters: ['${', '}'],
		el: "#MainGunContent",
		data: {
			erorr: null,
			gunSearch: null,
			currentGun: null,
			groupGuns: JSON.parse('{!! addslashes(json_encode($auth->group->guns->all())) !!}'),
			showModal: false,
			alert: { success: null, error: null, info: null, warning: null }
		},
		watch: {
			gunSearch: function() {
				this.searchGuns()
			}
		},
		methods: {
			closeModal: function() {
				this.showModal = false;
			},
			editGun: function (e, gun) {
				e.preventDefault();
				this.showModal = true;
				this.currentGun = gun;
			},
			updateGunParameters: function (e, gun) {
				e.preventDefault();
				alert(JSON.stringify(this.currentGun));
			/*	axios.post("{{ route('gun.update') }}", {
					
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
								
								break;
						}
					})
					.catch(function (error) {
						console.log(error);
					});*/
			},
			searchGuns: _.debounce(function() {
						//send axios post quesry
						axios.post("{{ route('gun.search') }}",{
								search: this.gunSearch
						}).then(response => {
								this.groupGuns = response.data;
						}).catch(function(error){
								console.log(error)
						});
			}, 500),
			deleteGun: function (e, index) {
				e.preventDefault();

			},
			clearAlert: function (name) {
				this.alert[name] = null;
			}
		}
	});
</script>
@endpush