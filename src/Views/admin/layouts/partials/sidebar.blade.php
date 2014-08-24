<ul class="nav nav-sidebar">
    <li class="{{ Route::is('admin') ? 'active' : '' }}">{{link_to_route('admin', 'Dashboard')}}</li>
</ul>
<ul class="nav nav-sidebar">
    <li class="{{ Route::is('admin.users') ? 'active' : '' }}">{{link_to_route('admin.users', 'Manage Users')}}</li>
    <li class="{{ Route::is('admin.users.create') ? 'active' : '' }}">{{link_to_route('admin.users.create', 'Add User')}}</li>
</ul>
<ul class="nav nav-sidebar">
    <li class="{{ Route::is('admin.blog.posts') ? 'active' : '' }}">{{link_to_route('admin.blog.posts', 'Manage Blog')}}</li>
    <li class="{{ Route::is('admin.blog.posts.create') ? 'active' : '' }}">{{link_to_route('admin.blog.posts.create', 'Add Blog')}}</li>
</ul>
<ul class="nav nav-sidebar">
    <li class="{{ Route::is('admin.blog.categories') ? 'active' : '' }}">{{link_to_route('admin.blog.categories', 'Manage Blog Categories')}}</li>
    <li class="{{ Route::is('admin.blog.categories.create') ? 'active' : '' }}">{{link_to_route('admin.blog.categories.create', 'Add Category')}}</li>
</ul>
<ul class="nav nav-sidebar">
    <li class="{{ Route::is('admin.blog.tags') ? 'active' : '' }}">{{link_to_route('admin.blog.tags', 'Manage Blog Tags')}}</li>
    <li class="{{ Route::is('admin.blog.tags.create') ? 'active' : '' }}">{{link_to_route('admin.blog.tags.create', 'Add Tag')}}</li>
</ul>
<ul class="nav nav-sidebar">
    <li class="{{ Route::is('admin.pages') ? 'active' : '' }}">{{link_to_route('admin.pages', 'Manage Pages')}}</li>
    <li class="{{ Route::is('admin.pages.create') ? 'active' : '' }}">{{link_to_route('admin.pages.create', 'Add Page')}}</li>
</ul>