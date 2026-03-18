
<h2 class="text-2xl font-bold mb-6">
Add Employee
</h2>

<form method="POST" action="/employees">

@csrf

<div class="mb-4">
<label>Name</label>
<input type="text" name="name" class="w-full border p-2">
</div>

<div class="mb-4">
<label>Email</label>
<input type="email" name="email" class="w-full border p-2">
</div>

<div class="mb-4">
<label>Role</label>

<select name="role" class="w-full border p-2">

<option value="Сотрудник">Сотрудник</option>
<option value="Менэджер">Менэджер</option>

</select>


<label>Pin</label>
<input type="text" name="pin_code" class="w-full border p-2">



</div>

<button class="bg-green-600 text-white px-4 py-2 rounded">
Save Employee
</button>

</form>

