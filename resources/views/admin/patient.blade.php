<x-adminlayouts.app>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Patients') }}
        </h2>
    </x-slot>
    @if (session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
    @endif
    <style>
        .pending-status {
            color: red;
        }

        .approved-status {
            color: green;
        }
    </style>

    <div class="container mx-auto mt-9">
        <table class="min-w-full mt-4 border-collapse" style="width: 1000px;">
            <thead class="bg-gray-100">
                <tr>
                    <th class="px-2 py-2 border">ID</th>
                    <th class="px-2 py-2 border">First Name</th>
                    <th class="px-2 py-2 border">Last Name</th>
                    <th class="px-2 py-2 border">Contact Number</th>
                    <th class="px-2 py-2 border">Email</th>
                    <th class="px-2 py-2 border">Appointment Date</th>
                    <th class="px-2 py-2 border">Address</th>
                    <th class="px-2 py-2 border">Status</th>
                    <th class="px-2 py-2 border"></th>
                    <th class="px-2 py-2 border"></th>
                </tr>
            </thead>
            <tbody>
                @foreach ($appointments as $appointment)
                <tr>
                    <td class="px-2 py-2 border">{{ $appointment->id }}</td>
                    <td class="px-2 py-2 border">{{ $appointment->first_name }}</td>
                    <td class="px-2 py-2 border">{{ $appointment->last_name }}</td>
                    <td class="px-2 py-2 border">{{ $appointment->contact_number }}</td>
                    <td class="px-2 py-2 border">{{ $appointment->email }}</td>
                    <td class="px-2 py-2 border">{{ $appointment->appointment_date }}</td>
                    <td class="px-2 py-2 border">{{ $appointment->address }}</td>
                    <td class="px-2 py-2 border 
    {{ $appointment->status == 'Pending' ? 'pending-status' : 'approved-status' }}">
                        {{ $appointment->status }}
                    </td>

                    <td class="px-2 py-2 border text-center">
                        @if ($appointment->status == 'Pending')
                        <form action="{{ route('appointments.approve', $appointment->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('PATCH')
                            <button type="submit" class="btn btn-success">Approve</button>
                        </form>
                        @endif
                    </td>

                    <td class="px-2 py-2 border text-center">
                        <!-- Check if the appointment status is neither 'Done' nor 'Approved' -->
                        @if ($appointment->status !== 'Done' && $appointment->status !== 'Approved')
                        <form action="{{ route('appointments.cancel', $appointment->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('PATCH')
                            <button type="submit" class="btn btn-danger">Cancel</button>
                        </form>
                        @else
                        <span>Completed</span> <!-- Show this if the status is 'Done' or 'Approved' -->
                        @endif
                    </td>

                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</x-adminlayouts.app>