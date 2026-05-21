<form action="/admin/categories/create" method="POST">
    @csrf


    <label for="name">Category Name</label>
    <input type="text" name="name" placeholder="category name">


    <button type="submit">Create</button>


</form>