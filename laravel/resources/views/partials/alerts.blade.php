@if( isset($errors) && count($errors) > 0)
    <div class="alert alert-danger alert-dismissible auto-dismiss">
        <ul class="list-unstyled mb-0">
            @foreach($errors->all() as $error)
                <li><i class="icon-cross-circle"></i> {!! $error !!}</li>
            @endforeach
        </ul>
    </div>
@endif

@if(Session::get('success', false))
    <?php $data = Session::get('success'); ?>
    @if (is_array($data))
        @foreach ($data as $msg)
            <div class="alert alert-success alert-dismissible auto-dismiss" >
                <i class="fa"></i> {!! $msg !!}
            </div>
        @endforeach
    @else
        <div class="alert alert-success alert-dismissible auto-dismiss" >
            <i class="icon-checkmark-circle"></i> {!! $data !!}
        </div>
    @endif
@endif
