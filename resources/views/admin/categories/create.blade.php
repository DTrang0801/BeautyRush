<x-site-layout>

<form action="/admin/categories" method="POST">
    @csrf


    <label for="name">Category Name</label>
    <input type="text" name="name" placeholder="category name">


    <button type="submit">Create</button>


</form>

</x-site-layout>