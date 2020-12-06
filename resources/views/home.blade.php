<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
          @forelse($posts as $post)
            @can('view_post', $post)
              <h1>{{$post->title}}</h1>
              <p>{{$post->description}}</p><br>
              <b>Author: {{$post->user->name}}</b><br>
              <a href='{{url("/post/$post->id/update")}}'>Editar</a>
              <hr>
            @endcan
          @empty
            <p>Nenhum Post Cadastrado!</p>
          @endforelse
        </div>
    </div>
</div>

