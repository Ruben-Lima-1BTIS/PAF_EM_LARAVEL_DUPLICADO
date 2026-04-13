@extends('layouts.auth')

@section('content')

<div class="min-h-screen bg-gray-50 py-12 px-4 sm:px-6 lg:px-8">
	<div class="max-w-6xl mx-auto">

		<div class="mb-8">
			<h1 class="text-3xl font-bold text-gray-900 mb-8">
				Hours Approval
			</h1>

			<div class="bg-white rounded-lg shadow p-6">
				<form method="GET" action="{{ route('supervisor.hour_approval') }}" id="studentForm">
					<x-select
						name="student_id"
						label="Select Student"
						:selected="$selectedStudentId"
						:options="$cleanedStudents"
						onchange="document.getElementById('studentForm').submit()" />
				</form>
			</div>
		</div>

		@if($stats)
		<!-- componentes -->
		<div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-6 gap-4 mb-8">
			<x-stat-card title="Student Name" :value="$stats['student']->name" color="gray" />
			<x-stat-card title="Pending" :value="$stats['totalPending']" color="yellow" />
			<x-stat-card title="Approved" :value="$stats['totalApproved']" color="green" />
			<x-stat-card title="Rejected" :value="$stats['totalRejected']" color="red" />
			<x-stat-card title="Total Hours Logged" :value="$stats['totalHoursLogged'].'h'" color="blue" />
			<x-stat-card title="Approved Hours" :value="$stats['approvedHoursCount'].'h'" color="green" />
		</div>


		<!-- tabelas agora são componentes -->
		
		<x-pending-hours-table :hours="$pendingHours" />
		<x-approved-hours-table :hours="$approvedHours" />

		@else
		<!-- estado vazio -->
		<x-empty-state message="Please select a student to view their hours" />

		@endif

	</div>
</div>

<!-- Modals agora são componentes -->
<x-approve-modal />
<x-reject-modal />

@endsection