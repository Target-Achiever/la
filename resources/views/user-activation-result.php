    
        <div class="alert alert-info">
            @if((session('success'))
                {{(session('success')}}
            @elseif(session('failed')
                {{(session('failed')}}
            @endif    
        </div>
    

