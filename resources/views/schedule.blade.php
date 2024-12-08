<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('My Schedule') }}
        </h2>
    </x-slot>
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
                        <!-- Check if the appointment status is neither 'Pending' nor 'Done' -->
                        @if ($appointment->status !== 'Pending' && $appointment->status !== 'Done')
                        <form action="{{ route('appointments.markAsDone', $appointment->id) }}" method="POST">
                            @csrf
                            @method('PATCH')
                            <button type="submit" class="btn btn-success">Done</button>
                        </form>
                        @elseif ($appointment->status === 'Done')
                        <span>Completed</span>
                        @endif
                    </td>

                    <td class="px-2 py-2 border text-center">
                        <!-- Check if the appointment status is neither 'Approved' nor 'Done' -->
                        @if ($appointment->status !== 'Approved' && $appointment->status !== 'Done')
                        <form action="{{ route('appointments.cancel', $appointment->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('PATCH')
                            <button type="submit" class="btn btn-danger">Cancel</button>
                        </form>
                        @else
                        <span>Completed</span>
                        @endif
                    </td>



                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</x-app-layout>