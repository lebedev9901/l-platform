<h2 class="text-2xl font-bold mb-6">
Edit Employee
</h2>

<form method="POST" action="/employees/{{ $employee->id }}">

@csrf
@method('PUT')

<div class="mb-4">
<label>Name</label>
<input type="text" name="name" value="{{ $employee->name }}" class="w-full border p-2">
</div>

<div class="mb-4">
<label>Email</label>
<input type="email" name="email" value="{{ $employee->email }}" class="w-full border p-2">
</div>

<div class="mb-4">
<label>Role</label>

<select name="role" class="w-full border p-2">

<option value="employee" {{ $employee->role == 'employee' ? 'selected' : '' }}>
Employee
</option>

<option value="manager" {{ $employee->role == 'manager' ? 'selected' : '' }}>
Manager
</option>

</select>


    <label>Pin</label>
    <input type="text" name="pin_code" value="{{ $employee->pin_code }}" class="w-full border p-2">



</div>

<button class="bg-green-600 text-white px-4 py-2 rounded">
Update Employee
</button>

</form>