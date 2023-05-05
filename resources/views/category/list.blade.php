@foreach($categories as $category)
<div>{{$category->name}}</div>
<div><a href="category/{{$category->id}}">{{$category->name}}</a></div>
@endforeach