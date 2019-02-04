@extends('layouts.pages')
@section('title', 'Meruem | Gun')

@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">

	<!-- Content Header (Page header) -->
	<section class="content-header">
		<h1>
			Guns
			<small>Create Gun</small>
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
					<div class="box-header with-border">
						<h3 class="box-title">Create New Gun</h3>
					</div>

					<!-- /.box-header -->
					<!-- form start -->
					<form role="form">
						<div class="box-body">
							<div class="form-group col-xs-4">
								<label>Serial Code</label>
								<input type="text" v-model="gunSerialCode" class="form-control" id="gunSerialCode">
							</div>

							<div class="form-group col-xs-4">
								<label>Model</label>
								<input type="text" v-model="gunModel" class="form-control" id="gunModel">
							</div>

							<div class="form-group col-xs-4">
								<label>Type</label>
								<input type="text" v-model="gunType" class="form-control" id="gunType">
							</div>

						</div>
						<!-- /.box-body -->

						<div class="box-footer">
							<button type="submit" v-on:click="createGun" class="btn btn-primary bg-blue btn-flat rounded">
								Create Gun
								<div class="ripple-container"></div>
							</button>
						</div>
					</form>
				</div>
				<!-- /.box -->
			</div>
		</div>
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
			gunSerialCode: null,
			gunModel: null,
			gunType: null,
			alert: { success: null, error: null, info: null, warning: null }
		},
		methods: {
			createGun: function (e) {
				e.preventDefault();


				axios.post("{{ route('gun.create') }}", {
					gun_serial_code: this.gunSerialCode,
					gun_model: this.gunModel,
					gun_type: this.gunType,
				})
					.then(response => {
						//receive response and create alert
						switch (response.data.type) {
							case 'error':
								this.alert.error = response.data.message
								break;
							case 'success':
								this.alert.success = response.data.message
								//clear values
								this.gunSerialCode = null;
								this.gunModel = null;
								this.gunType = null;
								break;
						}
					})
					.catch(function (error) {
						console.log(error);
					});
			},
			clearAlert: function (name) {
				this.alert[name] = null;
			}
		}
	});
</script>
@endpush