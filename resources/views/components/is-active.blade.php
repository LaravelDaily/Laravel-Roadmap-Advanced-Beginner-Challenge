<div>
    @if($status==0)
        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-red-100 text-red-800">
            {{__('Open')}}
        </span>
    @else
        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
            {{__('Closed')}}
        </span>
    @endif
</div>
