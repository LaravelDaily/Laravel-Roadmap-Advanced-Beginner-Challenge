<div>
    @if(count($errors->all())>0)
        <div class="text-red-600 inline-flex float-left text-xs">{{ count($errors->all()) }} {{__('errors found.')}}</div>
    @endif
</div>
